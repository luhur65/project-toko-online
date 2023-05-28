@extends('layouts.app')
@section('content')


<div class="container">

  <div class="row justify-content-between">

    <div class="col-md-10 mb-1">
      <div class="title-page">
        <h1 class="h3 fw-bold mb-0">
          Detail pesanan 
          <span class="text-muted">
            #{{ $order->id }}
          </span>
        </h1>
        <span class="text-muted">
          Dipesan pada {{ $order->created_at->format('d M Y') }}
        </span>
      </div>
    </div>
    <div class="col-md mb-1">
      <div class="button-aksi-pesanan">
        <form class="d-inline" action="{{ route('pesanan.update', $order->kode_order) }}" method="post">
          @csrf
          @method('PUT')
          <button type="submit" class="btn btn-sm btn-success mb-1">
            <i class="fas fa-check fa-fw"></i> Terima pesanan
          </button>
        </form>
        <form class="d-inline" action="{{ route('pesanan.destroy', $order->kode_order) }}" method="post">
          @csrf
          @method('DELETE')
          <button type="submit" class="btn btn-sm btn-danger mb-1">
            <i class="fas fa-times fa-fw"></i> Tolak pesanan
          </button>
        </form>
      </div>
    </div>

  </div>

  <hr>

  <dl class="row">

    <h3 class="fw-bold text-muted h4">Info pesanan</h3>
    <dt class="col-sm-3">No. Order</dt>
    <dd class="col-sm-9">{{ $order->kode_order }}</dd>

    <dt class="col-sm-3">Total harga</dt>
    <dd class="col-sm-9">Rp. {{ number_format($order->total_harga) }}</dd>

    <dt class="col-sm-3">Status</dt>
    <dd class="col-sm-9">
      @if ($order->order_status_id == 1)
      <span class="badge bg-warning text-light">
        {{ $order->order_status->status }}
      </span>
      @elseif($order->order_status_id == 2)
      <span class="badge bg-info text-light">
        {{ $order->order_status->status }}
      </span>
      @elseif($order->order_status_id == 3)
      <span class="badge bg-success text-light">
        {{ $order->order_status->status }}
      </span>
      @elseif($order->order_status_id == 4)
      <span class="badge bg-danger text-light">
        {{ $order->order_status->status }}
      </span>
      @endif
    </dd>

    <dt class="col-sm-3">Pembayaran</dt>
    <dd class="col-sm-9">
      <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#buktipembayaran">
        <i class="fas fa-eye fa-fw" aria-hidden="true"></i> Lihat bukti pembayaran
      </button>
    </dd>

    <h3 class="fw-bold h4 text-muted mt-3">Barang pesanan</h3>
    <dt class="col-sm-3">Nama barang</dt>
    <dd class="col-sm-9">{{ $order->barang->nama }}</dd>

    <dt class="col-sm-3">Jml order</dt>
    <dd class="col-sm-9">{{ $order->jumlah }} Qty</dd>
    
    <h3 class="fw-bold h4 text-muted mt-3">Info pengiriman</h3>
    <dt class="col-sm-3">Nama pelanggan</dt>
    <dd class="col-sm-9">{{ $order->user->name }}</dd>

    <dt class="col-sm-3">No. HP</dt>
    <dd class="col-sm-9">{{ $order->no_telp }}</dd>

    <dt class="col-sm-3">Alamat</dt>
    <dd class="col-sm-9">{{ $order->alamat }}</dd>
    
  </dl>

  <a href="{{ route('pesanan.index') }}" class="btn btn-sm btn-outline-secondary"> &larr; Kembali</a>

</div>

<div class="modal fade" id="buktipembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Bukti pembayaran</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        {!! $order->isPaid(true) !!}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    
@endsection