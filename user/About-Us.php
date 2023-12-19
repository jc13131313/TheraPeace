<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header('location: ../index.php');
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
    <link rel="stylesheet" href="../css/about-us.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="icon" href="../pictures/logo-circle.png">
    <title>About Us</title>

    <style>
      .right-btn{
    font-size: 35px;
    margin-left: 15px;
    color: gray;
    cursor: pointer;
}
    </style>
</head>
<body>
    <div class="whole-container">
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <img src="../pictures/logo-picture.png" alt="" class="navbar-brand">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo01" aria-controls="navbarTogglerDemo01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
            <ul class="navbar-nav me-auto mb-5 mb-lg-0 offset-4">
              <li class="nav-item">
                <a class="nav-link" href="../user/home.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/forum.php">Community</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="../user/about-us.php">About Us</a>
              </li>
            </ul>
          
          </div>
          <div class="navbar-nav">
          <div class="collapse navbar-collapse" id="navbarTogglerDemo01">
              <a class="right-btn" href="../user/general/profile.php"><i class="bi bi-person-circle"></i></a>
          </div>
              <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background: none; color: gray; border:0;"><i class="fa-solid fa-bars fa-2xl"></i></button>


            <div class="pos-f-t">
              <div class="collapse" id="navbarToggleExternalContent">
                <div class="bg-dark p-4">
                  <h4 class="text-white">Collapsed content</h4>
                  <span class="text-muted">Toggleable via the navbar brand.</span>
                </div>
              </div>
            </div>
        </div>
      </nav>

      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <img src="../pictures/logo-picture.png" alt="" style="height: 80px; margin-left: 50px;">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
        <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="../user/general/profile.php" style="color: #333;">
                            General
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/help-center/Help-Center.php" style="color: #333;">
                            Help
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/help-center/Privacy-Policy.php" style="color: #333;">
                        See Privacy Policy<i class="bi bi-arrow-up-right-square"></i>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/help-center/Terms-of-Service.php" style="color: #333;">
                        See Terms of Service<i class="bi bi-arrow-up-right-square"></i>
                        </a>
                    </li>
                </ul>

                <ul class="nav flex-column" style="position: absolute; bottom:0;">
                <li class="nav-item">
                        <a class="nav-link" href="../logout.php" style="color: #333;">
                            Log Out
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../user/general/profile.php" style="color: red; border-top:solid 3px #E6E5E5; width: 100%;">
                            Delete Account
                        </a>
                    </li>
                </ul>
  </div>
</div>

          <section id="first-section">

            <div class="container px-4 text-center" style="margin-top: 100px;">
                <div class="row gx-5" style="top: 10%;">
                  <div class="col-sm-11 col-md-11 col-lg-7 offset-1">
                    <div class="aboutthera">
                        <h2>About TheraPeace</h2>
                        <p>TheraPeace is a mental health help finder website that helps people find mental health resources and support groups in their area. With a robust set of features, TheraPeace goes beyond the conventional, offering a comprehensive platform for mental well-being.
                        </p>
                        <p>Our Community Forum serves as a digital sanctuary, fostering a supportive environment where individuals can share experiences, seek advice, and find solace in the understanding community. Here, users can connect with others facing similar challenges, creating a network of mutual support and empathy.</p>
                        <p>TheraPeace meticulously curates a wealth of mental health resources, meticulously listing local facilities, counseling centers, and therapists in San Fernando, Pampanga. Detailed information about these professionals and facilities is readily available, allowing users to make informed decisions about their mental health care.</p>
                        <p>The integrated GPS tracker elevates the user experience, providing real-time location services to identify mental health resources nearby. Whether you need immediate assistance or prefer a facility within your vicinity, our GPS technology guides you to the closest support options, ensuring timely access to the help you need.</p>
                        <p>TheraPeace isn't just a website; it's a lifeline, connecting individuals with the resources and communities vital for mental health support. By combining cutting-edge technology, community engagement, and detailed information, TheraPeace stands as a beacon of hope, empowering individuals on their journey to mental well-being in San Fernando, Pampanga.</p>
                        </div>
                  </div>
                  <div class="col-sm-12 col-md-12 col-lg-3 offset-1">
                    <div class="advert"></div>
                  </div>
                </div>
              </div>
    
          </section>

          <section id="second-section">

            <div class="container text-center">
                <div class="row gx-5">
                  <div class="col-sm-5 offset-md-1">
                    <div class="mission-circle">
                        <img src="../pictures/mission-pic.JPG" alt="">
                        <h1>MISSION</h1>
                        <p>TheraPeace is committed to making mental health support more accessible and affordable for everyone. We believe that everyone deserves to have access to the resources they need to live a happy and fulfilling life.</p>
                    </div>
                  </div>
                  <div class="col-sm-5">
                    <div class="vision-circle">
                        <img src="../pictures/vision-pic.JPG" alt="">
                        <h1>VISION</h1>
                        <p>We envision a future where everyone has access to the mental health support they need, when they need it. We believe that mental health should be treated with the same respect and urgency as physical health, and that everyone should have the opportunity to live a mentally healthy life.</p>
                    </div>
                  </div>
                </div>
              </div>

    
    

          </section>

          <div class="container">
            <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-1 my-3">
              <div class="col mb-3">
        
                  <img src="../pictures/logo-picture.png" alt="" style="height: 100px;">
        
               </a>
                <p class="text-body-secondary">therapeace@gmail.com</p>
                <p class="text-body-secondary">Phone: +631010101010</p>
                <p class="text-body-secondary">&copy; TheraPeace | 2023</p>
                <p class="text-body-secondary">version 1.0</p>
              </div>
        
              <div class="col mb-3">
                <h5><b>MENU</b></h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="../user/home.php" class="nav-link p-0 text-body-secondary">HOME</a></li>
                  <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">COMMUNITY</a></li>
                  <li class="nav-item mb-2"><a href="../user/About-Us.php" class="nav-link p-0 text-body-secondary">ABOUT</a></li>
                </ul>
              </div>
        
              <div class="col mb-3">
                <h5><b>OTHERS</b>
                </h5>
                <ul class="nav flex-column">
                  <li class="nav-item mb-2"><a href="../user/help-center/FAQs.php" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                  <li class="nav-item mb-2"><a href="../user/help-center/Privacy-Policy.php" class="nav-link p-0 text-body-secondary">PRIVACY POLICY</a></li>
                  <li class="nav-item mb-2"><a href="../user/help-center/Terms-of-Service.php" class="nav-link p-0 text-body-secondary">TERM OF SERVICE</a></li>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

<script src="../js/nav-active.js"></script>
</body>
</html>