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
  <title>GPS Tracker</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+WytkYkgpt3HXF5F5lF5s/FDBFvS2CygPzg" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.2/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
  <link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
  <link rel="stylesheet" href="../css/map-style.css" />
  <link rel="icon" href="../pictures/logo-circle.png">
</head>

<body>
  <div id="sidebar">
    <i class="bi bi-microsoft" onclick="toggleSecondSidebar()"></i>
    <i class="bi bi-geo-alt-fill" id="locate-button" onclick="locateOnMap()"></i>
  </div>
  <div id="navbar">
    <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft"
      aria-controls="offcanvasLeft" style="background: none; color: White; border:0;"><i
        class="fa-solid fa-bars fa-2xl"></i></button>
    <div id="navbar-icons">

      <a class="right-btn" href="../user/general/profile.php" style="color: black; font-size:30px;"><i
          class="bi bi-person-circle"></i></a>
    </div>
  </div>
  <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
    <div class="offcanvas-header">
      <img src="../pictures/logo-picture.png" alt="" style="height: 80px; margin-left: 50px;">
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <ul class="nav flex-column">
        <li class="nav-item">
          <a class="nav-link" href="../user/home.php" style="color: #333;">
            Home
          </a>
        </li>
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

  <div id="map"></div>
  <div id="secondSidebar">
    <div>Mental Health Resources</div>
    <div class="secondSidebarItem" onclick="handleClick(1)">
    <p>Tañedo Psychological Services</p>
    <p style="font-size: 10px; margin-top:-10px; margin-bottom:-6px;">Mental health service</p>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <p style="font-size: 10px;">San Fernando Interchange, San Fernando, 2000 Pampanga</p>
  </div>
    <div class="secondSidebarItem" onclick="handleClick(2)">
    <p>Argao Center for Psychological Services</p>
    <p style="font-size: 10px; margin-top:-10px; margin-bottom:-6px;">Mental health service</p>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <p style="font-size: 10px;">Argao Bldg, Queensborough Executive Village, San Fernando, Pampanga</p>
  </div>
    <div class="secondSidebarItem" onclick="handleClick(3)">
    <p>Hospital V.L. Makabali Memorial, Inc.</p>
    <p style="font-size: 10px; margin-top:-10px; margin-bottom:-6px;">Healthcare services</p>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <p style="font-size: 10px;">Room 128, V.L. Makabali Memorial Hospital, Main Building, B. Mendoza Street, B. Mendoza, San Fernando, 2000 Pampanga</p>
  </div>
    <div class="secondSidebarItem" onclick="handleClick(4)">
    <p>Joseph Gene G. Ponio Psychiatry Clinic</p>
    <p style="font-size: 10px; margin-top:-10px; margin-bottom:-6px;">Psychiatric clinic</p>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star"></span>
    <span class="fa fa-star"></span>
    <p style="font-size: 10px;">Capati Compound, MacArthur Hwy, San Fernando, 2000 Pampanga, Philippines</p>
  </div>
    <div class="secondSidebarItem" onclick="handleClick(5)">
    <p>AMT Psych Consult Clinic</p>
    <p style="font-size: 10px; margin-top:-10px; margin-bottom:-6px;">Mental health service</p>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <span class="fa fa-star checked"></span>
    <p style="font-size: 10px;"> 3rd floor ALECEL Building, MacArthur Hwy, Telabastagan, San Fernando, Pampanga</p>
  </div>
  </div>
  <div class="newSidebar" id="newSidebar1">
  <div class="title">
    <img src="../pictures/tanedopsych.png" alt="">
    <div class="details-container">
    <div class="details-item">
      <p>Tañedo Psychological Services</p>
      <p style="font-size: 10px; margin-top:-15px;">Mental health service</p>
    </div>
    <div class="details-item">

    <i class="bi bi-geo-alt-fill" style="font-size: 10px;">San Fernando Interchange, San Fernando, 2000 Pampanga</i>
    <i class="bi bi-clock-fill" style="font-size: 10px; margin-top:-20px;">9:00 AM – 7:00 PM (Saturday)</i>
    <i class="bi bi-telephone-fill" style="font-size: 10px; margin-top:-20px;">0961-042-9278</i>
    <i class="bi bi-envelope-fill" style="font-size: 10px; margin-top:-20px;">tañedopsychological@gmail.com</i>
    
    </div>
    <div class="details-item">
      <p>Website</p>
      <a href="https://www.cybo.com/PH-biz/ta%C3%B1edo-psychological-services?fbclid=IwAR1B3_RCSRtpRAiW4Np4vKXugW7umLqTg-W_mlWWEF4X61zcJASjr5MQIZk"><i class="bi bi-globe" style="font-size: 7px;">https://www.cybo.com/PH-biz/ta%C3%B1edo-psychological-services?fbclid=IwAR1B3_RCSRtpRAiW4Np4vKXugW7umLqTg-W_mlWWEF4X61zcJASjr5MQIZk</i></a>
    </div>
    <div class="details-item">
      <p>Services Offered</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">COUNSELING AND PSYCHOTHERAPY</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">PREMARITAL COUNSELING</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">MARITAL/RELATIONSHIP COUNSELING</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">PARENTAL COUNSELING</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">PSYCHOLOGICAL ASSESSMENT</p>
    </div>
    <div class="details-item">
      <p>Reviews</p>
      <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    </div>
    <div class="details-item">
      <p>About</p>
      <p style="font-size: 10px; margin-top:-15px;">Tañedo Psychological Services is a psychological clinic located in San Fernando, Pampanga, Philippines. The clinic offers a wide range of psychological services, including diagnosis and treatment of mental health conditions, psychotherapy, and psychological testing.</p>
    </div>
    </div>
      
      <button class="close-btn" onclick="closeSidebar(1)">&times;</button>
    </div>
  </div>

  <div class="newSidebar" id="newSidebar2">
  <div class="title">
    <img src="../pictures/argaops.jpg" alt="">
    <div class="details-container">
    <div class="details-item">
      <p>Argao Center for Psychological Services</p>
      <p style="font-size: 10px; margin-top:-15px;">Mental health center</p>
    </div>
    <div class="details-item">

    <i class="bi bi-geo-alt-fill" style="font-size: 10px;">Argao Bldg, Queensborough Executive Village, San Fernando, Pampanga</i>
    <i class="bi bi-clock-fill" style="font-size: 10px; margin-top:-20px;">10:00 AM to 6:00 PM (Monday - Saturday)</i>
    <i class="bi bi-telephone-fill" style="font-size: 10px; margin-top:-20px;">+63 917 621 1649 / +63 999 713 88 44</i>
    <i class="bi bi-envelope-fill" style="font-size: 10px; margin-top:-20px;">appointment@argaopsych.com / support@argaopsych.com</i>
    
    </div>
    <div class="details-item">
      <p>Website</p>
      <a href="https://argaopsych.com/"><i class="bi bi-globe" style="font-size: 7px;">https://argaopsych.com/</i></a>
    </div>
    <div class="details-item">
      <p>Services Offered</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">PSYCHOTHERAPY & PSYCHOLOGICAL COUNSELING</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">PSYCHOLOGICAL ASSESSMENT</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">COUPLES COUNSELING</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">WORKPLACE MENTAL HEALTH</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">TRAINING AND CONTINUING PROFESSIONAL DEVELOPMENT</p>
    </div>
    <div class="details-item">
      <p>Reviews</p>
      <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    </div>
    <div class="details-item">
      <p>About</p>
      <p style="font-size: 10px; margin-top:-15px;">Argao Psych is the largest private out-patient mental health center in Central Luzon Region. It is located in the heart of the City of San Fernando, Pampanga, operated and managed by Argao Health Inc. It was established in 2016 as the Argao Center for Psychological Services by its proprietor Dr. Renz Argao. In 2021, as part of the vision of making Argao Psych the leading mental health provider in the Mega Manila Region, the operations and management of the Center was taken over by the mental health corporation Argao Health Inc. The founders of Argao Health are mental health professionals, advocates, and individuals who share the same values.</p>
    </div>
    </div>
      <button class="close-btn" onclick="closeSidebar(2)">&times;</button>
    </div>
  </div>

  <div class="newSidebar" id="newSidebar3">
  <div class="title">
    <img src="../pictures/vlmakabali.gif" alt="">
    <div class="details-container">
    <div class="details-item">
      <p>Hospital V.L. Makabali Memorial, Inc.</p>
      <p style="font-size: 10px; margin-top:-15px;">Mental health center</p>
    </div>
    <div class="details-item">

    <i class="bi bi-geo-alt-fill" style="font-size: 10px;">Room 128, V.L. Makabali Memorial Hospital, Main Building, B. Mendoza Street, B. Mendoza, San Fernando, 2000 Pampanga</i>
    <i class="bi bi-clock-fill" style="font-size: 10px; margin-top:-20px;">8:00 AM - 5:00 PM (Monday - Saturday)</i>
    <i class="bi bi-telephone-fill" style="font-size: 10px; margin-top:-20px;">(045) 961 2442</i>
    <i class="bi bi-envelope-fill" style="font-size: 10px; margin-top:-20px;">makabali_hospital@yahoo.com</i>
    
    </div>
    <div class="details-item">
      <p>Website</p>
      <a href="https://vlmakabalihospital.com.ph/"><i class="bi bi-globe" style="font-size: 7px;">https://vlmakabalihospital.com.ph/</i></a>
    </div>
    <div class="details-item">
      <p>Services Offered</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">FAMILY MEDICINE</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">NURSING SERVICES</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">ANESTHESIA</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">PEDIATRICS</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">RADIOLOGY</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">SURGERY</p>
    </div>
    <div class="details-item">
      <p>Reviews</p>
      <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    </div>
    <div class="details-item">
      <p>About</p>
      <p style="font-size: 10px; margin-top:-15px;">The V.L. was established on August 11, 1957, by its late founder. The organization at the time was known as V.L. a six-bed maternity clinic called Makabali Clinic. A few months later, the clinic had 10 beds, an X-ray room, a lab, a delivery room, ten nursery bassinets, and an operation room. Later, all of the surviving brothers and sisters served as incorporators to turn the clinic into a family corporation. The V.L. appeared at that time. V.L. Clinic replaced Makabali Clinic. Hospital Makabali Memorial, Inc.</p>
    </div>
    </div>
      <button class="close-btn" onclick="closeSidebar(3)">&times;</button>
    </div>
  </div>

  <div class="newSidebar" id="newSidebar4">
  <div class="title">
    <img src="../pictures/ponios.png" alt="">
    <div class="details-container">
    <div class="details-item">
      <p>Joseph Gene G. Ponio Psychiatry Clinic</p>
      <p style="font-size: 10px; margin-top:-15px;">Psychiatric clinic</p>
    </div>
    <div class="details-item">

    <i class="bi bi-geo-alt-fill" style="font-size: 10px;">Capati Compound, MacArthur Hwy, San Fernando, 2000 Pampanga, Philippines</i>
    <i class="bi bi-clock-fill" style="font-size: 10px; margin-top:-20px;">13:00 - 16:00 (Tuesday & Thursday)</i>
    <i class="bi bi-telephone-fill" style="font-size: 10px; margin-top:-20px;">0919-691-2904</i>
    <i class="bi bi-envelope-fill" style="font-size: 10px; margin-top:-20px;">josephgeneponio@gmail.com</i>
    
    </div>
    <div class="details-item">
      <p>Website</p>
      <a href="https://www.cybo.com/PH-biz/joseph-gene-g-ponio-psychiatry-clinic?fbclid=IwAR3kXzfofJAPm_UeF3mZKJcxN4gxRN1VgBzuROPQKJMtZIYu4gsFe2xd0l4"><i class="bi bi-globe" style="font-size: 7px;">https://www.cybo.com/PH-biz/joseph-gene-g-ponio-psychiatry-clinic?fbclid=IwAR3kXzfofJAPm_UeF3mZKJcxN4gxRN1VgBzuROPQKJMtZIYu4gsFe2xd0l4</i></a>
    </div>
    <div class="details-item">
      <p>Services Offered</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">VARIAN UNIQUE POWER LINEAR ACCELERATOR</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">SIEMENS ONCOR LINEAR ACCELERATOR</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">3D ROBOTIC ARM LAPAROSCOPY MACHINE</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">CRYO 6 THERAPEUTIC MACHINE</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">EPILEPSY MONITORING UNIT</p>
    </div>
    <div class="details-item">
      <p>Reviews</p>
      <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    </div>
    <div class="details-item">
      <p>About</p>
      <p style="font-size: 10px; margin-top:-15px;">Joseph Gene G. Ponio Psychiatry Clinic is a psychiatric clinic located in San Fernando, Pampanga, Philippines. The clinic offers a wide range of psychiatric services, including diagnosis and treatment of mental health conditions, medication management, and psychotherapy. The clinic also offers assisted living activities for people with mental health conditions.</p>
    </div>
    </div>
      <button class="close-btn" onclick="closeSidebar(4)">&times;</button>
    </div>
  </div>

  <div class="newSidebar" id="newSidebar5">
    <div class="title">
    <img src="../pictures/AMT.jpg" alt="">
    <div class="details-container">
    <div class="details-item">
      <p>AMT Psych Consult Clinic</p>
      <p style="font-size: 10px; margin-top:-15px;">Mental health service</p>
    </div>
    <div class="details-item">

    <i class="bi bi-geo-alt-fill" style="font-size: 10px;">3rd floor ALECEL Building, MacArthur Hwy, Telabastagan, San Fernando, Pampanga</i>
    <i class="bi bi-clock-fill" style="font-size: 10px; margin-top:-20px;">9:00 AM to 5:00 PM (Monday - Saturday)</i>
    <i class="bi bi-telephone-fill" style="font-size: 10px; margin-top:-20px;">0919-691-2904</i>
    <i class="bi bi-envelope-fill" style="font-size: 10px; margin-top:-20px;">josephgeneponio@gmail.com</i>
    
    </div>
    <div class="details-item">
      <p>Website</p>
      <a href="https://www.cybo.com/PH-biz/joseph-gene-g-ponio-psychiatry-clinic?fbclid=IwAR3kXzfofJAPm_UeF3mZKJcxN4gxRN1VgBzuROPQKJMtZIYu4gsFe2xd0l4"><i class="bi bi-globe" style="font-size: 7px;">https://www.cybo.com/PH-biz/joseph-gene-g-ponio-psychiatry-clinic?fbclid=IwAR3kXzfofJAPm_UeF3mZKJcxN4gxRN1VgBzuROPQKJMtZIYu4gsFe2xd0l4</i></a>
    </div>
    <div class="details-item">
      <p>Services Offered</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">VARIAN UNIQUE POWER LINEAR ACCELERATOR</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">SIEMENS ONCOR LINEAR ACCELERATOR</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">3D ROBOTIC ARM LAPAROSCOPY MACHINE</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">CRYO 6 THERAPEUTIC MACHINE</p>
      <p style="font-size: 10px; margin-top:-15px; border-bottom: solid 2px #BDB0B0;">EPILEPSY MONITORING UNIT</p>
    </div>
    <div class="details-item">
      <p>Reviews</p>
      <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    <span class="fa fa-star fa-lg checked"></span>
    </div>
    <div class="details-item">
      <p>About</p>
      <p style="font-size: 10px; margin-top:-15px;">A mental health service provider that offers assessment, intervention, and education to individuals, companies, and communities. It aims to be a leading advocate of mental health in the Philippines and one of the top providers of competent psychological services.</p>
    </div>
    </div>
      <button class="close-btn" onclick="closeSidebar(5)">&times;</button>
    </div>
  </div>
  <script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
  <script src="https://unpkg.com/leaflet-routing-machine/dist/leaflet-routing-machine.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-eL3ARvNvRi2ZZHnH5h0kvoqgTENBdk9oECDWmYD/5NceEV4S9g5Rsbk9tHwxd3Kx"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL"
    crossorigin="anonymous"></script>
  <script src="../js/jquery-3.1.1.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.0.1/socket.io.js"></script>
  <script src="../js/map.js"></script>
  <!-- Add this script to your HTML file -->
  <script>
    let targetLocation = null;
