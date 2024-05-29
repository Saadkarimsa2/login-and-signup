<?php
require 'connection.php';

if(isset($_POST["submit"])){
    $username = mysqli_real_escape_string($conn, $_POST["name"]);
    $password = mysqli_real_escape_string($conn, $_POST["password"]);
    $confirm_password = mysqli_real_escape_string($conn, $_POST["confirm-password"]);
    $email = mysqli_real_escape_string($conn, $_POST["email"]);
    $date_of_birth = $_POST["date_of_birth"];
    $gender = $_POST["gender"];
    $contact_number = mysqli_real_escape_string($conn, $_POST["contact_number"]);
    $address = mysqli_real_escape_string($conn, $_POST["address"]);

    if($password != $confirm_password){
        echo "<script>alert('Passwords do not match')</script>";
    } else {
        if(isset($_POST["terms-conditions"])){
            $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $query = "INSERT INTO user (username, password, email, date_of_birth, gender, contact_number, address) 
                      VALUES ('$username', '$hashed_password', '$email', '$date_of_birth', '$gender', '$contact_number', '$address')";
            if(mysqli_query($conn, $query)){
                echo "<script>alert('Signup Successful')</script>";
                header("Location: final_landing_page.php");
                exit;
            } else {
                echo "<script>alert('Error inserting data')</script>";
            }
        } else {
            echo "<script>alert('Please accept the terms and conditions')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration & Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
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
    <div id="registration-form" class="login-form">
        <form method="post">
            <h2>Registration</h2>
            <div class="form-group">
                <label for="name" class="form-label">Username:</label>
                <input type="text" placeholder="Enter username" id="name" name="name" class="form-input">
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email:</label>
                <input type="email" placeholder="Enter email" id="email" name="email" class="form-input">
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password:</label>
                <input type="password" placeholder="Enter Password" id="password" name="password" class="form-input">
            </div>

            <div class="form-group">
                <label for="confirm-password" class="form-label">Confirm password:</label>
                <input type="password" placeholder="ReEnter Password" id="confirm-password" name="confirm-password" class="form-input">
            </div>

            <div class="form-group">
                <label for="date-of-birth" class="form-label">Date of Birth:</label>
                <input type="date" id="date-of-birth" name="date_of_birth" class="form-input">
            </div>

            <div class="form-group">
                <label for="gender" class="form-label">Gender:</label>
                <select id="gender" name="gender" class="form-input">
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div class="form-group">
                <label for="contact-number" class="form-label">Contact Number:</label>
                <input type="text" placeholder="Enter contact number" id="contact-number" name="contact_number" class="form-input">
            </div>

            <div class="form-group">
                <label for="address" class="form-label">Address:</label>
                <textarea id="address" name="address" class="form-input" rows="4" placeholder="Enter address"></textarea>
            </div>

            <div class="form-group">
                <input type="checkbox" id="terms-conditions" name="terms-conditions">
                <label for="terms-conditions">I accept all terms & conditions</label>
            </div>
            
            <button type="submit" name="submit" class="form-button">Register Now</button>

            <div class="already-have-an-account">
                Already have an account? <a href="login.php">Login now</a>
            </div>

        </form>
    </div>
</body>
</html>
