<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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
        <h2>Sign In</h2>
        <form>
            <input type="email" placeholder="Email" required><br>
            <input type="password" placeholder="Password" required><br>
            <input type="submit" class="btn" value="Sign In">
        </form>
        <p>
            <a href="#">Forgot Password</a> |
            <a href="signup.php">Create an Account</a>
        </p>
    </div>
</body>
</html>
