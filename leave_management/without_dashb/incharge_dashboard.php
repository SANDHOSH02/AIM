<?php
$conn = new mysqli("localhost", "root", "", "LeaveManagement");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"])) {
    $id = $_POST["leave_id"];
    $status = $_POST["status"];

    // Update the incharge status based on the action taken
    $stmt = $conn->prepare("UPDATE leave_requests SET incharge_status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        echo "<div class='success'>Leave request status updated successfully.</div>";
    } else {
        echo "<div class='error'>Error: " . $stmt->error . "</div>";
    }
}

$result = $conn->query("SELECT * FROM leave_requests WHERE incharge_status='Pending'");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Incharge Dashboard</title>
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
            padding: 15px;
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

        button {
            background-color: #EE5A24; /* Button color */
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d45d1f; /* Darken button on hover */
        }

        .success {
            color: #2ecc71; /* Success message color */
            text-align: center;
            margin-bottom: 15px;
        }

        .error {
            color: #e74c3c; /* Error message color */
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Class Incharge Leave Requests</h1>
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Student ID</th>
                    <th>Class</th>
                    <th>Reason</th>
                    <th>Date From</th>
                    <th>Date To</th>
                    <th>Action</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row["student_id"]) ?></td>
                        <td><?= htmlspecialchars($row["class"]) ?></td>
                        <td><?= htmlspecialchars($row["reason"]) ?></td>
                        <td><?= htmlspecialchars($row["date_from"]) ?></td>
                        <td><?= htmlspecialchars($row["date_to"]) ?></td>
                        <td>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="leave_id" value="<?= htmlspecialchars($row["id"]) ?>">
                                <button type="submit" name="status" value="Accepted">Accept</button>
                            </form>
                            <form method="post" style="display: inline;">
                                <input type="hidden" name="leave_id" value="<?= htmlspecialchars($row["id"]) ?>">
                                <button type="submit" name="status" value="Forwarded">Forward to HOD</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p style="color: #fff; text-align: center;">No pending leave requests.</p>
        <?php endif; ?>
    </div>
</body>
</html>
