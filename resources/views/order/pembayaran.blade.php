@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
    <div class="col-md-6 mx-auto">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h1 class="h3 mb-0">Upload bukti bayar</h1>
            <span class="text-muted">Silakan diupload bukti pembayaran anda...</span>
          </div>
          <form action="{{ route('order.upload.bukti_pembayaran') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="input-group">
              <input type="file" name="bukti" id="bukti" class="form-control @error('bukti') is-invalid @enderror" aria-describedby="bukti" aria-label="Upload">
              @error('bukti')
                <div class="invalid-feedback">
                  {{ $message }}
                </div>
              @enderror
              <input type="hidden" name="order_id" value="{{ json_encode($order_id) }}">
              <button class="btn btn-primary" type="submit" >Upload</button>
            </div>
          </form>
          <hr>
          <div class="rincian-pembayaran mb-3">
            <h5 class="h3 mb-0">Rincian Pembayaran</h5>
            <span class="text-muted">Berikut ialah rincian barang yang akan anda bayarkan...</span>
            <div class="row g-1 mt-2">
              <div class="col-md-9">
                <p class="mb-0">Total Barang</p>
                <p class="mb-0">Total Qty Seluruh Barang</p>
                <p class="mb-0">Total Pembayaran</p>
              </div>
              <div class="col-md text-end">
                <p class="mb-0">{{ $barang }} Barang</p>
                <p class="mb-0">{{ $qty }} Qty</p>
                <p class="mb-0 fw-bold lead">Rp. {{ number_format($totalHarga) }}</p>
              </div>
            </div>
          </div>
          <div class="metode-pembayaran mb-3" id="metodepembayaran">
            <h5 class="mb-0">Cara pembayaran</h5>
            <span class="text-muted">Pilih dan klik untuk melihat cara pembayaran dibawah ini!!</span>
            <div class="d-flex justify-content-between align-items-center">
            @forelse ($methods as $m)
            <div class="icon-container">
              <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#{{ $m->nama_metode }}Modal">
                <img width="60px" src="{{ asset('/storage/logo/' . $m->logo_metode) }}" alt="Logo metode" class="icon img-thumbnail">
              </button>
            </div>

          <!-- Modal for {{ $m->nama_metode }} -->
          <div class="modal fade" id="{{ $m->nama_metode }}Modal" tabindex="-1" aria-labelledby="briModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="briModalLabel">Detail Pembayaran {{ $m->nama_metode }}</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <!-- Isi dengan detail metode pembayaran Bank BRI -->
                  <span class="text-muted small">Silakan transfer ke no.rek/ no.hp di bawah ini dan unggah bukti pembayaran di halaman pembayaran.</span>
                  <dl class="row mt-3">
                    <dt class="col-sm-4">No. Rek/No. Hp</dt>
                    <dd class="col-sm-8">{{ $m->nomor_rekening }}</dd>

                    <dt class="col-sm-4">Nama Rekening</dt>
                    <dd class="col-sm-8">
                      {{ $m->nama_pemilik_rekening }}
                    </dd>

                    <dt class="col-sm-4">Metode Pembayaran</dt>
                    <dd class="col-sm-8"> {{ $m->jenis_metode }} </dd>
                  </dl>
                  <button type="button" class="btn btn-outline-secondary btn-sm" onclick="salinRekening({{ $m->nomor_rekening }})">
                    <i class="fas fa-copy fa-fw"></i> Salin No.Rek
                  </button>
                </div>
              </div>
            </div>
          </div>
                
            @empty
                
            @endforelse
          </div>

          </div>
          <div class="d-flex justify-content-between">
            <a href="{{ route('order.index') }}" class="btn btn-outline-danger btn-sm">&larr; Kembali</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  @push('scripts')
      <script>
        const salinRekening = async (nomorRekening) => {

            try {

              await navigator.clipboard.writeText(nomorRekening);
              
              Swal.fire({
                icon: 'success',
                title: 'Berhasil disalin',
                text: 'No. Rekening berhasil disalin!',
                showConfirmButton: false,
                timer: 1500
              });

            } catch (err) {
              console.error('Failed to copy: ', err);

              Swal.fire({
                icon: 'error',
                title: 'Gagal disalin',
                text: 'No. Rekening tidak bisa disalin!',
                showConfirmButton: false,
                timer: 1500
              });
            }
          
        }
      </script>
  @endpush

</div>
    
@endsection