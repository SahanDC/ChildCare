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
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  
  <link rel="stylesheet" href="./css/styles.css">
  <link rel="stylesheet" href="css/patientmanager_styles.css" >
  <title>Patient Manager Home</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">


 
 

</head>

<body>

  <!-- added ********************************************************************************-->

  <div class="px-3 py-2 bg-dark text-white">
    <h3>Harshani Bandara</h3>
    <div class="container">

      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center my-2 my-lg-0 me-lg-auto text-white text-decoration-none">
          <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
            <use xlink:href="#bootstrap" />
          </svg>
        </a>

        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
          <li>
            <a href="manager.php" class="nav-link text-secondary">
             
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#home" />
              </svg> 
              <p class="hover-underline-animation">
              Home 
            </p>
            </a>
           
          </li>
          <li>
            <a href="health advices.php" class="nav-link text-white">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#speedometer2" />
              </svg>
              <p class="hover-underline-animation">
                Health Advice
              </p>
             
            </a>
          </li>
          <li>
            <a href="child report.php" class="nav-link text-white">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#table" />
              </svg>
              Child Reports
            </a>
          </li>
          <li>
            <a href="requests.php" class="nav-link text-white">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#grid" />
              </svg>
              Child Report Request
            </a>
          </li>
          <li>
            <a href="area details.php" class="nav-link text-white">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#grid" />
              </svg>
              Area details
            </a>
          </li>

          <li>
            <a href="profile.php" class="nav-link text-white">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#people-circle" />
              </svg>
              Profile
            </a>
          </li>
          <li>
            <!-- <a href="profile.php" class="nav-link text-white"> -->
            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
              <use xlink:href="#people-circle" />
            </svg><a class="btn btn-danger" href="./controllers/logout.php">Log out</a>

            <!-- </a> -->
          </li>
          <!-- <li>
            <div class="text-end"><a href="main.php" class="nav-link text-white"></a>

              <a class="btn btn-danger" href="./controllers/logout.php">Log out</a>
            </div>
      </div>
      </li> -->
        </ul>
      </div>
    </div>
  </div>


  <!--header finish-->
<!-- add midwife -->
<br>
<!-- searching box -->
<!-- <div class="search">
  <form action="manager.php" method="get"> 
    <input type="text" name="search" id="" autofocus>
  </form>
</div> -->




<div class="container">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Add New Midwife
    </button>
    
    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add midwife</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
        
          <form action="" method="POST">
            <div class="modal-body">
              <div class="col-md-12"><label class="labels">midwife email</label><input type="email" name="email" class="form-control" id="mail" placeholder="name@example.com" value="" required></div>
              <div class="col-md-12"><label class="labels">midwife's center </label><input type="text" class="form-control" id="content_area" name="center" rows="8" placeholder="enter center here. ex:centre1 " required></textarea></div>
              <div class="col-md-12"><label class="labels">midwife's ares </label><input type="text" class="form-control" id="content_area" name="area" rows="8" placeholder="enter areas here. " required></textarea></div>
              <div class="col-md-12"><label class="labels">midwife's noc </label><input type="number" class="form-control" id="content_area" name="noc" rows="8" placeholder="enter number of children here. " required></textarea></div>
            
            </div>
            <div class="modal-footer">
              <!-- <button type="button" class="btn btn-primary" name="submit"><input type="submit" value="submit" name="submit" style="background-color: blue;"></button>
            -->
            <input type="submit" value="submit" name="submit" style="background-color: blue;">
            </div>
          </form>
          <!-- finish -->
        </div>
      </div>
    </div>
  </div>
  <?php
  if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $center = $_POST['center'];
    $areas=$_POST['area'];
    $noc=$_POST['noc'];
    

    $query = "INSERT INTO midwife (email,centre,areas,noc) VALUES ('{$email}','{$center}','{$areas}',{$noc})";

    $insert = mysqli_query($connection, $query);

    if (!$insert) {
      echo mysqli_error($connection);
    } else {
      echo "";
    }
  }?>



  <div class="container">
    <h2 class="mt-4">Midwieves Details</h2>
    <p>They diagnose, educate, and treat patients to ensure that they 
      have the best possible care. A few of the main duties of a doctor 
      are performing diagnostic tests, recommending specialists for patients, 
      document patient's medical history, and educating patients. 
      They also have to administer vaccines and other treatments.</p>
    <!-- ********************* -->
    


    <div class="container">

    <div class="row mb-4">
          <div class="col-md-6">
            <form action="manager.php" method="get">
              <div class="form">
                <i class="fa fa-search"></i>
                  <input type="text" class="form-control form-input" placeholder="Search by name, id, center, areas..." autofocus name="search" > <span class="left-pan"><i class="fa fa-microphone"></i></span>
                  
                </div>
            </form>
            
          </div>
          <div class="col-md-6">
          <div class="form"><i class="fa fa-search"></i>
            <a href="manager.php" class="btn btn-info btn-lg">
              <span class="glyphicon glyphicon-refresh"></span> Refresh
            </a>
          </div>
          </div>
    </div>  

    </div>
    <br>
    <div class="row mb-4">
      <div class="col-3 themed-grid-col">ID</div>
      <div class="col-3 themed-grid-col">EMAIL</div>
      <div class="col-3 themed-grid-col">CENTER</div>
      <div class="col-3 themed-grid-col">AREAS</div>
    </div>
    <?php
    $search='';
    if(isset($_GET['search'])){
      
      
      $search=mysqli_real_escape_string($connection,$_GET['search']);
      $midwife_set="SELECT * FROM midwife WHERE (email LIKE '%{$search}%' or id LIKE '%{$search}%') ORDER BY id";
      
    }else{
      
      $midwife_set="SELECT * FROM midwife ";
    }


     //$midwife_set = "SELECT * FROM midwife ";
    $midwife = mysqli_query($connection, $midwife_set);
    if ($midwife) {
      

      while ($records = mysqli_fetch_assoc($midwife)) {
    ?>
        
        <div class="row mb-4">
          <div class="col-3 themed-grid-col"><?php echo $records['id'];?></div>
          <div class="col-3 themed-grid-col"><?php echo $records['email'];?></div>
          <div class="col-3 themed-grid-col"><?php echo $records['centre'];?></div>
          <div class="col-3 themed-grid-col"><?php echo $records['areas'];?></div>
        </div>

    <?php
      }
    }
     ?>
     <!-- ***************** -->
    
  <!--first table finish************************************************************************************************-->


  <!--footer**************************************************************************************************************-->
  <div class="container">
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
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
                  <use xlink:href="#twitter" />
                </svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
                  <use xlink:href="#instagram" />
                </svg></a></li>
            <li class="ms-3"><a class="link-dark" href="#"><svg class="bi" width="24" height="24">
                  <use xlink:href="#facebook" />
                </svg></a></li>
          </ul>
        </div>
    </footer>
  </div>
  <!-- finish********************************************************************************** -->

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>