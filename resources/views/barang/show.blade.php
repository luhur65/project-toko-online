@extends('layouts.app')
@section('content')
    
    <div class="container">

      {{-- back button --}}
      <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('/') }}" class="btn btn-outline-secondary btn-sm">
          <i class="fa-solid fa-arrow-left fa-fw"></i> Kembali
        </a>
      </div>

        <div class="row g-2 my-3">
            <div class="col-md-3">
                <img src="{{ $barang->gambar }}" class="img-fluid rounded shadow-sm">
            </div>
            <div class="col-md">
                <h1 class="fw-bold h1">{{ $barang->nama }}</h1>
                <p>{{ $barang->keterangan }}</p>
                <div class="d-flex justify-content-between align-items-center">
                  <div class="info-brg">
                    <span>Stok : {{ $barang->stok }}</span>
                    <p>Kategori : 
                      <a href="{{ route('home.kategori.show', $barang->kategori->slug) }}" class="text-decoration-none">
                        {{ $barang->kategori->nama_kategori }}
                      </a>
                    </p>
                  </div>
                  <p class="lead display-6 fw-bold">
                    {{ 'Rp '. number_format($barang->harga, 0, ',', '.') }}
                  </p>
                </div>

                {{-- wishlist button --}}
                <x-wishlist :id="$barang->id" :icon="true"/>

                {{-- <hr> --}}
                <div class="ulasan-section my-4">
                  <h5>Review pelanggan</h5>

                  {{-- list ulasan --}}
                  {{-- komentar --}}
                  <div class="alert alert-success" role="alert">
                    <h4 class="alert-heading">Belum ada ulasan</h4>
                    <p class="mb-0">Jangan lupa memberi ulasan ketika telah membeli suatu barang.</p> 
                    <p class="mb-0">Agar membantu pembeli lainnya.</p>
                  </div>


                </div>
            </div>
            <div class="col-md-4">
              <div class="card my-3">
                  <div class="card-body">
                    {{-- info buy --}}
                    <h2 class="card-title h4">Transaksi</h2>
                    <hr>
                    <form action="{{ route('cart.add') }}" method="post">
                      @csrf
                        <input type="hidden" name="kode" value="{{ $barang->id }}">
                        <div class="mb-3 row">
                          <label for="quantity" class="col-sm-6 col-form-label">Jumlah barang</label>
                          <div class="col-sm-6">
                            <input type="number" class="form-control" id="quantity" name="qty" value="{{ $cart ? $cart->qty : 1 }}" min="1" max="{{ $barang->stok }}">
                          </div>
                        </div>
                        <div class="mb-3 row">
                          <label for="price" class="col-sm-6 col-form-label">Total harga</label>
                          <div class="col-sm-6">
                            <input type="hidden" class="form-control" id="price" name="price" value="{{ $cart ? $barang->harga*$cart->qty : $barang->harga }}" data-harga="{{ $barang->harga }}" value="{{ $barang->harga }}" readonly>
                            <p class="fw-bold" id="info-total-harga">0</p>
                          </div>
                        </div>
                        <div class="mb-3">
                          {{-- <a href="{{ route('order.detail', $barang->kode) }}" class="btn btn-success w-100">
                            <i class="fa-solid fa-shopping-bag fa-fw"></i> 
                            Beli langsung
                          </a> --}}
                          <hr class="my-3">
                          <button type="submit" class="btn btn-success">
                            <i class="fa-solid fa-cart-shopping fa-fw"></i> 
                            Masuk keranjang 
                          </button>
                        </div>
                    </form>
                  </div>
                </div>
                @guest
                  <a href="{{ route('login') }}" class="text-decoration-none link-login" data-nextpage="{{ route('home.barang.show', $barang->kode) }}">
                    <div class="alert alert-danger" role="alert">
                      <strong>Maaf</strong>,Silahkan login terlebih dahulu!
                    </div>
                  </a>
                @endguest
            </div>
        </div>

        {{-- produk serupa sesuai kategori barang --}}
        <div class="row g-2">
          <h3 class="fw-bold">Produk serupa</h3>
          <hr>
          
          @foreach ($barang->kategori->barang as $item)
            @if ($barang->kode != $item->kode)
                <div class="col-md-3">
                  <div class="card">
                    <img src="{{ $item->gambar }}" class="card-img-top" alt="...">
                    <div class="card-body">
                      <h4 class="card-title fw-bold">{{ $item->nama }}</h4>
                      <div class="text-truncate">
                        <p class="card-text">{{ $item->keterangan }}</p>
                      </div>
                      <p class="card-text fw-bold">{{ 'Rp '. number_format($item->harga, 0, ',', '.') }}</p>
                      <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('home.barang.show', $item->kode) }}" class="btn btn-primary">
                          <i class="fa-solid fa-shopping-cart fa-fw"></i>
                        </a>
                        <x-wishlist :id="$item->id" :icon="false"/>
                      </div>
                    </div>
                  </div>
                </div>
            @endif
          @endforeach
        
        </div>

    </div>

        
    @push('scripts')
      <script defer>

        // get element
        const quantity = document.getElementById('quantity');
        const price = document.getElementById('price');
        const infoTotalHarga = document.getElementById('info-total-harga');
        const harga = price.dataset.harga;

        // format price
        const formatter = new Intl.NumberFormat('id-ID', {
          style: 'currency',
          currency: 'IDR',
          minimumFractionDigits: 0
        });
        
        // change price value
        infoTotalHarga.innerHTML = formatter.format(price.value);

        // check quantity value when user click on quantity input
        quantity.addEventListener('change', function() {
          price.value = quantity.value * harga;
          infoTotalHarga.innerHTML = formatter.format(price.value);
          
        });

        // check quantity value when user typing on quantity input
        quantity.addEventListener('keyup', function() {
          if (quantity.value > parseInt(quantity.max)) {
            quantity.value = parseInt(quantity.max);
            price.value = quantity.value * harga;
            infoTotalHarga.innerHTML = formatter.format(price.value);

          } else if (quantity.value < parseInt(quantity.min)) {
            quantity.value = parseInt(quantity.min);
            price.value = harga;
            infoTotalHarga.innerHTML = formatter.format(price.value);

          } else {
            price.value = quantity.value * harga;
            infoTotalHarga.innerHTML = formatter.format(price.value);

          }
        });

        // get element tag a
        const tagA = document.querySelector('a.link-login');

        // get next page
        const nextPage = tagA.dataset.nextpage;

        // save next page to local storage
        localStorage.setItem('nextPage', nextPage);


      </script>  
    @endpush
    
@endsection