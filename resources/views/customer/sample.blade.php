<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')





<p><span class="fs-1 fw-bold">Hi, </span><span class="fs-3">Kunal</span></p>
<div class="alert alert-primary" role="alert">
    Want to get a job done? <a class="btn btn-sm btn-outline-primary">Upload project</a>
</div>

<div class="container px-4">
    <div class="row mx-auto">
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card">
          <div class="card-body scr-card">
            <a class="btn btn-sm btn-outline-primary">View &gt;&gt;</a>
          </div>
        </div>
      </div>
  
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">Card 2</h5>
            <p class="card-text">This is the second card.</p>
          </div>
        </div>
      </div>
  
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card">
          <img src="https://via.placeholder.com/150" class="card-img-top" alt="Card Image">
          <div class="card-body">
            <h5 class="card-title">Card 3</h5>
            <p class="card-text">This is the third card.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
  

@endsection
