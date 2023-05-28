<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kategori;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

class KategoriController extends Controller
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
        // ambil semua data kategori dari database
        $kategoris = Kategori::orderBy('id', 'desc')->paginate(10);
        return view('admin.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // tampilkan halaman create
        // return view('admin.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validasi data yang dikirim dari form
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori',
        ]);

        // if ($request->validator->fails()) {
        //     return redirect()->back()->withInput($request->all());
        // }

        // ambil semua data dari form
        $data = [
            'slug' => Str::slug($request->nama_kategori, '-'),
            'nama_kategori' => $request->nama_kategori,
        ];

        // simpan data ke database
        Kategori::create($data);

        // redirect ke halaman index
        return redirect()->route('kategori.index')->with('success', 'Kategori baru ditambahkan');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
    public function update(Request $request, $id)
    {
        //

        // validasi data yang dikirim dari form
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori,' . $id,
        ]);

        // ambil semua data dari form
        $data = [
            'slug' => Str::slug($request->nama_kategori, '-'),
            'nama_kategori' => $request->nama_kategori,
        ];

        // simpan data ke database
        Kategori::where('id', $id)->update($data);

        // redirect ke halaman index
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // ambil data kategori berdasarkan id
        $kategori = Kategori::findOrFail($id);
        // hapus data dari database
        $kategori->delete();
        // redirect ke halaman index
        return redirect()->route('kategori.index')->with('success', 'Kategori berhasil dihapus');
    }
}
