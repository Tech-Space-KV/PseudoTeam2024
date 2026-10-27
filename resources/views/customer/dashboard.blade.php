<!-- resources/views/customer/page1.blade.php -->
@extends('customer.base_layout')

@section('content')

  <style>
    /* Import a font similar to the one in the image */
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;700&display=swap');

    /* .widget {
                  display: flex;
                  flex-direction: column;
                  align-items: center;
                  text-align: center;
                  flex-grow: 1;
                  min-width: 200px;
                } */
    .widget {
      display: flex;
      flex-direction: column;
      align-items: center;
      /* center everything inside widget */
      justify-content: center;
      width: 100%;
    }

    .title {
      text-transform: uppercase;
      letter-spacing: 0.15em;
      font-weight: 500;
      font-size: 13px;
      color: #91a0be;
      margin-bottom: 20px;
    }

    /* .progress-wrapper {
                  position: relative;
                  width: 140px;
                  height: 140px;
                  margin-bottom: 20px;
                } */
    .progress-wrapper {
      display: flex;
      justify-content: center;
      align-items: center;
      width: 100%;
      /* allow auto centering */
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
      text-align: center;
    }

    .label {
      color: #000000ff;
      font-size: 14px;
      font-weight: 400;
      letter-spacing: 0.1em;
      text-align: center;
    }

    .card-tile {
      background-color: #fff;
      border: 2px solid #000000ff;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
      padding: 24px 20px;
      transition: transform 0.3s ease;
    }

    .card:hover {
      transform: translateY(-4px);
    }

    a {
      text-decoration: none;
    }

    /* Control the area that replaces the SVG */
    /* .bg-image-section {
                    height: 140px; 
                    background-image: url('{{ asset('images/redlight.jpeg') }}');
                    background-size: cover;
                    background-position: center;
                    border-radius: 10px; 
                    display: flex;
                    align-items: center;
                    justify-content: center;
                  } */

    .bg-image-section0 {
      height: 140px;
      width: 140px;
      background-image: url('{{ asset('images/nolight.png') }}');
      background-repeat: no-repeat;
      background-size: contain;
      /* <— shows the full image */
      background-position: center;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bg-image-section1 {
      height: 140px;
      width: 140px;
      background-image: url('{{ asset('images/redlight.jpeg') }}');
      background-repeat: no-repeat;
      background-size: contain;
      /* <— shows the full image */
      background-position: center;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bg-image-section2 {
      height: 140px;
      width: 140px;
      background-image: url('{{ asset('images/yellowlight.jpeg') }}');
      background-repeat: no-repeat;
      background-size: contain;
      /* <— shows the full image */
      background-position: center;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .bg-image-section3 {
      height: 140px;
      width: 140px;
      background-image: url('{{ asset('images/greenlight.jpeg') }}');
      background-repeat: no-repeat;
      background-size: contain;
      /* <— shows the full image */
      background-position: center;
      border-radius: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* .bg-image-section1,
                .bg-image-section2,
                .bg-image-section3 {
                  width: 100%;
                  max-width: 120px;
                  aspect-ratio: 1/1;
                  background-repeat: no-repeat;
                  background-size: contain;
                  background-position: center;
                  margin: 0 auto;
                } */

    .bg-image-section0,
    .bg-image-section1,
    .bg-image-section2,
    .bg-image-section3 {
      width: 100%;
      max-width: 120px;
      aspect-ratio: 1/1;
      background-repeat: no-repeat;
      background-size: contain;
      background-position: center;
      margin: 0 auto;
      /* ensure image is centered */
    }

    .cards-grid {
      display: grid;
      grid-template-columns: repeat(4, minmax(0, 1fr));
      gap: 20px;
      width: 100%;
    }

    .card-tile {
      width: 100%;
      /* Make each card auto-fit its grid column */
    }

    /* .gradient-title {
      font-weight: bold;
      font-size: inherit;
  
      background: linear-gradient(90deg, #19327d, #006EC4, #155de2, #659bff);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
      position: relative;
     
      text-shadow: 0 0 3px rgba(25, 50, 125, 0.4),
        0 0 6px rgba(0, 110, 196, 0.3);
      transition: text-shadow 0.3s ease-in-out;
    }

    .gradient-title:hover {
     
      text-shadow: 0 0 5px rgba(25, 50, 125, 0.5),
        0 0 10px rgba(0, 110, 196, 0.35);
    } */
  </style>

  <style>
.circular-ring {
  --size: 42px;          /* diameter */
  --thickness: 5px;      /* ring thickness */
  --progress: 0;         /* dynamic value (0–100) */

  width: var(--size);
  height: var(--size);
  border-radius: 50%;
  display: inline-flex;
  align-items: center;
  justify-content: center;

  /* ORANGE RING */
  background: conic-gradient(#ff8c00 calc(var(--progress) * 1%), #e6e6e6 0);
  position: relative;
  transition: background 0.45s cubic-bezier(.2,.8,.2,1);
}

/* inner circle */
.circular-ring .inner {
  width: calc(var(--size) - (var(--thickness) * 2));
  height: calc(var(--size) - (var(--thickness) * 2));
  border-radius: 50%;
  background: #ffffff;
  display: flex;
  align-items: center;
  justify-content: center;
}

/* percentage text */
.circular-ring .value {
  font-size: 10px;
  font-weight: 600;
  color: #ff8c00;      /* ORANGE TEXT */
  user-select: none;
}

/* small responsive tweak so the cell doesn't shrink too much */
.table td.progress-cell {
  white-space: nowrap;
  vertical-align: middle;
}
</style>


  <p><span class="fs-1 fw-bold gradient-title">Hi, </span><span
      class="fs-3 gradient-title">{{ session('pown_name') }}</span></p>
  <div class="alert alert-primary" role="alert">
    Your questions matter to us? <a href="{{ route('inquire.now') }}"
      class="btn btn-sm btn-outline-primary rounded-pill">Inquire Now</a>
  </div>

  <div class="container px-4">

    <div class="panel cards-grid">


      <div class="card-tile">
        <a href="{{ url('customer/session/track-project-not-started') }}">
          <section class="widget" aria-label="Not started projects">

            <div class="progress-wrapper bg-image-section0"></div>

            <div class="count">@livewire('projects-not-started-count')</div>
            <div class="label">Projects Not Started</div>

          </section>
        </a>
      </div>

       <div class="card-tile">
        <a href="{{ url('customer/session/track-project-in-progress') }}">
          <section class="widget" aria-label="In progress projects">

            <div class="progress-wrapper bg-image-section2"></div>

            <div class="count">@livewire('in-progress-projects-count')</div>
            <div class="label">Projects In Progress</div>

          </section>
        </a>
      </div>

      <div class="card-tile">
        <a href="{{ url('customer/session/track-project-on-hold') }}">
          <section class="widget" aria-label="On Hold projects">

            <div class="progress-wrapper bg-image-section1"></div>

            <div class="count">@livewire('projects-on-hold-count')</div>
            <div class="label">Projects At risk/On hold</div>

          </section>
        </a>
      </div>

      <div class="card-tile">
        <a href="{{ url('customer/session/track-project-delivered') }}">
          <section class="widget" aria-label="Delivered projects">

            <div class="progress-wrapper bg-image-section3"></div>

            <div class="count">@livewire('delivered-count')</div>
            <div class="label">Projects delivered</div>

          </section>
        </a>
      </div>

    </div>


    </br>
    </br>
    <p><span class="fs-2 fw-bold mt-4 gradient-title">Latest Projects <p class="text-muted ms-2">
          <!-- (Overall Progress: {{ session('overallProgress') ?? 0 }}%) -->
        </p> </span></p>

    <table class="table table-hover">
      <thead>
        <tr>
          <th class="text-pseudo" scope="col">Proj. ID.</th>
          <th class="text-pseudo" scope="col">Title</th>
          <th class="text-pseudo" scope="col">Start Date</th>
          <th class="text-pseudo" scope="col">End Date</th>
          <th class="text-pseudo" scope="col">Completed Progress</th>
          <th scope="col"></th>
        </tr>
      </thead>

      @livewire('recent-projests')

    </table>

    <div class="pagination" id="pagination"></div>

  </div>


@endsection