CREATE DATABASE LeaveManagement;

USE LeaveManagement;

CREATE TABLE leave_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    student_id VARCHAR(50),
    class VARCHAR(50),
    reason TEXT,
    date_from DATE,
    date_to DATE,
    status VARCHAR(20) DEFAULT 'Pending',
    incharge_status VARCHAR(20) DEFAULT 'Pending',
    hod_status VARCHAR(20) DEFAULT 'Pending'
);
