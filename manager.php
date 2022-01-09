<?php

include_once('controllers/manager.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

  <!-- <link rel="stylesheet" href="./css/indexStyle.css"> -->
  <link rel="stylesheet" href="css/patientmanager_styles.css">
  <link rel="stylesheet" href="css/footer.css">
  <link rel="stylesheet" href="css/header.css">
  <title>Patient Manager Home</title>

  <meta http-equiv="X-UA-Compatible" content="IE=edge">
</head>

<body>
  <!-- added ********************************************************************************-->

  <div class="px-3 py-2 text-black">
      <div class="container">
        <ul class="nav col-12 col-lg-auto my-2 justify-content-center my-md-0 text-small">
          <li class="name">
            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
              <use xlink:href="#home" />
            </svg>
            <h3>Harshani Bandara</h3>
          </li>
          <li class="details">
            <h1>&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;</h1>
          </li>

          <li class="details">
            <a href="manager.php" class="nav-link text-secondary">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#home" />
              </svg>
              <p class="hover-underline-animation">
                Home
              </p>
            </a>
          </li>

          <li class="details">
            <a href="health advices.php" class="nav-link text-black">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#speedometer2" />
              </svg>
              <p class="hover-underline-animation">
                Health Advice
              </p>
            </a>
          </li>
          <li class="details">
            <a href="child report.php" class="nav-link text-black">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#table" />
              </svg>
              <p class="hover-underline-animation">
                Child Reports
              </p>
            </a>
          </li>
          <li class="details">
            <a href="requests.php" class="nav-link text-black">
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#grid" />
              </svg>
              <p class="hover-underline-animation">
                Child Report Request
              </p>
            </a>
          </li>
          <li class="details">
            <!-- <a href="profile.php" class="nav-link text-white"> -->
            <svg class="bi d-block mx-auto mb-1" width="24" height="24">
              <use xlink:href="#people-circle" />
            </svg><a class="btn btn-danger" href="./controllers/logout.php">Log out</a>
          </li>
        </ul>
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
              <input type="text" class="form-control form-input" name='search' placeholder="Search by name, id, center, areas..." autofocus name="search" value='<?php echo $search ?>'> <span class="left-pan"><i class="fa fa-microphone"></i></span>
              <!-- <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search by Id, Name, etc." aria-label="Search" style="float: left; width: 50%" value="<?php echo $search; ?>" autofocus> -->

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
    ?>

    <?php
    if (!empty($midwifeList)) {
      foreach ($midwifeList as $id => $midwife) {
    ?>
        <div class="row mb-4">
          <div class="col-3 themed-grid-col"><?php echo $midwife->getId(); ?></div>
          <div class="col-3 themed-grid-col"><?php echo $midwife->getEmail(); ?></div>
          <div class="col-3 themed-grid-col"><?php echo $midwife->getCentre(); ?></div>
          <div class="col-3 themed-grid-col"><?php echo $midwife->getArea(); ?></div>
        </div>
    <?php
      }
    } else {
      echo "NOT FOUND ANY RESULT!";
    }
    ?>
    <!--first table finish************************************************************************************************-->
  </div>

  <!--footer**************************************************************************************************************-->
  <!-- <div class="container">
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
  </div> -->

  <!-- footer section starts -->


  <section class="footer">

    <div class="container">

      <div class="row">

        <div class="col-md-6" data-aos="fade-right">
          <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem</a>
          <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur nemo porro quasi minima consequuntur dolorum, quas amet in autem id?</p>
        </div>

        <!-- <div class="col-md-4 text-center" data-aos="fade-up">
                  <h3>links</h3>
                  <a href="#">LOGIN</a>
                  <a href="#">Signup</a>

              </div> -->

        <div class="col-md-6 text-center" data-aos="fade-left">
          <h3>share</h3>
          <a href="#">Facebook</a>
          <a href="#">Twitter</a>
          <a href="#">Linkedin</a>
          <a href="#">Github</a>
        </div>

      </div>

    </div>

    <h4 class="credit text-center mx-auto">created by <span>TEAM NINJAS-GROUP 23</span> | all rights reserved.</h4>

  </section>

  <!-- footer section ends -->

  <!-- finish********************************************************************************** -->

  <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
</body>

</html>