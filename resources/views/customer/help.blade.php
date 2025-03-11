<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')


</br>
<div class="container ">
  <div class="mb-4">
    <h2>Support</h2>
  </div><br>
  <div class="card shadow p-4">

  <form id="queryform" action="{{ route('submit.query') }}" method="POST">
    @csrf
    <div class="form-group mb-3">
      <label for="query" class="form-label  fw-semibold">Your Query</label>
      <textarea
        id="query"
        class="form-control"
        rows="5"
        placeholder="Type your query here..."
        name="query"></textarea>
    </div>
    <div class="d-grid">
      <button type="submit" id="submit-btn" class="btn btn-primary btn-lg">Submit</button>
    </div>
  </form>
  </div>

</div>

  <script>

    document.getElementById('submit-btn').addEventListener('click', function() {

      event.preventDefault();

      const query = document.getElementById('query').value.trim();

      if (query) {
        document.getElementById('queryform').submit();
        alert('Form submit successfullly!');
      } else {
        alert('Please enter a query before submitting.');
      }

    });

  </script>
  @endsection