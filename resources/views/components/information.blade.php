<a href="{{ $route ?? __('/my' . strtolower($title) )  }}" class="text-decoration-none text-black">
  <div class="card border-0 border-start border-{{ $color }} border-5 shadow-sm py-2">
    <div class="card-body">
      <div class="row g-0 align-items-center">
        <div class="col mx-1">
          <div class="fs-4 fw-bold text-uppercase mb-1">{{ $title }}</div>
          <div class="h5 mb-0 fw-bold text-muted">
              {{ $total }} {{ $title ?? '' }}
          </div>
        </div>
        <div class="col-auto">
          <i class="fas fa-{{ $icon }} fa-3x text-{{ $color }}"></i>
        </div>
      </div>
    </div>
  </div>
</a>