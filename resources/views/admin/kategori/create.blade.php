@extends('layouts.app')
@section('content')

  <div class="container">

    <h1 class="h2">Tambah kategori</h1>

    <div class="row">
      <div class="col-md-6">
        <form action="{{ route('kategori.store') }}" method="post">
          @csrf
          <div class="mb-3">
            <label for="nama_kategori" class="form-label">Nama kategori</label>
            <input type="text" name="nama_kategori" id="nama_kategori" class="form-control @error('nama_kategori') is-invalid @enderror" value="{{ old('nama_kategori') }}" autofocus>
            @error('nama_kategori')
              <div class="invalid-feedback">
                {{ $message }}
              </div>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
      </div>
    </div>


  </div>
    
@endsection