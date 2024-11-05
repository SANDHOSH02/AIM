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

// Fetch all accepted leave requests
$sql = "SELECT sl.id, st.register_no, st.name, sl.reason, sl.start_date, sl.end_date
        FROM student_leave sl
        JOIN student_table st ON sl.student_id = st.id
        WHERE sl.status = 'Approved'
        ORDER BY sl.start_date DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accepted Leave Requests</title>
    <style>
        body { font-family: Arial, sans-serif; background-color: #f4f6f9; color: #333; }
        .details-container { max-width: 800px; margin: 50px auto; padding: 20px; background-color: #ffffff; border-radius: 5px; box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); }
        h2 { color: #1d3557; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #ddd; padding: 8px; }
        th { background-color: #1d3557; color: white; }
        td { text-align: center; }
    </style>
</head>
<body>
    <div class="details-container">
        <h2>Accepted Leave Requests</h2>
        <table>
            <tr>
                <th>Registration No</th>
                <th>Student Name</th>
                <th>Reason</th>
                <th>Start Date</th>
                <th>End Date</th>
            </tr>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['register_no']); ?></td>
                        <td><?= htmlspecialchars($row['name']); ?></td>
                        <td><?= htmlspecialchars($row['reason']); ?></td>
                        <td><?= htmlspecialchars($row['start_date']); ?></td>
                        <td><?= htmlspecialchars($row['end_date']); ?></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr><td colspan="5">No accepted leave requests found.</td></tr>
            <?php endif; ?>
        </table>
    </div>
</body>
</html>

<?php
$conn->close();
?>
