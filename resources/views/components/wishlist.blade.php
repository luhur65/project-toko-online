@auth
    <form class="" action="{{ route('wishlist.add') }}" method="post">
      @csrf
        <input type="hidden" name="kode" value="{{ $id }}" readonly>
        <button type="submit" class="btn btn-danger">
          @if (auth()->user()->isAWishlist($id) == false)
            @if (isset($icon))
              <i class="fa-solid fa-heart fa-fw"></i>

            @else
              <i class="fa-solid fa-heart fa-fw"></i> Tambahkan ke wishlist

            @endif

          @else
            @if (isset($icon))
              <i class="fa-solid fa-bookmark fa-fw"></i> Lihat wishlist

            @else
              <i class="fa-solid fa-bookmark fa-fw"></i>

            @endif
              
          @endif
        </button>
    </form>
@endauth