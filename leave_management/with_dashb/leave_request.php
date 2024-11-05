<?php
session_start();
$conn = new mysqli("localhost", "root", "", "leave_manage");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the student is logged in
if (!isset($_SESSION['student_id'])) {
    header("Location: login.php");
    exit();
}

$student_id = $_SESSION['student_id'];

// Fetch student details from the database
$sql = "SELECT register_no, name FROM student_table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $reason = $_POST['reason'];
    $start_date = $_POST['start_date'];
    $end_date = $_POST['end_date'];

    // Insert leave request into the database
    $insert_sql = "INSERT INTO student_leave (student_id, reason, start_date, end_date) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("isss", $student_id, $reason, $start_date, $end_date);
    
    if ($insert_stmt->execute()) {
        echo "<script>alert('Leave request submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error submitting leave request.');</script>";
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request</title>
    <style>
        /* Add the same styling as the dashboard */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .form-container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            margin-bottom: 20px;
            color: #1d3557;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #1d3557;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #457b9d;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Leave Request Form</h2>
        <form method="POST">
            <div class="form-group">
                <label for="register_no">Registration Number</label>
                <input type="text" id="register_no" name="register_no" value="<?= htmlspecialchars($student['register_no']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="student_name">Student Name</label>
                <input type="text" id="student_name" name="student_name" value="<?= htmlspecialchars($student['name']); ?>" readonly>
            </div>
            <div class="form-group">
                <label for="reason">Reason for Leave</label>
                <textarea id="reason" name="reason" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date</label>
                <input type="date" id="start_date" name="start_date" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date</label>
                <input type="date" id="end_date" name="end_date" required>
            </div>
            <button type="submit">Submit Leave Request</button>
        </form>
    </div>
</body>
</html>
