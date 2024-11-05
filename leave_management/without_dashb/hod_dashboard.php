<?php
$conn = new mysqli("localhost", "root", "", "LeaveManagement");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$message = ""; // Variable to store the message

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["status"])) {
    $id = $_POST["leave_id"];
    $status = $_POST["status"];

    $stmt = $conn->prepare("UPDATE leave_requests SET hod_status = ? WHERE id = ?");
    $stmt->bind_param("si", $status, $id);
    
    if ($stmt->execute()) {
        // Set message based on status
        $message = ($status === "Accepted") ? "Leave request accepted." : "Leave request rejected.";
    } else {
        $message = "Error: " . $stmt->error; // Capture error message
    }
}

// Fetch leave requests for HOD approval
$result = $conn->query("SELECT * FROM leave_requests WHERE hod_status='Pending'");

if (!$result) {
    die("Query failed: " . $conn->error); // Check for errors in the query
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HOD Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            width: 80%;
            max-width: 1000px;
            background-color: #2c3e50;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            overflow-y: auto;
        }

        h1 {
            text-align: center;
            color: #22a6b3;
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
            color: #fff;
        }

        th {
            background-color: #22a6b3;
        }

        tr:hover {
            background-color: #34495e;
        }

        button {
            background-color: #EE5A24;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #d45d1f;
        }

        .error {
            color: #e74c3c;
            text-align: center;
            margin-bottom: 15px;
        }

        .message {
            color: #22a6b3; /* Message color */
            text-align: center;
            margin-bottom: 15px;
        }
    </style>
    <script>
        // Function to show alert message
        function showAlert(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>HOD Leave Requests</h1>
        <?php if (!empty($message)): ?>
            <div class="message"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>
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
                            <form method="post" style="display: inline;" onsubmit="showAlert('Leave request accepted.');">
                                <input type="hidden" name="leave_id" value="<?= htmlspecialchars($row["id"]) ?>">
                                <button type="submit" name="status" value="Accepted">Accept</button>
                            </form>
                            <form method="post" style="display: inline;" onsubmit="showAlert('Leave request rejected.');">
                                <input type="hidden" name="leave_id" value="<?= htmlspecialchars($row["id"]) ?>">
                                <button type="submit" name="status" value="Rejected">Reject</button>
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
