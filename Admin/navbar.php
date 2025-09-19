<?php
if(!isset($_SESSION)) {
    session_start();
}

if(isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'):
?>
    <nav class="navbar">
        <div class="navbar-left">
            <span>Admin Dashboard</span>
        </div>
        <div class="navbar-right">
            <a href="dashboard.php">Home</a>
            <a href="attendanceReports.php">Records</a>
            <a href="studentsList.php">Students</a>
            <a href="manageExcuses.php">Excuse Letters</a>
            <a href="../handle/handleForms.php?logoutUserBtn=1">Logout</a>
        </div>
    </nav>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap');

        .navbar {
            width: 100%;
            background: #1E4E79;
            padding: 12px 25px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 2px 6px rgba(0,0,0,0.1);
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        .navbar-left span {
            color: #fff;
            font-size: 18px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        .navbar-right a {
            color: #fff;
            font-weight: 500;
            text-decoration: none;
            margin-left: 22px;
            padding: 6px 12px;
            border-radius: 5px;
            font-size: 14px;
            transition: background 0.3s, color 0.3s;
        }

        .navbar-right a:hover {
            background: #163B5C;
            color: #fff;
        }
    </style>
<?php endif; ?>
