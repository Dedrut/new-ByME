<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembelian', function (Blueprint $table) {
            $table->integer('id_pembelian')->autoIncrement();
            $table->integer('id_user');
            $table->integer('id_produk');
            $table->integer('id_order');
            $table->integer('jumlah');
            $table->string('status_pengiriman');
            $table->timestamps();

            $table->foreign('id_user')->references('id_user')->on('user')->onDelete('cascade');
            $table->foreign('id_produk')->references('id_produk')->on('product')->onDelete('cascade');
            $table->foreign('id_order')->references('id_order')->on('orders')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelians');
    }
};
