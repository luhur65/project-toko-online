<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');

        // ambil data setting
        $setting = \App\Models\Setting::first();

        // kirim data setting ke semua view
        View::share('setting', $setting);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('user.home');
    }

    public function admin()
    {

        // admin
        // seluruh rekapan data

        // hitung semua barang
        $totalBarang = Barang::count();

        // hitung semua orderan yang masuk
        $totalOrder = Order::count();

        // hitung semua user / pelanggan
        $totalPelanggan = User::where('role', 'user')->count();

        // hitung semua barang yang di wishlist
        $totalWishlist = Wishlist::count();

        return view('admin.home', [
            'order' => $totalOrder,
            'barang' => $totalBarang,
            'pelanggan' => $totalPelanggan,
            'wishlist' => $totalWishlist,

        ]);
    }
}
