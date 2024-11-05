<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_id = $_POST["student_id"];
    $class = $_POST["class"];
    $reason = $_POST["reason"];
    $date_from = $_POST["date_from"];
    $date_to = $_POST["date_to"];

    $conn = new mysqli("localhost", "root", "", "LeaveManagement");
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $stmt = $conn->prepare("INSERT INTO leave_requests (student_id, class, reason, date_from, date_to) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $student_id, $class, $reason, $date_from, $date_to);

    if ($stmt->execute()) {
        echo "<div class='success'>Leave request submitted successfully.</div>";
    } else {
        echo "<div class='error'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave Request Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color:#2f3542;
            color: #fff;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #006266;
            border-radius: 8px;
            padding: 30px; /* Increased padding for the container */
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color: white;
        }

        label {
            display: block;
            margin: 15px 0 5px; /* Increased margin for better spacing */
        }

        input[type="text"],
        input[type="date"],
        textarea {
            width: 100%;
            padding: 15px; /* Increased padding for better input area */
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding is included in total width */
        }

        textarea {
            height: 100px;
            resize: none;
        }

        button {
            background-color: #EE5A24;
            color: white;
            border: none;
            padding: 12px 15px; /* Adjusted padding for the button */
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 16px; /* Increased font size for better readability */
        }

        button:hover {
            background-color: #c84c1e; /* Darken on hover */
        }

        .success {
            color: #22a6b3;
            margin-top: 15px;
            text-align: center;
        }

        .error {
            color: #e74c3c;
            margin-top: 15px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Leave Request Form</h1>
        <form method="post" action="leave_form.php">
            <label for="student_id">Student ID:</label>
            <input type="text" id="student_id" name="student_id" required>

            <label for="class">Class:</label>
            <input type="text" id="class" name="class" required>

            <label for="reason">Reason for Leave:</label>
            <textarea id="reason" name="reason" required></textarea>

            <label for="date_from">From:</label>
            <input type="date" id="date_from" name="date_from" required>

            <label for="date_to">To:</label>
            <input type="date" id="date_to" name="date_to" required>

            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>
