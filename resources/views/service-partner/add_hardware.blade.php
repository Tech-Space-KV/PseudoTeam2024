@extends('service-partner.base_layout')

@section('content')

  <div class="container mt-5">
    <!-- Page Title -->
    <div class="mb-4">
    <h2 class="text-pseudo">Add Hardware Details</h2>
    </div>
    <!--demo push-->
    <div class="container w-100 mb-4">
    <form action="{{ route('hardware.store') }}" method="POST" id="hardware-form"
      style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      @csrf

      <div class="">
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

      <!-- Serial Number -->
      <div class="form-group">
      <label for="serialNumber" class="form-label">Serial Number <span class="text-muted">(optional)</span></label>
      <input type="text" id="serialNumber" class="form-control" name="hrdws_serial_number"
        placeholder="Serial number of h/w">
      </div>
      <br>
      <!-- Hardware Identifier -->
      <div class="form-group">
      <label for="hardwareIdentifier" class="form-label">Hardware Identifier</label>
      <input type="text" id="hardwareIdentifier" name="hrdws_hw_identifier" class="form-control"
        placeholder="Identifier">
      </div>
      <br>
      <!-- Model Number -->
      <div class="form-group">
      <label for="modelNumber" class="form-label">Model Number</label>
      <input type="text" id="modelNumber" name="hrdws_model_number" class="form-control"
        placeholder="H/w model number">
      </div>
      <br>
      <!-- Model Description -->
      <div class="form-group">
      <label for="modelDescription" class="form-label">Model Description</label>
      <textarea id="modelDescription" name="hrdws_model_description" class="form-control"
        placeholder="Description and details"></textarea>
      </div>
      <br>
      <!-- Quantity -->
      <div class="form-group">
      <label for="quantity" class="form-label">Quantity</label>
      <input type="number" id="quantity" name="hrdws_qty" required class="form-control" placeholder="Quantity"
        min="1">
      </div>
      <br>
      <!-- Family -->
      <div class="form-group">
      <label for="family" class="form-label">Family</label>
      <input type="text" id="family" name="hrdws_family" class="form-control" placeholder="Family of H/w">
      </div>
      <br>
      <!-- City -->
      <div class="form-group">
      <label for="city" class="form-label">City</label>
      <input type="text" id="city" name="hrdws_city" class="form-control" placeholder="City where H/w is available">
      </div>
      <br>
      <!-- State -->
      <div class="form-group">
      <label for="state" class="form-label">State</label>
      <input type="text" id="state" name="hrdws_state" class="form-control"
        placeholder="State where H/w is available">
      </div>
      <br>
      <!-- Price Per Unit -->
      <div class="form-group">
      <label for="pricePerUnit" class="form-label">Price per unit</label>
      <input type="text" id="pricePerUnit" name="hrdws_price" class="form-control" placeholder="H/w price per unit">
      </div>
      <br>
      <!-- Submit Button -->
      <div class="form-group">
      <button type="button" onclick="submitForm()" class="btn btn-primary w-100">Submit</button>
      <!-- <input type="submit" class="btn btn-primary w-100" value="Submit"> -->
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

    if (!quantity || isNaN(quantity) || quantity <= 0) {
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

    document.getElementById('hardware-form').submit();

    alert('Form submitted successfully!');
    // Add form submission logic here (e.g., AJAX request or form POST).
    }
  </script>

@endsection