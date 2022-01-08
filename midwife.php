<?php include('controllers/midwife.php') ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="css/midwifeStyle.css">
    <title>Midwife Main Page</title>

</head>

<body>
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="btn btn-primary" href="#" role="button">See Medical Advice</a>
            <a class="btn btn-danger" href="./controllers/logout.php" role="button">Log Out</a>
        </div>
    </nav>

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
                <input class="form-control mr-sm-2" name="search" type="search" placeholder="Search by Id, Name, etc." aria-label="Search" style="float: left; width: 50%" value="<?php echo $search; ?>" autofocus>
                <!-- <div class="mt-1"><button class="btn btn-dark my-sm-0" type="submit">Refresh</button></div> -->
                <div class="mt-1"><button class="btn btn-light my-sm-0" type="submit"><a href="midwife.php">Refresh</a></button> </div>
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
                        <tr>
                            <td><a href="child_report.php?ChildId= <?php echo $item['ChildId']; ?>"><?php echo $item['ChildId']; ?></a></td>
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



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>