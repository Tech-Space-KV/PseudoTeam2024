@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container">

    <h2>Your Cart</h2>

    <div class="mb-4" id="message-container">
    @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>
  @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
      {{ session('error') }}
    </div>
  @endif
    </div>


    </br>

    <form method="POST">
    @csrf
    <div class="mb-2">
      <select class="form-select form-select-sm" aria-label=".form-select-sm example">
      <option selected>Select delivery address</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
      </select>
    </div>

    <!-- <div class="mb-4">
      <a class="text-decoration-none" href="">+ add new adress</a>
    </div> -->

    <div class="mb-4">
      <a class="text-decoration-none" href="#" data-bs-toggle="modal" data-bs-target="#addressModal">+ Add new
      address</a>
    </div>

    <div class="order-md-last">
      <ul class="list-group mb-3">
      @foreach($hardwareDetails as $detail)
      <li class="list-group-item d-flex justify-content-between lh-sm"
      id="cart-item-{{ $detail['hardware']->hrdws_id }}">
      <div>
      <h6 class="my-0">Identifier: {{ $detail['hardware']->hrdws_hw_identifier ?? 'Identifier not found' }}</h6>
      <small class="text-body-secondary">Description:
        {{ $detail['hardware']->hrdws_model_description ?? 'Description not found' }}</small><br>
      <small class="quantity-info">Quantity: {{ $detail['quantity'] }}</small>
      </div>
      <span class="text-body-secondary">
      <i class="fa fa-times remove-from-cart" style="cursor: pointer;"
        data-cart-item-id="{{ $detail['hardware']->hrdws_id }}"></i>
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

      <button type="submit" class="btn btn-primary w-100 mt-2" id="place-order-btn">Place order</button>


    </div>

    </form>


    <!-- Modal -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addressModalLabel">Enter New Address</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="addressForm">
        <div class="mb-3">
          <label for="street" class="form-label">Street Address</label>
          <input type="text" class="form-control" id="street" required>
        </div>
        <div class="mb-3">
          <label for="city" class="form-label">City</label>
          <input type="text" class="form-control" id="city" required>
        </div>
        <div class="mb-3">
          <label for="state" class="form-label">State</label>
          <input type="text" class="form-control" id="state" required>
        </div>
        <div class="mb-3">
          <label for="zipcode" class="form-label">Zipcode</label>
          <input type="text" class="form-control" id="zipcode" required>
        </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" form="addressForm" class="btn btn-primary">Save Address</button>
      </div>
      </div>
    </div>
    </div>



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

        $('#message-container').html(`
      <div class="alert alert-success" role="alert">
      ${response.message}
      </div>
    `);

        setTimeout(function () {
        window.location.href = '/customer/session/marketplace/hardwares-orders';
        }, 2000);

        // // Optionally, redirect to order confirmation page
        // window.location.href = '/order-confirmation';  // Redirect to order confirmation page, for example
      },
      error: function (xhr, status, error) {

        $('#place-order-btn').prop('disabled', false).text('Place Order');

        console.log('Error:', error);

        $('#message-container').html(`
      <div class="alert alert-danger" role="alert">
      An error occurred while placing the order. Please try again.
      </div>
    `);

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

<!-- <script>
  document.getElementById('addressForm').addEventListener('submit', function(e) {
    e.preventDefault(); /
    // You can add your logic to process the address here, like saving to a database
    let street = document.getElementById('street').value;
    let city = document.getElementById('city').value;
    let state = document.getElementById('state').value;
    let zipcode = document.getElementById('zipcode').value;

    console.log('Address:', street, city, state, zipcode);
 
    let modal = new bootstrap.Modal(document.getElementById('addressModal'));
    modal.hide();
  });
</script> -->

<script>
  document.getElementById('saveAddressButton').addEventListener('click', function() {
  
    let form = new FormData(document.getElementById('addressForm'));
    
    // Send the data to the server using AJAX
    fetch('{{ route('saveAddress') }}', {
      method: 'POST',
      body: form
    })
    .then(response => response.json())
    .then(data => {
      if (data.success) {
        alert(data.message); // Show success message
        // Optionally close the modal
        let modal = new bootstrap.Modal(document.getElementById('addressModal'));
        modal.hide();
      } else {
        alert('There was an error saving the address.');
      }
    })
    .catch(error => {
      console.error('Error:', error);
      alert('There was an error with the request.');
    });
  });
</script>




@endsection