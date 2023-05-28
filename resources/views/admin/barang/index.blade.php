@extends('layouts.app')
@section('content')

<div class="container">

  <div class="d-flex flex-rows justify-content-between align-items-center my-4">
    <div class="title-page">
      <h1 class="h2 mb-0">Barang</h1>
      <span class="text-muted">Halaman tambah data barang, update stok, dan hapus barang.</span>
    </div>
  
    <div class="row">
      <div class="col-md-12">
        <div class="dropdown">
          <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="fas fa-plus fa-fw"></i> Tambah Data
          </button>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="{{  route('barang.create')  }}">
                <i class="fas fa-cubes fa-fw"></i> Barang baru
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="{{ route('kategori.index') }}">
                <i class="fas fa-layer-group fa-fw"></i> 
                Kategori baru
              </a>
            </li>
            <li><a class="dropdown-item" href="#"></a></li>
          </ul>
        </div>
      </div>
    </div>
  </div>


  {{-- tabel barang --}}
  <div class="card">
    <div class="card-body">
      <div class="table-responsive">
    <table class="table table-striped">
      <thead class="table-dark">
        <th>No.</th>
        <th>Nama barang</th>
        <th>Harga satuan (Rp) </th>
        <th>Stok </th>
        <th>Aksi</th>
      </thead>
      <tbody>
        @forelse ($barangs as $b)
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $b->nama }}</td>
              <td>{{ number_format($b->harga) }}</td>
              <td>{{ $b->stok }}</td>
              <td>
                <a href="{{ route('barang.show', $b->kode) }}" class="btn btn-primary btn-sm mb-1"><i class="fas fa-eye fa-fw" aria-hidden="true"></i></a>
                <a href="{{ route('barang.edit', $b->kode) }}" class="btn btn-warning btn-sm mb-1"><i class="fas fa-pencil fa-fw" aria-hidden="true"></i></a>
                <form class="d-inline" action="{{ route('barang.destroy', $b->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-delete btn-sm mb-1">
                    <i class="fas fa-trash-alt fa-fw"></i>
                  </button>
                </form>
              </td>
            </tr>
        @empty
            <tr>
              <td colspan="5" class="text-center">
                <span class="fw-bold fs-5 text-danger">Tidak ada data</span>
              </td>
            </tr>
        @endforelse
      </tbody>
    </table>

    {{-- pagination --}}
    {{ $barangs->links() }}

  </div>
    </div>
  </div>

  
</div>

@push('scripts')
  
<script>
  
    // tombol delete diklik, munculkan sweetalert
    const buttonDelete = document.querySelectorAll(".btn-delete");
    buttonDelete.forEach(btn => {
      btn.addEventListener("click", function(e){
        e.preventDefault();
        // ambil form
        const form = this.parentElement;

        // munculkan sweetalert
        Swal.fire({
          title: 'Yakin dihapus ?',
          text: "Data yang sudah dihapus tidak dapat dikembalikan!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#d33',
          cancelButtonColor: '#6c757d',
          confirmButtonText: 'Hapus',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.isConfirmed) {
            // submit form
            form.submit();
          }
        })
      });
    });

  </script>

@endpush


    
@endsection