<?php
session_start();
$conn = new mysqli("localhost", "root", "", "leave_manage");

// Check database connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ensure the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header("Location: login.php");
    exit();
}

// Handle leave approval and forwarding actions
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $leave_id = $_POST['leave_id'];
    if (isset($_POST['accept'])) {
        $update_sql = "UPDATE student_leave SET status = 'Approved' WHERE id = ?";
    } elseif (isset($_POST['forward'])) {
        $update_sql = "UPDATE student_leave SET status = 'Forwarded to HOD' WHERE id = ?";
    }
    $stmt = $conn->prepare($update_sql);
    $stmt->bind_param("i", $leave_id);
    $stmt->execute();
}

// Fetch all leave requests with student details
$sql = "SELECT sl.id, st.register_no, st.name, sl.reason, sl.start_date, sl.end_date, sl.status
        FROM student_leave sl
        JOIN student_table st ON sl.student_id = st.id
        ORDER BY sl.id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teacher Notifications</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; color: #333; }
        .notification-container { max-width: 800px; margin: 50px auto; padding: 20px; background-color: #ffffff; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #1d3557; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #1d3557; color: white; }
        td { text-align: center; }
        button { padding: 5px 10px; background-color: #1d3557; color: white; border: none; border-radius: 3px; cursor: pointer; }
        button:hover { background-color: #457b9d; }
    </style>
</head>
<body>
    <div class="notification-container">
        <h2>Leave Requests</h2>
        <table>
            <tr>
                <th>Registration No</th>
                <th>Student Name</th>
                <th>Reason</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['register_no']); ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['reason']); ?></td>
                        <td><?= htmlspecialchars($row['start_date']); ?></td>
                        <td><?= htmlspecialchars($row['end_date']); ?></td>
                        <td><?= htmlspecialchars($row['status'] ?? 'Pending'); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="leave_id" value="<?= $row['id']; ?>">
                                <button type="submit" name="accept">Accept</button>
                                <button type="submit" name="forward">Forward to HOD</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="7">No leave requests found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
