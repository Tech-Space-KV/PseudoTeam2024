<!DOCTYPE html>
<html>

<head>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            width: 100%;
            text-align: center;
            margin-bottom: 20px;
        }

        header img {
            max-height: 80px;
        }

        header h2 {
            margin: 10px 0 5px 0;
            font-size: 22px;
        }

        header p {
            margin: 0;
            font-size: 12px;
            color: #555;
        }

        /* ---- CARD STYLING ---- */
        .card-tile {
            background-color: #fff;
            border: 2px solid #000;
            border-radius: 12px;
            padding: 16px 10px;
            text-align: center;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.05);
            box-sizing: border-box;
        }

        .progress-wrapper {
            height: 120px;
            width: 120px;
            margin: 0 auto 12px;
            background-repeat: no-repeat;
            background-size: contain;
            background-position: center;
        }

        .bg-image-section0 { background-image: url('{{ public_path("images/nolight.png") }}'); }
        .bg-image-section1 { background-image: url('{{ public_path("images/redlight.jpeg") }}'); }
        .bg-image-section2 { background-image: url('{{ public_path("images/yellowlight.jpeg") }}'); }
        .bg-image-section3 { background-image: url('{{ public_path("images/greenlight.jpeg") }}'); }

        .count {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 4px;
        }

        .label {
            font-size: 12px;
            letter-spacing: 0.05em;
        }

        /* ---- TABLE FOR 4 CARDS ---- */
        .card-table {
            width: 100%;
            margin-bottom: 40px;
            table-layout: fixed;
        }

        .card-table td {
            width: 25%;
            vertical-align: top;
            padding: 5px;
        }

        /* ---- PROJECTS TABLE ---- */
        table.project-list {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table.project-list th,
        table.project-list td {
            border: 1px solid #444;
            padding: 6px;
            font-size: 10px;
        }

        table.project-list th {
            background: #f5f5f5;
            font-weight: bold;
        }

        footer {
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #666;
            margin-top: 20px;
            border-top: 1px solid #ccc;
            padding-top: 5px;
        }
    </style>
</head>

<body>

    <!-- ==========================
          HEADER WITH LOGO & DATE
    ==============================-->
    <header>
        <img src="{{ public_path('images/logopt.png') }}" alt="PseudoTeam Logo">
        <img src="{{ public_path('images/beltron.jpeg') }}" alt="F1InfoTech Logo">
        <h2>Comprehensive Project Report</h2>
        <p>Generated on: {{ \Carbon\Carbon::now()->format('d M Y, H:i') }}</p>
    </header>

    <!-- ==========================
          4 CARDS IN ONE ROW
    ==============================-->
    <table class="card-table" cellspacing="0" cellpadding="0">
        <tr>
            <td>
                <div class="card-tile">
                    <div class="progress-wrapper bg-image-section0"></div>
                    <div class="count">{{ $notStarted }}</div>
                    <div class="label">Projects Not Started</div>
                </div>
            </td>

            <td>
                <div class="card-tile">
                    <div class="progress-wrapper bg-image-section1"></div>
                    <div class="count">{{ $onHold }}</div>
                    <div class="label">Projects At Risk/Hold</div>
                </div>
            </td>

            <td>
                <div class="card-tile">
                    <div class="progress-wrapper bg-image-section2"></div>
                    <div class="count">{{ $progress }}</div>
                    <div class="label">Projects In Progress</div>
                </div>
            </td>

            <td>
                <div class="card-tile">
                    <div class="progress-wrapper bg-image-section3"></div>
                    <div class="count">{{ $delivered }}</div>
                    <div class="label">Projects Delivered</div>
                </div>
            </td>
        </tr>
    </table>

    <!-- ==========================
          PROJECT LIST
    ==============================-->
    <h3>All Projects</h3>
    <table class="project-list">
        <thead>
            <tr>
                <th>Project ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
                <tr>
                    <td>{{ $project->plist_projectid }}</td>
                    <td>{{ $project->plist_title }}</td>
                    <td>{{ $project->plist_description }}</td>
                    <td>{{ $project->plist_startdate }}</td>
                    <td>{{ $project->plist_enddate }}</td>
                    <td>{{ $project->plist_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <footer>
        &copy; {{ \Carbon\Carbon::now()->format('Y') }} PseudoPlatforms. All Rights Reserved.
    </footer>

</body>

</html>
