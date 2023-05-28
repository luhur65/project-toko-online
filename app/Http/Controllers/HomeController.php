<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Cart;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {

        // ambil data setting
        $setting = \App\Models\Setting::first();

        // kirim data setting ke semua view
        View::share('setting', $setting);
    }

    public function index(Request $request)
    {
        
        // ambil 5 data kategori
        $categories = Kategori::take(5)->get();
        $barangs =  $this->cari($request);

        // dd()      
        return view('index', compact('barangs', 'categories', 'request'));
    }

    public function detailBarang($kode)
    {

        $barang = Barang::where('kode', $kode)->first();
        
        if (auth()->check()) {
            
            // jika barang ada di keranjang
            $cart = Cart::where('barang_id', $barang->id)->where('user_id', auth()->user()->id)->first();
            
        } else {
            
            $cart = null;
        }

        // ambil barang yang sama kategori
        // $barangSekategori = Barang::where('kategori_id', $barang->kategori_id)->where('kode', '!=', $kode)->take(4)->get();

        return view('barang.show', compact('barang', 'cart'));
    }

    public function kategori($slug = null)
    {
        if ($slug == null) {
            $kategori = Kategori::all();
            return view('kategori.show', compact('kategori', 'slug'));
        }

        $kategori = Kategori::where('slug', $slug)->first();
        return view('kategori.show', compact('kategori', 'slug'));
    }

    public function cari(Request $request)
    {

        // cari barang
        if ($request->has('keyword')) {

            $this->validate($request, [
                'keyword' => 'required|min:1'
            ]);

            return Barang::where('nama', 'like', '%' . $request->keyword . '%')->paginate(12);

        } else {

            // cek user login
            if (!auth()->check()) {
                return Barang::paginate(12);
            }

            // ambil barang yang belum dicart
            return Barang::whereDoesntHave('cart', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->paginate(12);

        }
    }
}
