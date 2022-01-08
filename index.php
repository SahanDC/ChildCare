<?php
include('config/db.php');

if (isset($_SESSION['login'])) {
    header("Location: ./dashboard.php");
}
?>

<!-- <!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="css/styles_index.css">
    <title>Child Care</title>
</head>

<body background="img/doctor.jpg" style="background-size: cover;">
<header>

<span class="d-block p-4 bg-info text-white" style="background-color:black">
 </span>
</header>
    <nav class="navbar navbar-expand-lg navbar-light mb-4" style="background-color: blue">
        <div class="container">
            <a class="navbar-brand" href="./index.php">Child Care</a>
            <br>
            <br>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse justify-content-right" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Sign in</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signup.php">Sign up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <br>
        <br>
        <h1 style="justify-content: center;">Child Care Managent System</h1>
    </div>

    <div class="container" style="background-image: img/24093.jpg">
        <div class="card text-white bg-info mb-3" style="max-width: 40rem; opacity:.5; height:100%">
            <div class="card-header">Welcome to child care</div>
            <div class="card-body">
                <br>
                <br>
                <br>
                <p>Create an account <a href="signup.php">Sign up</a> </p>
                <p>Already have an account? <a href="login.php">Log in</a></p>
            </div>
        </div>

        <h3></h3>
        <br>
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html> -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChildCare</title>

    <!-- aos css file cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css">

    <!-- magnific popup css cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/magnific-popup.min.css">

    <!-- bootstrap cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.3/css/bootstrap.min.css">

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="css/indexStyle.css">

</head>
<body>
    

<!-- header section starts  -->

<header style="background-color: rgb(181, 239, 241);">

<div class="container" style="background-color: rgb(181, 239, 241);">

    <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem.</a>

    <nav class="nav">
        <ul>
            <li><a href="login.php">LogIn</a></li>
            <li><a href="signup.php">Signup</a></li>
            
        </ul>
    </nav>

    <div class="fas fa-bars"></div>

</div>

</header>

<!-- header section ends  -->

<!-- home section starts  -->

<section class="home" id="home">

<div class="container">

    <div class="row min-vh-100 align-items-center text-center text-md-left">

        <div class="col-md-6 pr-md-5" data-aos="zoom-in">
            <img src="img/front.jpg" width="100%" alt="">
        </div>

        <div class="col-md-6 pl-md-5 content" data-aos="fade-left">
            
            <h1><span>Children </span> are <span>the</span> gift <span>of </span> God</h1>
            <h4>caring for you.</h3>
            <a href="login.php"><button class="button">LogIn</button></a>
            <a href="signup.php"><button class="button">Signup</button></a>
        </div>

    </div>

</div>

</section>


<!-- home section ends -->

<!-- about section start  -->

<section class="about" id="about">

<div class="container">
    
    <h1 class="heading"><span>'</span> our Services. <span>'</span></h1>
    <div class="row min-vh-100 align-items-center">

        <div class="col-md-6 content" data-aos="fade-right">

            <div class="box">
                <h3> <i class="fas fa-stethoscope"></i> Give Medical Advice. </h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, suscipit.</p>
            </div>

            <div class="box">
                <h3> <i class="fas fa-syringe"></i> Notify your child's vaccination date. </h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, suscipit.</p>
            </div>

            <div class="box">
                <h3> <i class="fas fa-balance-scale-right"></i> Notify your child's weight record dates. </h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsa, suscipit.</p>
            </div>

        </div>

        <div class="col-md-6 d-none d-md-block" data-aos="fade-left">
            <img src="img/immunation.jpg" width="100%" alt="">
        </div>

    </div>

</div>

</section>

<!-- about section ends -->

<!-- facility section starts  -->

<section class="facility" id="facility">

<div class="container">

<h1 class="heading"><span>'</span> our facilities <span>'</span></h1>

<div class="box-container">

    <div class="box" data-aos="zoom-in">
        <a href="images/123.jfif" title="vaccination process">
            <img src="img/baby1.jpg" alt="">
        </a>
    </div>

    <div class="box" data-aos="zoom-in">
        <a href="images/123.jfif" title="registation for babies">
            <img src="img/baby2.jfif" alt="">
        </a>
    </div>

    <div class="box" data-aos="zoom-in">
        <a href="images/123.jfif" title="Health Advice">
            <img src="img/baby3.jpg" alt="">
        </a>
    </div>

    <div class="box" data-aos="zoom-in">
        <a href="images/123.jfif" title="Medical child report">
            <img src="img/report.jfif" alt="">
        </a>
    </div>

    <div class="box" data-aos="zoom-in">
        <a href="images/123.jfif" title="weight recording">
            <img src="img/weight.jpg" alt="">
        </a>
    </div>

    <div class="box" data-aos="zoom-in">
        <a href="images/123.jfif" title="immunation process">
            <img src="img/im.jpg" alt="">
        </a>
    </div>

    

</div>

</div>

</section>



<section class="footer">

    <div class="container">

        <div class="row">

            <div class="col-md-4" data-aos="fade-right">
                <a href="#" class="logo"><span>C</span>ild <span>C</span>are <span>M</span>anagement <span>S</span>ystem</a>
                <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Tenetur nemo porro quasi minima consequuntur dolorum, quas amet in autem id?</p>
            </div>

            <div class="col-md-4 text-center" data-aos="fade-up">
                <h3>links</h3>
                <a href="#">LOGIN</a>
                <a href="#">Signup</a>
                
            </div>

            <div class="col-md-4 text-center" data-aos="fade-left">
                <h3>share</h3>
                <a href="#">facebook</a>
                <a href="#">twitter</a>
                <a href="#">Linkedin</a>
                <a href="#">github</a>
            </div>

        </div>

    </div>

    <h1 class="credit text-center mx-auto">created by <span>ALL STARS-GROUP 23</span> | all rights reserved.</h1>

</section>

<!-- footer section ends -->


















<!-- jquery cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<!-- magnific popup js link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/magnific-popup.js/1.1.0/jquery.magnific-popup.min.js"></script>

<!-- aos js file cdn link  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>

<!-- custom js link  -->
<script src="js/main.js"></script>


<script>

AOS.init({
    duration:1000,
    delay:400
});

</script>

</body>
</html>
