@extends('layouts.app')
@section('content')

{{-- @dd($orders) --}}
  <div class="container">

    <h1 class="h3 fw-bold mb-0">Order masuk</h1>
    <span>
      Halaman ini berisi daftar order yang masuk, silahkan klik tombol <strong>Detail</strong> untuk melihat detail order.
    </span>

    <hr>

    <div class="row">
      <div class="col-md-12">
        <div class="card shadow-sm border-0">
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover">
                <thead class="bg-light">
                  <tr>
                    <th>#</th>
                    <th>Pelanggan</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Pembayaran</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($orders as $order)
                    <tr>
                      <td>{{ $loop->iteration }}</td>
                      <td>{{ $order->user->name }}</td>
                      <td>{{ number_format($order->total_harga) }}</td>
                      <td>
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
                      </td>
                      <td>{!! $order->isPaid(false) !!}</td>
                      <td>
                        <a href="{{ route('pesanan.show',$order->kode_order) }}" class="btn btn-sm btn-primary">Detail</a>
                      </td>
                    </tr>
                  @empty
                    <tr>
                      <td colspan="6" class="text-center">Tidak ada data</td>
                    </tr>
                  @endforelse
                </tbody>
              </table>
            </div>
            <div class="d-flex justify-content-end">
              {{ $orders->links() }}
            </div>
          </div>
        </div>
      </div>
    </div>
    

  </div>
    
@endsection