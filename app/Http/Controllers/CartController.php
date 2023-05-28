<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\Cart;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');

        // ambil data setting
        $setting = \App\Models\Setting::first();

        // kirim data setting ke semua view
        View::share('setting', $setting);
    }

    // 
    public function index()
    {

        $user = auth()->user();

        $carts = $user->cart->sortDesc();

        // \dd($carts);

        return view('cart.index', compact('carts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'qty' => 'required',
            'price' => 'required',
            // 'status' => 'required',
        ]);

        // $barang = Barang::find($request->kode);
        // $total_harga = $barang->harga * $request->qty;

        // jika barang sudah ada di keranjang
        $cart = Cart::where('barang_id', $request->kode)->where('user_id', auth()->user()->id)->first();

        if ($cart) {
            
            $cart->update([
                'qty' => $request->qty,
                'total_harga' => $request->price,
            ]);

            return redirect()->route('cart.index')->with('success', 'Berhasil Diubah');
        }

        Cart::create([
            'user_id' => auth()->user()->id,
            'barang_id' => $request->kode,
            'qty' => $request->qty,
            'total_harga' => $request->price,
            // 'status' => $request->status,
        ]);

        return redirect()->route('cart.index')->with('success', 'Berhasil Ditambahkan');
    }

    public function destroy($id)
    {
        $cart = Cart::find($id);
        $cart->delete();

        return redirect()->route('cart.index')->with('success', 'Berhasil Dihapus');
    }
}
