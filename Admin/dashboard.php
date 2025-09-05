<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/course.php';

$courseObj = new Course();
$courses = $courseObj->getAllCourses();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #DDEAF6;
            color: #333;
            margin: 0;
            padding: 0;
        }

        h1 {
            margin: 25px 0;
            text-align: center;
            color: #1E4E79;
            font-weight: 600;
            letter-spacing: 1px;
        }

        h2 {
            color: #1E4E79;
            margin-top: 40px;
            margin-bottom: 15px;
            text-align: center;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .form-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            padding: 25px;
            margin: 30px auto;
            max-width: 500px;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
        }

        .form-box h2 {
            color: #1E4E79;
            text-align: center;
            font-weight: 600;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #1E4E79;
            font-weight: 600;
            font-size: 14px;
        }

        input[type="text"], select {
            width: 100%;
            padding: 11px;
            margin-bottom: 15px;
            border: 1px solid #7FAAD1;
            border-radius: 5px;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
        }

        button {
            background: #1E4E79;
            color: #fff;
            border: none;
            padding: 10px 18px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }

        button:hover {
            background: #163B5C;
            color: #fff;
        }

        .form-box button[type="submit"] {
            display: block;
            width: 60%;
            margin: 15px auto 0 auto;
        }

        table {
            width: 85%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0px 2px 6px rgba(0,0,0,0.1);
            table-layout: fixed;
        }

        th, td {
            border: 1px solid #7FAAD1;
            padding: 12px;
            text-align: center;
            font-size: 14px;
            vertical-align: middle;
        }

        th {
            background: #1E4E79;
            color: white;
            font-weight: 600;
        }

        table input[type="text"], table select {
            width: 95%;
            padding: 8px;
            border: 1px solid #7FAAD1;
            border-radius: 5px;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
            box-sizing: border-box;
        }

        table button {
            background: #1E4E79;
            color: #fff;
            border: none;
            padding: 8px 14px;
            border-radius: 5px;
            font-weight: 600;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 13px;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: 0.3s;
            margin: 2px;
        }

        table button:hover {
            background: #163B5C;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h1>Add New Course</h1>
        <form method="POST" action="../handle/handleForms.php">
            <label for="code">Course Code</label>
            <input type="text" name="code" id="code" placeholder="Course Code" required>

            <label for="name">Course Name</label>
            <input type="text" name="name" id="name" placeholder="Course Name" required>

            <label for="year_levels">Year Levels</label>
            <select name="year_levels" id="year_levels" required>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>

            <button type="submit" name="add_course">Add Course</button>
        </form>
    </div>

    <h2>Existing Courses</h2>
    <table>
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Year Levels</th>
            <th>Actions</th>
        </tr>
        <?php foreach($courses as $c): ?>
        <tr id="row-<?= $c['id'] ?>">
            <form method="POST" action="../handle/handleForms.php" id="form-<?= $c['id'] ?>">
                <td>
                    <span class="view"><?= htmlspecialchars($c['code']) ?></span>
                    <input class="edit" type="text" name="code" value="<?= htmlspecialchars($c['code']) ?>" style="display:none;" required>
                </td>
                <td>
                    <span class="view"><?= htmlspecialchars($c['name']) ?></span>
                    <input class="edit" type="text" name="name" value="<?= htmlspecialchars($c['name']) ?>" style="display:none;" required>
                </td>
                <td>
                    <span class="view"><?= htmlspecialchars($c['year_levels']) ?></span>
                    <select class="edit" name="year_levels" style="display:none;">
                        <option value="1" <?= $c['year_levels']==1?'selected':'' ?>>1</option>
                        <option value="2" <?= $c['year_levels']==2?'selected':'' ?>>2</option>
                        <option value="3" <?= $c['year_levels']==3?'selected':'' ?>>3</option>
                        <option value="4" <?= $c['year_levels']==4?'selected':'' ?>>4</option>
                    </select>
                </td>
                <td>
                    <div class="view">
                        <button type="button" onclick="toggleEdit('<?= $c['id'] ?>')">Edit</button>
                        <button type="submit" name="delete_course" onclick="return confirm('Are you sure?')">Delete</button>
                    </div>
                    <div class="edit" style="display:none;">
                        <input type="hidden" name="id" value="<?= $c['id'] ?>">
                        <button type="submit" name="edit_course">Save</button>
                        <button type="button" onclick="toggleEdit('<?= $c['id'] ?>')">Cancel</button>
                    </div>
                </td>
            </form>
        </tr>
        <?php endforeach; ?>
    </table>

    <script>
    function toggleEdit(id) {
        let row = document.getElementById("row-" + id);
        let viewElems = row.querySelectorAll(".view");
        let editElems = row.querySelectorAll(".edit");

        viewElems.forEach(el => {
            el.style.display = (el.style.display === "none") ? "inline-block" : "none";
        });
        editElems.forEach(el => {
            el.style.display = (el.style.display === "none") ? "inline-block" : "none";
        });
    }
    </script>
</body>
</html>
