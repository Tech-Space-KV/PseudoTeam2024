@extends('service-partner.base_layout')

@section('content')
</br>
<div class="container">
  <div class="mb-4">
    <h2 style="font-size: 24px; font-weight: bold; color: #333;">Hardware Details</h2>
  </div>
  <div class="container w-100 mb-4">
    <form id="hardware-form" style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      <div style="margin-bottom: 20px;">
        <label for="serialNumber" style="font-weight: bold; font-size: 16px; color: #555;">Serial Number</label><br>
        <input type="text" id="serialNumber" value="123" readonly
          style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
      </div>

      <div style="margin-bottom: 20px;">
        <label for="hardwareIdentifier" style="font-weight: bold; font-size: 16px; color: #555;">Hardware Identifier</label><br>
        <input type="text" id="hardwareIdentifier" name="hardwareIdentifier" value="aq1" readonly
          style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">
      </div>

      <div style="margin-bottom: 20px;">
        <label for="modelNumber" style="font-weight: bold; font-size: 16px; color: #555;">Model Number</label><br>
        <input type="text" id="modelNumber" name="modelNumber" readonly style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);" value="zaq1">
      </div>

      <div style="margin-bottom: 20px;">
        <label for="modelDescription" style="font-weight: bold; font-size: 16px; color: #555;">Model Description</label><br>
        <textarea id="modelDescription" name="modelDescription" readonly style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);">xsw2</textarea>
      </div>

      <div style="margin-bottom: 20px;">
        <label for="quantity" style="font-weight: bold; font-size: 16px; color: #555;">Quantity</label><br>
        <input type="number" id="quantity" required name="quantity"
          style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;"
          placeholder="Quantity" min="1">
        <small style="display: block; margin-top: 5px; font-size: 14px; color: #777;">Quantity available: <span id="availableQuantity" style="font-weight: bold;">2</span></small>
      </div>

      <div style="margin-bottom: 20px;">
        <label for="family" style="font-weight: bold; font-size: 16px; color: #555;">Family</label><br>
        <input type="text" id="family" name="family" readonly style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);" value="cde1">
      </div>

      <div style="margin-bottom: 20px;">
        <label for="city" style="font-weight: bold; font-size: 16px; color: #555;">City</label><br>
        <input type="text" id="city" name="city" readonly style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);" value="delhi">
      </div>

      <div style="margin-bottom: 20px;">
        <label for="state" style="font-weight: bold; font-size: 16px; color: #555;">State</label><br>
        <input type="text" id="state" name="state" readonly style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);" value="delhi">
      </div>

      <button type="button" onclick="submitForm()"
        style="width: 20%;  padding: 12px; background-color: #007bff; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer;">
        Request Purchase
      </button>
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
      alert("Please enter a valid quantity.");
      quantityInput.focus();
      return;
    }

    if (quantity > availableQuantity) {
      alert(`Quantity cannot exceed the available quantity (${availableQuantity}).`);
      quantityInput.focus();
      return;
    }

    if (serialNumber && hardwareIdentifier && modelNumber && quantity) {
      alert('Form submitted successfully!');
      // Submit the form via AJAX or to the backend here if needed.
    } else {
      alert('Please fill in all required fields.');
    }
  }
</script>

@endsection