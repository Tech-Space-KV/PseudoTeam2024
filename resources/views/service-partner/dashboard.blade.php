<!-- resources/views/customer/page1.blade.php -->
@extends('service-partner.base_layout')

@section('content')

<p><span class="fs-1 fw-bold">Hi, </span><span class="fs-3">Kunal</span></p>

<div class="container px-4">
    <div class="row mx-auto">
     
      <div class="col-lg-12 col-md-12 col-sm-12 mb-4 p-4">
        <div class="card teal-gradient rounded-pill p-3 text-light">
          <div class="card-body px-4 py-4 mx-3">
            <h4 class="card-title fw-bold mt-2 ms-2">Find projects</h4>
            <p class="card-title ms-2">Explore exciting new projects and showcase your skills, discover the perfect opportunities to grow and succeed right here</p>
            <a href="{{ url('service-partner/session/find-project') }}" class="btn btn-sm btn-outline-light m-2 mx-auto ms-2 w-25">View &gt;&gt;</a>
          </div>
        </div>
      </div>
  
    </div>
  
<hr class="border border-2 border-secondary">
  </br>
    <p><span class="fs-2 fw-bold mt-4 text-pseudo">Recently Assigned Projects</span></p>

    <div class="card p-3 bg-light btn-outline-primary my-3 text-dark">
      <h5>Project Title: Project ID</h5>
      <p>Project description</p>
      <p>Project details</p>
    </div>

    <div class="card p-3 bg-light btn-outline-primary my-3 text-dark">
      <h5>Project Title: Project ID</h5>
      <p>Project description</p>
      <p>Project details</p>
    </div>

    <div class="card p-3 bg-light btn-outline-primary my-3 text-dark">
      <h5>Project Title: Project ID</h5>
      <p>Project description</p>
      <p>Project details</p>
    </div>

    <div class="card p-3 bg-light btn-outline-primary my-3 text-dark">
      <h5>Project Title: Project ID</h5>
      <p>Project description</p>
      <p>Project details</p>
    </div>

   
          
  </div>
  

@endsection
