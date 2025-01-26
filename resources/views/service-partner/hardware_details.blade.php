@extends('service-partner.base_layout')

@section('content')

<div class="container mt-5">
  <!-- Page Title -->
  <div class="mb-4">
    <h2 class="text-pseudo">Add Hardware Details</h2>
  </div>

  <div class="container w-100 mb-4">
    <form id="hardware-form" style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      <!-- Serial Number -->
      <div class="form-group mb-3">
        <label for="serialNumber" class="form-label">Serial Number</label>
        <input type="text" id="serialNumber" class="form-control" value="13243546">
      </div>
      <!-- Hardware Identifier -->
      <div class="form-group mb-3">
        <label for="hardwareIdentifier" class="form-label">Hardware Identifier</label>
        <input type="text" id="hardwareIdentifier" name="hardwareIdentifier" class="form-control" value="BRCASS1950L00D">
      </div>
      <!-- Model Number -->
      <div class="form-group mb-3">
        <label for="modelNumber" class="form-label">Model Number</label>
        <input type="text" id="modelNumber" name="modelNumber" class="form-control" value="MP-7800B-FV-CF">
      </div>
      <!-- Model Description -->
      <div class="form-group mb-3">
        <label for="modelDescription" class="form-label">Model Description</label>
        <textarea id="modelDescription" name="modelDescription" class="form-control">MP-7800B FABRIC VISION LICENSE =MA</textarea>
      </div>
      <!-- Add/Reduce Quantity -->
      <div class="form-group mb-3">
        <label for="quantity" class="form-label">Add/Reduce Quantity</label>
        <input type="number" id="quantity" name="quantity" class="form-control" value="0">
      </div>
      <!-- Total Quantity Details -->
      <div class="form-group mb-3">
        <label class="form-label">Quantity Details</label>
        <p>Total Qty: 1</p>
        <p>Available Qty: 1</p>
        <p>Booked Qty: 0</p>
      </div>
      <!-- Family -->
      <div class="form-group mb-3">
        <label for="family" class="form-label">Family</label>
        <input type="text" id="family" name="family" class="form-control" value="CONNECTRIX">
      </div>
      <!-- City -->
      <div class="form-group mb-3">
        <label for="city" class="form-label">City</label>
        <input type="text" id="city" name="city" class="form-control" value="BANGALORE">
      </div>
      <!-- State -->
      <div class="form-group mb-3">
        <label for="state" class="form-label">State</label>
        <input type="text" id="state" name="state" class="form-control" value="KARNATAKA">
      </div>
      <!-- Price Per Unit -->
      <div class="form-group mb-3">
        <label for="pricePerUnit" class="form-label">Price per unit</label>
        <input type="text" id="pricePerUnit" name="pricePerUnit" class="form-control" value="200000">
      </div>
      <!-- Submit Button -->
      <div class="form-group">
        <button type="button" onclick="submitForm()" class="btn btn-primary w-100">Submit</button>
      </div>
    </form>
  </div>
</div>

<script>
  function submitForm() {
    const serialNumber = document.getElementById('serialNumber').value.trim();
    const hardwareIdentifier = document.getElementById('hardwareIdentifier').value.trim();
    const modelNumber = document.getElementById('modelNumber').value.trim();
    const modelDescription = document.getElementById('modelDescription').value.trim();
    const quantity = document.getElementById('quantity').value.trim();
    const family = document.getElementById('family').value.trim();
    const city = document.getElementById('city').value.trim();
    const state = document.getElementById('state').value.trim();
    const pricePerUnit = document.getElementById('pricePerUnit').value.trim();

    if (!hardwareIdentifier) {
      alert("Hardware Identifier is required.");
      document.getElementById('hardwareIdentifier').focus();
      return;
    }

    if (!modelNumber) {
      alert("Model Number is required.");
      document.getElementById('modelNumber').focus();
      return;
    }

    if (!modelDescription) {
      alert("Model Description is required.");
      document.getElementById('modelDescription').focus();
      return;
    }

    if (!quantity || isNaN(quantity) || quantity < 0) {
      alert("Please enter a valid Quantity.");
      document.getElementById('quantity').focus();
      return;
    }

    if (!family) {
      alert("Family is required.");
      document.getElementById('family').focus();
      return;
    }

    if (!city) {
      alert("City is required.");
      document.getElementById('city').focus();
      return;
    }

    if (!state) {
      alert("State is required.");
      document.getElementById('state').focus();
      return;
    }

    if (!pricePerUnit || isNaN(pricePerUnit) || pricePerUnit <= 0) {
      alert("Please enter a valid Price per unit.");
      document.getElementById('pricePerUnit').focus();
      return;
    }

    alert('Form submitted successfully!');
    // Add form submission logic here (e.g., AJAX request or form POST).
  }
</script>

@endsection
