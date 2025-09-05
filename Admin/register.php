<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Registration</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background: #DDEAF6; 
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #1E4E79;
            font-weight: 600;
            margin-bottom: 35px;
            text-align: center;
            letter-spacing: 1px;
        }

        .form-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            padding: 20px;
            margin: 30px auto;
            max-width: 500px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }

        a {
            color: #1E4E79;
            text-decoration: none;
            font-weight: 600;
            margin-left: 10px;
        }

        a:hover {
            text-decoration: underline;
            color: #163B5C;
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
        input[type="password"] {
            width: 95%;
            padding: 11px;
            margin-bottom: 16px;
            border: 1px solid #7FAAD1;
            border-radius: 5px;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 14px;
        }

        button {
            background: #1E4E79;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-family: "Poppins", Arial, sans-serif;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
        }

        button:hover {
            background: #163B5C;
        }
    </style>
</head>
<body>
    <a href="../index.php">← Back to Login</a>

    <div class="form-box">
        <h1>Admin Registration</h1>
        <form method="POST" action="../handle/handleForms.php">
            <label for="full_name">Full Name</label>
            <input type="text" name="full_name" id="full_name" required>

            <label for="email">Email</label>
            <input type="email" name="email" id="email" required>

            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>

            <label for="confirm_password">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" required>

            <button type="submit" name="register_admin">Register Admin</button>
        </form>
    </div>
</body>
</html>
