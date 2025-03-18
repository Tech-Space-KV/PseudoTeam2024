@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container ">
    <div class="mb-4">
    <h2>Support</h2>
    </div><br>
    <form id="support-query-form" action="{{ route('submitSupportQuery') }}" method="POST">
    @csrf 
    <div class="card shadow p-4">
      <div class="form-group mb-3">
      <label for="query" class="form-label  fw-semibold">Your Query</label>
      <textarea id="query" name="query" class="form-control" rows="5"
        placeholder="Type your query here..."></textarea>
      </div>
      <div class="d-grid">
      <button type="submit" id="submit-btn" class="btn btn-primary btn-lg">Submit</button>
      </div>
    </div>
    </form>
  </div>


  <script>

    document.getElementById('submit-btn').addEventListener('click', function (event) {

    const query = document.getElementById('query').value.trim();
    if (!query) {
      event.preventDefault();
      alert('Please enter a query before submitting.');
    }
    });

    @if(session('success'))
      alert('{{ session('success') }}');
    @endif

  </script>

@endsection