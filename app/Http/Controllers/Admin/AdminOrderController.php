<?php

namespace App\Http\Controllers\Admin;

use App\Models\Order;
use App\Models\OrderStatus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminOrderController extends Controller
{

    public function __construct() {

        // ambil data setting
        $setting = \App\Models\Setting::first();

        // kirim data setting ke semua view
        View::share('setting', $setting);

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ambil data order masuk dari database
        $orders = Order::orderBy('id', 'desc')->paginate(10);
        return view('admin.order.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode_order)
    {
        //

        $order_status = OrderStatus::all();
        $order = Order::where('kode_order', $kode_order)->firstOrFail();
        return view('admin.order.show', compact('order', 'order_status'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $kode_order)
    {
        //

        $order = Order::where('kode_order', $kode_order)->firstOrFail();
        // \dd($order);
        
        // cek order status
        if ($order->order_status_id == 1) {
            $order->order_status_id = 2;
        } elseif ($order->order_status_id == 2) {
            $order->order_status_id = 3;
        } elseif ($order->order_status_id == 3) {
            $order->order_status_id = 4;
        } else {
            $order->order_status_id = 1;
        }

        $order->save();

        return redirect()->route('pesanan.index')->with('success', 'Order berhasil diupdate');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($kode_order)
    {
        // search order
        $order = Order::where('kode_order', $kode_order)->firstOrFail();

        // hapus gambar
        if ($order->bukti_pembayaran) {
            Storage::disk('local')->delete('public/bukti_pembayaran/' . $order->bukti_pembayaran);
        }

        // hapus order
        $order->delete();

        return redirect()->route('pesanan.index')->with('success', 'Order berhasil dihapus');
    }
}
