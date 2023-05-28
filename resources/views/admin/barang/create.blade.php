@extends('layouts.app')
@section('content')

  <div class="container">

    <div class="row justify-content-center">
      <div class="col-md-6">
        <h1 class="h2">Tambah Barang</h1>
        <p class="text-muted">Halaman Tambah data barang.</p>

        <div class="form-tambah-barang my-3">

          <div class="card">
            <div class="card-body">
              <form action="{{ route('barang.store') }}" method="post" enctype="multipart/form-data">
                
                @csrf
    
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama barang</label>
                  <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama')  }}">
                  @error('nama')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="stok" class="form-label">Stok barang</label>
                  <input type="number" class="form-control @error('stok') is-invalid @enderror" id="stok" name="stok" value="{{ old('stok') }}">
                  @error('stok')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="harga" class="form-label">Harga satuan barang</label>
                  <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga" name="harga" value="{{ old('harga') }}">
                  @error('harga')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="kategori" class="form-label">Kategori barang</label>
                  <select class="form-select @error('kategori') is-invalid @enderror" id="kategori" name="kategori">
                    <option selected disabled>Pilih kategori barang</option>
                    @foreach ($kategoris as $kategori)
                      <option value="{{ $kategori->id }}">{{ $kategori->nama_kategori }}</option>
                    @endforeach
                  </select>
                  @error('kategori')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="keterangan" class="form-label">Deskripsi barang</label>
                  <textarea class="form-control @error('keterangan') is-invalid @enderror" id="keterangan" name="keterangan" rows="3">{{ old('keterangan') }}</textarea>
                  @error('keterangan')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>
    
                <div class="mb-3">
                  <label for="gambar" class="form-label">Gambar barang</label>
                  <input class="form-control @error('gambar') is-invalid @enderror" type="file" id="gambar" name="gambar">
                  @error('gambar')
                    <div class="invalid-feedback">
                      {{ $message }}
                    </div>
                  @enderror
                </div>

                {{-- preview gambar --}}
                <div class="mb-3">
                  <label for="gambar" class="form-label">Preview gambar barang</label>
                  <br>
                  <img id="preview" src="http://via.placeholder.com/640x360
" alt="preview" width="200">
                </div>
    
                <button type="submit" class="btn btn-primary">Tambah barang</button>
    
              </form>

            </div>
          </div>


        </div>
      </div>
    </div>

  </div>

  @push('scripts')
    
    <script>
      // preview gambar
      function previewImage() {
        const gambar = document.querySelector('#gambar');
        const preview = document.querySelector('#preview');

        const fileGambar = new FileReader();
        fileGambar.readAsDataURL(gambar.files[0]);

        fileGambar.onload = function(e) {
          preview.src = e.target.result;
        }
      }

      const gambar = document.querySelector('#gambar');

      // event listener
      gambar.addEventListener('change', previewImage);
    </script>

  @endpush
    
@endsection