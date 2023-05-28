@extends('layouts.app')
@section('content')

  <div class="container">

    {{-- product --}}
    <div class="d-flex justify-content-between align-items-center">

      @if ($request->has('keyword'))
        <div class="">
          <h1 class="h3">Hasil pencarian: 
            <span class="text-secondary">{{ $request->keyword }}</span>
          </h1>
          <a href="{{ route('/') }}" class="btn btn-outline-secondary btn-sm">Kembali</a>
        </div>
          
      @else
        <h1 class="h2">Produk kami</h1>
          
      @endif

      <div class="dropdown">
        <button class="btn btn-outline-secondary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Kategori
        </button>
        <ul class="dropdown-menu">
          @foreach ($categories as $k)
            <li>
              <a class="dropdown-item" href="{{ route('home.kategori.show', $k->slug) }}">
                {{ $k->nama_kategori }}
              </a>
            </li>
          @endforeach
            <li><a class="dropdown-item text-primary" href="{{ route('home.kategori.show.all') }}">See moree ...</a></li>
        </ul>
      </div>
    </div>

    <div class="row g-2 g-lg-3 my-2">
      @forelse ($barangs as $b)
        @if (auth()->check() && auth()->user()->isAWishlist($b->id) == false)
        <x-barang 
          :kode="$b->kode"
          :gambar="$b->gambar"
          :nama="$b->nama"
          :keterangan="$b->keterangan"
          :kategori="$b->kategori"
          :harga="$b->harga"
          :stok="$b->stok"
          :upload="$b->created_at"
          :id="$b->id"/>
        @else
          <x-barang 
            :kode="$b->kode"
            :gambar="$b->gambar"
            :nama="$b->nama"
            :keterangan="$b->keterangan"
            :kategori="$b->kategori"
            :harga="$b->harga"
            :stok="$b->stok"
            :upload="$b->created_at"
            :id="$b->id"/>
        @endif
      @empty
        <div class="col-md-12">
          {{-- make jumbotron with gif --}}
          <div class="jumbotron jumbotron-fluid bg-transparent text-center">
            <div class="container">
              <img width="150" src="{{ asset('wait.gif') }}" alt="waiting" class="img-fluid">
              <h1 class="display-6">Oops!</h1>
              <p class="lead">
                Barang lagi kosong nih, tungguin yaa.
              </p>
            </div>
          </div>
        </div>
      @endforelse
    </div>
    {{-- end product --}}

    {{-- pagination --}}
    {{ $barangs->links() }}
    
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

  </div>

    
@endsection