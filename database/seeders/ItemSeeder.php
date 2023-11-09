<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kategori')->insert([
            [
                'nama_kategori' => 'Snack',
                'foto_kategori' => '1679328380-minuman.jpg'
            ],

            [
                'nama_kategori' => 'Drink',
                'foto_kategori' => '1679328905-makanan_ringan.jpg'
            ],

        ]);

        DB::table('produk')->insert([
            [
                'kategori_id' => 1,
                'kode_produk' => 'SN001',
                'nama_produk' => 'Nabati',
                'foto_produk' => '1.png',
                'harga'       => 8000,
                'status'      => 'Tersedia'
            ],
            [
                'kategori_id' => 1,
                'kode_produk' => 'SN002',
                'nama_produk' => 'Bembeng',
                'foto_produk' => '2.jpeg',
                'harga'       => 7000,
                'status'      => 'Kosong'
            ],
            [
                'kategori_id' => 1,
                'kode_produk' => 'SN003',
                'nama_produk' => 'Oreo',
                'foto_produk' => '3.png',
                'harga'       => 10000,
                'status'      => 'Tersedia'

            ],

            [
                'kategori_id' => 1,
                'kode_produk' => 'SN004',
                'nama_produk' => 'citato',
                'foto_produk' => '4.png',
                'harga'       => 10000,
                'status'      => 'Tersedia'

            ],

            [
                'kategori_id' => 2,
                'kode_produk' => 'DR005',
                'nama_produk' => 'ultra Milk',
                'foto_produk' => '11 (1).png',
                'harga'       => 5000,
                'status'      => 'Tersedia'

            ],

            [
                'kategori_id' => 2,
                'kode_produk' => 'DR006',
                'nama_produk' => 'lemineral',
                'foto_produk' => '11 (2).png',
                'harga'       => 12000,
                'status'      => 'Tersedia'

            ],

            [
                'kategori_id' => 2,
                'kode_produk' => 'DR007',
                'nama_produk' => 'Teh kotak',
                'foto_produk' => '11 (3).png',
                'harga'       => 8000,
                'status'      => 'Tersedia'

            ],

            [
                'kategori_id' => 2,
                'kode_produk' => 'DR008',
                'nama_produk' => 'good day',
                'foto_produk' => '11 (4).png',
                'harga'       => 2000,
                'status'      => 'Tersedia'

            ]
        ]);
    }
}
