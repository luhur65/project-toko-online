<div class="col-6 col-sm-6 col-md-3">
  <a href="{{ route('home.barang.show', $kode) }}" class="text-decoration-none text-black">
    <div class="card placeholder-glow shadow-sm" aria-hidden="true">
      <img src="{{ $gambar }}" class="img-fluid rounded-top shadow-sm placeholder-glow">
      <div class="card-body">
        <h5 class="card-title fw-bold h3 placeholder mt-2 mb-1">{{ $nama }}</h5>
        <div class="row">
          <div class="text-truncate">
            <span class="placeholder">{{ $keterangan }}</span>
          </div>
          <div>
            <a href="{{ route('home.kategori.show', $kategori->slug) }}" class="">
              <span class="badge rounded-pill text-bg-light placeholder">
                #{{ $kategori->nama_kategori}}
              </span>
            </a>
          </div>
        </div>
        <div class="d-flex justify-content-between align-items-center">
          <div class="d-block">
            <p style="font-size: 18px" class="fw-bolder p-0 mt-3 placeholder">
              {{ 'Rp '. number_format($harga, 0, ',', '.') }}
            </p>
          </div>
          @auth
          <div class="action">
              <a href="{{ route('home.barang.show', $kode) }}" class="btn btn-warning btn-sm placeholder">
                <i class="fa-solid fa-cart-shopping fa-fw"></i> 
              </a>
              <form class="d-inline-block" action="{{ route('wishlist.add') }}" method="post">
                @csrf
                  <input type="hidden" name="kode" value="{{ $id }}" readonly>
                  <button type="submit" class="btn btn-outline-danger btn-sm placeholder">
                    <i class="fa-solid fa-heart fa-fw"></i> 
                </button>
              </form>
            {{-- @else
            <form class="d-inline-block" action="{{ route('wishlist.destroy', $id) }}" method="post">
              @csrf
              @method('DELETE')
              <input type="hidden" name="kode" value="{{ $id }}" readonly>
              <button type="submit" class="btn btn-black btn-sm placeholder">
                <i class="fa-solid fa-bookmark fa-fw"></i>
              </button>
              <a href="{{ route('wishlist.index') }}" class="btn btn-primary btn-sm placeholder">
                <i class="fa-solid fa-eye fa-fw"></i> 
              </a> --}}
            </div>
            @endauth
          </div>
          <div class="d-flex justify-content-between">
            <span class="text-muted">
              <i class="fa-solid fa-store fa-fw"></i> tokoonline
            </span>
            <span class="text-muted">
              {{ $upload->diffForHumans() }}
            </span>
          </div>
          {{-- <span class="text-muted d-block">
            stok : {{ $stok }}
          </span> --}}
        </div>
      </div>
    </a>
  </div>