let userLocationMarker = null;
let userMovementInterval = null;
let isLocateButtonClicked = false;

function toggleSecondSidebar() {
  const secondSidebar = document.getElementById('secondSidebar');
  const newSidebars = document.querySelectorAll('.newSidebar');

  if (secondSidebar.style.display === 'none' || secondSidebar.style.display === '') {
    secondSidebar.style.display = 'flex';
    newSidebars.forEach(sidebar => sidebar.style.display = 'none');
  } else {
    secondSidebar.style.display = 'none';
  }
}

function openNewSidebar(index) {
  const newSidebar = document.getElementById(`newSidebar${index}`);
  newSidebar.style.display = 'flex';
}

function closeSidebar(index) {
  const newSidebar = document.getElementById(`newSidebar${index}`);
  newSidebar.style.display = 'none';
  location.reload();
  isLocateButtonClicked = false; // Reset the click flag when closing the sidebar
}

function handleClick(index) {
  toggleSecondSidebar();
  openNewSidebar(index);

  switch (index) {
        case 1:
          targetLocation = [15.044221246741227, 120.68565916665791];
          break;
        case 2:
          targetLocation = [15.043760924859884, 120.70501901052658];
          break;
          case 3:
          targetLocation = [15.031925338321273, 120.68893465633974];
          break;
          case 4:
          targetLocation = [15.038470721425536, 120.68184111327609];
          break;
          case 5:
          targetLocation = [15.120622862952745, 120.6009652378151];
          break;
      }
}

