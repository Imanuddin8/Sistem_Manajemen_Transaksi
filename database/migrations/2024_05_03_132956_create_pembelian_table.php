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
    Schema::create('pembelian', function (Blueprint $table) {
      $table->id();
      $table
        ->foreignId('produk_id')
        ->constrained('produks')
        ->onDelete('cascade');
      $table->integer('jumlah');
      $table->integer('total');
      $table->string('metode_pembayaran');
      $table->datetime('tanggal');
      $table
      ->foreignId('user_id')
      ->constrained('users')
      ->onDelete('cascade');
      $table->string('catatan');
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists('pembelian');
  }
};
