<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')


  <!-- <style>
                .card {
                  border-radius: 10px;
                }

                .display-4 {
                  font-size: 2.5rem;
                }
              </style> -->
  <!-- <style>
              .card-custom {
                border: none;
                border-radius: 0.75rem;
              }
            </style> -->

  <style>
    .card-gradient-pending {
      background: linear-gradient(135deg, #d54949ff 0%, #ddafafff 100%);
      color: white;
    }

    .card-gradient-inprogress {
      background: linear-gradient(135deg, #d69e2e 0%, #f6e05e 100%);
      color: white;
    }

    .card-gradient-delivered {
      background: linear-gradient(135deg, #2f855a 0%, #48bb78 100%);
      color: white;
    }

    .card-gradient-pending a,
    .card-gradient-inprogress a,
    .card-gradient-delivered a {
      color: rgba(255, 255, 255, 0.85);
      text-decoration: none;
      transition: color 0.3s ease;
    }

    .card-gradient-pending a:hover,
    .card-gradient-inprogress a:hover,
    .card-gradient-delivered a:hover {
      color: white;
      text-decoration: underline;
    }

    .card-custom {
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
  </style>


  <style>
    /* Import a font similar to the one in the image */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');

    .widget {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      flex-grow: 1;
      min-width: 200px;
    }

    .title {
      text-transform: uppercase;
      letter-spacing: 0.15em;
      font-weight: 500;
      font-size: 13px;
      color: #91a0be;
      margin-bottom: 20px;
    }

    .progress-wrapper {
      position: relative;
      width: 140px;
      height: 140px;
      margin-bottom: 20px;
    }

    .progress-wrapper svg.ring {
      width: 140px;
      height: 140px;
      transform: rotate(-90deg);
      /* Start progress from the top */
    }

    /* The new inner circle track */
    .track-inner {
      fill: none;
      stroke: #1c2340;
      stroke-width: 8;
    }

    .track {
      fill: none;
      stroke: #252f4b;
      /* The darker, outer track */
      stroke-width: 13;
    }

    .bar {
      fill: none;
      stroke-width: 13;
      stroke-linecap: round;
      /* Rounded end for the progress bar */
      transition: stroke-dashoffset 0.9s cubic-bezier(0.65, 0, 0.35, 1);
    }

    /* Colors for each status bar */
    .bar.pending {
      stroke: #ff3636ff;
    }

    .bar.inprogress {
      /* stroke: url(#progress-gradient); */
      stroke: #ffd448ff;
    }

    .bar.delivered {
      stroke: #58ff46ff;
    }

    .icon {
      position: absolute;
      inset: 0;
      display: grid;
      place-items: center;
    }

    .icon svg {
      width: 45px;
      height: 45px;
      stroke-width: 1.8;
      stroke-linejoin: round;
      stroke-linecap: round;
      fill: none;
    }

    /* Icon colors */
    .icon.pending svg {
      stroke: #ff3636ff;
    }

    .icon.inprogress svg {
      stroke: #ffd448ff;
    }

    .icon.delivered svg {
      stroke: #58ff46ff;
    }

    .count {
      font-size: 48px;
      font-weight: 700;
      color: #000000ff;
      line-height: 1;
      margin-bottom: 5px;
    }

    .label {
      color: #000000ff;
      font-size: 14px;
      font-weight: 400;
      letter-spacing: 0.1em;
    }

    .card {
      background-color: #fff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      padding: 24px 20px;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
    }
  </style>


  <p><span class="fs-1 fw-bold">Hi, </span><span class="fs-3">{{ session('pown_name') }}</span></p>
  <div class="alert alert-primary" role="alert">
    Your questions matter to us? <a href="{{ route('inquire.now') }}"
      class="btn btn-sm btn-outline-primary rounded-pill">Inquire Now</a>
  </div>

  <!-- 
                  need to implement livewire -->

  <div class="container px-4">
    <!-- <div class="row mx-auto">

                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                      <div class="card scr-card scr-card1">
                        <div class="card-body">
                          <h4 class="card-title">Projects In Progress</h4>
                        </div>
                        @livewire('in-progress-projects-count')
                        <a href="{{ url('customer/session/track-project-in-progress') }}" class="btn btn-sm btn-outline-dark m-2">View
                          &gt;&gt;</a>
                      </div>
                    </div>


                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                      <div class="card scr-card scr-card2">
                        <div class="card-body">
                          <h4 class="card-title">Pending Projects</h4>
                        </div>
                        @livewire('pending-projects-count')
                        <a href="{{ url('customer/session/track-project-pending') }}" class="btn btn-sm btn-outline-dark m-2">View
                          &gt;&gt;</a>
                      </div>
                    </div>

                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                      <div class="card scr-card scr-card3">
                        <div class="card-body">
                          <h4 class="card-title">Delivered Projects</h4>
                        </div>
                        @livewire('delivered-count')
                        <a href="{{ url('customer/session/track-project-delivered') }}" class="btn btn-sm btn-outline-dark m-2">View
                          &gt;&gt;</a>
                      </div>
                    </div>

                  </div> -->
    <!-- <div class="row mx-auto">


              <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <div
                  class="card card-custom p-3 d-flex flex-row align-items-center justify-content-between card-gradient-pending">
                  <div>
                    <div class="text-white-75">Pending Projects</div>
                    <div class="display-4 fw-bold">@livewire('in-progress-projects-count')</div>
                    <a href="{{ url('customer/session/track-project-pending') }}" class="btn btn-link p-0 mt-2">View more
                      &gt;&gt;</a>
                  </div>
                  <div class="fs-1 text-white-75">
                    <i class="bi bi-clock-history"></i>
                  </div>
                </div>
              </div>


              <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <div
                  class="card card-custom p-3 d-flex flex-row align-items-center justify-content-between card-gradient-inprogress">
                  <div>
                    <div class="text-white-75">In Progress</div>
                    <div class="display-4 fw-bold">@livewire('pending-projects-count')</div>
                    <a href="{{ url('customer/session/track-project-in-progress') }}" class="btn btn-link p-0 mt-2">View more
                      &gt;&gt;</a>
                  </div>
                  <div class="fs-1 text-white-75">
                    <i class="bi bi-tools"></i>
                  </div>
                </div>
              </div>


              <div class="col-12 col-sm-6 col-lg-4 mb-4">
                <div
                  class="card card-custom p-3 d-flex flex-row align-items-center justify-content-between card-gradient-delivered">
                  <div>
                    <div class="text-white-75">Delivered Projects</div>
                    <div class="display-4 fw-bold">@livewire('delivered-count')</div>
                    <a href="{{ url('customer/session/track-project-delivered') }}" class="btn btn-link p-0 mt-2">View more
                      &gt;&gt;</a>
                  </div>
                  <div class="fs-1 text-white-75">
                    <i class="bi bi-truck"></i>
                  </div>
                </div>
              </div>

            </div> -->

    <!-- <div class="panel d-flex flex-wrap justify-content-center gap-4">


          <section class="widget" aria-label="Pending projects">
            <div class="title">PENDING</div>
            <div class="progress-wrapper" data-max="200" data-value="35">
              <svg class="ring" tabindex="-1" aria-hidden="true">
                <defs>
                  <linearGradient id="progress-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                    <stop offset="0%" stop-color="#C0D0E1" />
                    <stop offset="100%" stop-color="#A8B9CB" />
                  </linearGradient>
                </defs>

                <circle class="track-inner" cx="70" cy="70" r="48" />
                <circle class="track" cx="70" cy="70" r="58" />
                <circle class="bar pending" cx="70" cy="70" r="58" />
              </svg>
              <div class="icon pending">
                <svg viewBox="0 0 24 24">
                  <circle cx="12" cy="12" r="9" />
                  <path d="M12 7v5l3 1.5" />
                </svg>
              </div>
            </div>
            <div class="count">@livewire('pending-projects-count')</div>
            <div class="label">Projects</div>
          </section>


          <section class="widget" aria-label="In Progress projects">
            <div class="title">IN PROGRESS</div>
            <div class="progress-wrapper" data-max="200" data-value="82">
              <svg class="ring" tabindex="-1" aria-hidden="true">

                <circle class="track-inner" cx="70" cy="70" r="48" />
                <circle class="track" cx="70" cy="70" r="58" />
                <circle class="bar inprogress" cx="70" cy="70" r="58" />
              </svg>
              <div class="icon inprogress">
                <svg viewBox="0 0 24 24">
                  <path
                    d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                  <circle cx="12" cy="12" r="3" />
                </svg>
              </div>
            </div>
            <div class="count">@livewire('in-progress-projects-count')</div>
            <div class="label">Projects</div>
          </section>


          <section class="widget" aria-label="Delivered projects">
            <div class="title">DELIVERED</div>
            <div class="progress-wrapper" data-max="200" data-value="147">
              <svg class="ring" tabindex="-1" aria-hidden="true">

                <circle class="track-inner" cx="70" cy="70" r="48" />
                <circle class="track" cx="70" cy="70" r="58" />
                <circle class="bar delivered" cx="70" cy="70" r="58" />
              </svg>
              <div class="icon delivered">
                <svg viewBox="0 0 24 24">
                  <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                  <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
              </div>
            </div>
            <div class="count">@livewire('delivered-count')</div>
            <div class="label">Projects</div>
          </section>

        </div> -->

    <div class="panel d-flex flex-wrap justify-content-center gap-4">

      <!-- PENDING CARD -->
      <div class="card">
        <section class="widget" aria-label="Pending projects">
          <div class="title">PENDING</div>
          <div class="progress-wrapper" data-max="200" data-value="35">
            <svg class="ring" tabindex="-1" aria-hidden="true">
              <defs>
                <linearGradient id="progress-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                  <stop offset="0%" stop-color="#C0D0E1" />
                  <stop offset="100%" stop-color="#A8B9CB" />
                </linearGradient>
              </defs>
              <circle class="track-inner" cx="70" cy="70" r="48" />
              <circle class="track" cx="70" cy="70" r="58" />
              <circle class="bar pending" cx="70" cy="70" r="58" />
            </svg>
            <div class="icon pending">
              <svg viewBox="0 0 24 24">
                <circle cx="12" cy="12" r="9" />
                <path d="M12 7v5l3 1.5" />
              </svg>
            </div>
          </div>
          <div class="count">@livewire('pending-projects-count')</div>
          <div class="label">Projects</div>
        </section>
      </div>

      <!-- IN PROGRESS CARD -->
      <div class="card">
        <section class="widget" aria-label="In Progress projects">
          <div class="title">IN PROGRESS</div>
          <div class="progress-wrapper" data-max="200" data-value="82">
            <svg class="ring" tabindex="-1" aria-hidden="true">
              <circle class="track-inner" cx="70" cy="70" r="48" />
              <circle class="track" cx="70" cy="70" r="58" />
              <circle class="bar inprogress" cx="70" cy="70" r="58" />
            </svg>
            <div class="icon inprogress">
              <svg viewBox="0 0 24 24">
                <path
                  d="M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 01-2.83 2.83l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-4 0v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 010-4h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 012.83-2.83l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 014 0v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 010 4h-.09a1.65 1.65 0 00-1.51 1z" />
                <circle cx="12" cy="12" r="3" />
              </svg>
            </div>
          </div>
          <div class="count">@livewire('in-progress-projects-count')</div>
          <div class="label">Projects</div>
        </section>
      </div>

      <!-- DELIVERED CARD -->
      <div class="card">
        <section class="widget" aria-label="Delivered projects">
          <div class="title">DELIVERED</div>
          <div class="progress-wrapper" data-max="200" data-value="147">
            <svg class="ring" tabindex="-1" aria-hidden="true">
              <circle class="track-inner" cx="70" cy="70" r="48" />
              <circle class="track" cx="70" cy="70" r="58" />
              <circle class="bar delivered" cx="70" cy="70" r="58" />
            </svg>
            <div class="icon delivered">
              <svg viewBox="0 0 24 24">
                <path d="M22 11.08V12a10 10 0 11-5.93-9.14" />
                <polyline points="22 4 12 14.01 9 11.01" />
              </svg>
            </div>
          </div>
          <div class="count">@livewire('delivered-count')</div>
          <div class="label">Projects</div>
        </section>
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
      <!-- <tbody>
                      @if(session('recentProjects') && session('recentProjects')->count() > 0)
                      @foreach(session('recentProjects') as $project)
                      <tr>
                      <th scope="row">{{ $project->plist_projectid }}</th>
                      <td>{{ $project->plist_title }}</td>
                      <td>{{ $project->plist_startdate }}</td>
                      <td>{{ $project->plist_enddate }}</td>
                      <td>{{ $project->plist_status }}</td>
                      <td>
                      <a href="{{ url('customer/session/track-project-report-location/' . $project->plist_id) }}"
                      class="btn btn-sm btn-outline-primary" title="Track Progress"><i class="fa fa-eye"></i></a>
                      </td>
                      </tr>
                    @endforeach
                    @else
                      <tr>
                      <td colspan="6">No recent projects found.</td>
                      </tr>
                    @endif
                    </tbody> -->

      @livewire('recent-projests')

    </table>

    <div class="pagination" id="pagination"></div>

  </div>


@endsection