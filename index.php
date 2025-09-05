<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <!-- Font Awesome para sa icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: "Poppins", Arial, sans-serif;
            background-color: #DDEAF6;
            color: #333;
            margin: 0;
            padding: 20px;
        }

        h1 {
            color: #1E4E79;
            font-weight: 600;
            margin-bottom: 40px;
            text-align: center;
            letter-spacing: 1px; 
        }

        .form-box {
            background: #fff;
            border: 2px solid #1E4E79;
            border-radius: 8px;
            padding: 25px;
            margin: 30px auto;
            max-width: 400px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            color: #1E4E79;
            text-align: left;
            font-weight: 600;
            font-size: 14px;
        }

        .input-wrapper {
            position: relative;
            margin-bottom: 16px;
        }

        .input-wrapper input {
            width: 100%;
            padding: 11px 40px; /* space for left+right icons */
            border: 1px solid #7FAAD1;
            border-radius: 5px;
            font-size: 14px;
            font-family: "Poppins", Arial, sans-serif;
            box-sizing: border-box;
        }

        /* Left icon (hash, mail, lock, etc.) */
        .input-wrapper .icon-left {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: #1E4E79;
            font-size: 16px;
            pointer-events: none;
        }

        /* Right icon (show/hide password) */
        .input-wrapper .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
            color: #1E4E79;
            font-size: 16px;
            transition: 0.3s;
        }
        .input-wrapper .toggle-password:hover {
            color: #163B5C;
        }

        button {
            background: #1E4E79;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.5px;
            font-family: "Poppins", Arial, sans-serif;
        }

        button:hover {
            background: #163B5C;
        }

        p {
            margin-top: 18px;
            font-size: 14px;
            text-align: center; 
        }

        a {
            color: #1E4E79;
            font-weight: 600;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
            color: #163B5C;
        }
    </style>
</head>
<body>
    <div class="form-box">
        <h1>Login</h1>
        <form method="POST" action="handle/handleForms.php">
            
            <label for="email">Email</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-envelope icon-left"></i>
                <input type="email" name="email" id="email" required>
            </div>

            <label for="password">Password</label>
            <div class="input-wrapper">
                <i class="fa-solid fa-lock icon-left"></i>
                <input type="password" name="password" id="password" required>
                <i class="fa-solid fa-eye toggle-password" onclick="togglePassword('password', this)"></i>
            </div>

            <button type="submit" name="login">Login</button>
            <p>Don't Have An Account Yet? You May <a href="register.php">Register Here!</a></p>
        </form>
    </div>

    <script>
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
    </script>
</body>
</html>
