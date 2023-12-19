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
    <link rel="stylesheet" href="../../css/help-center.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>Help Center</title>
</head>
<body>
    <div class="whole-container">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
              <div class="logo-con">
                <img src="../../pictures/logo-circle.png" alt="" class="navbar-brand">
                <a aria-current="page" href="../../user/help-center/help-center.php" style="color: #004AAD; font-size: 20px; margin-bottom: 5px; text-decoration: none;">Help Center</a>
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
                    <a class="nav-link" href="../../user/help-center/terms-of-Service.php">Terms of Service</a>
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
            <img src="../../pictures/helpcenter1.png" alt="" class="help-center-pic">
            <div class="bottom-line"></div>

            <div class="search-box">
              <h1>What are you looking for?</h1>
              <form class="d-flex" role="search">
                <button class="search-btn" style="font-size: xx-large;"><i class="bi bi-search"></i></button>
              <input class="form-control me-1" type="search" placeholder="Search the help center..." aria-label="Search" id="searchBar">
              
            </form>
            <h5 style="color: #004AAD;">Search for something, or browse by topic below.</h5>
          </div>

          </Section>

          <Section id="second-section">
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div style="width: 100%; text-align: center; color: #004AAD; margin-top: 50px; margin-bottom: 30px;"><h1><b>Featured Articles</b></h1></div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    <h4>Facilities in San Fernando, Pampanga</h4>
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <h4>Facilities in San Fernando, Pampanga</h4>
                    <p>See more facilities near in San Fernando, Pampanga</p>
                    <button class="sf-btn">See Features</button>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    <h4>Meal Supply for Mental Health Training in San Fernando, Pampanga</h4>
                  </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <h4>Meal Supply for Mental Health Training in San Fernando, Pampanga</h4>
                    <p>See more facilities near in San Fernando, Pampanga</p>
                    <button class="sf-btn">See Features</button>
                  </div>
                </div>
              </div>
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingThree">
                  <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
                    <h4>The Best Counseling & Mental Health Near San Fernando, Pampanga</h4>
                  </button>
                </h2>
                <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <h4>The Best Counseling & Mental Health Near San Fernando, Pampanga</h4>
                    <p>See more facilities near in San Fernando, Pampanga</p>
                    <button class="sf-btn">See Features</button>
                  </div>
                </div>
              </div>
            </div>
          </Section>

          <Section id="last-section">
            <div class="snh-container">
              <h1 style="margin-right: 10px;">Still need help?</h1><i class="fa-solid fa-phone fa-2xl" style="color: black; font-size: 50px;"></i><button style="width: 200px;">Unavailable Rightnow</button>
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