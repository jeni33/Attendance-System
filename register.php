<?php
require_once 'classes/course.php';

$courseObj = new Course();
$courses = $courseObj->getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

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

        a {
            margin-top: 20px;
            color: #1E4E79;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
        }

        a:hover {
            text-decoration: underline;
            color: #163B5C;
        }

        .form-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 12px;
            padding: 30px 25px;
            margin: 30px auto;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 6px 18px rgba(0,0,0,0.12);
        }

        h1 {
            color: #1E4E79;
            font-weight: 600;
            margin-bottom: 25px;
            text-align: center;
            letter-spacing: 1px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #1E4E79;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"], 
        input[type="email"], 
        input[type="password"], 
        input[type="number"], 
        select {
            width: 100%;       
            padding: 12px;
            margin-bottom: 16px;
            border: 1px solid #7FAAD1;
            border-radius: 6px;
            box-sizing: border-box; 
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
            transition: 0.3s;
            line-height: 1.2;
        }

        input:focus, select:focus {
            border-color: #1E4E79;
            box-shadow: 0 0 6px rgba(30,78,121,0.3);
            outline: none;
        }

        .password-wrapper {
            position: relative;
            display: flex;
            align-items: center; 
        }

        .password-wrapper input {
            flex: 1;
            padding-right: 40px;
            height: 45px; 
            font-size: 14px;
            line-height: 1.2;
            border-radius: 6px;
            border: 1px solid #7FAAD1;
        }

        .password-wrapper .toggle-password {
            position: absolute;
            right: 16px; 
            cursor: pointer;
            font-size: 18px;
            color: #1E4E79;
            transition: 0.3s;
        }
        .password-wrapper .toggle-password:hover {
            color: #163B5C;
        }

        button {
            background: #1E4E79;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            width: 100%;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }

        button:hover {
            background: #163B5C;
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        #student_fields {
            margin-top: 10px;
        }
    </style>

</head>
<body>

    <div class="form-box">
        <h1>Registration</h1>
        <form method="POST" action="handle/handleForms.php">

            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <div class="password-wrapper">
                <input type="password" name="password" id="password" required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
            </div>

            <label for="confirm_password">Confirm Password</label>
            <div class="password-wrapper">
                <input type="password" name="confirm_password" id="confirm_password" required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('confirm_password', this)"></i>
            </div>

            <label for="role">Role</label>
            <select name="role" id="role" required>
                <option value="student" selected>Student</option>
                <option value="admin">Admin</option>
            </select>

            <div id="student_fields">
                <label for="student_id">Student ID</label>
                <input type="text" name="student_id" id="student_id">

                <label for="course">Course</label>
                <select name="course" id="course">
                    <option value="">Select Course</option>
                    <?php foreach ($courses as $c): ?>
                        <option value="<?= htmlspecialchars($c['name']) ?>">
                            <?= htmlspecialchars($c['name']) ?> (<?= htmlspecialchars($c['code']) ?>)
                        </option>
                    <?php endforeach; ?>
                </select>

                <label for="year_level">Year Level</label>
                <input type="number" name="year_level" id="year_level" min="1" max="6">
            </div>

            <button type="submit" name="register_student">Register</button>
        </form>
    </div>

    <script>
        const roleSelect = document.getElementById("role");
        const studentFields = document.getElementById("student_fields");

        const studentId = document.getElementById("student_id");
        const course = document.getElementById("course");
        const yearLevel = document.getElementById("year_level");

        function toggleStudentFields() {
            const isStudent = roleSelect.value === "student";
            studentFields.style.display = isStudent ? "block" : "none";

            studentId.required = isStudent;
            course.required = isStudent;
            yearLevel.required = isStudent;
        }

        function togglePassword(fieldId, el) {
            const input = document.getElementById(fieldId);
            if (input.type === "password") {
                input.type = "text";
                el.classList.remove("fa-eye");
                el.classList.add("fa-eye-slash");
            } else {
                input.type = "password";
                el.classList.remove("fa-eye-slash");
                el.classList.add("fa-eye");
            }
        }

        roleSelect.addEventListener("change", toggleStudentFields);
        window.addEventListener("DOMContentLoaded", toggleStudentFields);
    </script>
</body>
</html>
