<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create('penjualan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('produk_id')
              ->constrained('produks')
              ->onDelete('cascade');
        $table->string('no');
        $table->string('struk');
        $table->integer('jumlah');
        $table->integer('total');
        $table->integer('keuntungan');
        $table->string('metode_pembayaran');
        $table->datetime('tanggal');
        $table->foreignId('user_id')
              ->nullable()
              ->constrained('users')
              ->onDelete('set null');
        $table->string('catatan');
        $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('penjualan');
  }
};
