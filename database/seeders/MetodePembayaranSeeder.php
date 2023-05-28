<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
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
            // [
            //     'kode_metode' => '00007',
            //     'nama_metode' => 'ShopeePay',
            //     'nomor_rekening' => '1234567890',
            //     'nama_pemilik_rekening' => 'PT. ABC',
            //     'logo_metode' => 'shopeepay.png',
            //     'is_active' => '1',
            //     'jenis_metode' => 'transfer',
            // ],
            // [
            //     'kode_metode' => '00008',
            //     'nama_metode' => 'LinkAja',
            //     'nomor_rekening' => '1234567890',
            //     'nama_pemilik_rekening' => 'PT. ABC',
            //     'logo_metode' => 'linkaja.png',
            //     'is_active' => '1',
            //     'jenis_metode' => 'transfer',
            // ],
            // [
            //     'kode_metode' => '00009',
            //     'nama_metode' => 'Alfamart',
            //     'nomor_rekening' => '1234567890',
            //     'nama_pemilik_rekening' => 'PT. ABC',
            //     'logo_metode' => 'alfamart.png',
            //     'is_active' => '1',
            //     'jenis_metode' => 'transfer',
            // ],
    	];

        \App\Models\MetodePembayaran::insert($data);

    }
}
