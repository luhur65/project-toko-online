@extends('layouts.app')
@section('content')

  <div class="container">

    @if ($slug == null)
      {{-- list of kategori --}}
      <div class="list-kategori">
        <h1>List Kategori</h1>
        <div class="row g-3">
          @foreach ($kategori as $k)
            <div class="col-md-3">
              <a href="{{ route('home.kategori.show', $k->slug) }}" class="text-decoration-none text-muted">
                <div class="card rounded shadow-sm position-relative">
                  <div class="card-body">
                    @if ($k->barang->count() > 0)
                    <div class="row">
                      <div class="col-3">
                          <img width="20" src="{{ $k->barang[0]->gambar }}" alt="icon" class="img-fluid rounded-circle">
                      </div>
                      <div class="col">
                        <h3 class="fs-4 fw-bold my-auto">
                          {{ $k->nama_kategori }}
                        </h3>
                      </div>
                    </div>
                    @else 
                      <h3 class="fs-4 fw-bold my-auto">
                        {{ $k->nama_kategori }}
                      </h3>
                    @endif
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                      {{ $k->barang->count() }}
                      <span class="visually-hidden">unread messages</span>
                    </span>
                  </div>
                </div>
              </a>
            </div>
   
          @endforeach
        </div>

      </div>

    @else
      {{-- product by kategori --}}
      <div class="list-produk-by-kategori">
        <div class="title-page">
          <h1 class="h2">
            Kategori <span class="text-muted">#{{ $kategori->nama_kategori }}</span>
          </h1>
          <p class="lead">
            Menampilkan seluruh barang yang berkategori 
            <span class="text-muted">#{{ $kategori->nama_kategori }}</span>
          </p>
        </div>
        <div class="row">
          @forelse ($kategori->barang as $barang)
          <x-barang 
          :kode="$barang->kode"
          :gambar="$barang->gambar"
          :nama="$barang->nama"
          :keterangan="$barang->keterangan"
          :kategori="$barang->kategori"
          :harga="$barang->harga"
          :stok="$barang->stok"
          :upload="$barang->created_at"
          :id="$barang->id"/>
            {{-- <div class="col-6 col-md-4 col-lg-3 mb-3">
              <div class="card h-100">
                <img src="{{ $barang->gambar }}" class="card-img-top" alt="{{ $barang->nama }}">
                <div class="card-body">
                  <h5 class="card-title h2 fw-bold">{{ $barang->nama }}</h5>
                  <p class="card-text">{{ $barang->keterangan }}</p>
                </div>
                <div class="card-footer">
                  <div class="d-flex justify-content-between align-items-center">
                    <p class="lead m-0 fw-bold">
                      {{ 'Rp '. number_format($barang->harga, 0, ',', '.') }}
                    </p>
                    <a href="{{ route('home.barang.show', $barang->kode) }}" class="btn btn-sm btn-primary">
                      <i class="fa-solid fa-eye fa-fw"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div> --}}
          @empty
            <d class="col-12">
              <div class="alert alert-danger" role="alert">
                <strong>Maaf</strong>, barang di kategori ini sedang kosong!
              </div>
            </d iv>
          @endforelse
        </div>
      </div>
        
    @endif

  </div>
  @push('scripts')
        <script>

          const placeholder = document.querySelectorAll('.placeholder');
          const placeholderGlow = document.querySelectorAll('.placeholder-glow');

          document.addEventListener('DOMContentLoaded', () => {
            // reset placeholder class
            placeholder.forEach((el) => {
              el.classList.remove('placeholder');
            });
          });

        </script>
    @endpush
    
@endsection