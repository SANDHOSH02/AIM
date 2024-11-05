<?php
session_start();
$conn = new mysqli("localhost", "root", "", "leave_manage");

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
$sql = "SELECT register_no, name, department, year, profile_image FROM student_table WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $student_id);
$stmt->execute();
$result = $stmt->get_result();
$student = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Calendar</title>
    <link href='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css' rel='stylesheet' />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        .calendar-container {
            max-width: 900px;
            margin: 40px auto;
            background-color: #f1faee;
            padding: 20px;
            border-radius: 10px;
            border: 1px solid #1d3557;
        }
        #calendar {
            max-width: 100%;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="calendar-container">
        <h2>Digital Calendar</h2>
        <div id="calendar"></div>
    </div>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                events: [
                    // Add your events here
                    {
                        title: 'Sample Event',
                        start: '2024-11-10'
                    }
                ]
            });
            calendar.render();
        });
    </script>
</body>
</html>
