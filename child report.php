<?php include('config/db.php');
if (!isset($_SESSION['login'])) {
  header("Location: ./login.php");
}
if ($_SESSION['role'] == 'parent') {
  header("Location: ./dashboard.php");
}
if ($_SESSION['role'] == 'midwife') {
  header("Location: ./midwife.php");
} ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="style.css" rel="stylesheet">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <link href="css/patientmanager_styles.css" rel="stylesheet">
    <title>child report</title>
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
              <a href="health advices.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#speedometer2"/></svg>
                Helth Advices
              </a>
            </li>
            <li>
              <a href="child report.php" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24"><use xlink:href="#table"/></svg>
                Child Reports
              </a>
            </li>
            <li>
              <a href="requests.php" class="nav-link text-white">
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
<!-- content reports -->
<br>
<div class="container">


<div class="container">

    <div class="row mb-4">
          <div class="col-md-6">
            <form action="child report.php" method="get">
              <div class="form">
                <i class="fa fa-search"></i>
                  <input type="text" class="form-control form-input" placeholder="Search by name, id, ..." autofocus name="search" > 
                  <span class="left-pan"><i class="fa fa-microphone"></i></span>
                  
                </div>
            </form>
            
          </div>
          <div class="col-md-6">
          <div class="form"><i class="fa fa-search"></i>
            <a href="child report.php" class="btn btn-info btn-lg">
              <span class="glyphicon glyphicon-refresh"></span> Refresh
            </a>
          </div>
          </div>
    </div>  

    </div>
    <br>
    <div class="row mb-4">
      <div class="col-3 themed-grid-col">ID</div>
      <div class="col-3 themed-grid-col">Name</div>
      <div class="col-3 themed-grid-col">CENTER</div>
      <div class="col-3 themed-grid-col">AREAS</div>
    </div>
    <?php
    $search='';
    if(isset($_GET['search'])){
      
      
      $search=mysqli_real_escape_string($connection,$_GET['search']);
      $report_set="SELECT * FROM child_report WHERE (name LIKE '%{$search}%' or ChildId LIKE '%{$search}%') ORDER BY ChildId";
      
    }else{
      
      $report_set="SELECT * FROM child_report ";
    }


     
    $report = mysqli_query($connection, $report_set);
    if ($report) {
      

      while ($records = mysqli_fetch_assoc($report)) {
    ?>
        <a href="child_report.php?ChildId= <?php echo $records['ChildId']; ?>">
        <div class="row mb-4">
          <div class="col-3 themed-grid-col"><?php echo $records['ChildId']; ?></a></div>
          <div class="col-3 themed-grid-col"><?php echo $records['Name'];?></div>
          <div class="col-3 themed-grid-col"><?php echo $records['Centre'];?></div>
          <div class="col-3 themed-grid-col"><?php echo $records['Area'];?></div> 
        </div>
      </a>
    <?php
      }
    }
     ?>
</div>
<!-- content reports finsh -->


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