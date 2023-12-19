<?php
session_start();
require './database/database.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Validate inputs
    if (empty($email) || empty($password)) {
        $error = "Email and password are required!";
    } else {
        // Retrieve info from the database
        $query = $pdo->prepare('SELECT * FROM users WHERE email = ?');
        $query->execute([$email]);
        $user = $query->fetch();

        // Compare email and password
        if ($user && password_verify($password, $user['password'])) {
            if ($user['email_verified'] == 1) {
                // Check if the user is an admin (you might add this field to your table)
                if ($user['role'] == 'admin') {
                    $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];

                    // Redirect to admin dashboard
                    header('location: ./admin/dashboard.php');
                    exit(); // Stop further execution
                } else {
                  $_SESSION['user_id'] = $user['id'];
                    $_SESSION['username'] = $user['username'];
                    // Regular user, redirect to user dashboard or home.php
                    header('location: ./user/home.php');
                    exit(); // Stop further execution
                }
            } else {
                // User is not verified, redirect to otp_verification.php
                header('location: otp_verification.php?email=' . urlencode($email));
                exit();
            }
        } else {
            $error = "Incorrect email or password!";
        }
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/index.css">
    <link rel="icon" href="./pictures/logo-circle.png">
    <title>Login</title>
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
  

   <div class="container"> 

    <div class="content"> 

     <h2>LOG IN</h2>
     <p style="margin-top: -40px;">Doesn’t have an account yet?</p>
     <a href="register.php" style="margin-top: -50px; text-decoration: none; color: green; font-weight: bold;">Signup</a> 
     <?php if (isset($msg)) echo '<div class="alert alert-danger">' . $msg . '</div>'; ?>
     <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>

     <form action="index.php" method="post" class="form">

      <div class="inputBox"> 

      <input type="text" name="email" required> <i>Email</i> 

      </div> 

      <div class="inputBox"> 

      <input type="password" name="password" required> <i>Password</i> 

      </div> 

      <div class="links"> <a href="check_email.php" style="text-decoration: none; color: green; font-weight: bold;">Forgot Password</a>

      </div> 

      <div class="inputBox"> 

      <input type="submit" name="submit" value="Log In"> 

      </div> 

     </form>

    </div> 

   </div> 

  </section> <!-- partial --> 


    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="./js/nav-active.js"></script>
  </body>
</html>