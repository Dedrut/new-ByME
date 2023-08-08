<?php

namespace App\Http\Controllers;

use App\Models\order;
use App\Models\cart;
use App\Models\pembelian;
use App\Models\product;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Xendit\Xendit;
use GuzzleHttp\Client;


class TransaksiController extends Controller
{

    //XENDIT PROCESS SECTION
    public function membuatVirtualAccount($external_id)
    {
        Xendit::setApiKey('xnd_development_e0PZ7oQDdh5kclwPr4ZrxDOsEyTTKHm4XYFt4bEUXwTioDKRJqFijR8OHYkMBhgE');

        $order = order::where('external_id', $external_id)->first();
        if (empty($order) || $order === null) {
            abort(404);
        }

        $params = [ 
            'external_id' => $external_id,
            'bank_code' => $order->metode_pembayaran,
            'name' => Auth::user()->nama_lengkap,
            'country' => 'ID',
            'currency' => 'IDR',
            'is_single_use' => true,
            'is_closed' => true,
            'expected_amount' => $order->total_harga,
            'expiration_date' => Carbon::now()->addDay()->format('Y-m-d\TH:i:s\Z'),
        ];
      
        $createVA = \Xendit\VirtualAccounts::create($params);

        if ($order->id_va === null) {
            order::where('external_id', $external_id)->update([
                'id_va' => $createVA['id'],
            ]);
        }

        return $createVA;
    }


    public function getVirtualAccount($external_id)
    {
        Xendit::setApiKey('xnd_development_e0PZ7oQDdh5kclwPr4ZrxDOsEyTTKHm4XYFt4bEUXwTioDKRJqFijR8OHYkMBhgE');

        $order = order::where('external_id', $external_id)->first();
        if (empty($order) || $order === null) {
            abort(404);
        }


        $id = $order->id_va;
        $getVA = \Xendit\VirtualAccounts::retrieve($id);

        return $getVA;
    }


    public function getPaidVirtualAccount($external_id)
    {
        Xendit::setApiKey('xnd_development_e0PZ7oQDdh5kclwPr4ZrxDOsEyTTKHm4XYFt4bEUXwTioDKRJqFijR8OHYkMBhgE');

        $order = order::where('external_id', $external_id)->first();
        if (empty($order) || $order === null) {
            abort(404);
        }


        $paymentID = $order->id_va;
        $getFVAPayment = \Xendit\VirtualAccounts::getFVAPayment($paymentID);


        return $getFVAPayment;
    }


    public function callbackVirtualAccount(Request $request)
    {
        $data = $request->all();
        $id_va = $data['id'];
        $external_id = $data['external_id'];

        if ($data['status'] === 'INACTIVE') {
            $order = order::where('external_id', $external_id)->first();
            $cart = cart::where('id_order', $order->id_order)->get();
            foreach ($cart as $item) { 
                $product = product::findOrFail($item->id_produk);
                $product->jumlah += $item->quantity;
                $product->save();
            }

            order::where('external_id', $external_id)->delete();
        }

        return response()->json($data);
    }


    public function callbackPembayaran(Request $request)
    {
        $data = $request->all();
        $external_id = $data['external_id'];
        $payment_id = $data['payment_id'];
        
        order::where('external_id', $external_id)->update([
            'status_order' => 'SUKSES',
            'status_pengiriman' => 'Dalam Proses',
            'id_va' => $payment_id,
        ]);


        return response()->json($data);
    }
    //END OF XENDIT PROCESS



