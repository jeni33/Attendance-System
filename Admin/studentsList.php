<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/student.php';

$studentObj = new Student();
$students = $studentObj->selectAll("students");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Students List</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #DDEAF6;
            margin: 0;
            padding: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #1E4E79;
            font-weight: 600;
            margin: 35px 0;
            letter-spacing: 1px;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
            border: 2px solid #1E4E79;
        }

        th, td {
            border: 1px solid #7FAAD1;
            padding: 12px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background: #1E4E79;
            color: white;
            font-weight: 600;
            font-size: 15px;
        }

        tr:nth-child(even) {
            background: #F3F8FC;
        }
    </style>
</head>
<body>
    <h1>Students List</h1>

    <table>
        <tr>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year Level</th>
        </tr>
        <?php foreach($students as $s): ?>
        <tr>
            <td><?= htmlspecialchars($s['student_id']) ?></td>
            <td><?= htmlspecialchars($s['full_name']) ?></td>
            <td><?= htmlspecialchars($s['course']) ?></td>
            <td><?= htmlspecialchars($s['year_level']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    
</body>
</html>
