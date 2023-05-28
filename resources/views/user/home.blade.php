@extends('layouts.app')

@section('content')
<div class="container">

    <div class="row mb-3">
        <div class="col-md-12">
            <h1 class="h3 fw-bold mb-0">Hi, {{ auth()->user()->name }}</h1>
            <span class="text-muted">Berikut ini adalah rekapan semua transaksi yang kamu lakukan seperti Order, Cart, dan Wishlist</span>
        </div>
    </div>

    <div class="row g-2 my-3">
        <div class="col-md-4 my-1">
            <x-information title="Order" icon="shopping-bag" total="{{ auth()->user()->countOrder() }}" color="success"/>
        </div>
        <div class="col-md-4 my-1">
            <x-information title="Cart" icon="shopping-cart" total="{{ auth()->user()->countCart() }}" color="warning"/>
        </div>
        <div class="col-md-4 my-1">
            <x-information title="Wishlist" icon="heart" total="{{ auth()->user()->countWishlist() }}" color="danger"/>
        </div>
    </div>
</div>

<div class="temp-location d-none"></div>

@push('scripts')
    <script>

        document.addEventListener('DOMContentLoaded', function() {
            
            // get data from local storage
            const data = localStorage.getItem('nextPage');

            const elem = document.querySelector('.temp-location');
            elem.textContent = data;

            // remove data from local storage
            localStorage.removeItem('nextPage');


            // check if data is not null
            if ( elem.textContent !== "") {
                
                // redirect
                document.location.href = elem.textContent;

            }
            
            
        });

    </script>
@endpush

@endsection
