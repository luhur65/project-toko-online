<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode',
        'nama',
        'kategori_id',
        'harga',
        'stok',
        'gambar',
        'keterangan',
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class, 'kode');
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class, 'barang_id');
    }

    protected function gambar(): Attribute
    {
        return Attribute::make(
            get: fn ($img) => $img ? asset('/barangs/' . $img) : null
        );
    }

}
