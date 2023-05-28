@extends('layouts.app')
@section('content')

  <div class="container">
    <h1 class="h2">Detail Barang</h1>
    <a href="{{ route('barang.index') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>

    <dl class="row g-0 my-4">
      <dt class="col-sm-3">Nama barang</dt>
      <dd class="col-sm-9">{{ $barang->nama }}</dd>

      <dt class="col-sm-3">Stok barang</dt>
      <dd class="col-sm-9">{{ $barang->stok }} pcs</dd>

      <dt class="col-sm-3">Harga satuan barang</dt>
      <dd class="col-sm-9">Rp. {{ number_format($barang->harga) }}</dd>

      <dt class="col-sm-3">Kategori barang</dt>
      <dd class="col-sm-9">
        <a class="text-decoration-none" href="{{ route('home.kategori.show', $barang->kategori->slug) }}">
          <span class="badge bg-secondary text-white">#{{ $barang->kategori->nama_kategori }}</span>
        </a>
      </dd>

      <dt class="col-sm-3">Deskripsi Barang</dt>
      <dd class="col-sm-9">
        <p>
          {{ $barang->keterangan }}
        </p>
      </dd>

      <dt class="col-sm-3">Gambar barang</dt>
      <dd class="col-sm-9">
        <img width="200px" src="{{ $barang->gambar }}" alt="{{ $barang->nama }}" class="img-fluid img-thumbnail">
      </dd>

    </dl>

    <div class="action-btn my-1">
      <a href="{{ route('barang.edit', $barang->kode) }}" class="btn btn-warning mb-1">
        <i class="fas fa-pencil fa-fw"></i> Update barang
      </a>
      <form class="d-inline" action="{{ route('barang.destroy', $barang->id) }}" method="post">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-delete mb-1">
          <i class="fas fa-trash-alt fa-fw"></i> Hapus barang
        </button>
      </form>
    </div>

  </div>

    
@endsection