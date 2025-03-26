@extends('customer.base_layout')

@section('content')

  </br>
  <div class="container ">
    <h2>Support</h2>
    <div class="mb-4" id="message-container">
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

      document.getElementById('message-container').innerHTML = `
        <div class="alert alert-warning" role="alert">
          Please enter a query before submitting.
        </div>
      `;
    }
  });

  @if(session('success'))
    document.getElementById('message-container').innerHTML = `
      <div class="alert alert-success" role="alert">
        {{ session('success') }}
      </div>
    `;
  @endif
</script>


@endsection