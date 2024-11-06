<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project-upload</title>
    <link rel="stylesheet" href="{{ asset('css/customer/project_upload.css') }}">
</head>

<body>

    @extends('customer.base_layout')

    @section('content')

    <div>
        <h2>Upload a project</h2>
    </div>

    <form action="#">

        <h5 class="mt-4 mb-4 text-primary">
            <span class="fa fa-bars"></span> First details of the project
        </h5>


        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" placeholder="Project title">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <!-- <input type="textarea" class="form-control" id="description" placeholder="About project"> -->
            <textarea id="description" name="description" class="form-control"
                placeholder="Enter your description here"></textarea>
        </div>

        <div class="mb-3">
            <label for="sow" class="form-label">Scope of work</label>
            <input type="file" class="form-control" id="sow" placeholder="Scope of work">
        </div>

        <div class="row">
            <div class="col-md-4 mb-3">
                <label for="projectIs" class="form-label">Project is</label>
                <select class="form-select" id="projectIs">
                    <option selected>--Select type--</option>
                    <option value="t1">t1</option>
                    <option value="t2">t2</option>
                    <option value="t3">t3</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="projectType" class="form-label">Project type</label>
                <select class="form-select" id="projectType">
                    <option selected>--Select type--</option>
                    <option value="t1">t1</option>
                    <option value="t2">t2</option>
                    <option value="t3">t3</option>
                </select>
            </div>
            <div class="col-md-4 mb-3">
                <label for="projectCategory" class="form-label">Project Category</label>
                <select class="form-select" id="projectCategory">
                    <option selected>--Select category--</option>
                    <option value="t1">t1</option>
                    <option value="t2">t2</option>
                    <option value="t3">t3</option>
                </select>
            </div>
        </div>

        <div class="mb-3">
            <label for="budget" class="form-label">Budget</label>

            <div class="d-flex">
                <div class="me-2" style="flex: 0.3;">
                    <select class="form-select" id="budget">
                        <option selected>Currency type</option>
                        <option value="t1">t1</option>
                        <option value="t2">t2</option>
                        <option value="t3">t3</option>
                    </select>
                </div>

                <div style="width: 465px;">
                    <input type="number" class="form-control" id="budgetAmount" placeholder="Enter amount">
                </div>
            </div>
        </div>

        <h5 class="mt-4 mb-4 text-primary">
            <span class="fa fa-bars"></span> Define interval
        </h5>

        <div class="row">
            <div class="col-md-6 mb-3">
                <label for="startDate" class="form-label">Start date</label>
                <input type="date" class="form-control" id="startDate" placeholder="Start date">
            </div>

            <div class="col-md-6 mb-3">
                <label for="endDate" class="form-label">End date</label>
                <input type="date" class="form-control" id="endDate" placeholder="End date">
            </div>
        </div>


        <h5 class="mt-4 mb-4 text-primary">
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

        <h5 class="mt-4 mb-4 text-primary">
            <span class="fa fa-bars"></span> Updates on additional/customer email id <sup>(Optional)</sup>
        </h5>

        <div class="mb-3">
            <div class="custom-switch">
                <label class="slider-label" for="customSwitch">Receive notification emails</label>
                <input type="checkbox" id="customSwitch">
                <label class="slider" for="customSwitch"></label>
            </div>
        </div>

        <h5 class="mt-4 mb-4 text-primary">
            <span class="fa fa-bars"></span> Apply coupons/promo code <sup>(Optional)</sup>
        </h5>

        <div class="mb-3">
            <label for="coupon" class="form-label">Coupon/Promo Code</label>
            <input type="text" class="form-control" id="title" placeholder="Add your coupon or promocode here">
        </div>

        <button type="submit" class="btn btn-primary">Upload</button>

    </form>

    @endsection

</body>

</html>