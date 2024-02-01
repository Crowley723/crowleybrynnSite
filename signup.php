<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <?php include "./header.php" ?>

    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }

        .container {
            max-width: 400px;
            margin: auto;
        }

        input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 5px;
            margin: 10px;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        <form onsubmit="return validateForm()">
            <input type="text" placeholder="Full Name" required><br>
            <input type="email" placeholder="Email" required><br>
            <input type="password" placeholder="Password" required><br>
            <input type="password" placeholder="Confirm Password" required><br>
            <input type="submit" class="btn" value="Sign Up">
        </form>
        <p>
            Already have an account? <a href="signin.php">Sign In</a>
        </p>
    </div>
    <script>
        function validateForm() {
            var fullName = document.getElementById('fullName').value;
            var email = document.getElementById('email').value;
            var password = document.getElementById('password').value;
            var confirmPassword = document.getElementById('confirmPassword').value;

            // Check if any field is empty
            if (fullName === '' || email === '' || password === '' || confirmPassword === '') {
                alert('All fields are required');
                return false;
            }

            // Check if passwords match
            if (password !== confirmPassword) {
                alert('Passwords do not match');
                return false;
            }

            // Check if the email is valid
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (!emailRegex.test(email)) {
                alert('Invalid email address');
                return false;
            }

            // Add more checks for password strength if needed

            // If all checks pass, the form will be submitted
            return true;
        }
    </script>
</body>
</html>
