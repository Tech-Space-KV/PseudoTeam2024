@extends('customer.base_layout')

@section('content')
  </br>
  <div class="container">
    <div class="mb-4" id="message-container">
      
    <h2 style="font-size: 24px; font-weight: bold; color: #333;">Hardware Details</h2>

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
    <div class="container w-100 mb-4">

    <form id="hardware-form" action="addToCart" method="POST"
      style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      @csrf
 
     <!-- code added by sanskar on 24/02/2025 -->
      <input type="hidden" id="hrdws_id" name="cart_hw_id" value="{{ $hardware->hrdws_id }}"/>

      <div style="margin-bottom: 20px;">
      <label for="serialNumber" style="font-weight: bold; font-size: 16px; color: #555;">Serial Number</label><br>
      <input type="text" id="serialNumber" value="{{ $hardware->hrdws_serial_number }}" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="hardwareIdentifier" style="font-weight: bold; font-size: 16px; color: #555;">Hardware
        Identifier</label><br>
      <input type="text" id="hardwareIdentifier" name="hardwareIdentifier"
        value="{{ $hardware->hrdws_hw_identifier }}" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="modelNumber" style="font-weight: bold; font-size: 16px; color: #555;">Model Number</label><br>
      <input type="text" id="modelNumber" name="modelNumber" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"
        value="{{ $hardware->hrdws_model_number }}">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="modelDescription" style="font-weight: bold; font-size: 16px; color: #555;">Model
        Description</label><br>
      <textarea id="modelDescription" name="modelDescription" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">{{ $hardware->hrdws_model_description }}</textarea>
      </div>

      <div style="margin-bottom: 20px;">
      <label for="quantity" style="font-weight: bold; font-size: 16px; color: #555;">Quantity</label><br>
      <input type="number" id="quantity" required name="cart_qty"
        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;"
        placeholder="{{ $hardware->hrdws_qty }}" min="1" max="{{ $hardware->hrdws_qty }}">
      <small style="display: block; margin-top: 5px; font-size: 14px; color: #777;">Quantity available: <span id="availableQuantity" style="font-weight: bold;">{{ $hardware->hrdws_qty }}</span></small>
      </div>

      <div style="margin-bottom: 20px;">
      <label for="family" style="font-weight: bold; font-size: 16px; color: #555;">Family</label><br>
      <input type="text" id="family" name="family" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"
        value="{{ $hardware->hrdws_family }}">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="city" style="font-weight: bold; font-size: 16px; color: #555;">City</label><br>
      <input type="text" id="city" name="city" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"
        value="{{ $hardware->hrdws_city }}">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="state" style="font-weight: bold; font-size: 16px; color: #555;">State</label><br>
      <input type="text" id="state" name="state" readonly
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);"
        value="{{ $hardware->hrdws_state }}">
      </div>

      <input type="submit" onclick="submitForm()" value="Add To Cart"
      style="width: 20%;  padding: 12px; background-color: #007bff; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer;"/>
    </form>
    </div>
  </div>
  </div>

  <script>
    function submitForm() {
    const serialNumber = document.getElementById('serialNumber').value;
    const hardwareIdentifier = document.getElementById('hardwareIdentifier').value;
    const modelNumber = document.getElementById('modelNumber').value;
    const quantityInput = document.getElementById('quantity');
    const quantity = parseInt(quantityInput.value);
    const availableQuantity = parseInt(document.getElementById('availableQuantity').innerText);

    // Validation logic
    if (!quantity) {
      // alert("Please enter a valid quantity.");

      document.getElementById('message-container').innerHTML = `
        <div class="alert alert-warning" role="alert">
          Please enter a valid quantity.
        </div>
      `;

      document.getElementById('message-container').scrollIntoView({ behavior: 'smooth' });

      return;

      quantityInput.focus();
      return;
    }

    if (quantity > availableQuantity) {
      // alert(`Quantity cannot exceed the available quantity (${availableQuantity}).`);

      document.getElementById('message-container').innerHTML = `
        <div class="alert alert-warning" role="alert">
          Quantity cannot exceed the available quantity (${availableQuantity}).
        </div>
      `;

      quantityInput.focus();

      document.getElementById('message-container').scrollIntoView({ behavior: 'smooth' });

      return;
    }

    if (serialNumber && hardwareIdentifier && modelNumber && quantity) {

      document.getElementById('hardware-form').submit();
      // alert('Item added to cart successfully!');
      
    } else {
      // alert('Please fill in all required fields.');
      document.getElementById('message-container').innerHTML = `
        <div class="alert alert-warning" role="alert">
        Please fill in all required fields.
        </div>
      `;

      document.getElementById('message-container').scrollIntoView({ behavior: 'smooth' });

    }
    }
  </script>

  <script>

    document.addEventListener('DOMContentLoaded', function () {
    var availableQty = {{ $hardware->hrdws_qty }};
    var quantityInput = document.getElementById('quantity');
    quantityInput.setAttribute('max', availableQty);
    document.getElementById('availableQuantity').textContent = availableQty;
    });

  </script>


@endsection