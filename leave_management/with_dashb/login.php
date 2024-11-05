<?php
session_start();
$conn = new mysqli("localhost", "root", "", "leave_manage");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$register_no = $_POST['register_no'];
$password = $_POST['password'];

// Check if the student exists by register_no only
$sql = "SELECT * FROM students WHERE register_no = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $register_no);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows == 1) {
    $student = $result->fetch_assoc();
    
    if (empty($student['password'])) {
        
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $update_sql = "UPDATE students SET password = ? WHERE register_no = ?";
        $update_stmt = $conn->prepare($update_sql);
        $update_stmt->bind_param("ss", $hashed_password, $register_no);
        $update_stmt->execute();
        
        
        $_SESSION['student_id'] = $student['id'];
        header("Location: dashboard.php");
        exit();
    } else {
        // Verify the password
        if (password_verify($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password. Please try again.";
        }
    }
} else {
    echo "Student not found. Please check your registration number.";
}

$conn->close();
?>
