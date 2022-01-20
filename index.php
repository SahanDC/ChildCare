<?php
include('config/db.php');

if (isset($_SESSION['login'])) {
    header("Location: ./dashboard.php");
}
?>

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


<!-- footer section starts -->


<section class="footer">

    <div class="container">

        <div class="row">

            <div class="col-md-4" data-aos="fade-right">
                <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem</a>
                <p>Our child care management system allows parents, and midwives to access everything securely about the children remotely at their fingertips</p>
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

    <h1 class="credit text-center mx-auto">created by <span>TEAM NINJAS-GROUP 23</span> | all rights reserved.</h1>

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
