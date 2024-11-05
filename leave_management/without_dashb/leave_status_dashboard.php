<?php
$conn = new mysqli("localhost", "root", "", "LeaveManagement");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch accepted and rejected leave requests
$result = $conn->query("SELECT * FROM leave_requests WHERE hod_status IN ('Accepted', 'Rejected')");

if (!$result) {
    die("Query failed: " . $conn->error); // Check for errors in the query
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Status Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Full viewport height */
            overflow: hidden; /* Hide overflow */
        }

        .container {
            width: 80%; /* Full width with some margin */
            max-width: 1000px; /* Maximum width for the dashboard */
            background-color: #2c3e50; /* Dashboard background color */
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow-y: auto; /* Enable vertical scrolling if content exceeds height */
        }

        h1 {
            text-align: center;
            color: #22a6b3; /* Title color */
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            color: #fff; /* Text color */
        }

        th {
            background-color: #22a6b3; /* Header background color */
        }

        tr:hover {
            background-color: #34495e; /* Row hover effect */
        }

        .no-results {
            color: #fff; /* Color for no results message */
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Leave Status Dashboard</h1>

        <table>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Reason</th>
                <th>Status</th>
            </tr>
            <?php if ($result->num_rows > 0): // Check if there are results ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["id"]) ?></td>
                        <td><?= htmlspecialchars($row["student_id"]) ?></td>
                        <td><?= htmlspecialchars($row["reason"]) ?></td>
                        <td><?= htmlspecialchars($row["hod_status"]) ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: // No results found ?>
                <tr>
                    <td colspan="4" class="no-results">No leave requests found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>
