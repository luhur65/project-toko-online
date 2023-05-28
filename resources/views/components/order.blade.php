{{-- card list --}}
@forelse ($items as $item)

  <div class="card mb-2 border-0 shadow-md" style="max-width: 700px">
    <div class="row g-0">
      <div class="col-sm">
        <img src="{{ $item->barang->gambar }}" class="img-fluid rounded-lg p-2">
      </div>
      <div class="col-sm-6">
        <div class="card-body">
          <div class="row g-0">
            <div class="col-8">
              <h5 class="text-lead h2">{{ $item->barang->nama }}</h5>
              <div class="info-barang">
                <div class="card-text">
                  <small class="text-body-secondary">Kategori : </small>
                  <span class="text-body">
                    <a href="{{ route('home.kategori.show', $item->barang->kategori->slug) }}" class="text-decoration-none">
                      {{ $item->barang->kategori->nama_kategori }}
                    </a>
                  </span>
                </div>
                <div class="card-text">
                  <small class="text-body-secondary">Quantity : </small>
                  <span class="text-body">{{ $item->jumlah }}</span>
                </div>
                <div class="my-3">
                  @if ($item->order_status_id == 2)
                    @if($item->bukti_pembayaran == 'kosong' || $item->bukti_pembayaran == null)
                      <form action="{{ route('order.checkout') }}" method="post">
                        @csrf
                        <input type="hidden" name="data" value="{{ json_encode($item->id) }}">
                        <button type="submit" class="btn btn-success btn-sm">
                          <i class="fas fa-dollar-sign fa-fw"></i> Bayar sekarang
                        </button>
                      </form>
                    @endif
                  @endif
                </div>
              </div>
            </div>
            <div class="col text-end">
              <span class="fw-bolder fs-5">Rp. {{ number_format($item->total_harga, 0, ',', '.') }}</span>
              <hr class="my-0">
              <x-status-badge :item="$item" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@empty

    <div class="alert alert-primary" role="alert">
      <strong>INFO. </strong> Tidak ada pesanan.
    </div>
    
@endforelse