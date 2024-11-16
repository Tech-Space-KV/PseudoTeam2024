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
        <div class="card scr-card scr-card1">
          <div class="card-body">
            <h4 class="card-title">Total Projects</h4>
          </div>
          <p class="card-title ms-3">No. of projects added: 117</p>
          <a class="btn btn-sm btn-outline-dark m-2">View &gt;&gt;</a>
        </div>
      </div>
  
     
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card scr-card scr-card2">
          <div class="card-body">
            <h4 class="card-title">Total Projects</h4>
          </div>
          <p class="card-title ms-3">No. of projects added: 117</p>
          <a class="btn btn-sm btn-outline-dark m-2">View &gt;&gt;</a>
        </div>
      </div>
  
     
      <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
        <div class="card scr-card scr-card3">
          <div class="card-body">
            <h4 class="card-title">Total Projects</h4>
          </div>
          <p class="card-title ms-3">No. of projects added: 117</p>
          <a class="btn btn-sm btn-outline-dark m-2">View &gt;&gt;</a>
        </div>
      </div>
  
    </div>
  
</br>
</br>
    <p><span class="fs-2 fw-bold mt-4">Latest Projects </span></p>

    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">First</th>
          <th scope="col">Last</th>
          <th scope="col">Handle</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th scope="row">1</th>
          <td>Mark</td>
          <td>Otto</td>
          <td>@mdo</td>
        </tr>
        <tr>
          <th scope="row">2</th>
          <td>Jacob</td>
          <td>Thornton</td>
          <td>@fat</td>
        </tr>
        <tr>
          <th scope="row">3</th>
          <td colspan="2">Larry the Bird</td>
          <td>@twitter</td>
        </tr>
      </tbody>
    </table>

  </div>
  

@endsection
