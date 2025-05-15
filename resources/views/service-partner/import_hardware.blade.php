@extends('service-partner.base_layout')

@section('content')

  <div class="container mt-5">
    <!-- Page Title -->
    <div class="mb-4">
    <h2 class="text-pseudo">Import Hardware Details</h2>
    </div>

    @if (session('success'))
    <div class="alert alert-success">
    {{ session('success') }}
    </div>
    @endif

    @if ($errors->any())
    <div class="alert alert-danger">
    <ul class="mb-0">
      @foreach ($errors->all() as $error)
      <li>{{ $error }}</li>
    @endforeach
    </ul>
    </div>
    @endif

    <!-- Import Form -->
    <form id="hardwareImportForm" method="POST" action="{{ route('hardware.import') }}" enctype="multipart/form-data"
    onsubmit="validateAndImportFile(event)">
    @csrf

    <!-- File Input -->
    <div class="mb-4">
      <label for="fileInput" class="form-label fw-bold">Select a .csv file</label>
      <input type="file" class="form-control" id="fileInput" name="file" accept=".csv,.xls,.xlsx" required
      aria-describedby="fileHelp" />
      <div id="fileHelp" class="form-text">Only .csv files are supported.</div>
    </div>

    <!-- Buttons -->
    <div class="d-flex justify-content-start gap-3">
      <button type="submit" class="btn btn-sm btn-outline-primary" title="Import Hardware List"
      onclick="validateAndImportFile(event)">
      <i class="fa fa-upload me-1"></i> Import File
      </button>

      <a href="{{ asset('samplecsv.csv') }}" class="btn btn-sm btn-outline-secondary" title="Download Sample CSV"
      download="sample-hardware.csv">
      <i class="fa fa-download me-1"></i> Download Sample CSV
      </a>
    </div>
    </form>
  </div>

  <!-- JavaScript Validation and Submission -->
  <!-- <script>
    function validateAndImportFile(event) {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];

    if (!file) {
      event.preventDefault();
      alert("Please select a file before importing.");
      return;
    }

    const fileName = file.name;
    const fileExtension = fileName.split('.').pop().toLowerCase();

    if (fileExtension !== 'csv') {
      event.preventDefault();
      alert("The selected file is not in CSV format. Please choose a .csv file.");
    }

    // If checks pass, form submits naturally
    }
    </script> -->

  <script>
    function validateAndImportFile(event) {
    const fileInput = document.getElementById('fileInput');
    const file = fileInput.files[0];

    if (!file) {
      event.preventDefault();
      alert("Please select a file before importing.");
      return;
    }

    const fileName = file.name;
    const fileExtension = fileName.split('.').pop().toLowerCase();

    // Allowed extensions
    const allowedExtensions = ['csv', 'xls', 'xlsx'];

    if (!allowedExtensions.includes(fileExtension)) {
      event.preventDefault();
      alert("Invalid file format. Please upload a .csv, .xls, or .xlsx file.");
    }

    // If checks pass, form submits naturally
    }
  </script>


@endsection