<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Report</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
<h1>Monthly Report</h1>
<p><strong>Total Events:</strong> {{ $totalEvents }}</p>
<p><strong>Tickets Sold:</strong> {{ $ticketsSold }}</p>
<p><strong>New Customers:</strong> {{ $newCustomers }}</p>
<p><strong>Total Revenue:</strong> {{ $totalRevenue }}</p>

<h2>Detailed Reports</h2>
<table>
    <thead>
    <tr>
        <th>Event Name</th>
        <th>Event Date</th>
        <th>Tickets Sold</th>
    </tr>
    </thead>
    <tbody>
    @foreach ($detailedReports as $report)
        <tr>
            <td>{{ $report['name'] }}</td>
            <td>{{ $report['date'] }}</td>
            <td>{{ $report['tickets'] }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>
