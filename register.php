<?php
require './database/database.php';
require 'functions.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirmPassword) {
        $error = "Passwords do not match.";
    } else {
        // Check if the email already exists in the database
        $existingUser = getUserByEmail($email); // Assuming you have a function to fetch user by email

        if ($existingUser) {
            $error = "Email already exists. Please use a different email.";
        } else {
            // Hash the password for storage
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            // Generate a random 6-digit OTP
            $otp = mt_rand(100000, 999999);

            // Insert user data into the database
            $query = $pdo->prepare("INSERT INTO users (username, firstname, lastname, email, password, otp) VALUES (?, ?, ?, ?, ?, ?)");
            $query->execute([$username, $firstname, $lastname, $email, $hashedPassword, $otp]);

            // Send email with OTP using PHPMailer
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "therapeace8@gmail.com"; // Replace with your Gmail email address
            $mail->Password   = "apoh rysh svcx vdpt"; // Replace with your Gmail password

            $mail->IsHTML(true);
            $mail->AddAddress($email);
            $mail->SetFrom("therapeace8@gmail.com", "TheraPeace");
            $mail->Subject = 'Email Verification';
            $mail->Body = '
                <p>Dear ' . $name . ',</p>
                <p>Your One-Time Password (OTP) is: ' . $otp . '</p>
                Best wishes,
                <br>
                <span>TheraPeace</span>
            ';

            if ($mail->Send()) {
                // Redirect to a page for OTP verification
                header("Location: otp_verification.php?email=" . urlencode($email));
                exit();
            } else {
                $error = "Failed to send the email. Error: " . $mail->ErrorInfo;
            }
        }
    }
}

// Assuming you have a function to fetch user by email
function getUserByEmail($email) {
    global $pdo;
    $query = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $query->execute([$email]);
    return $query->fetch(PDO::FETCH_ASSOC);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/register.css">
    <link rel="icon" href="../pictures/logo-circle.png">
    <title>Register</title>
</head>
<body>
<nav class="navbar navbar-expand-lg" style="width: 100%;">
        <div class="container-fluid">
            <img src="pictures/logo-picture.png" alt="" class="navbar-brand">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-5 mb-lg-0 offset-4">
              <li class="nav-item">
                <a class="nav-link" href="./landingpage.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link">Community</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./about-us.php">About Us</a>
              </li>
            </ul>
          
          </div>
          <div class="navbar-nav">
              <a class="nav-link" href="./index.php" style="font-size: 25px; cursor: pointer;">Login</a>
        </div>
      </nav>

<section class="h-100 gradient-form" style="background-color: #A1E9A6;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-xl-10">
        <div class="card rounded-3">
          <div class="row g-0">
            <div class="col-lg-7">
              <div class="card-body p-md-5 mx-md-8">

              <img src="pictures/logo-picture.png" alt="" class="form-logo">

                <form action="register.php" method="POST"">
                <h1 style="margin-bottom: 30px;">Create Account</h1>
                <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
                <div class="col-12">
                  <input type="text" class="form-control" style="background-color: white; border: solid 2px gray;" id="inputusername" name="username" placeholder="Username">
                </div>
                <div class="row">
                  <div class="col-sm-12 col-md-6">
                    <input type="text" class="form-control" style="background-color: white; border: solid 2px gray;" id="firstname" name="firstname" placeholder="First Name">
                  </div>
                  <div class="col-sm-12 col-md-6">
                    <input type="text" class="form-control" style="background-color: white; border: solid 2px gray;" id="lastname" name="lastname" placeholder="Last Name">
                  </div>
              </div>
                <div class="col-12">
                  <input type="email" class="form-control" style="background-color: white; border: solid 2px gray;" id="inputAddress" name="email" placeholder="Email">
                </div>
                  <div class="col-12">
                    <input type="password" class="form-control" style="background-color: white; border: solid 2px gray;" id="password" name="password" placeholder="Password">
                  </div>
                  <div class="col-12">
                    <input type="password" class="form-control" style="background-color: white; border: solid 2px gray;" id="confirmpassword" name="confirm_password" placeholder="Confirm Password">
                  </div>

                <input type="submit" value="Sign Up" style="margin-top: 15px;" class="btn" name="create_account">
                <p style="width: 100%;">Already have an Account?<a href="./index.php" style="text-decoration: none; color: green; font-weight: bold;">Log In</a></p>
              </form>

              </div>
            </div>
            <div class="col-lg-5 right-page">
            <h1>HELLO, FRIEND!</h1>
                  <p>YOUR WELL BEING MATTERS</p>
                  <img src="pictures/other-logo.png" alt="" class="other-lo">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>