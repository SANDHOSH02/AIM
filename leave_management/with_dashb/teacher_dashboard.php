<?php
session_start();
$conn = new mysqli("localhost", "root", "", "leave_manage");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login1.php");
    exit();
}

$teacher_id = $_SESSION['teacher_id'];

// Fetch teacher details from the database
// Fetch teacher details from the database
$sql = "SELECT register_no, name, department FROM teacher_table WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $teacher_id);
$stmt->execute();
$result = $stmt->get_result();
$teacher = $result->fetch_assoc();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Dashboard</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }

        .dashboard-container {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            width: 250px;
            background-color: #1d3557;
            color: #fff;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-img {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            margin-bottom: 10px;
            border: 2px solid #a8dadc;
        }

        .teacher-name {
            font-size: 1.2em;
            font-weight: bold;
        }

        .teacher-details {
            font-size: 0.9em;
            color: #a8dadc;
        }

        .menu {
            width: 100%;
        }

        .menu-item {
            display: flex;
            align-items: center;
            padding: 15px;
            color: #f1faee;
            text-decoration: none;
            font-size: 1em;
            transition: background 0.3s ease;
        }

        .menu-item:hover {
            background-color: #457b9d;
            border-radius: 5px;
        }

        .icon {
            width: 24px;
            height: 24px;
            margin-right: 10px;
        }

        .content {
            flex-grow: 1;
            padding: 40px;
            background-color: #f1faee;
        }

        h1 {
            color: #1d3557;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <aside class="sidebar">
            <div class="profile">
                <!-- Uncomment this line if you have a profile image -->
                <!-- <img src="<?= htmlspecialchars($teacher['profile_image']); ?>" alt="Teacher Image" class="profile-img"> -->
                <h2 class="teacher-name"><?= htmlspecialchars($teacher['name']); ?></h2>
                <p class="teacher-details"><?= htmlspecialchars($teacher['department']); ?></p>
            </div>
            <nav class="menu">
                <a href="teacher_notifications.php" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon">
                        <path d="M12 22c5.522 0 10-4.478 10-10S17.522 2 12 2 2 6.478 2 12s4.478 10 10 10zm1-16h2v8h-2V6zm-4 4h2v4H9v-4zm-3 6h2v-6H6v6zm8 4h2v-8h-2v8z" />
                    </svg>
                    Notifications
                </a>
                <a href="calendar.php" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon">
                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM5 19V5h14v14H5z" />
                    </svg>
                    Calendar
                </a>
                <a href="leave_details.php" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon">
                        <path d="M12 22c5.522 0 10-4.478 10-10S17.522 2 12 2 2 6.478 2 12s4.478 10 10 10zm0-10c-2.21 0-4 1.79-4 4s1.79 4 4 4 4-1.79 4-4-1.79-4-4-4z" />
                    </svg>
                    Leave Details
                </a>
                <a href="reports.php" class="menu-item">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="icon">
                        <path d="M18 2H6c-1.1 0-2 .9-2 2v16l7-3 7 3V4c0-1.1-.9-2-2-2zm-2 15.17L12 14l-4 3.17V4h8v13.17z" />
                    </svg>
                    Reports
                </a>
            </nav>
        </aside>
        <main class="content">
            <h1>Welcome, <?= htmlspecialchars($teacher['name']); ?>!</h1>
            <p>This is your dashboard. Use the menu to navigate through your options.</p>
        </main>
    </div>
</body>
</html>
