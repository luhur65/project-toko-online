@extends('layouts.app')
@section('content')


<div class="container">
        <div class="page-info">
            <h1 class="h2">My Wishlists</h1>
            <p class="text-muted">Daftar barang wishlist yang anda simpan.</p>
        </div>
        <div class="row">
            @forelse ($wishlists as $w)
            <div class="col-md-12">
                {{-- make a list card --}}
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-3">
                        <img src="{{ $w->product->gambar }}" class="img-fluid rounded-start " alt="...">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h5 class="card-title fw-bold">{{ $w->product->nama }}</h5>
                                <p class="card-text">{{ $w->product->keterangan }}.
                                <a class="d-inline-block" href="{{ route('home.barang.show', $w->product->kode) }}">Lihat detail barang</a>
                                </p>
                                <div class="card-text">
                                   Kategori : 
                                    <span class="badge bg-white">
                                        <a href="{{ route('home.kategori.show', $w->product->kategori->slug) }}">
                                            {{ $w->product->kategori->nama_kategori }}
                                        </a>
                                    </span> 
                                </div>
                                <div class="card-text">
                                    Sisa Stok : 
                                    <span class="badge bg-success">
                                        {{ $w->product->stok }}
                                    </span>
                                </div>
                                <p class="card-text mt-3">
                                    <small class="text-body-secondary">
                                        {{ 'Rp '. number_format($w->product->harga, 0, ',', '.') }}
                                    </small>
                                    <small class="text-body-secondary">
                                        {{ 'x'.$w->qty }} = 
                                    </small>
                                    <small class="text-body-secondary fw-bolder">
                                        {{ 'Rp '. number_format($w->product->harga * $w->qty, 0, ',', '.') }}
                                    </small>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="row g-1 p-2">
                                <div class="col my-2">
                                    <a href="{{ route('home.barang.show',$w->product->kode) }}" class="btn btn-success btn-sm w-100">
                                        <i class="fas fa-shopping-cart fa-fw"></i>
                                    </a>
                                </div>
                                <div class="col my-2">
                                    <form action="{{ route('wishlist.destroy',$w->product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm w-100">
                                            <i class="fas fa-trash fa-fw"></i>
                                        </button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="alert alert-info" role="alert">
                <strong> <i class="fas fa-info-circle fa-fw"></i>  INFO.</strong> Wishlist anda kosong!!.
            </div>
            @endforelse
        </div>
    </div>

    
@endsection