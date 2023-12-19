
<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/landingpage.css">
    <link rel="stylesheet" href="./css/navbar.css">
    <link rel="stylesheet" href="./css/modal.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="./css/jquery.hislide.css" rel="stylesheet">
    <link rel="icon" href="../pictures/logo-circle.png">
    <title>TheraPeace</title>
</head>
<body>
    <div class="whole-container">
      <nav class="navbar navbar-expand-lg">
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
                <a class="nav-link" href="./index.php">Community</a>
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


        <section id="first-section">
            <div class="container">
                <div class="tria-design"></div>
                    <div class="row align-items-center">
                      <div class="col-lg-6">
                        <div class="title-container">
                            <h2><b>TheraPeace</b> : Help finder In San Fernando Pampanga with GPS Technology</h2>
                            <p>Discover solace and support, where understanding meets assistance. Our platform is a beacon for those seeking mental health help, offering personalized guidance to match your unique needs...</p>

                        </div>  
                      </div>
                      <div class="col-lg-6">
                      <div class="picture-container">
                          <div id="slide">
                              <div class="item" style="background-image: url(./pictures/vlmakabali.gif);">
                                  <div class="content">
                                      <div class="name">V.L. Makabali</div>
                                  </div>
                              </div>
                              <div class="item" style="background-image: url(./pictures/ponios.png);">
                                  <div class="content">
                                      <div class="name">Joseph Gene G. Ponio Psychiatry Clinic</div>
                                  </div>
                              </div>
                              <div class="item" style="background-image: url(./pictures/AMT.jpg);">
                                  <div class="content">
                                      <div class="name">AMT PSYCH CONSULT LEASING, TRADING & SERVICES</div>
                                  </div>
                              </div>
            
                              <div class="item" style="background-image: url(./pictures/tanedopsych.png);">
                                <div class="content">
                                    <div class="name">Tañedo Psychological Services</div>
                                </div>
                            </div>
                            <div class="item" style="background-image: url(./pictures/argaops.jpg);">
                              <div class="content">
                                  <div class="name">Argao Psych</div>
                              </div>
                          </div>  
                          </div>
                          <div class="buttons">
                              <button id="prev"><i class="bi bi-chevron-left"></i></button>
                              <button id="next"><i class="bi bi-chevron-right"></i></button>
                          </div>
                      </div>
                      </div>
                  </div>
            </div>
            <div class="bottom-design"></div>
        </section>

        <section id="second-section">
          <div class="circles">
            <div class="circle1"></div>
            <div class="circle2"></div>
        </div>
        <div class="triangles">
            <img src="pictures/sr-pic.png" alt="">
            <div class="triangle1"></div>
            <div class="triangle2"></div>
        </div>

          <div class="container text-center">
            <div class="row">
              <div class="col align-self-start">
                <div class="sectitle-container">
                  <h2>Find Mental Health Support Near You with GPS Technology</h2>
                  <a class="loc-btn" href="./index.php"><i class="fa-solid fa-location-dot fa-2xl"></i></a>
                  <p>❝At our service, we prioritize
                      your ease and accessibility. 
                     You can discover personalized mental health support right where you are.❞</p>
              </div>
              </div>
              <div class="col align-self-end">
                <div class="explore-container">
                  <a class="explore-btn" href="./index.php">Explore</a>
                  <img src="./pictures/welcomepage-picture.jpg" alt="">
              </div>
              
              </div>
            </div>
          </div>
          <svg class="waves1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
              <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
              <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
              <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
              <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
              <use xlink:href="#gentle-wave" x="48" y="7" fill="#f8f8f8" />
            </g>
          </svg>
        </section>

        <section id="third-section">
          <div class="container text-center">
            <div class="row align-items-center">
              <div class="col align-self-start">
              <div class="image-rotator hi-slide">
              <div class="hi-prev"><i class="fa-solid fa-angles-left fa-l"></i></div>
              <div class="hi-next"><i class="fa-solid fa-angles-right fa-l"></i></div>
              <ul>
                <li><img src="./pictures/AMT.jpg"></li>
                <li><img src="./pictures/argaops.jpg"></li>
                <li><img src="./pictures/tanedopsych.png"></li>
                <li><img src="./pictures/ponios.png"></li>
                <li><img src="./pictures/vlmakabali.gif"></li>
              </ul>
            </div>
          </div>
          <div class="col align-self-end">
              <div class="third-text"><p>❝Explore comprehensive facilities and resources tailored to support your mental well-being in 
              San Fernando, Pampanga.❞</p></div>
            </div>
          </div>
        </div>
          
        </section>

        <section id="fourth-section">
          <svg class="waves2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 24 150 28" preserveAspectRatio="none" shape-rendering="auto">
            <defs>
              <path id="gentle-wave" d="M-160 44c30 0 58-18 88-18s 58 18 88 18 58-18 88-18 58 18 88 18 v44h-352z" />
            </defs>
            <g class="parallax">
              <use xlink:href="#gentle-wave" x="48" y="0" fill="rgba(255,255,255,0.7" />
              <use xlink:href="#gentle-wave" x="48" y="3" fill="rgba(255,255,255,0.5)" />
              <use xlink:href="#gentle-wave" x="48" y="5" fill="rgba(255,255,255,0.3)" />
              <use xlink:href="#gentle-wave" x="48" y="7" fill="#f8f8f8" />
            </g>
          </svg>

          <img src="pictures/fourth-row-pic.png" alt="">
          <div class="row">
            <div class="col-sm-12 col-md-7">
          <div class="row text-start">
            <div class="col-sm-5">
            <div class="card" style="max-width: 20rem; max-height: 20rem;">
              <div class="card-header" style="background-color: #EEDAEF;">Ideas</div>
              <div class="card-body"  style="background-color: #E6E5E5;">
                <p class="card-text">Inventive strategies and creative approaches aimed at improving mental well-being, encouraging fresh thinking and problem-solving in the community.</p>
              </div>
            </div>
            </div>

            <div class="col-sm-5 offset-1" style="margin-top: 10px;">
            <div class="card" style="max-width: 20rem; max-height: 20rem;">
              <div class="card-header" style="background-color: #CFD7F8;">Ask The Community</div>
              <div class="card-body"  style="background-color: #E6E5E5;">
                <p class="card-text">Engage with a supportive network, posing queries and seeking guidance from a diverse community, fostering mutual understanding and shared wisdom about mental health.</p>
              </div>
              </div>
            </div>

            <div class="col-sm-5 offset-2" style="margin-top: 10px;">
            <div class="card" style="max-width: 20rem; max-height: 20rem;">
              <div class="card-header" style="background-color: #C3EDC5">Experiences</div>
              <div class="card-body"  style="background-color: #E6E5E5;">
                <p class="card-text">Personal narratives and shared journeys, offering insights into coping with challenges and recovery, providing valuable perspectives and relatable stories for mental health empowerment within the community forum.</p>
              </div>
            </div>
            </div>
          </div>
        </div>
        <div class="col-sm-12 col-md-4">
          <div class="com-container">
            <h1>Community</h1>
            <div class="linya"></div>
            <p>Dive into a world of diverse community topics that cater to your interests and concerns</p>
            <a class="startat-btn" href="./index.php">Start A Topic</a>
          </div>
        </div>
        </div>


        </section>

        <section id="fifth-section">
          <h1>5 STEPS TO MENTAL HEALTH SUCCESS</h1>
          <div class="step-rows">
            <div class="column" style="background-color: #EAB3ED;"><div class="circle-rows">I</div>HAVE CLEAR GOALS</div>
            <div class="column" style="background-color: #FFB6A3;"><div class="circle-rows">II</div>IDENTIFY AND DON'T TOLERATE PROBLEMS</div>
            <div class="column" style="background-color: #99A3FF;"><div class="circle-rows">III</div>DIAGNOSE PROBLEMS</div>
            <div class="column" style="background-color: #A5FF97;"><div class="circle-rows">IV</div>DESIGN PLAN</div>
            <div class="column" style="background-color: #B2FAFF"><div class="circle-rows">V</div>PUSH THROUGH TO COMPLETION</div>
          </div>
        </section>

        <section id="last-section">
          <img src="./pictures/last-row-pic.png" alt="" class="last-pic">
              <div class="mhm">
                <h1 style="font-size: 70px;">MENTAL HEALTH MATTERS</h1>
            </div>
            <div class="mission">
                <div class="shape"></div>
                <h2>Our Mission</h2>
                <p>Empowering every individual to navigate their mental health journey
                    with confidence and compassion, our mission is to provide a guiding light towards accessible resources, fostering resilience, understanding, and
          </div>

        </section>
        <div class="container">
          <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-4 py-1 my-3">
            <div class="col mb-3">
      
                <img src="./pictures/logo-picture.png" alt="" style="height: 100px;">
      
             </a>
              <p class="text-body-secondary">therapeace@gmail.com</p>
              <p class="text-body-secondary">Phone: +631010101010</p>
              <p class="text-body-secondary">&copy; TheraPeace | 2023</p>
              <p class="text-body-secondary">version 1.0</p>
            </div>
      
            <div class="col mb-3">
              <h5><b>MENU</b></h5>
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="./landingpage.php" class="nav-link p-0 text-body-secondary">HOME</a></li>
                <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-body-secondary">COMMUNITY</a></li>
                <li class="nav-item mb-2"><a href="./About-Us.php" class="nav-link p-0 text-body-secondary">ABOUT</a></li>
              </ul>
            </div>
      
            <div class="col mb-3">
              <h5><b>OTHERS</b>
              </h5>
              <ul class="nav flex-column">
                <li class="nav-item mb-2"><a href="./help-center/FAQs.php" class="nav-link p-0 text-body-secondary">FAQs</a></li>
                <li class="nav-item mb-2"><a href="./help-center/Privacy-Policy.php" class="nav-link p-0 text-body-secondary">PRIVACY POLICY</a></li>
                <li class="nav-item mb-2"><a href="./help-center/Terms-of-Service.php" class="nav-link p-0 text-body-secondary">TERM OF SERVICE</a></li>
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.0.min.js"></script><script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

    <script src="./js/jquery-3.1.1.min.js"></script>
    <script src="./js/jquery.hislide.js"></script>

    <script src="./js/nav-active.js"></script>
    <script>

document.getElementById('next').onclick = function(){
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').appendChild(lists[0]);
}
document.getElementById('prev').onclick = function(){
    let lists = document.querySelectorAll('.item');
    document.getElementById('slide').prepend(lists[lists.length - 1]);
}

$('.image-rotator').hiSlide({
            interval:3000,
            speed:500
        });

      </script>

</body>
</html>