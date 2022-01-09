<?php require_once('config/db.php');
require_once('models/manager.php');

$manager = new Manager($connection, $_SESSION['id'], $_SESSION['firstname'] . " " . $_SESSION['lastname'], $_SESSION['email']);

if (isset($_POST['submit'])) {
  $topic = $_POST['topic'];
  $content = $_POST['content'];
  $is_deleted = 0;
  $manager->addAdvice($topic, $content);
  // $query = "INSERT INTO advice (topic, content, isdeleted) VALUES ('{$topic}','{$content}',{$is_deleted})";

  // $insert = mysqli_query($connection, $query);

  // if (!$insert) {
  //   echo mysqli_error($connection);
  // } else {
  //   echo "";
  // }
}

if (isset($_POST['delete'])) {
  $manager->deleteAdvice($_POST['delete']);
}


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
  <link href="css/patientmanager_styles.css" rel="stylesheet">
  <link href="css/footer.css" rel="stylesheet">
  <link href="css/header.css" rel="stylesheet">

  <title>Health advices</title>
  <title>Document</title>

</head>

<body>


  <!-- Optional JavaScript; choose one of the two! -->

  <!-- Option 1: Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>


  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>




  <!--header start-->
  <header>
    <!-- <div class="px-3 py-2 bg-dark text-white">
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
              <a href="manager.php" class="nav-link text-white">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                  <use xlink:href="#home" />
                </svg>
                Home
              </a>
            </li>
            <li>
              <a href="health advices.php" class="nav-link text-secondary">
                <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                  <use xlink:href="#speedometer2" />
                </svg>
                Health Advices
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
              <svg class="bi d-block mx-auto mb-1" width="24" height="24">
                <use xlink:href="#people-circle" />
              </svg><a class="btn btn-danger" href="./controllers/logout.php">Log out</a>
            </li>
          </ul>

        </div>

      </div>
    </div>
    </div> -->
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
  </header>
  <!--header finish-->
  <br>
  <div class="container">
    <h2>Health Advices</h2>
    <div class="btn-group" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-primary"><a href="health advices.php" class="nav-link text-secondary"> My View</a></button>
      <button type="button" class="btn btn-primary"><a href="parents health advices.php" class="nav-link text-white">Parent View</a></button>

    </div>
  </div>
  <br>
  <!--Slider-->
  <div class="container">
    <div class="container">
      <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
          <div class="carousel-item active">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
              <rect width="100%" height="100%" fill="#777" />
            </svg>
            <img class="d-block w-100" src="img/immunation.jpg" alt="Third slide">
            <div class="container" style="background-color: red;">
              <div class="carousel-caption text-start">
                <h1 style="color: black;">Young children’s health: what to expect</h1>
                <p>"This Church Leaders Guide is a very timely resource that responds to a critical need today: how churches can support parents with children at home amid the ongoing uncertainty and hardship caused by the global pandemic. Biblical, practical and focused specifically on pastors and church leaders, this guide will be greatly beneficial for local churches as they serve and equip the families among them.”</p>
                <!--p><a class="btn btn-lg btn-primary" href="#">Sign up today</a></p-->
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
              <rect width="100%" height="100%" fill="#777" />
            </svg>
            <img class="d-block w-100" src="img/1234.jfif" alt="Third slide">
            <div class="container">
              <div class="carousel-caption">
                <h1>Make Childrens Happy.</h1>
                <!--<p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>-->
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false">
              <rect width="100%" height="100%" fill="#777" />
            </svg>
            <img class="d-block w-100" src="img/122.jfif" alt="Third slide">
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
  </div>
  <!--slider finish-->

  <!--add advice button-->
  <!-- Button trigger modal -->
  <div class="container">
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Add New Advice
    </button>

    <!-- Modal -->

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Add Advice</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <form action="" method="POST">

            <div class="modal-body">
              <div class="col-md-12"><label class="labels">Advice Topic</label><textarea class="form-control" id="topic_area" name="topic" rows="3" placeholder="enter advice topic here. " required></textarea></div>
              <div class="col-md-12"><label class="labels">Advice content </label><textarea class="form-control" id="content_area" name="content" rows="8" placeholder="enter advice content here. " required></textarea></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-primary" name="submit"><input type="submit" value="submit" name="submit" style="background-color: blue;"></button>
            </div>
          </form>
          <!-- finish -->
        </div>
      </div>
    </div>
  </div>

  <!--finish add advice-->
  <!--advices grid-->

  <div class="container">

    <h2 class="mt-4">Advices</h2>
    <p>Is the advice from your child’s doctor falling on deaf ears?<br>
      <strong>A good parent is someone who strives to make decisions in the best interest of the child.

        What makes a great parent isn’t only defined by the parent’s action, but also their intention.

        A good parent doesn’t have to be perfect. No one is perfect. No child is perfect either … keeping this in mind is important when we set our expectations.

        Successful parenting is not about achieving perfection. But it doesn’t mean that we shouldn’t work towards that goal. Set high standards for ourselves first and then our children second. We serve as role models for them.

        Here are 10 tips on learning good parenting skills and avoiding bad parenting. Many of them are not

        quick nor easy. And probably no one can do all of them all of the time. But if you can keep working
        on the tips in this parenting guide, even though you may only do part of these some of the time, you will
        still be moving in the right direction.

      </strong>.
    </p>
    <?php

    // $advice_set = "SELECT * FROM advice WHERE isdeleted=0";
    // $result_advices = mysqli_query($connection, $advice_set);

    $advices = $manager->get_advices();

    foreach ($advices as $id => $advice) {
    ?>
      <div class="row mb-3">
        <div class="col-md-4 themed-grid-col"><?php echo $advice->get_topic(); ?></div>
        <div class="col-md-8 themed-grid-col">
          <p><?php echo $advice->get_content();

              ?></p>
          <div class="container">

            <?php
            ?>
            <form method="post">
              <button type="button" onclick="addEdit()" class="btn btn-secondary"><a href="update record.php?id=<?php echo  $advice->get_id(); ?>">EDIT</a> </button>
              <button type="submit" name="delete" class="btn btn-secondary" value='<?php echo $advice->get_id(); ?>'>DELETE</button>



            </form>
          </div>
        </div>
      </div>

    <?php
    }
    ?>






  </div>
  <!---advices grid finish-->
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


  <script>
    function addEdit() {
      <?php $_SESSION['manager'] = serialize($manager); ?>
    }
  </script>
</body>

</html>
<?php mysqli_close($connection); ?>