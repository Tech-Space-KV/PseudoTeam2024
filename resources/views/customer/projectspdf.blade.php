<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects List</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid black; }
        th, td { padding: 8px; text-align: left; }
    </style>
</head>
<body>

    <h1>Projects List</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Customer ID</th>
                <th>Project ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Budget</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($projects as $project)
            <tr>
                <td>{{ $project->plist_id }}</td>
                <td>{{ $project->plist_customer_id }}</td>
                <td>{{ $project->plist_projectid }}</td>
                <td>{{ $project->plist_title }}</td>
                <td>{{ $project->plist_description }}</td>
                <td>{{ $project->plist_budget }}</td>
                <td>{{ $project->plist_startdate }}</td>
                <td>{{ $project->plist_enddate }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>
