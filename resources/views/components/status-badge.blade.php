@if ($item->bukti_pembayaran == 'kosong' or $item->bukti_pembayaran == null)
  <span class="badge bg-danger">Belum Bayar</span>
@else
  <span class="badge bg-success">Sudah Bayar</span>
@endif

@if ($item->order_status_id == 1)
  <span class="badge bg-warning text-dark">{{ $item->order_status->status }}</span>
@elseif ($item->order_status_id == 2)
  <span class="badge bg-primary">{{ $item->order_status->status }}</span>
@elseif ($item->order_status_id == 3)
  <span class="badge bg-info">{{ $item->order_status->status }}</span>
@elseif ($item->order_status_id == 4)
  <span class="badge bg-success">{{ $item->order_status->status }}</span>
@elseif ($item->order_status_id == 5)
  <span class="badge bg-danger">{{ $item->order_status->status }}</span>
@endif