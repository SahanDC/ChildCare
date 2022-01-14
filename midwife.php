<?php include('controllers/midwife.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    
    <link rel="stylesheet" href="css/midwifeStyle.css">
    <!-- <link rel="stylesheet" href="css/indexStyle.css"> -->
    <title>Midwife Main Page</title>

</head>

<body>
    <!-- header section starts  -->
    <header style="background-color: rgb(181, 239, 241);">
        <div class="container" style="background-color: rgb(181, 239, 241);">
            <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem.</a>
            <nav class="nav">
                <ul>
                    <li><a href="login.php">See Medical Advice</a></li>
                    <li><a href="./controllers/logout.php">Log Out</a></li>
                </ul>
            </nav>
            <div class="fas fa-bars"></div>
        </div>
    </header>
    <!-- header section ends  -->

    <div class="container">
        <div class="m-5">
            <table class="table table-info table-bordered" width=100%>
                <thead>
                    <tr class="table-success">
                        <th class="table-primary">Vaccination Centers</th>
                        <th class="table-primary">Number of Children</th>
                        <th class="table-primary">Areas</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($details as $item) {
                    ?>
                        <tr>
                            <td><?php echo $item['centre']; ?></td>
                            <td><?php echo $item['noc']; ?></td>
                            <td><?php echo $item['areas']; ?></td>
                        </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="mt-5 ms-5 me-5">
            <form class="form-inline" action="midwife.php" method="get">
                <div class="type">
                    <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search by Id, Name, etc." aria-label="Search" value="<?php echo $search; ?>" autofocus>
                </div>

                <div class="search mt-1">
                    <button class="btn btn-light my-sm-0" type="submit"><a href="midwife.php">Refresh</a></button>
                </div>
            </form>
        </div>
    </div>

    <div class="container">
        <div class="mb-5 ms-5 me-5">
            <table class="table table-info table-bordered table-hover">
                <thead>
                    <tr class="table-success">
                        <th class="table-primary">Child Id</th>
                        <th class="table-primary">Name</th>
                        <th class="table-primary">Guardian</th>
                        <th class="table-primary">Area</th>
                        <th class="table-primary">Next Vaccination</th>
                    </tr>
                </thead>
                
                <tbody>
                    <?php
                    foreach ($childReportDetails as $item) {
                    ?>
                        <tr onclick="<?php echo $midwifeObj->viewChildReport($item['ChildId']);?>">
                            <td><?php echo $item['ChildId']; ?></td>
                            <td><?php echo $item['Name']; ?></td>
                            <td><?php echo $item['Guardian']; ?></td>
                            <td><?php echo $item['Area']; ?></td>
                            <td><?php echo $item['NVD']; ?></td>
                        </tr>

                    <?php
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="mt-5 ms-5 me-5">
            <h2>Vaccination within two weeks</h2>
        </div>
        <div class="mb-5 ms-5 me-5">
            <table class="table table-info table-bordered" width=100%>
                <thead>
                    <tr class="table-success">
                        <th class="table-primary">Child Id</th>
                        <th class="table-primary">Name</th>
                        <th class="table-primary">Date</th>
                        <th class="table-primary">Centre</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($vaccinateWithinTwoWeeks as $item) {
                        if (((strtotime($item['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 < 14) && ((strtotime($item['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 > 0)) {
                    ?>
                            <tr>
                                <td><?php echo $item['ChildId']; ?></td>
                                <td><?php echo $item['Name']; ?></td>
                                <td><?php echo $item['NVD']; ?></td>
                                <td><?php echo $item['Centre']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="container">
        <div class="mt-5 ms-5 me-5">
            <h2>Vaccination missed</h2>
        </div>
        <div class="mb-5 ms-5 me-5">
            <table class="table table-info table-bordered" width=100%>
                <thead>
                    <tr class="table-success">
                        <th class="table-primary">Child Id</th>
                        <th class="table-primary">Name</th>
                        <th class="table-primary">Date</th>
                        <th class="table-primary">Centre</th>
                    </tr>
                </thead>

                <tbody>
                    <?php
                    foreach ($vaccinationMissed as $item) {
                        if ((strtotime($item['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 < 0) {
                    ?>
                            <tr>
                                <td><?php echo $item['ChildId']; ?></td>
                                <td><?php echo $item['Name']; ?></td>
                                <td><?php echo $item['NVD']; ?></td>
                                <td><?php echo $item['Centre']; ?></td>
                            </tr>
                    <?php
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>