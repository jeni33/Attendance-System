<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/attendance.php';
require_once '../classes/student.php';

$attendanceObj = new Attendance();
$studentObj = new Student();
$studentId = $_SESSION['user']['id'];
$student = $studentObj->selectOne("students", "user_id = :uid", ["uid"=>$studentId]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #DDEAF6;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        h1 {
            color: #1E4E79;
            font-weight: 600;
            margin: 0;
            text-align: center;
            padding: 30px 20px 10px;
            letter-spacing: 1px;
        }

        .form-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            padding: 25px;
            margin: 20px auto;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        h2 {
            color: #1E4E79;
            text-align: center;
            margin-bottom: 20px;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #1E4E79;
            font-weight: 600;
            font-size: 14px;
        }

        select, input[type="text"] {
            width: 100%;
            padding: 11px;
            margin-bottom: 16px;
            border: 1px solid #7FAAD1;
            border-radius: 5px;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
        }

        button {
            display: block;
            margin: 0 auto;
            background: #1E4E79;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-family: "Poppins", Arial, sans-serif;
            font-weight: 600;
            font-size: 15px;
            transition: background 0.3s;
        }

        button:hover {
            background: #163B5C;
        }
    </style>
</head>
<body>
    <h1>Welcome, <?= htmlspecialchars($_SESSION['user']['full_name']) ?>!</h1>

    <div class="form-box">
        <h2>Attendance</h2>
        <form method="POST" action="../handle/handleForms.php">
            <input type="hidden" name="student_id" value="<?= $studentId ?>">

            <label for="course">Course</label>
            <input type="text" name="course" id="course" value="<?= $student['course'] ?>" readonly>

            <label for="year_level">Year Level</label>
            <input type="text" name="year_level" id="year_level" value="<?= $student['year_level'] ?>" readonly>

            <label for="status">Status</label>
            <select name="status" id="status" required>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Excused">Excused</option>
            </select>

            <button type="submit" name="file_attendance">Mark Attendance</button>
        </form>
    </div>
</body>
</html>
