<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')





  <p><span class="fs-1 fw-bold">Hi, </span><span class="fs-3">{{ session('pown_name') }}</span></p>
  <div class="alert alert-primary" role="alert">
    Want to get a job done? <a href="session/upload-project" class="btn btn-sm btn-outline-primary">Upload project</a>
  </div>

  <div class="container px-4">
    <div class="row mx-auto">

    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card scr-card scr-card1">
      <div class="card-body">
        <h4 class="card-title">Projects In Progress</h4>
      </div>
      <p class="card-title ms-3">No. of projects: {{ session('inProgressCount') }}</p>
      <a href="{{ url('customer/session/track-project-in-progress') }}" class="btn btn-sm btn-outline-dark m-2">View
        &gt;&gt;</a>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card scr-card scr-card2">
      <div class="card-body">
        <h4 class="card-title">Pending Projects</h4>
      </div>
      <p class="card-title ms-3">No. of projects: {{ session('pendingCount')  }}</p>
      <a href="{{ url('customer/session/track-project-pending') }}" class="btn btn-sm btn-outline-dark m-2">View
        &gt;&gt;</a>
      </div>
    </div>


    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
      <div class="card scr-card scr-card3">
      <div class="card-body">
        <h4 class="card-title">Delivered Projects</h4>
      </div>
      <p class="card-title ms-3">No. of projects: {{ session('deliveredCount')  }}</p>
      <a href="{{ url('customer/session/track-project-delivered') }}" class="btn btn-sm btn-outline-dark m-2">View
        &gt;&gt;</a>
      </div>
    </div>

    </div>

    </br>
    </br>
    <p><span class="fs-2 fw-bold mt-4">Latest Projects </span></p>

    <table class="table table-hover">
    <thead>
      <tr>
      <th class="text-pseudo" scope="col">Proj. ID.</th>
      <th class="text-pseudo" scope="col">Title</th>
      <th class="text-pseudo" scope="col">Start Date</th>
      <th class="text-pseudo" scope="col">End Date</th>
      <th class="text-pseudo" scope="col">Status</th>
      <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
      <!-- <tr>
      <th scope="row">100134</th>
      <td>Test Project 1</td>
      <td>28/11/2023</td>
      <td>28/11/2024</td>
      <td>In Progress</td>
      <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
      <th scope="row">100135</th>
      <td>Test Project 2</td>
      <td>28/11/2023</td>
      <td>28/11/2024</td>
      <td>In Progress</td>
      <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr>
      <tr>
      <th scope="row">100136</th>
      <td>Test Project 3</td>
      <td>28/11/2023</td>
      <td>28/11/2024</td>
      <td>In Progress</td>
      <td ><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
      </tr> -->
      <!-- 
      @if(session('recentProjects'))
        @foreach(session('recentProjects') as $project)
          <tr>
            <th scope="row">{{ $project->plist_projectid }}</th>
            <td>{{ $project->plist_title }}</td>
            <td>{{ $project->plist_startdate }}</td>
            <td>{{ $project->plist_enddate }}</td>
            <td>{{ $project->plist_status }}</td>
            <td><a class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a></td>
          </tr>
        @endforeach
      @else
        <tr>
          <td colspan="6">No recent projects found.</td>
        </tr>
      @endif -->

      @if(session('recentProjects') && session('recentProjects')->count() > 0)
      @foreach(session('recentProjects') as $project)
      <tr>
      <th scope="row">{{ $project->plist_projectid }}</th>
      <td>{{ $project->plist_title }}</td>
      <td>{{ $project->plist_startdate }}</td>
      <td>{{ $project->plist_enddate }}</td>
      <td>{{ $project->plist_status }}</td>
      <!-- <td>
      <a class="btn btn-sm btn-outline-primary" title="Track Progress">
      <i class="fa fa-eye"></i>
      </a>
      </td> -->
      <td>
        <a href="{{ url('customer/session/track-project-report-location/'.$project->plist_id) }}" class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a>
      </td>
      </tr>
    @endforeach
    @else
      <tr>
      <td colspan="6">No recent projects found.</td>
      </tr>
    @endif


    </tbody>
    </table>

    <div class="pagination" id="pagination"></div>

  </div>


@endsection