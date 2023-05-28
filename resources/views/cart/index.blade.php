@extends('layouts.app')
@section('content')

<div class="container">

  <h1 class="h2">My Cart</h1>
  <p class="text-muted"> Daftar barang yang ada di keranjang anda!</p>

  <div class="row g-2 row-reverse">
    <div class="col-md-8">

      @forelse ($carts as $c)
        <div class="card mb-3 border-0">
          <div class="row g-0">
            <div class="col-sm-4">
              <img src="{{ $c->barang->gambar }}" class="img-fluid rounded-start">
            </div>
            <div class="col-sm-8">
              <div class="card-body">
                <div class="row g-0">
                  <div class="col-8">
                    <h5 class="text-lead h2">{{ $c->barang->nama }}</h5>
                    <div class="info-barang">
                      <div class="card-text">
                        <small class="text-body-secondary">Kategori : </small>
                        <span class="text-body">
                          <a href="{{ route('home.kategori.show', $c->barang->kategori->slug) }}" class="text-decoration-none">
                            {{ $c->barang->kategori->nama_kategori }}
                          </a>
                        </span>
                      </div>
                      <div class="card-text">
                        <small class="text-body-secondary">Quantity : </small>
                        <span class="text-body">{{ $c->qty }} </span>
                      </div>
                      <div class="btn-group btn-group-sm my-3" role="group" aria-label="Basic example">
                        <a href="{{ route('home.barang.show', $c->barang->kode) }}" class="btn btn-link mt-1">Edit</a>
                        {{-- <form action="{{ route('wishlist.add') }}" method="post">
                          @csrf
                          <input type="hidden" name="kode" value="{{ $c->barang->id }}" readonly>
                          <button type="submit" class="btn btn-link">save</button>
                        </form> --}}
                        <form action="{{ route('cart.destroy', $c->id) }}" method="post">
                          @csrf
                          @method('delete')
                          <button type="submit" class="btn btn-link text-danger">Delete</button>
                        </form>
                      </div>
                    </div>
                  </div>
                  <div class="col text-end">
                    <span class="fw-bolder fs-5">
                      {{ 'Rp '. number_format($c->barang->harga * $c->qty, 0, ',', '.') }}
                    </span>
                    <hr>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

      @empty

        <div class="alert alert-info" role="alert">
            <strong> <i class="fas fa-info-circle fa-fw"></i>  INFO.</strong> Cart anda kosong!!.
        </div>
          
      @endforelse

    </div>
    @if ($carts->count() > 0)
      <div class="col-md">
        <div class="card border-0 fixed">
          <div class="card-body">
            <h5 class="card-title fw-bold h3 mb-3">Ringkasan Belanja</h5>
            <div class="card-text">
              {{-- <div class="alert alert-info" role="alert">
                <strong>You got 10% discount!! <i class="fa-solid fa-tag"></i> </strong>
              </div> --}}
              <div class="d-flex justify-content-between">
                <span class="text-body">Jenis barang</span>
                <span class="text-body">{{ $carts->count() }} buah</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="text-body">Jumlah Qty</span>
                <span class="text-body">{{ $c->totalQtyCheckout($carts) }} qty</span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="text-body">Subtotal</span>
                <span class="text-body">{{ number_format($c->info($carts)['total']) }}</span>
              </div>
              {{-- <div class="d-flex justify-content-between">
                <span class="text-body">Diskon</span>
                <span class="text-body"> 
                  - {{ number_format($c->info($carts)['diskon']) }}
                </span>
              </div>
              <div class="d-flex justify-content-between">
                <span class="text-body">Ongkos kirim</span>
                <span class="text-body"> + {{ number_format($c->info($carts)['ongkir']) }}</span>
              </div> --}}
              <hr>
              <div class="d-flex justify-content-between">
                <span class="text-body">Total</span>
                <span class="text-body fw-bold fs-5">{{ 'Rp '.number_format($c->info($carts)['totalBayar'],0,',','.') }}</span>
              </div>
            </div>
            <form action="{{ route('order.add') }}" method="post">
              @csrf
              @method('post')

              @foreach ($carts as $c)
                <input type="hidden" name="barangs[]" value="{{ $c->barang->id }}" readonly>
                <input type="hidden" name="qtys[]" value="{{ $c->qty }}" readonly>
                <input type="hidden" name="prices[]" value="{{ $c->barang->harga*$c->qty }}" readonly>
              @endforeach

              @if ($carts->count() > 1)
                <button type="submit" class="btn btn-success btn-block mt-3">
                  <i class="fa-regular fa-credit-card fa-fw"></i>
                  Pesan sekarang
                </button>
              @else 
                <button type="submit" class="btn btn-success btn-block mt-3">
                  <i class="fa-regular fa-credit-card fa-fw"></i>
                  Pesan barang ini
                </button>
              @endif
            </form>
          </div>
        </div>
      </div>   
    @endif
  </div>

</div>
    
@endsection