<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Barang;
use App\Models\Cart;

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class OrderController extends Controller
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
        $orders = Order::where('user_id', $user->id)->get();

        // barang yang diterima
        $dipesan = $orders->filter(function ($order) {
            return $order->order_status_id == 1;
        });
        
        $diterima = $orders->filter(function ($order) {
            return $order->order_status_id == 2;
        });

        $diperiksa = $orders->filter(function ($order) {
            return $order->order_status_id == 3;
        });

        $dikirim = $orders->filter(function ($order) {
            return $order->order_status_id == 4;
        });

        return view('order.index', [
            'pesanan' => $dipesan,
            'terima' => $diterima,
            'periksa' => $diperiksa,
            'kirim' => $dikirim,

        ]);
    }

    public function buktiPembayaran(Request $request)
    {

        $request->validate([
            'bukti' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // ambil id order
        $orderId = collect(json_decode($request->order_id));

        // jika lebih dari satu barang selain menggunakan for 
        $order = Order::whereIn('id', $orderId)->get();

        // \dd($order);

        // upload bukti pembayaran
        $imageName = time() . '.' . $request->bukti->extension();
        $request->bukti->move(public_path('storage/bukti_pembayaran'), $imageName);
        
        // update order
        foreach ($order as $item) {

            $item->update([
                'bukti_pembayaran' => $imageName,
                'order_status_id' => 3, // 'terima pesanan
            ]);
        }

        return redirect()->route('order.index')->with('success', 'Bukti pembayaran berhasil diupload');
    }

    public function orderStore(Request $request) 
    {

        // check jika tidak ada barang yang dipilih
        if ($request->barangs == null ) {
            return redirect()->route('cart.index')->with('error', 'Tidak ada barang yang dipilih');
        }

        return view('order.pengiriman', [
            'order' => $request->all(),
        ]);

    }

    public function invoice(Request $request)
    {
        $temp = [];
        $data = json_decode($request->data);
        
        if (count($data->barangs) > 1) {

            // jika lebih dari satu barang
            for ($i=0; $i < count($data->barangs); $i++) { 
                
                $order = [
                    'kode_order' => \fake()->uuid(),
                    'user_id' => \auth()->user()->id,
                    'barang_id' => $data->barangs[$i],
                    'order_status_id' => 1, // 'terima pesanan'
                    'jumlah' => $data->qtys[$i],
                    'total_harga' => $data->prices[$i],
                    'alamat' => $request->alamat,
                    'no_telp' => $request->nohp,
                    'email' => $request->email,
                    'bukti_pembayaran' => 'kosong',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                array_push($temp, $order);

            }

            // masukkan ke dalam database
            Order::insert($temp);

            // hapus cart
            Cart::whereIn('barang_id', $data->barangs)->delete();

            // ubah stok barang
            for ($i=0; $i < count($data->barangs); $i++) { 
                $barang = Barang::find($data->barangs[$i]);
                $barang->stok -= $data->qtys[$i];
                $barang->save();
            }

        } else {

            // jika hanya satu barang
            $order = [
                'kode_order' => \fake()->uuid(),
                'user_id' => \auth()->user()->id,
                'barang_id' => $data->barangs[0],
                'order_status_id' => 1, // 'terima pesanan'
                'jumlah' => $data->qtys[0],
                'total_harga' => $data->prices[0],
                'alamat' => $request->alamat,
                'no_telp' => $request->nohp,
                'email' => $request->email,
                'bukti_pembayaran' => 'kosong',
            ];

            Order::create($order);

            // hapus cart
            Cart::where('barang_id', $data->barangs[0])->delete();

            // ubah stok barang
            $barang = Barang::find($data->barangs[0]);
            $barang->stok -= $data->qtys[0];
            $barang->save();
        }

        return \redirect()->route('order.index')->with('success', 'Order berhasil dibuat');
        
    }

    public function pembayaran(Request $request)
    {


        // check jika tidak ada barang yang dipilih
        if ($request->data == null) {
            return redirect()->route('order.index')->with('error', 'Tidak ada barang yang dipilih');
        }

        $temp = [];

        // ambil data order
        $order = \collect(json_decode($request->data));

        // \dd($order);

        // ambil data metode pembayaran
        $methods = \App\Models\MetodePembayaran::all();

        // hitung total harga
        // $total = 0;
        // foreach ($order as $item) {
        //     $total += $item->total_harga;
        // }

        // \dd($order);

        // jika barang lebih dari satu
        if ($order->count() > 1) {
            $total = $order->reduce(function ($carry, $item) {
                return $carry + $item->total_harga;
            });
    
            // hitung qty barang
            $qty = $order->reduce(function ($carry, $item) {
                return $carry + $item->jumlah;
            });

            // ambil id order dan masukkan ke $temp
            foreach ($order as $item) {
                array_push($temp, $item->id);
            }

        } else {

            $satubarang = Order::findOrFail($order[0]);

            $total = $satubarang->total_harga;
            $qty = $satubarang->jumlah;

            array_push($temp, $order[0]);
        }

        // hitung barang
        $barang = $order->count();

        // \dd(\json_decode($request->data));
        return view('order.pembayaran', [
            'totalHarga' => $total,
            'qty' => $qty,
            'barang' => $barang,
            'methods' => $methods,
            'order_id' => $temp,
        ]);
    }
}