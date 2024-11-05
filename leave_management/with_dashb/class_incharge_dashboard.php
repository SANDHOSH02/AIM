<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'class_teacher') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Class Incharge Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, Class Incharge!</h1>
    <p>This is your dashboard.</p>
    <!-- Add further functionalities and links here -->
</body>
</html>
