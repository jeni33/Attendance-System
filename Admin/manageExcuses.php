<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/course.php';
require_once '../classes/student.php';
require_once '../classes/excuse.php';

$courseObj = new Course();
$excuseObj = new ExcuseLetter();

$courses = $courseObj->getAllCourses();

$courseFilter = isset($_GET['course']) ? $_GET['course'] : '';
$yearFilter   = isset($_GET['year_level']) ? $_GET['year_level'] : '';

if ($courseFilter && $yearFilter) {
    $excuses = $excuseObj->getByCoursesYear($courseFilter, $yearFilter);
} else {
    $excuses = $excuseObj->getAllWithStudents();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Excuse Letters</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
            text-align: center;
            margin: 30px 0 10px;
            letter-spacing: 1px;
        }

        form {
            text-align: center;
            margin: 20px auto;
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            width: 100%;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        select, input[type="text"] {
            padding: 10px;
            margin: 0 8px 12px;
            border: 1px solid #7FAAD1;
            border-radius: 5px;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
            width: 45%;
        }

        button {
            background: #1E4E79;
            color: white;
            border: none;
            padding: 10px 22px;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
            font-size: 14px;
            transition: background 0.3s;
        }

        button:hover {
            background: #163B5C;
        }

        table {
            width: 90%;
            margin: 20px auto;
            border-collapse: collapse;
            background: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        th, td {
            border: 1px solid #7FAAD1;
            padding: 10px;
            text-align: center;
            font-size: 14px;
        }

        th {
            background: #1E4E79;
            color: white;
            font-weight: 600;
        }

        td img {
            max-width: 80px;
            max-height: 80px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        select.status_select {
            padding: 6px;
            border-radius: 5px;
            border: 1px solid #7FAAD1;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 13px;
        }

        p.no-data {
            text-align: center;
            color: #666;
            font-style: italic;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <h1>Excuse Letter Management</h1>

    <form method="GET" action="">
        <select name="course" required>
            <option value="">Select Course</option>
            <?php foreach($courses as $c): ?>
                <option value="<?= htmlspecialchars($c['name']) ?>"
                    <?= ($courseFilter == $c['name']) ? 'selected' : '' ?>>
                    <?= htmlspecialchars($c['name']) ?>
                </option>
            <?php endforeach; ?>
        </select>

        <input type="text" name="year_level" placeholder="Year Level" value="<?= htmlspecialchars($yearFilter) ?>">

        <button type="submit">Filter</button>
    </form>

    <?php if($excuses): ?>
    <table>
        <tr>
            <th>Student ID</th>
            <th>Student Name</th>
            <th>Reason</th>
            <th>Letter</th>
            <th>Date Submitted</th>
            <th>Status</th>
        </tr>
        <?php foreach($excuses as $e): ?>
        <tr>
            <td><?= htmlspecialchars($e['student_number']) ?></td>
            <td><?= htmlspecialchars($e['full_name']) ?></td>
            <td><?= htmlspecialchars($e['reason']) ?></td>
            <td>
                <?php if (!empty($e['photo'])): ?>
                    <a href="<?= htmlspecialchars($e['photo']) ?>" target="_blank">
                        <img src="<?= htmlspecialchars($e['photo']) ?>" alt="Photo">
                    </a>
                <?php else: ?>
                    No Photo
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($e['date_submitted']) ?></td>
            <td>
                <select name="status" class="status_select" data-excuse-id="<?= $e['id']; ?>">
                    <option value="Pending"  <?= ($e['status']=="Pending") ? "selected" : "" ?>>Pending</option>
                    <option value="Approved" <?= ($e['status']=="Approved") ? "selected" : "" ?>>Approved</option>
                    <option value="Rejected" <?= ($e['status']=="Rejected") ? "selected" : "" ?>>Rejected</option>
                </select>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <?php else: ?>
        <p class="no-data">No excuse letters found.</p>
    <?php endif; ?>

    <script>
    $('.status_select').on('change', function (event) {
        event.preventDefault();
        var formData = {
          excuse_id: $(this).data('excuse-id'),
          status: $(this).val(),
          updateExcuseStatus: 1
        }

        if (formData.excuse_id != "" && formData.status != "") {
          $.ajax({
            type: "POST",
            url: "../handle/handleForms.php",
            data: formData,
            success: function (data) {
              if (data) {
                location.reload();
              } else {
                alert("Status update failed");
              }
            }
          })
        }
    })
    </script>

</body>
</html>
