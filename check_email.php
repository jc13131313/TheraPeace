<?php
require './database/database.php';
include 'functions.php';
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['reset_link'])) {

    $email = $_POST['email'];

    // Check if email exists in the database
    $query = $pdo->prepare("SELECT email FROM users WHERE email = ?");
    $query->execute([$email]);
    $row = $query->rowCount();

    if ($row == 1) {
        // Existing user, proceed with the password reset

        // Generate a random code
        $code = generateRandomString();

        // Formulate the link
        $link = 'http://localhost/Therapeace/reset_password.php?email=' . urlencode($email) . '&code=' . urlencode($code);

        $link2 = '<span style="width:100%;"><a style="padding:10px 100px;border-radius:30px;background:#a8edbc;" href="' . $link . '"> Link </a></span>';

        // Check if there is an existing reset attempt
        $query_exist = $pdo->prepare("SELECT * FROM reset WHERE email = ?");
        $query_exist->execute([$email]);
        $from_reset = $query_exist->fetch();

        if (empty($from_reset)) {
            // Save code and INSERT email into the database
            $query_insert = $pdo->prepare("INSERT INTO reset(email, code) VALUES (?, ?)");
            $query_insert->execute([$email, $code]);
        } else {
            // Existing reset attempt, switch to UPDATE the reset table instead
            $query_insert = $pdo->prepare("UPDATE reset SET code = ? WHERE email = ?");
            $query_insert->execute([$code, $email]);
        }

        // Send email with the link using PHPMailer
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
        $mail->Subject = 'Reset password from TheraPeace';
        $mail->Body = '
            <p>Dear ' . $email . ',</p>
            <p>Please click on this link to reset your password:</p>
            <p>' . $link2 . '</p>
            Best wishes,
            <br>
            <span>TheraPeace</span>
        ';

        if ($mail->Send()) {
            // Notification
            $msg = "Please check your email (including spam) to see the password reset link.";
        } else {
            // Handle mail sending error
            $error = "Failed to send the email. Error: " . $mail->ErrorInfo;
        }
    } else {
        $error = "Email does not exist!";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/check_email-style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="icon" href="./pictures/logo-circle.png">
    <title>Reset Password</title>
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


<section>

   <div class="container" style="width: 500px;"> 
    
    <div class="content"> 

     <h2>Forget password?<br> Input your registration email!</h2> 
     <?php if (isset($msg)) echo '<div class="alert alert-success">' . $msg . '</div>'; ?>
     <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>

     <form action="check_email.php" method="post" class="form">
      <div class="inputBox"> 

      <input type="text" name="email" required> <i>Enter your email</i> 

      </div> 

      <div class="inputBox"> 

      <input type="submit" name="reset_link" value="Send Reset Link">

      </div> 

     </form>

    </div> 

   </div> 

  </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </body>
</html>