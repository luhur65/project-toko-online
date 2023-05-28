@extends('layouts.app')
@section('content')

<div class="container">

  <div class="d-flex flex-rows justify-content-between align-items-center my-4">
    <div class="title-page">
      <h1 class="h2 mb-0">Kategori</h1>
      <span class="text-muted">Halaman tambah data kategori, update kategori, dan hapus kategori.</span>
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
              <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#createKategoriModal">
                <i class="fas fa-layer-group fa-fw"></i> 
                Kategori baru
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>


  {{-- tabel kategori --}}
  <div class="table-responsive">
    <table class="table table-striped">
      <thead class="table-dark">
        <th>No.</th>
        <th>Nama kategori</th>
        <th>Aksi</th>
      </thead>
      <tbody>
        @forelse ($kategoris as $k)
            <tr>
              <th>{{ $loop->iteration }}</th>
              <td>{{ $k->nama_kategori }}</td>
              <td>
                {{-- <a href="{{ route('kategori.show', $k->nama_kategori) }}" class="btn btn-primary btn-sm"><i class="fas fa-eye fa-fw" aria-hidden="true"></i></a> --}}
                {{-- <a href="{{ route('kategori.edit', $k->id) }}" class="btn btn-warning btn-sm"><i class="fas fa-pencil fa-fw" aria-hidden="true"></i></a> --}}
                <form class="d-inline" action="{{ route('kategori.destroy', $k->id) }}" method="post">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-danger btn-delete btn-sm">
                    <i class="fas fa-trash-alt fa-fw"></i>
                  </button>
                </form>
              </td>
            </tr>
        @empty
            
        @endforelse
      </tbody>
    </table>

    {{-- pagination --}}
    {{ $kategoris->links() }}

  </div>

  
</div>

<!-- Modal -->
<div class="modal fade" id="createKategoriModal" tabindex="-1" aria-labelledby="createKategoriModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createKategoriModalLabel">Tambah kategori</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('kategori.store') }}" method="post">
          @csrf
          @method('POST')
          <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" autofocus>
            @error('nama_kategori')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </form>
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