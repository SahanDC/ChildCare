
<?php require_once('config/db.php') ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <link href="css/patientmanager_styles.css" rel="stylesheet">
    <title>Hello, world!</title>
    <title>Document</title>
</head>
<body>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

  <!-- Option 2: Separate Popper and Bootstrap JS -->
  <!--
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
  -->



<!--header start-->
  <header>
    <?php ?>
    <div class="px-3 py-2 bg-dark text-white"><h3>Harshani Bandara</h3>
      <div class="container">
        
        <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
          <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
            <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap"><use xlink:href="#bootstrap"/></svg>
          </a>
          
          <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
            <li>
              <a href="manager.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#home"/></svg>
                Home
              </a>
            </li>
            <li>
              <a href="health advices.php" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                Helth Advices
              </a>
            </li>
            <li>
              <a href="child report.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                 Child Reports
              </a>
            </li>
            <li>
              <a href="request.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                Child Report Request
              </a>
            </li>
            <li>
              <a href="area details.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#grid"/></svg>
                Area details
              </a>
            </li>
            <li>
              <a href="profile.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#people-circle"/></svg>
                Profile
              </a>
            </li>
            <li>
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#people-circle" />
              </svg><a class="btn btn-danger" href="./controllers/logout.php">Log out</a>

            </li>
          </ul>
        </div>
      </div>
    </div>
  
  </header>
<!--header finish-->
<br>
<div class="container">
    <h2>Health Advices</h2>
    <div class="btn-group" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-secondary"><a href="health advices.php" class="nav-link text-white"> My View</a></button>
        <button type="button" class="btn btn-secondary"><a href="parents health advices.php" class="nav-link text-decoration-none">Parent View</a></button>
        
      </div>
</div>
<br>
<!--Slider-->
<div class="container">
<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img class="d-block w-100" src="img/high3.jpg" alt="Third slide">
        <div class="container" style="background-color: red;">
          <div class="carousel-caption text-start">
            <h1 style="color: black;">Young children’s health: what to expect</h1>
            <p>"This Church Leaders Guide is a very timely resource that responds to a critical need today: how churches can support parents with children at home amid the ongoing uncertainty and hardship caused by the global pandemic. Biblical, practical and focused specifically on pastors and church leaders, this guide will be greatly beneficial for local churches as they serve and equip the families among them.”</p>
            <!--p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p-->
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img class="d-block w-100" src="img/high 2.jpg" alt="Third slide">
        <div class="container">
          <div class="carousel-caption">
            <h1>Make Childrens Happy.</h1>
            <!--<p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>-->
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>
        <img class="d-block w-100" src="img/high1.jpg" alt="Third slide">
        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Eat Balanced Meal.</h1>
            <!--<p>Some representative placeholder content for the third slide of this carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Browse gallery</a></p>-->
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>
<!--slider finish-->
<!--advices grid-->

<div class="container">

  <h2 class="mt-4">Advices</h2>
      <p>Is the advice from your child’s doctor falling on deaf ears?<br> <strong>Sure you disagree with your pediatrician sometimes, but mostly you’re on the same page – at least in the doctor’s office. You don’t take your child’s health lightly. What parent does? Still, just as adults may be loath to follow their own physicians’ advice from time to time, parents – frustratingly for pediatricians who see their children – frequently do the same. Experts say the reasons – like difficulty implementing recommendations at home – vary, as do the consequences: from exposure to certain health issues that might not seem so dire to potentially putting a child’s life at risk.</strong>.</p>
      <?php

      $advice_set = "SELECT * FROM advice WHERE isdeleted=0";
      $result_advices = mysqli_query($connection, $advice_set);
      if ($result_advices) {
        #echo mysqli_num_rows($result_advices);
        #$records=mysqli_fetch_assoc($result_advices);

        while ($records = mysqli_fetch_assoc($result_advices)) {
      ?>
          <div class="row mb-3">
            <div class="col-md-4 themed-grid-col"><?php echo $records['topic']; ?></div>
            <div class="col-md-8 themed-grid-col">
              <p><?php echo $records['content'];
                  ?></p>
              <!-- <div class="container">

                <button type="button" class="btn btn-secondary"><a href="delete advices.php?id=<?php echo $records['id']; ?>">DELETE</a> </button>
                <button type="button" class="btn btn-secondary"><a href="update record.php?id=<?php echo $records['id']; ?>">EDIT</a> </button>
              </div> -->
            </div>
          </div>
      <?php
        }
      }
      ?>

      
    
</div>
<!---advices grid finish-->
<!--footer**************************************************************************************************************-->
  <div class="container" >
    <footer class="py-5">
      <div class="row">
        <div class="col-2">
          <h5>Section</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Home</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Features</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">Pricing</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">FAQs</a></li>
            <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted">About</a></li>
          </ul>
        </div>
  

  
        
  
      <div class="d-flex justify-content-between py-4 my-4 border-top">
        <p>&copy; 2021 Company, Inc. All rights reserved.</p>
        <ul class="list-unstyled d-flex">
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#twitter"/></svg></a></li>
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#instagram"/></svg></a></li>
          <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24"><use xlink:href="#facebook"/></svg></a></li>
        </ul>
      </div>
    </footer>
  </div>
</body>
</html>