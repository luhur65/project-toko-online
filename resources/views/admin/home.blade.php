@extends('layouts.app')
@section('content')

<div class="container">

    <div class="row mb-3">
        <div class="col-md-12">
            <h1 class="h2 fw-bold mb-0">Hi, {{ auth()->user()->name }}</h1>
            <span class="text-muted">Seluruh rekapan data toko online</span>
        </div>
    </div>

    <div class="row g-2 my-3">
        <div class="col-md-3 my-1">
            <x-information title="Order" icon="shopping-bag" total="{{ $order }}" color="success" ket="Order" route="{{ route('pesanan.index') }}"/>
        </div>
        <div class="col-md-3 my-1">
            <x-information title="Barang" icon="cubes" total="{{ $barang }}" color="primary" ket="Barang" route="{{ route('barang.index') }}"/>
        </div>
        <div class="col-md-3 my-1">
            <x-information title="Wishlist" icon="heart" total="{{ $wishlist }}" color="danger" ket="Wishlist"/>
        </div>
        <div class="col-md-3 my-1">
            <x-information title="Pelanggan" icon="user-circle" total="{{ $pelanggan }}" color="secondary" ket="Pelanggan"/>
        </div>
    </div>
</div>

@endsection
