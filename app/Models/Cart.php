<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'barang_id',
        'user_id',
        'qty',
        'total_harga',
        // 'status',

    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    public function order()
    {
        return $this->hasOne(Order::class);
    }

    // hitung total harga
    public function totalHargaCheckout($item)
    {
        $total = 0;
        foreach ($item as $cart) {
            // $total += $cart->total_harga;
            $total += $cart->barang->harga * $cart->qty;
        }

        return $total;
    }

    // hitung total qty
    public function totalQtyCheckout($item)
    {
        $total = 0;
        foreach ($item as $cart) {
            $total += $cart->qty;
        }

        return $total;
    }

    // kasih diskon
    public function diskon($total)
    {

        // hitung diskon
        $diskon = $total * 0.1;

        return $diskon;
    }

    // hitung total bayar
    public function totalBayar($total, $diskon)
    {
        // $totalBayar = $total - $diskon;

        // $totalBayar += 10000; // ongkir

        return $total;
    }

    // info pembayaran
    public function info($item)
    {

        // hitung total harga
        $total = $this->totalHargaCheckout($item);

        // hitung diskon
        $diskon = $this->diskon($total);

        // hitung total bayar
        $totalBayar = $this->totalBayar($total, $diskon);

        $info = [
            'total' => $total,
            // 'diskon' => $diskon,
            // 'ongkir' => 10000,
            'totalBayar' => $totalBayar,
            'barangs' => \collect($item)->map(function ($cart) {
                return [
                    'id' => $cart->barang->id,
                ];
            }),
        ]; 

        return $info;
    }

}