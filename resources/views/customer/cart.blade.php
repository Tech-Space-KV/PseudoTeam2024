
@extends('customer.base_layout')

@section('content')

</br>
<div class="container">
<div class="mb-4">
    <h2>Your Cart</h2>
</div>
</br> 

<form>

  <div class="mb-2">
    <select class="form-select form-select-sm" aria-label=".form-select-sm example">
      <option selected>Select delivery address</option>
      <option value="1">One</option>
      <option value="2">Two</option>
      <option value="3">Three</option>
    </select>
  </div>

  <div class="mb-4">
    <a class="text-decoration-none" href="">+ add new adress</a>
  </div>

<div class="order-md-last">
    <ul class="list-group mb-3">
      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0">Product name</h6>
          <small class="text-body-secondary">Brief description</small>
        </div>
        <span class="text-body-secondary">$12</span>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0">Second product</h6>
          <small class="text-body-secondary">Brief description</small>
        </div>
        <span class="text-body-secondary">$8</span>
      </li>
      <li class="list-group-item d-flex justify-content-between lh-sm">
        <div>
          <h6 class="my-0">Third item</h6>
          <small class="text-body-secondary">Brief description</small>
        </div>
        <span class="text-body-secondary">$5</span>
      </li>
      <li class="list-group-item d-flex justify-content-between bg-body-tertiary">
        <div class="text-success">
          <h6 class="my-0">Promo code</h6>
          <small>EXAMPLECODE</small>
        </div>
        <span class="text-success">−$5</span>
      </li>
      <li class="list-group-item d-flex justify-content-between">
        <span>Total (USD)</span>
        <strong>$20</strong>
      </li>
    </ul>

    {{-- <div class="card p-2">
      <div class="input-group">
        <input type="text" class="form-control" placeholder="Promo code">
        <button type="submit" class="btn btn-secondary">Redeem</button>
      </div>
    </div> --}}

          <button type="submit" class="btn btn-primary w-100 mt-2">Place order</button>


</div>

</form>

</div>



@endsection
