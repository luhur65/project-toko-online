{{-- @props(['items', 'message']) --}}

@if (count($items) > 1)

<div class="alert alert-info" role="alert">
  <strong> <i class="fas fa-info-circle fa-fw" aria-hidden="true"></i> INFO</strong> 

  {{ $message }}
  
</div>    
@endif