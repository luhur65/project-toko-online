@extends('layouts.app')

@section('content')

  <div class="container">

    <div class="page-title">
      <h1 class="h2">My Order</h1>
      <span class="text-muted">Semua pesanan kamu dapat dipantau dari sini.</span>
    </div>
    
    {{-- navigation --}}
    <div class="d-flex align-items-start my-3">
      <div class="nav flex-column nav-pills me-5" id="v-pills-tab" role="tablist" aria-orientation="vertical">
        <button class="nav-link text-start active border border-2 my-1" id="v-pills-pesan-tab" data-bs-toggle="pill" data-bs-target="#v-pills-pesan" type="button" role="tab" aria-controls="v-pills-pesan" aria-selected="true">Di Pesan</button>
        <button class="nav-link text-start border border-2 my-1" id="v-pills-terima-tab" data-bs-toggle="pill" data-bs-target="#v-pills-terima" type="button" role="tab" aria-controls="v-pills-terima" aria-selected="false">Di Terima</button>
        <button class="nav-link text-start border border-2 my-1" id="v-pills-periksa-tab" data-bs-toggle="pill" data-bs-target="#v-pills-periksa" type="button" role="tab" aria-controls="v-pills-periksa" aria-selected="false">Di Periksa</button>
        <button class="nav-link text-start border border-2 my-1" id="v-pills-kirim-tab" data-bs-toggle="pill" data-bs-target="#v-pills-kirim" type="button" role="tab" aria-controls="v-pills-kirim" aria-selected="false">Di Kirim</button>
      </div>

      {{-- content --}}
      <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane active" id="v-pills-pesan" role="tabpanel" aria-labelledby="v-pills-pesan-tab" tabindex="0">

          <x-info-order 
            :items="$pesanan"
            message="Pesanan sudah diterima, dan menunggu konfirmasi penjual"
            />
          <x-order :items="$pesanan" />

        </div>
        <div class="tab-pane" id="v-pills-terima" role="tabpanel" aria-labelledby="v-pills-terima-tab" tabindex="0">

          <x-info-order 
            :items="$terima"
            message="Pesanan dikonfirmasi, dan menunggu pembayaran dari anda."
            />

          {{-- jika banyak barang, bayar semua barang --}}
          @if (count($terima) > 1 )
          <div class="info-tabs mb-3">
            <div class="d-flex align-items-center justify-content-between">
              <h3 class="h4 text-muted">Total pesanan : {{ count($terima) }} barang</h3>
              <form action="{{ route('order.checkout') }}" method="post">
                @csrf
                <input type="hidden" name="data" value="{{ json_encode($terima) }}">
                <button type="submit" class="btn btn-success btn-sm">
                  <i class="fas fa-dollar-sign fa-fw"></i> Bayar semua
                </button>
              </form>
            </div>
          </div>
          @endif
            
          <x-order :items="$terima" />

        </div>
        <div class="tab-pane" id="v-pills-periksa" role="tabpanel" aria-labelledby="v-pills-periksa-tab" tabindex="0">

          <x-info-order 
            :items="$periksa"
            message="Pembayaran barang diterima, dan menunggu konfirmasi penjual"
            />
          <x-order :items="$periksa" />

        </div>
        <div class="tab-pane" id="v-pills-kirim" role="tabpanel" aria-labelledby="v-pills-kirim-tab" tabindex="0">

          <x-info-order 
            :items="$kirim"
            message="Pembayaran Berhasil, barang pesanan anda telah dikirim."
            />
          <x-order :items="$kirim" />

        </div>
      </div>

    </div>

  </div>
    
@endsection