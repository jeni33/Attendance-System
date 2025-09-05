<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/student.php';

$studentObj = new Student();
$studentId = $_SESSION['user']['id'];
$student = $studentObj->selectOne("students", "user_id = :uid", ["uid"=>$studentId]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Profile</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        body {
            font-family: "Poppins", sans-serif;
            background-color: #F4F7FA;
            color: #333;
            margin: 0;
        }

        h1 {
            color: #1E4E79;
            font-weight: 600;
            margin: 0;
            text-align: center;
            padding: 30px 20px 10px;
        }

        h2 {
            color: #1E4E79;
            text-align: center;
            margin-bottom: 25px;
            font-weight: 600;
        }

        .links {
            text-align: center;
            margin-bottom: 20px;
        }

        .links a {
            color: #1E4E79;
            font-weight: 500;
            text-decoration: none;
            margin: 0 5px;
        }

        .links a:hover {
            text-decoration: underline;
        }

        .form-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 10px;
            padding: 25px;
            margin: 30px auto;
            max-width: 450px;
            text-align: left;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        label {
            display: block;
            margin-top: 10px;
            margin-bottom: 5px;
            color: #1E4E79;
            font-weight: 500;
        }

        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        button {
            background: #1E4E79;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            margin-top: 10px;
            font-weight: 500;
            transition: background 0.3s;
        }

        button:hover {
            background: #163B5C;
        }

        .profile-info p {
            margin: 15px 0;
            font-size: 14px;
        }

        .profile-info strong {
            color: #1E4E79;
        }
    </style>
</head>
<body>
<h1>My Profile</h1>

<div class="form-box" id="profileDisplay">
    <h2>Account Information</h2>
    <div class="profile-info">
        <p><strong>Full Name: </strong> <?= htmlspecialchars($_SESSION['user']['full_name']) ?></p>
        <p><strong>Email: </strong> <?= htmlspecialchars($_SESSION['user']['email']) ?></p>
        <p><strong>Course: </strong> <?= htmlspecialchars($student['course']) ?></p>
        <p><strong>Year Level: </strong> <?= htmlspecialchars($student['year_level']) ?></p>
    </div>
    <button onclick="toggleEditForm()">Edit Profile</button>
</div>

<div class="form-box" id="editForm" style="display:none;">
    <form method="POST" action="../handle/handleForms.php">
        <input type="hidden" name="id" value="<?= $student['id'] ?>">

        <label>Full Name</label>
        <input type="text" name="full_name" value="<?= htmlspecialchars($_SESSION['user']['full_name']) ?>" required>

        <label>Email</label>
        <input type="email" name="email" value="<?= htmlspecialchars($_SESSION['user']['email']) ?>" required>

        <label>Course</label>
        <input type="text" name="course" value="<?= htmlspecialchars($student['course']) ?>" required>

        <label>Year Level</label>
        <input type="text" name="year_level" value="<?= htmlspecialchars($student['year_level']) ?>" required>

        <button type="submit" name="update_student_profile">Save</button>
        <button type="button" onclick="toggleEditForm()">Cancel</button>
    </form>
</div>

<script>
function toggleEditForm() {
    let display = document.getElementById("profileDisplay");
    let form = document.getElementById("editForm");
    if (form.style.display === "none") {
        form.style.display = "block";
        display.style.display = "none";
    } else {
        form.style.display = "none";
        display.style.display = "block";
    }
}
</script>
</body>
</html>
