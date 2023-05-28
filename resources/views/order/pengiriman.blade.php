@extends('layouts.app')
@section('content')

<div class="container">
  
  <div class="row g-2">
    <div class="col-md-5 mx-auto">
      <div class="text-center">
        <h1 class="h2 mb-0">Alamat pengiriman</h1>
        <p class="text-muted mt-0">Silakan diisi alamat pengiriman anda!</p>
      </div>
      <div class="card mb-3 border-0">
        <div class="card-body">
          <div class="row">
            <div class="col-md">
              <form action="{{ route('invoice') }}" method="post">
                @csrf
                @method('post')
                <div class="mb-3">
                  <label for="nama" class="form-label">Nama penerima</label>
                  <input type="text" class="form-control" id="nama" name="nama" value="{{ old('nama') ?? auth()->user()->name }}">
                  @error('nama')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" name="email" value="{{ old('email') ?? auth()->user()->email }}">
                  @error('email')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="alamat" class="form-label">Alamat pengiriman</label>
                  <textarea class="form-control" id="alamat" rows="3" name="alamat">{{ old('alamat') }}</textarea>
                  @error('alamat')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <label for="nohp" class="form-label">No. HP</label>
                  <input type="text" class="form-control" id="nohp" name="nohp" value="{{ old('nohp') }}">
                  @error('nohp')
                    <div class="text-danger">{{ $message }}</div>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="hidden" name="data" value="{{ json_encode($order) }}">
                </div>
                <button type="submit" class="btn btn-success">Lanjut invoice</button>
                <a class="btn btn-danger" href="{{ route('cart.index') }}">Batalkan</a>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
              
</div>
    
@endsection