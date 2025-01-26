@extends('service-partner.base_layout')

@section('content')

<div class="container mt-5">
  <!-- Page Title -->
  <div class="mb-4">
    <h2 class="text-pseudo">Import Hardware Details</h2>
  </div>

  <!-- File Input -->
  <div class="mb-4">
    <label for="fileInput" class="form-label fw-bold">Select a .csv file</label>
    <input type="file" class="form-control" id="fileInput" name="file" />
  </div>

  <!-- Buttons -->
  <div class="d-flex justify-content-start gap-3">
    <button class="btn btn-sm btn-outline-primary" 
            title="Import Hardware List" 
            onclick="validateAndImportFile()">
      <i class="fa fa-upload me-1"></i> Import File
    </button>
    <a href="{{ asset('samplecsv.csv') }}" 
       class="btn btn-sm btn-outline-secondary" 
       title="Download Sample CSV" 
       download="sample-hardware.csv">
      <i class="fa fa-download me-1"></i> Download Sample CSV
    </a>
  </div>
</div>

<script>
  function validateAndImportFile() {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];

    if (!file) {
      alert("Please select a file before importing.");
      return;
    }

    const fileName = file.name;
    const fileExtension = fileName.split('.').pop().toLowerCase();

    if (fileExtension !== 'csv') {
      alert("The selected file is not in CSV format. Please choose a .csv file.");
      return;
    }

    // Proceed with file import logic
    alert("File is valid and ready to be imported!");
    // Add your import logic here, e.g., submitting the form or sending an AJAX request.
  }
</script>

@endsection
