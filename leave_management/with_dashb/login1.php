<?php
session_start();
$conn = new mysqli("localhost", "root", "", "leave_manage");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the registration number from POST data
$register_no = $_POST['register_no'];

// Check if the teacher exists by register_no
$sql = "SELECT id FROM teacher_table WHERE register_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $register_no);
$stmt->execute();
$result = $stmt->get_result();

// Verify if the teacher is found
if ($result->num_rows == 1) {
    // Fetch the teacher's ID only and store it in session
    $teacher = $result->fetch_assoc();
    $_SESSION['teacher_id'] = $teacher['id'];
    
    // Redirect to dashboard
    header("Location: teacher_dashboard.php");
    exit();
} else {
    echo "Teacher not found. Please check your registration number.";
}

// Close the database connection
$conn->close();
?>
