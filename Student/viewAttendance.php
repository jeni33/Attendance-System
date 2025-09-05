<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/attendance.php';

$attendanceObj = new Attendance();
$studentId = $_SESSION['user']['id'];
$attendances = $attendanceObj->getByStudent($studentId, 'DESC');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Attendance History</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            background-color: #F4F7FA;
            color: #333;
            margin: 0;
        }

        .container {
            width: 90%;
            margin: 30px auto;
        }

        h1 {
            color: #1E4E79;
            font-weight: 600;
            text-align: center;
            margin-bottom: 25px;
            letter-spacing: 0.5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            margin-top: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.05);
            border-radius: 8px;
            overflow: hidden;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 12px 10px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background: #1E4E79;
            color: white;
            font-weight: 600;
        }

        tr:nth-child(even) {
            background-color: #F9FBFD;
        }

        tr:hover {
            background-color: #E6EEF6;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Attendance History</h1>
    <table>
        <tr>
            <th>Date</th>
            <th>Time</th>
            <th>Course</th>
            <th>Status</th>
            <th>Late</th>
        </tr>
        <?php foreach($attendances as $a): ?>
        <tr>
            <td><?= htmlspecialchars($a['date']) ?></td>
            <td><?= htmlspecialchars($a['time']) ?></td>
            <td><?= htmlspecialchars($a['course']) ?></td>
            <td><?= htmlspecialchars($a['status']) ?></td>
            <td><?= $a['is_late'] ? 'Yes':'No' ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</div>
</body>
</html>