function locateOnMap() {
  if (!isLocateButtonClicked && targetLocation) {
    updateMarker(targetLocation);
    showRoadToTarget(targetLocation);
    isLocateButtonClicked = true;
  }
}

function updateMarker(location) {
  if (!userLocationMarker) {
    userLocationMarker = L.marker(location).addTo(map).bindPopup('Target Location.').openPopup();
  } else {
    userLocationMarker.setLatLng(location);
  }

  map.setView(location);
}

function showRoadToTarget(endLocation) {
  // Use Leaflet Routing Machine to show the road
  const control = L.Routing.control({
    waypoints: [
      L.latLng(map.getCenter()), // Current location
      L.latLng(endLocation)
    ],
    routeWhileDragging: true,
    show: false, // Set this option to hide turn-by-turn instructions
    lineOptions: {
      styles: [{ color: '#549D64', opacity: 1, weight: 5 }]
    },
    formatter: new L.Routing.Formatter({
      // Customize the instruction text
      instructionFormatter: function (instruction, i, n, locale) {
        // Display the instruction text in the console (you can modify this to update your UI)
        console.log(instruction.text);

        // You can update your UI here with the instruction.text
        const directionsContainer = document.getElementById('directions-container');
        directionsContainer.innerHTML += instruction.text + '<br>';

        return '<span class="number">' + (i + 1) + '</span>' +
          '<span class="instruction-text">' + instruction.text + '</span>';
      }
    })
  });

  control.addTo(map);
}

function simulateUserMovement() {
  userMovementInterval = setInterval(() => {
    const currentLocation = userLocationMarker.getLatLng();
    const distanceToTarget = currentLocation.distanceTo(L.latLng(targetLocation));

    if (distanceToTarget > 10) {
      const bearing = currentLocation.bearingTo(L.latLng(targetLocation));
      const newLocation = currentLocation.destinationPoint(0.1, bearing);

      updateMarker(newLocation);
    } else {
      clearInterval(userMovementInterval);
    }
  }, 1000);
}

  </script>

</body>

</html>
