@extends('layouts.app')
@section('content')

<div class="container">

  <h1 class="h2 mb-0">Setting Toko Online</h1>
  <span>Halaman setting toko online, meta seo, dll.</span>

  <div class="row">
    <div class="col-md-9">
      <div class="card my-3">
        <div class="card-body">
          <form action="{{ route('setting.update') }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
              <div class="mb-3 row">
                <label for="title" class="col-sm-2 col-form-label">Judul Website</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="title" name="website" value="{{ old('website') ?? $setting->website }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Tagline Website</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="description" rows="3" name="tagline">{{ old('tagline') ?? $setting->tagline }}</textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Deskripsi Website</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="description" rows="3" name="deskripsi">{{ old('deskripsi') ?? $setting->deskripsi }}</textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="keywords" class="col-sm-2 col-form-label">Keywords Website</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="keywords" rows="3" name="keyword">{{ old('keyword') ?? $setting->keyword }}</textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="author" class="col-sm-2 col-form-label">Author Website</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="author" name="author" value="{{ old('author') ?? $setting->author }}">
                </div>
              </div>


              <div class="mb-3 row">
                <label for="facebook" class="col-sm-2 col-form-label">Facebook</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="facebook" name="facebook" value="{{ old('facebook') ?? $setting->facebook }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="instagram" class="col-sm-2 col-form-label">Instagram</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram') ?? $setting->instagram }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="twitter" class="col-sm-2 col-form-label">Twitter</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="twitter" name="twitter" value="{{ old('twitter') ?? $setting->twitter }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="youtube" class="col-sm-2 col-form-label">Youtube</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="youtube" name="youtube" value="{{ old('youtube') ?? $setting->youtube }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="whatsapp" class="col-sm-2 col-form-label">Whatsapp</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="whatsapp" name="whatsapp" value="{{ old('whatsapp') ?? $setting->whatsapp }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="email" name="email" value="{{ old('email') ?? $setting->email }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="phone" class="col-sm-2 col-form-label">Phone</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="phone" name="telepon" value="{{ old('telepon') ?? $setting->telepon }}">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="address" class="col-sm-2 col-form-label">Alamat</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="address" rows="3" name="alamat">{{ old('alamat') ?? $setting->alamat }}</textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="map" class="col-sm-2 col-form-label">Map</label>
                <div class="col-sm-10">
                  <textarea class="form-control" id="map" rows="3" name="googlemaps">{{ old('googlemaps') ?? $setting->googlemaps }}</textarea>
                </div>
              </div>

              <div class="mb-3 row">
                <label for="logo" class="col-sm-2 col-form-label">Logo</label>
                <div class="col-sm-10">
                  <input type="file" class="form-control gambar" id="logo" name="logo" value="{{ old('logo') ?? $setting->logo }}" onchange="previewImage()">
                </div>
              </div>

              {{-- logo preview --}}
              <div class="mb-3 row">
                <label for="logo" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <img src="{{ asset('/storage/logo/'.$setting->logo) }}" alt="preview" width="100px" class="img-thumbnail">
                </div>
              </div>

              <div class="mb-3 row">
                <label for="logo" class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
  </div>


</div>

@push('scripts')

  <script>

    // untuk preview image sebelum di upload
    function previewImage() {
      const logo = document.querySelector('#logo');
      const imgPreview = document.querySelector('.img-thumbnail');

      const fileLogo = new FileReader();
      fileLogo.readAsDataURL(logo.files[0]);

      fileLogo.onload = function(e) {
        imgPreview.src = e.target.result;
      }
    }

  </script>
    
@endpush
    
@endsection