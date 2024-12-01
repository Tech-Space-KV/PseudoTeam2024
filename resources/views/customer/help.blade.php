<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')


</br>
<div class="container ">
  <div class="mb-4">
    <h2>Support</h2>
  </div><br>
  <div class="card shadow p-4">
    <div class="form-group mb-3">
      <label for="query" class="form-label  fw-semibold">Your Query</label>
      <textarea
        id="query"
        class="form-control "
        rows="5"
        placeholder="Type your query here...">
        </textarea>
    </div>
    <div class="d-grid">
      <button id="submit-btn" class="btn btn-primary btn-lg ">Submit</button>
    </div>
  </div>

  </div>

  <script>
    document.getElementById('submit-btn').addEventListener('click', function() {
      const query = document.getElementById('query').value.trim();
      if (query) {
        alert(`Your query: ${query}`);
      } else {
        alert('Please enter a query before submitting.');
      }
    });
  </script>
  @endsection