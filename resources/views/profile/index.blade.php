@extends('layouts.app')
@section('content')

  <div class="container">

    
    {{-- halaman profile --}}
    <div class="row g-3">
      <div class="col-md-4 my-2">
        <h1 class="h2">Profile </h1>
        <div class="card">
          <div class="card-body text-center">
            <div class="row justify-content-center">
              <div class="col-md-7 my-3">
                <img width="80px" src="{{ asset('storage/user.png') }}" alt="{{ $user->name }}" class="img-thumbnail rounded-circle">
              </div>
              <div class="col-md-7">
                <h3>{{ $user->name }}</h3>
                <p>
                  {{-- <i class="fa-solid fa-envelope fa-fw"></i> {{ $user->email }} <br> --}}
                  <span class="badge bg-primary">
                    <i class="fa-solid fa-shield fa-fw" aria-hidden="true"></i> {{ $user->role }}  
                  </span> <br>
                </p>
              </div>
            </div>
          </div>
        </div>
        <button type="button" class="btn btn-outline-dark w-100 mt-1">
          Terdaftar sejak {{ $user->created_at->diffForHumans() }}
        </button>
      </div>
      <div class="col-md my-2">
        <h2>Update profile</h2>
        <div class="card">
          <div class="card-body">
            <form action="{{-- route('profile.update',$user->id) --}}" method="POST">
              @csrf
              @method('PUT')
              <div class="mb-3">
                <label for="name" class="form-label">Nama lengkap</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
              </div>
              <div class="mb-3">
                <label for="email" class="form-label">Alamat email</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
              </div>
              <div class="mb-3">
                <label for="password" class="form-label">Ganti password</label>
                <input type="password" class="form-control" id="password" name="password">
              </div>
              <button type="submit" class="btn btn-primary">Update profile</button>
            </form>
          </div>
        </div>

        <div class="danger-zone">
          <h3 class="mt-3">Danger zone</h3>
          <div class="card">
            <div class="card-body">

              <form class="d-flex justify-content-between align-items-center" action="{{-- route('profile.destroy',$user->id) --}}" method="POST">
                @csrf
                @method('DELETE')
                <label for="btn-delete" class="fs-4 fw-bold">Hapus akun</label>
                <button id="btn-delete" type="submit" class="btn btn-danger btn-sm">Hapus</button>
              </form>
              <span class="text-small text-muted mt-1">
                <i class="fa-solid fa-exclamation-triangle fa-fw text-warning"></i> 
                Hapus akun akan menghapus semua data yang berhubungan dengan akun ini.
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>
    
@endsection