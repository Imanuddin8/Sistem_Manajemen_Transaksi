<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produks')->insert([
            'nama_produk' => 'kartu perdana telkomsel',
            'harga_beli' => '10000',
            'harga_jual' => '12000',
            'kategori' => 'kartu',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'earphone',
            'harga_beli' => '12000',
            'harga_jual' => '15000',
            'kategori' => 'aksessoris',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'pelindung layar',
            'harga_beli' => '9000',
            'harga_jual' => '10000',
            'kategori' => 'aksessoris',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'case hp',
            'harga_beli' => '9000',
            'harga_jual' => '10000',
            'kategori' => 'aksessoris',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'vocher 5gb telkomsel',
            'harga_beli' => '20000',
            'harga_jual' => '23000',
            'kategori' => 'vocher',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'vocher 5gb indosat',
            'harga_beli' => '12000',
            'harga_jual' => '15000',
            'kategori' => 'vocher',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'vocher 5gb xl',
            'harga_beli' => '12000',
            'harga_jual' => '15000',
            'kategori' => 'vocher',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'kartu perdana xl',
            'harga_beli' => '9000',
            'harga_jual' => '11000',
            'kategori' => 'kartu',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'kartu perdana indosat',
            'harga_beli' => '8000',
            'harga_jual' => '10000',
            'kategori' => 'kartu',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'pulsa',
            'harga_beli' => '0',
            'harga_jual' => '2000',
            'kategori' => 'saldo',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'token listrik',
            'harga_beli' => '0',
            'harga_jual' => '2000',
            'kategori' => 'saldo',
            'stok' => '0',
        ]);
        DB::table('produks')->insert([
            'nama_produk' => 'saldo',
            'harga_beli' => '0',
            'harga_jual' => '0',
            'kategori' => 'saldo',
            'stok' => '0',
        ]);
        DB::table('users')->insert([
            'nama' => 'Imanuddin',
            'username' => 'iman',
            'password' => bcrypt('1234'),
            'role' => 'admin'
        ]);
        DB::table('users')->insert([
            'nama' => 'Asep Surya',
            'username' => 'asep',
            'password' => bcrypt('1234'),
            'role' => 'karyawan'
        ]);
    }
}
