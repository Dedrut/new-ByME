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
        Schema::create('user', function (Blueprint $table) {
            $table->integer('id_user')->autoIncrement();
            $table->string('nama_lengkap', 30);
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('userType');
            $table->string('notelp', 20);
            $table->string('alamat', 150);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
