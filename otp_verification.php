<?php
require './database/database.php';
require 'functions.php';

try {
    $pdo->beginTransaction();

    if ($_SERVER['REQUEST_METHOD'] == 'GET' && isset($_GET['email'])) {
        $email = $_GET['email'];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $enteredOTP = $_POST['otp'];
        $email = $_POST['email'];

        // Check if entered OTP is valid
        $query = $pdo->prepare("SELECT * FROM users WHERE email = ? AND otp = ?");
        $query->execute([$email, $enteredOTP]);
        $user = $query->fetch();

        if ($user) {
            // Update user status (e.g., set email_verified to true)
            $updateQuery = $pdo->prepare("UPDATE users SET email_verified = 1 WHERE email = ?");
            $updateQuery->execute([$email]);

            // Commit the transaction
            $pdo->commit();

            // Redirect to a success page or login page
            $msg = 'Verified Successfully! <a class="btn btn-success" href="index.php"> >>Log In</a>';
        } else {
            $error = "Invalid OTP. Please try again.";
        }
    }
} catch (PDOException $e) {
    // Rollback the transaction in case of an error
    $pdo->rollBack();
    echo "Error: " . $e->getMessage();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/otp_verification-style.css">
    <link rel="icon" href="../pictures/logo-circle.png">
    <title>OTP Verification</title>
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

     <h2>OTP Verification</h2> 
     <?php if (isset($error)) echo '<div class="alert alert-danger">' . $error . '</div>'; ?>
     <?php if(isset($msg)){echo '<p class="alert-success rounded p-3">'.$msg.'</p>';}?>

     <form action="otp_verification.php" method="post" class="form">
     <input type="hidden" name="email" value="<?= $email ?>">
      <div class="inputBox"> 

      <input type="text" minlength="6" maxlength="6" oninput="javascript: if (this.value.length>this.maxlength) this.value = this.value.slice(0, this.maxlength)" name="otp" required> <i>Enter OTP</i> 

      </div> 

      <div class="inputBox"> 

      <input type="submit" value="Verify OTP"> 

      </div> 

     </form>

    </div> 

   </div>
   </section>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