    //TRANSACTION PROCESS
    public function prosesTransaksi(Request $request) {
        $metodePembayaran = $request->metodePembayaran;
        $kurir = $request->kurir;
        if ($metodePembayaran === null || $metodePembayaran === "") {
            return back()->withErrors("Metode Pembayaran tidak valid.");
        }
        if ($kurir === null || $kurir === "") {
            return back()->withErrors("Kurir tidak valid.");
        }


        $tglSekarang = Carbon::now()->format('Y-m-d');
        $now = Carbon::now();
        

        $items = Cart::where('id_user', Auth::user()->id_user)->where('status_produk', 'not purchased')->with('product')->get();
        $subtotal = $items->sum(function ($item) {
            return $item->product->harga * $item->quantity;
        });


        $ongkir = 0;
        switch ($kurir) {
            case 'JNE':
                $ongkir = 9000;
                break;

            case 'J&T':
                $ongkir = 8000;
                break;

            case 'Sicepat':
                $ongkir = 11500;
                break;

            case 'AnterAja':
                $ongkir = 11500;
                break;
            
            default:
                abort(404);
                break;
        }
        $total = $subtotal + $ongkir;


        $orderTerakhir = order::orderBy('created_at', 'desc')->first();
        $order = new order([
            'id_user' => Auth::user()->id_user,
            'total_harga'=> $total,
            'status_order' => 'PENDING',
            'metode_pembayaran' => $metodePembayaran,
            'kurir' => $kurir,         
        ]);

        if ($orderTerakhir && (substr($orderTerakhir->created_at, 0, -9) === $tglSekarang)) {
            $nomorTerakhir = intval(substr($orderTerakhir->external_id, 6, -9));
            $nomorTransaksi = $nomorTerakhir + 1;
        } else {
            $nomorTransaksi = 1;
        }

        switch ($metodePembayaran) {
            case "BNI":
                $order->external_id = "BNI-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
                $order->save();
              break;
            case "MANDIRI":
                $order->external_id = "MAN-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
                $order->save();
              break;
            case "BJB":
              $order->external_id = "BJB-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
              $order->save();
            break;
            case "BRI":
              $order->external_id = "BRI-VA" . $nomorTransaksi . Auth::user()->id_user . date('Ymd');
              $order->save();
            break;
            default:
              return redirect()->back()->withErrors('Metode pembayaran tidak valid');
        }


        switch ($order->kurir) {
            case 'JNE':
                $order->no_resi = "TJE" . $now->format('udny') . Auth::user()->id_user . $order->id_order;
                $order->save(); 
                break;

            case 'J&T':
                $order->no_resi = "JP" . $now->format('udny') . Auth::user()->id_user . $order->id_order;
                $order->save(); 
                break;

            case 'Sicepat':
                $order->no_resi = "00" . $now->format('udny') . Auth::user()->id_user . $order->id_order;
                $order->save(); 
                break;

            case 'AnterAja':
                $order->no_resi = "1001" . $now->format('udny') . Auth::user()->id_user . $order->id_order;
                $order->save(); 
                break;
            
            default:
                return redirect()->back()->withErrors('Metode pembayaran tidak valid');
        }
        $order->save();        

        
        $listItems = cart::where('id_user', Auth::user()->id_user)->where('status_produk', 'not purchased')->get();        
        foreach ($listItems as $item) { 
            $item->id_order = $order->id_order;           
            $item->status_produk = 'on hold';
            
            
            $product = product::findOrFail($item->id_produk);
            $product->jumlah -= $item->quantity;
            $product->save();
            $item->save();

        }        
        
        return redirect()->route('pembayaran', $order->external_id);
    }


    public function prosesPembayaran($external_id) {
        $order = order::where('external_id', $external_id)->where('id_user', Auth::user()->id_user)->first();
        if (empty($order) || $order === null) {
            abort(404);
        }


        $listItem = cart::where('id_order', $order->id_order)->where('id_user', Auth::user()->id_user)->get();

        if ($order->id_va === null) {
            $this->membuatVirtualAccount($external_id);
            
        }

        if ($order->status_order === 'SUKSES') {
            $virtualAcc = $this->getPaidVirtualAccount($external_id);
            return view('frontend.detailPesanan', compact('virtualAcc', 'order', 'listItem'));
        }

        $virtualAcc = $this->getVirtualAccount($external_id);
        return view('frontend.detailPesanan', compact('virtualAcc', 'order', 'listItem'));
    }



    public function historyTransaksi(){
        $orders = order::where('id_user', Auth::user()->id_user)->get();
        return view('frontend.historyTransaksi', compact('orders'));
    }
}
