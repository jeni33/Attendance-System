<?php
session_start();
if(!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'student'){
    header("Location: ../index.php");
    exit;
}

include 'navbar.php';
require_once '../classes/student.php';
require_once '../classes/excuse.php';

$studentObj = new Student();
$excuseObj = new ExcuseLetter();

$studentId = $_SESSION['user']['id'];

$student = $studentObj->selectOne("students", "user_id = :uid", ["uid"=>$studentId]);
$excuses = $excuseObj->selectAll("excuse_letters", "student_id = :sid", ["sid"=>$student['id']]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Excuse Letter</title>
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

        .form-box, .table-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            padding: 25px;
            margin: 20px auto;
            max-width: 700px;
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

        textarea, input[type="file"] {
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

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
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

        p.no-data {
            text-align: center;
            color: #666;
            font-style: italic;
        }
    </style>
</head>
<body>
    <h1>Excuse Letter Submission</h1>

    <div class="form-box">
        <form method="POST" action="../handle/handleForms.php" enctype="multipart/form-data">
            <input type="hidden" name="submit_excuse" value="1">
            <input type="hidden" name="student_id" value="<?= $student['id'] ?>">

            <label for="reason">Reason</label>
            <textarea name="reason" id="reason" rows="4" required></textarea>

            <label for="photo">Upload handwritten letter</label>
            <input type="file" name="photo" id="photo" accept="image/*">

            <button type="submit">Submit</button>
        </form>
    </div>

    <div class="table-box">
        <h2>Your Submitted Excuse Letters</h2>
        <?php if($excuses): ?>
        <table>
            <tr>
                <th>Date Submitted</th>
                <th>Reason</th>
                <th>Letter</th>
                <th>Status</th>
            </tr>
            <?php foreach($excuses as $e): ?>
            <tr>
                <td><?= htmlspecialchars($e['date_submitted']) ?></td>
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
                <td>
                    <?php
                        if ($e['status'] === 'Pending') echo "Pending";
                        elseif ($e['status'] === 'Approved') echo "Approved";
                        else echo "Rejected";
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p class="no-data">No excuse letters submitted yet.</p>
        <?php endif; ?>
    </div>
</body>
</html>
