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

</br>
<div class="container">
    <div class="">
        <h2>Track your project</h2>
    </div>

    <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">First</th>
            <th scope="col">Last</th>
            <th scope="col">Handle</th>
            <th scope="col">Track</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>Mark</td>
            <td>Otto</td>
            <td>@mdo</td>
            <td><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
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

</body>

</html>