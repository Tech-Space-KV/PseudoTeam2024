@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container">
    <div class="mb-4">
    <h2>Your Cart</h2>
    </div>
    </br>

    <form>
    @csrf

    <div class="mb-2">
      <select class="form-select form-select-sm" aria-label=".form-select-sm example">
      <option selected>Select delivery address</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
      </select>
    </div>

    <div class="mb-4">
      <a class="text-decoration-none" href="">+ add new adress</a>
    </div>

    <div class="order-md-last">
      <ul class="list-group mb-3">
      @foreach($hardwareDetails as $hardware)
      <li class="list-group-item d-flex justify-content-between lh-sm">
      <div>
      <h6 class="my-0">{{ $hardware->hrdws_hw_identifier ?? 'Identifier not found' }}</h6>
      <small
        class="text-body-secondary">{{ $hardware->hrdws_model_description ?? 'Description not found' }}</small>
      </div>
      <span class="text-body-secondary">
      <i class="fa fa-times" style="cursor: pointer;" data-cart-item-id="{{ $hardware->hrdws_id }}"></i>
      </span>
      </li>
    @endforeach
      </ul>

      {{-- <div class="card p-2">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Promo code">
        <button type="submit" class="btn btn-secondary">Redeem</button>
      </div>
      </div> --}}

      <button type="submit" class="btn btn-primary w-100 mt-2">Place order</button>


    </div>

    </form>

  </div>


  <script>
    function removeItem(itemId) {
    if (confirm('Are you sure you want to remove this item from your cart?')) {
      fetch(`/remove-from-cart/${itemId}`, {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Content-Type': 'application/json'
      },
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
        const itemElement = document.getElementById('cart-item-' + itemId);
        if (itemElement) {
          itemElement.remove();
        }
        } else {
        alert('There was an error removing the item.');
        }
      })
      .catch(error => {
        console.error('Error:', error);
        alert('Something went wrong. Please try again later.');
      });
    }
    }
  </script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $(".fa-times").click(function() {
        var cartItemId = $(this).data("cart-item-id");  
        var row = $(this).closest("li");  
        
        $.ajax({
            url: "{{ route('cart.remove') }}",  
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",  
                cart_item_id: cartItemId 
            },
            success: function(response) {
                if (response.cartCount !== undefined) {
                    $('#cart-count').text(response.cartCount);
                }
                row.remove();
            },
            error: function() {
                alert("Error removing item from cart.");
            }
        });
    });
});
</script>



@endsection