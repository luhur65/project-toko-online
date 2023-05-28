<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_order',
        'user_id',
        'order_status_id',
        'barang_id',
        'jumlah',
        'total_harga',
        'alamat',
        'no_telp',
        'email',
        'bukti_pembayaran',
        // 'note',
    ];

    // cek apakah order sudah dibayar
    public function isPaid($table = true)
    {
        $is_paid = $this->bukti_pembayaran != "kosong"; 
        $imageName = \asset('storage/bukti_pembayaran/'. $this->bukti_pembayaran);

        // kasih info apakah sudah dibayar atau belum
        if ($is_paid) {

            if ($table) {
                return '<img src="' . $imageName . '" alt="bukti_pembayaran" class="img-fluid img-thumbnail">';
            }

            return '<img src="' . $imageName . '" alt="bukti_pembayaran" width="100" class="img-fluid img-thumbnail">';

        } else {
            return '<span class="badge bg-danger">Belum Dibayar</span>';
        }
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function barang()
    {
        return $this->belongsTo(Barang::class);
    }

    // hitung total harga
    public function totalHarga($item)
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
}
