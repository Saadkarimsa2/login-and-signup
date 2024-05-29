<?php
require 'connection.php';

if(isset($_POST["login"])){
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $password = $_POST["password"]; 

    $query = "SELECT * FROM user WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if($result && mysqli_num_rows($result) > 0){
        $row = mysqli_fetch_assoc($result);
        if(password_verify($password, $row['password'])){
            header("Location: final_landing_page.php");
            exit; 
        } else {
            echo "<script>alert('Invalid password')</script>";
        }
    } else {
        echo "<script>alert('Invalid username')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .login-form {
            width: 300px;
            margin: 50px auto;
            padding: 30px;
            background-color: #fff;
            border: 1px solid #ddd;
            box-shadow: 0px 0px 5px rgba(0,0,0,0.1);
        }

        .login-form h2 {
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 5px;
            font-size: 14px;
            color: #666;
        }

        .form-input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
            font-size: 14px;
            color: #333;
        }

        .form-input:focus {
            outline: none;
            box-shadow: 0px 0px 2px 1px #4CAF50;
        }

        .form-button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            font-size: 14px;
            cursor: pointer;
        }

        .form-button:hover {
            background-color: #45a049;
        }

        .already-have-an-account {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
        }

        .already-have-an-account a {
            color: #4CAF50;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div id="login-form" class="login-form">
        <form method="post">
            <h2>Login</h2>
            <div class="form-group">
                <label for="username" class="form-label">Username</label>
                <input type="text" placeholder="Enter Username" id="username" name="username" class="form-input">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <input type="password" placeholder="Enter Password" id="password" name="password" class="form-input">
            </div>

            <div class="form-group">
                <input type="checkbox" id="remember-me" name="remember-me">
                <label for="remember-me">Remember me</label>
            </div>

            <button type="submit" name="login" class="form-button">Login</button>

            <div class="already-have-an-account">
                Don't have an account? <a href="signup.php">Register now</a>
            </div>
        </form>
    </div>
</body>
</html>
