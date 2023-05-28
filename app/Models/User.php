<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'role',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wishlist()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }

    public function cart()
    {
        return $this->hasMany(Cart::class);
    }

    public function isAWishlist($kode)
    {
        // cek user yang wishlist
        $user = auth()->user();

        // cek apakah barang sudah ada di wishlist
        // $wishlist = Wishlist::where('kode', $kode)->first();
        $wishlist = $user->wishlist->where('kode', $kode)->first();

        // jika sudah ada, maka return true
        if ($wishlist) {
            return true;
        }

        // jika belum ada, maka return false
        return false;

    }

    public function isACart($kode)
    {
        // cek user yang wishlist
        $user = auth()->user();

        // cek apakah barang sudah ada di wishlist
        // $wishlist = Wishlist::where('kode', $kode)->first();
        $cart = $user->cart->where('kode', $kode)->first();

        // jika sudah ada, maka return true
        if ($cart) {
            return true;
        }

        // jika belum ada, maka return false
        return false;

    }

    public function isAnOrder($kode)
    {
        // cek user yang wishlist
        $user = auth()->user();

        // cek apakah barang sudah ada di wishlist
        // $wishlist = Wishlist::where('kode', $kode)->first();
        $order = $user->order->where('kode', $kode)->first();

        // jika sudah ada, maka return true
        if ($order) {
            return true;
        }

        // jika belum ada, maka return false
        return false;

    }

    // hitung banyak barang yang ada di cart
    public function countCart()
    {
        $user = auth()->user();
        // $cart = $user->cart->where('status', 'cart');
        $cart = $user->cart->collect();
        $count = $cart->count();

        return $count;
    }

    // hitung banyak barang yang ada di wishlist
    public function countWishlist()
    {
        $user = auth()->user();
        // $wishlist = $user->wishlist->where('status', 'wishlist');
        $wishlist = $user->wishlist->collect();
        $count = $wishlist->count();

        return $count;
    }

    // hitung banyak barang yang ada di order
    public function countOrder()
    {
        $user = auth()->user();
        // $order = $user->order->where('status', 'order');
        $order = $user->order->groupBy('barang_id')->collect();
        $count = $order->count();

        return $count;
    }

}
