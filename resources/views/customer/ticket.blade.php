@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
  <div class="">
    <h2>Upload Ticket</h2>
  </div>

  <form action="#">

    <h5 class="mt-4 mb-4 text-pseudo">
      <span class="fa fa-bars"></span> Details of support ticket
    </h5>


    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" placeholder="Issue">
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <!-- <input type="textarea" class="form-control" id="description" placeholder="About project"> -->
      <textarea id="description" name="description" class="form-control"
        placeholder="Please elaborate your issue"></textarea>
    </div>

    <div class="mb-3">
      <label for="sow" class="form-label">Upload screenshot</label>
      <input type="file" class="form-control" id="screenshot" placeholder="Upload screenshot">
    </div>

    <div class="row">
        <label for="projectIs" class="form-label">Ticket type</label>
        <select class="form-select" id="tickettype">
          <option selected>--Select type--</option>
          <option value="t1">On Site</option>
          <option value="t2">On Remote</option>
          <option value="t3">t3</option>
        </select>
      
    </div>



    <h5 class="mt-4 mb-4 text-pseudo">
      <span class="fa fa-bars"></span> Define interval
    </h5>

    <div class="row">
      
        <label for="startDate" class="form-label">Start date</label>
        <input type="date" class="form-control" id="startDate" placeholder="Start date">
    

    </div>


    <h5 class="mt-4 mb-4 text-pseudo">
      <span class="fa fa-bars"></span> Details of the person to be contacted by PseudoTeam
    </h5>

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" id="title" placeholder="Name of the authorised person">
    </div>

    <div class="mb-3">
      <label for="email" class="form-label">Email</label>
      <input type="email" class="form-control" id="title" placeholder="Email of the authorised person">
    </div>

    <div class="mb-3">
      <label for="contact" class="form-label">Contact</label>
      <input type="text" class="form-control" id="title" placeholder="Contact no. of authorised person">
    </div>


    <h5 class="mt-4 mb-4 text-pseudo">
      <span class="fa fa-bars"></span> Apply coupons/promo code <sup>(Optional)</sup>
    </h5>

    <div class="mb-3">
      <label for="coupon" class="form-label">Coupon/Promo Code</label>
      <input type="text" class="form-control" id="title" placeholder="Add your coupon or promocode here">
    </div>

    <button type="submit" class="btn btn-primary">Upload</button>

  </form>
</div>

@endsection