<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');

        // ambil data setting
        $setting = \App\Models\Setting::first();

        // kirim data setting ke semua view
        View::share('setting', $setting);
    }

    public function index()
    {
        // user yang sedang login
        $user = auth()->user();

        // ambil wishlist milik user yang sedang login
        $wishlists = $user->wishlist->sortDesc();

        // \dd($wishlists);

        return view('wishlist.index', compact('wishlists'));
    }

    public function store(Request $request)
    {
        // user yang sedang login
        $user = auth()->user();

        // cek apakah user sudah menambahkan barang ke wishlist
        $wishlist = $user->wishlist->where('kode', $request->kode)->first();

        // jika belum ada, maka tambahkan
        if (!$wishlist) {
            Wishlist::create([
                'kode' => $request->kode,
                'user_id' => $user->id,
                'qty' => '1',
            ]);

        }

        return redirect()->route('wishlist.index')->with('success', 'Berhasil diwishlist');
    }

    public function destroy($kode)
    {
        // user yang sedang login
        $user = auth()->user();

        // cek apakah user sudah menambahkan barang ke wishlist
        $wishlist = $user->wishlist->where('kode', $kode)->first();

        // jika sudah ada, maka hapus
        if ($wishlist) {
            $wishlist->delete();
        }

        return redirect()->route('wishlist.index')->with('success', 'Dihapus dari wishlist');
    }
}
