<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header('location: ../../index.php');
    exit();
}

// Retrieve user information or perform other tasks for the home page

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/Privacy-Policy.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Help Center</title>
</head>
<body>
    <div class="whole-container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
              <div class="logo-con">
                <img src="../../pictures/logo-circle.png" alt="" class="navbar-brand">
                <a aria-current="page" href="../../user/help-center/Help-Center.php" style="color: #004AAD; font-size: 20px; margin-bottom: 5px; text-decoration: none;">Help Center</a>
              </div>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarTogglerDemo01" style="margin-left: 20%;">
                <ul class="navbar-nav me-auto mb-5 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link" style="color: #004AAD;">Explore</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../../user/help-center/Help-Center.php">Help</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../../user/help-center/Privacy-Policy.php">Privacy Policy</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="../../user/help-center/terms-of-service.php">Terms of Service</a>
                  </li>
                </ul>
              
              </div>
              <div class="navbar-nav">
              <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
                    <a href="#" style="color: #004AAD; font-size: 22px;" onclick="focusOnSearchBar()"><i class="bi bi-search"></i></a>

              </div>
              <a class="nav-link" href="../../user/home.php" style="color: #004AAD; font-size: 20px;">Home</a>
            </div>
          </nav>


          <Section id="first-section">
            <div class="privacy-logo"><h1><b>Privacy Policy</b></h1></div> 
            <div class="container px-5 text-center">
                <div class="row gx-5" style="top: 10%;">
                  <div class="col-sm-11 col-md-11 col-lg-8">
                    <div class="privacy-policy-container">
                      <p><i>Effective December 15, 2023</i></p>
                      <p><i>Our Privacy Policy </i></p><br>
                        <h2><b>Privacy Policy</b></h2>
                        <p>TheraPeace is committed to protecting your privacy. We collect the following information from our users:</p><br>
                        <p><i>Name</i></p><br>
                        <p><i>Email address</i></p><br>
                        <p><i>Location</i></p><br>
                        <p><i>IP Address</i></p><br>
                        <p><i>Search History</i></p><br>
                        <p><i>Reviews and Feedback</i></p><br>
                        <p>We use this information to provide you with the best possible experience and to improve our service. We will never share your information with third parties without your permission.</p><br>
                        <p>You have the right to access and update your personal information at any time. You also have the right to request that we delete your personal information.</p>
                      </div>
                    </div>
                  <div class="col-sm-12 col-md-12 col-lg-2">
                    <div class="advert"></div>
                  </div>
              </div>

          </Section>



          <div class="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-1 my-3">
              <div class="col mb-3">
        
                  <img src="../../pictures/logo-picture.png" alt="" style="height: 100px;">
        
               </a>
                <p class="text-body-secondary">therapeace@gmail.com</p>
                <p class="text-body-secondary">Phone: +631010101010</p>
                <p class="text-body-secondary">&copy; TheraPeace | 2023</p>
                <p class="text-body-secondary">version 1.0</p>
              </div>
        
              <div class="col mb-3">
                <h5><b>MENU</b></h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="../../user/home.php" class="nav-link p-0 text-body-secondary">HOME</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">COMMUNITY</a></li>
                  <li class="nav-item mb-2"><a href="../../user/About-Us.php" class="nav-link p-0 text-body-secondary">ABOUT</a></li>
                </ul>
              </div>
        
              <div class="col mb-3">
                <h5><b>OTHERS</b>
                </h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="../../user/help-center/FAQs.php" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                  <li class="nav-item mb-2"><a href="../../user/help-center/Privacy-Policy.php" class="nav-link p-0 text-body-secondary">PRIVACY POLICY</a></li>
                  <li class="nav-item mb-2"><a href="../../user/help-center/Terms-of-Service.php" class="nav-link p-0 text-body-secondary">TERM OF SERVICE</a></li>
                </ul>
              </div>
        
              <div class="col mb-3">
                <h5><b>CONNECT WITH US:</b></h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="https://www.facebook.com/profile.php?id=61552715082495" style="color: black;"><i class="fa-brands fa-facebook fa-xl"></i></a>Facebook</li>
                  <li class="nav-item mb-2"><a href="https://twitter.com/therapeace777" style="color: black;"><i class="fa-brands fa-twitter fa-xl"></i></a>Twitter</li>
                  <li class="nav-item mb-2"><a href="https://instagram.com/therapeace777?igshid=MzMyNGUyNmU2YQ==" style="color: black;"><i class="fa-brands fa-square-instagram fa-xl"></i></a>Instagram</li>
                </ul>
              </div>
              <div class="container-copright"><p>Copyright © 2023 | All Rights Reserved</p></div>
            </footer>
        </div>
    </div>

    <script src="../../js/nav-active.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script>

    function focusOnSearchBar() {
      var searchBar = document.getElementById("searchBar");
      searchBar.focus();
    }
      
      
    </script>
</body>
</html>