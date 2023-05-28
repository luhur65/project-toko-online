<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;

class BarangController extends Controller
{
    public function __construct()
    {

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
        $barangs = Barang::orderBy('updated_at', 'desc')->paginate(10);

        return \view('admin.barang.index', compact('barangs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // ambil semua kategori
        $kategoris = Kategori::all();
        return \view('admin.barang.create', compact('kategoris'));
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

        /**
         * 1. Validasi
         * 2. Upload gambar
         * 3. Simpan data
         */

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // cek jika ada gambar
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar');
            $gambar->storeAs('public/barangs', $gambar->hashName());

            $namaGmbr = $gambar->hashName();

        } else {
            $namaGmbr = 'default.png';

        }

        // simpan data
        Barang::create([
            'kode' => Str::slug($request->nama),
            'nama' => $request->nama,
            'kategori_id' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'gambar' => $namaGmbr,
            'keterangan' => $request->keterangan
        ]);

        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($kode)
    {
        //

        $barang = Barang::where('kode', $kode)->firstOrFail();
        return \view('admin.barang.show', compact('barang'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($kode)
    {
        //

        $barang = Barang::where('kode', $kode)->firstOrFail();
        $kategoris = Kategori::all();
        return \view('admin.barang.edit', compact('barang', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'kategori' => 'required',
            'harga' => 'required',
            'stok' => 'required',
            'keterangan' => 'required',
            'gambar' => 'image|mimes:png,jpg,jpeg|max:2048'
        ]);

        if ($validator->fails()) {
            return \redirect()->back()->withErrors($validator)->withInput();
        }

        // gambar lama
        $url = $request->oldGambar;
        $gambarLama = \basename($url);

        // cek gambar
        if ($request->gambar) {
            // upload gambar
            $imageFile = $request->file('gambar');
            $imageFile->storeAs('/public/barangs', $imageFile->hashName());
            
            // cek nama gambar
            if ($gambarLama != 'default.png') {
                Storage::disk('local')->delete('public/barangs/' . $gambarLama);
            }

            $gambar = $imageFile->hashName();
            
        } else {
            $gambar = $gambarLama;
        }

        // update barang
        Barang::where('id', $id)->update([
            'nama' => $request->nama,
            'kategori_id' => $request->kategori,
            'harga' => $request->harga,
            'stok' => $request->stok,
            'keterangan' => $request->keterangan,
            'gambar' => $gambar
        ]);

        return \redirect()->route('barang.index')->with('success', 'Berhasil diupdate!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // cek barang jika ada di tabel transaksi
        $cek = \App\Models\Order::where('barang_id', $id)->count();
        if ($cek > 0) {
            return \redirect()->route('barang.index')->with('error', 'Tidak bisa dihapus, barang sudah ada di order!!');
        }

        // hapus barang
        $barang = Barang::findOrFail($id);
        $gambar = $barang->gambar;
        Storage::disk('local')->delete('public/barangs/' . $gambar);
        $barang->delete();
        return \redirect()->route('barang.index')->with('success', 'Berhasil dihapus!!');


    }
}
