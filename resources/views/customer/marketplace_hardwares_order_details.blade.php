@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container">
    <div class="mb-4">
    <h2>Order No: {{ $ordplcd_order_no }}</h2>
    </div>
    </br>

    <form method="POST">
    @csrf
    <!-- <div class="mb-2">
      <select class="form-select form-select-sm" aria-label=".form-select-sm example">
      <option selected>Select delivery address</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
      </select>
    </div>

    <div class="mb-4">
      <a class="text-decoration-none" href="">+ add new adress</a>
    </div> -->

    <div class="order-md-last">
      <ul class="list-group mb-3">
      @foreach($hardwareDetails as $detail)
      <li class="list-group-item d-flex justify-content-between lh-sm"
      id="cart-item-{{ $detail['hardware']->hrdws_id }}">
      <div>
      <h6 class="my-0">Identifier: {{ $detail['hardware']->hrdws_hw_identifier ?? 'Identifier not available' }}</h6>
      <small class="text-body-secondary">Address: {{ $detail['address'] ?? 'Address not available' }}</small><br>
      <small class="text-body-secondary">Status: {{ $detail['status'] ?? 'Status not available' }}</small><br>
      <small class="text-body-secondary">Delivery Date: {{ $detail['delivery_date'] ?? 'Not Available' }}</small><br>
      <small class="quantity-info">Quantity requested: {{ $detail['quantity'] }}</small><br>          
      <small class="quantity-info">Quantity approved: {{ $detail['quantity_approved'] }}</small>
      </div>
      <!-- <span class="text-body-secondary">
      <i class="fa fa-times remove-from-cart" style="cursor: pointer;"
        data-cart-item-id="{{ $detail['hardware']->hrdws_id }}"></i>
      </span> -->
      </li>
    @endforeach

      </ul>

      {{-- <div class="card p-2">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Promo code">
        <button type="submit" class="btn btn-secondary">Redeem</button>
      </div>
      </div> --}}

      <!-- <button type="submit" class="btn btn-primary w-100 mt-2" id="place-order-btn">Place order</button> -->

    </div>

    </form>

  </div>

  <script>


    // $(document).ready(function() {
    //     $('.remove-from-cart').on('click', function() {
    //         var cartItemId = $(this).data('cart-item-id'); 

    //         $.ajax({
    //             url: '/remove-from-cart/' + cartItemId,  
    //             method: 'DELETE',
    //             data: {
    //                 _token: $('meta[name="csrf-token"]').attr('content')  
    //             },
    //             success: function(response) {

    //                 console.log(response.message);  

    //                 $('#cart-item-' + cartItemId).remove();  

    //                 $('.cart-count').text(response.cartCount); 

    //                 alert('Item removed from cart.');
    //             },
    //             error: function(xhr, status, error) {

    //                 console.log('Error:', error);
    //                 alert('Failed to remove item from cart.');
    //             }
    //         });
    //     });
    // });


    $(document).ready(function () {

    $('#place-order-btn').on('click', function () {

      $('#place-order-btn').prop('disabled', true).text('Processing...');

      $.ajax({

      url: '/place-order',
      method: 'POST',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {

        $('#place-order-btn').prop('disabled', false).text('Place Order');


        alert(response.message);

        setTimeout(function () {
        window.location.href = '/customer/session/marketplace/hardwares-orders';
        }, 1500);

        // // Optionally, redirect to order confirmation page
        // window.location.href = '/order-confirmation';  // Redirect to order confirmation page, for example
      },
      error: function (xhr, status, error) {

        $('#place-order-btn').prop('disabled', false).text('Place Order');

        console.log('Error:', error);
        alert('Failed to place order.');
      }
      });
    });

    // Remove item from cart
    $('.remove-from-cart').on('click', function () {
      var cartItemId = $(this).data('cart-item-id');

      $.ajax({
      url: '/remove-from-cart/' + cartItemId,
      method: 'DELETE',
      data: {
        _token: $('meta[name="csrf-token"]').attr('content')
      },
      success: function (response) {
        console.log(response.message);  // Log success message

        // Remove the item from the cart list
        $('#cart-item-' + cartItemId).remove();

        // Update the cart count on the page
        $('.cart-count').text(response.cartCount);

        // Optionally, alert the user about the removed item
        alert('Item removed from cart.');

        // If the cart is empty, you may want to disable the "Place order" button
        if (response.cartCount === 0) {
        $('#place-order-btn').prop('disabled', true).text('Your cart is empty');
        }
      },
      error: function (xhr, status, error) {
        // Handle error
        console.log('Error:', error);
        alert('Failed to remove item from cart.');
      }
      });
    });
    });


  </script>



@endsection