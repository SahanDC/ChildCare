<?php
include('config/db.php');
include_once('models/manager.php');

if (!isset($_SESSION['login'])) {
  header("Location: ./login.php");
}
if ($_SESSION['role'] == 'parent') {
  header("Location: ./dashboard.php");
}
if ($_SESSION['role'] == 'midwife') {
  header("Location: ./midwife.php");
}

$search = '';

if (isset($_GET['search'])) {
  $search = $_GET['search'];
}

$manager = new Manager($connection, $_SESSION['id'], $_SESSION['firstname'] . " " . $_SESSION['lastname'], $_SESSION['email']);
$ChildReports = $manager->getChildreports($search);



// if(isset($_GET['search'])){


//   $search=mysqli_real_escape_string($connection,$_GET['search']);
//   $report_set="SELECT * FROM child_report WHERE (name LIKE '%{$search}%' or ChildId LIKE '%{$search}%') ORDER BY ChildId";

// }else{

//   $report_set="SELECT * FROM child_report ";
// }

// $report = mysqli_query($connection, $report_set);

?>

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
  <link href="css/header.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
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
            <a href="manager.php" class="nav-link text-black">
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
              <input type="text" class="form-control form-input" placeholder="Search by name, id, ..." autofocus name="search" value='<?php echo $search ?>'>
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
      <div class="col-3 themed-grid-col-title">ID</div>
      <div class="col-3 themed-grid-col-title">Name</div>
      <div class="col-3 themed-grid-col-title">CENTER</div>
      <div class="col-3 themed-grid-col-title">AREAS</div>
    </div>

    <?php if (!empty($ChildReports)) {
      foreach ($ChildReports as $id => $ChildReport) {
    ?>
        <a  id="<?php echo $ChildReport->getChildId(); ?>" onclick="directChildreport(this)">
          <div class="row mb-4">
            <div class="col-3 themed-grid-col"><?php echo $ChildReport->getChildId(); ?>

  </div>
  <div class="col-3 themed-grid-col"><?php echo $ChildReport->getName(); ?></div>
  <div class="col-3 themed-grid-col"><?php echo $ChildReport->getCentre(); ?></div>
  <div class="col-3 themed-grid-col"><?php echo $ChildReport->getArea(); ?></div>
  </div>
  </a>
<?php
      }
    } else {
      echo "NOT FOUND ANY RESULT!";
    }
?>
</div>
<!-- content reports finsh -->



<!-- footer section starts -->
<section class="footer">

  <div class="container">

    <div class="row">

      <div class="col-md-6" data-aos="fade-right">
        <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem</a>
        <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur nemo porro quasi minima consequuntur dolorum, quas amet in autem id?</p>
      </div>

      <div class="col-md-6 text-center" data-aos="fade-left">
        <h3>share</h3>
        <a href="#">Facebook</a>
        <a href="#">Twitter</a>
        <a href="#">Linkedin</a>
        <a href="#">Github</a>
      </div>
  </footer>
</div>


<script>
  function directChildreport(e){
    e.onclick =function(){
      window.location = "child_report.php?ChildId= ".concat(e.id);
    };
  }
</script>

    </div>

  </div>

  <h4 class="credit text-center mx-auto">created by <span>TEAM NINJAS-GROUP 23</span> | all rights reserved.</h4>

</section>

<!-- footer section ends -->
</body>

</html>