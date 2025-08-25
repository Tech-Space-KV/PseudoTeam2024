@extends('service-partner.base_layout')

@section('content')
  </br>
  <div class="container">

    <div class="mb-4">
    <h2 style="font-size: 24px; font-weight: bold; color: #333;">Hardware Details</h2>

    @if(session('success'))
    <div class="alert alert-success" role="alert">
      {{ session('success') }}
    </div>

    <script>

      setTimeout(function () {
      window.location.href = "{{ route('hardware.fetch') }}";
      }, 1500);

    </script>

    @endif

    @if(session('error'))
    <div class="alert alert-danger" role="alert">
      {{ session('error') }}
    </div>
    @endif
    </div>

    <div class="container w-100 mb-4">
    <form id="hardwareEditForm" action="{{ route('hardware.update', $hardware->hrdws_id) }}" method="POST"
      style="background-color: #fff; padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
      @csrf
      @method('PUT')

      @php
    $readonly = empty($editMode) ? 'readonly' : '';
    @endphp

      <div style="margin-bottom: 20px;">
      <label for="serialNumber" style="font-weight: bold; font-size: 16px; color: #555;">Serial Number</label><br>
      <input type="text" id="serialNumber" name="serialNumber" value="{{ $hardware->hrdws_serial_number }}" {{ $readonly }}
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="hardwareIdentifier" style="font-weight: bold; font-size: 16px; color: #555;">Hardware
        Identifier</label><br>
      <input type="text" id="hardwareIdentifier" name="hardwareIdentifier"
        value="{{ $hardware->hrdws_hw_identifier }}" {{ $readonly }}
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="modelNumber" style="font-weight: bold; font-size: 16px; color: #555;">Model Number</label><br>
      <input type="text" id="modelNumber" name="modelNumber" {{ $readonly }}
        value="{{ $hardware->hrdws_model_number }}"
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="modelDescription" style="font-weight: bold; font-size: 16px; color: #555;">Model
        Description</label><br>
      <textarea id="modelDescription" name="modelDescription" {{ $readonly }}
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">{{ $hardware->hrdws_model_description }}</textarea>
      </div>

      <div style="margin-bottom: 20px;">
      <label for="quantity" style="font-weight: bold; font-size: 16px; color: #555;">UpdateQuantity</label><br>
      <input type="number" id="quantity" required name="quantity" value="{{ $hardware->hrdws_quantity }}"
        style="width: 100%; padding: 12px; border: 1px solid #ddd; border-radius: 6px; font-size: 14px;"
        placeholder="Quantity" min="1">
      <small style="display: block; margin-top: 5px; font-size: 14px; color: #777;">Quantity available: <span
        id="availableQuantity" style="font-weight: bold;">{{ $hardware->hrdws_qty }}</span></small>
      <small style="display: block; margin-top: 5px; font-size: 14px; color: #777;"><span id="availableQuantity"
        style="font-weight: bold; color: red;">Note: Provide actual quantity, this will not merge with the available
        quantity</span></small>
      </div>

      <div style="margin-bottom: 20px;">
      <label for="family" style="font-weight: bold; font-size: 16px; color: #555;">Family</label><br>
      <input type="text" id="family" name="family" {{ $readonly }} value="{{ $hardware->hrdws_family }}"
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="city" style="font-weight: bold; font-size: 16px; color: #555;">City</label><br>
      <input type="text" id="city" name="city" {{ $readonly }} value="{{ $hardware->hrdws_city }}"
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">
      </div>

      <div style="margin-bottom: 20px;">
      <label for="state" style="font-weight: bold; font-size: 16px; color: #555;">State</label><br>
      <input type="text" id="state" name="state" {{ $readonly }} value="{{ $hardware->hrdws_state }}"
        style="width: 100%; padding: 12px; border: 1px solid #ccc; border-radius: 6px; background-color: #f7f7f7; color: #333; font-size: 14px;">
      </div>

      <button type="button" onclick="submitForm()"
      style="width: 20%;  padding: 12px; background-color: #007bff; color: #fff; border: none; border-radius: 6px; font-size: 16px; cursor: pointer;">
      Edit Hardware
      </button>
    </form>
    </div>
  </div>

  <script>
    function submitForm() {
    const quantityInput = document.getElementById('quantity');
    const quantity = parseInt(quantityInput.value);
    const availableQuantity = parseInt(document.getElementById('availableQuantity').innerText);

    if (!quantity || quantity < 1) {
      alert("Please enter a valid quantity.");
      quantityInput.focus();
      return;
    }

    document.getElementById('hardwareEditForm').submit();
    }
  </script>

@endsection