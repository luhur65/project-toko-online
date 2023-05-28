<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\MetodePembayaran;
use App\Models\OrderStatus;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $orderStatusDataseed = [
            [
                'status' => 'Order Dipesan',
            ],
            [
                'status' => 'Order Diterima',
            ],
            [
                'status' => 'Order Diperiksa',
            ],
            [
                'status' => 'Order Dikirim',
            ],

        ];

        $metodePembayaranDataseed = [
            [
                'kode_metode' => '00003',
                'nama_metode' => 'BRI',
                'nomor_rekening' => '1234567890',
                'nama_pemilik_rekening' => 'PT. ABC',
                'logo_metode' => 'bri.png',
                'is_active' => '1',
                'jenis_metode' => 'transfer',
            ],
            [
                'kode_metode' => '00001',
                'nama_metode' => 'BCA',
                'nomor_rekening' => '1234567890',
                'nama_pemilik_rekening' => 'PT. ABC',
                'logo_metode' => 'bca.png',
                'is_active' => '1',
                'jenis_metode' => 'transfer',
            ],
            [
                'kode_metode' => '00004',
                'nama_metode' => 'Mandiri',
                'nomor_rekening' => '1234567890',
                'nama_pemilik_rekening' => 'PT. ABC',
                'logo_metode' => 'mandiri.png',
                'is_active' => '1',
                'jenis_metode' => 'transfer',
            ],
            [
                'kode_metode' => '00002',
                'nama_metode' => 'OVO',
                'nomor_rekening' => '1234567890',
                'nama_pemilik_rekening' => 'PT. ABC',
                'logo_metode' => 'ovo.png',
                'is_active' => '1',
                'jenis_metode' => 'transfer',
            ],
            [
                'kode_metode' => '00005',
                'nama_metode' => 'DANA',
                'nomor_rekening' => '1234567890',
                'nama_pemilik_rekening' => 'PT. ABC',
                'logo_metode' => 'dana.jpg',
                'is_active' => '1',
                'jenis_metode' => 'transfer',
            ],
            [
                'kode_metode' => '00006',
                'nama_metode' => 'GOPAY',
                'nomor_rekening' => '1234567890',
                'nama_pemilik_rekening' => 'PT. ABC',
                'logo_metode' => 'gopay.png',
                'is_active' => '1',
                'jenis_metode' => 'transfer',
            ],
        ];

        User::insert([
            [
                'user_id' => \fake()->uuid(),
                'name' => 'Administrator',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => \fake()->uuid(),
                'name' => 'Dharma Bakti Situmorang',
                'email' => 'dharmabakti1202@gmail.com',
                'role' => 'user',
                'password' => Hash::make('12345678'),
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);

        Kategori::insert([
            [
                'nama_kategori' => 'Kaos',
                'slug' => 'kaos',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Kemeja',
                'slug' => 'kemeja',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Jaket',
                'slug' => 'jaket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Celana',
                'slug' => 'celana',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Topi',
                'slug' => 'topi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Tas',
                'slug' => 'tas',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Sepatu',
                'slug' => 'sepatu',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama_kategori' => 'Aksesoris',
                'slug' => 'aksesoris',
                'created_at' => now(),
                'updated_at' => now(),
            ],


        ]);
        // Barang::factory(100)->create();
        OrderStatus::insert($orderStatusDataseed);
        MetodePembayaran::insert($metodePembayaranDataseed);

        Setting::factory(1)->create([

            'website' => 'Toko Online',
            'tagline' => 'Toko Online adalah toko online yang menyediakan berbagai macam kebutuhan anda, semua tersedia disini dengan harga yang sangat terjangkau.',
            'deskripsi' => 'Toko Online adalah toko online yang menyediakan berbagai macam kebutuhan anda, semua tersedia disini dengan harga yang sangat terjangkau.',
            'keyword' => 'Toko Online, Toko Online Murah, Toko Online Terpercaya, Toko Online Terbaik, Toko Online Terlengkap, Toko Online Terbaru, Toko Online Terupdate, Toko Online Terkini, Toko Online Terjangkau, Toko Online Teraman, Toko Online Tercepat, Toko Online',
            'author' => 'Toko Online',
            'logo' => 'logo.png',
            'email' => 'tokoonline@ecomerce.com',
            'telepon' => '081234567890',
            'alamat' => 'Jl. Jalan No. 1, Kota, Provinsi',
            'facebook' => 'https://facebook.com',
            'instagram' => 'https://instagram.com',
            'twitter' => 'https://twitter.com',
            'youtube' => 'https://youtube.com',
            'whatsapp' => 'https://whatsapp.com',
            'googlemaps' => 'https://google.com/maps',

        ]);

    }
}
