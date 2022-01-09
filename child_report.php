<?php
include('controllers/childreport.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link rel="stylesheet" href="css/bootstrap.css"> -->
    <link rel="stylesheet" href="css/child_reportStyle.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Child Report</title>
    <style>

    </style>
</head>

<body>
    <!-- header section starts  -->
    <header style="background-color: rgb(181, 239, 241);">
        <div class="container" style="background-color: rgb(181, 239, 241);">
            <a href="#" class="logo"><span>C</span>hild <span>C</span>are <span>M</span>anagement <span>S</span>ystem</a>
            <nav class="nav">
                <ul>
                    <li><a href="midwife.php">Back</a></li>
                    <li><a href="./controllers/logout.php">Log Out</a></li>
                </ul>
            </nav>
            <div class="fas fa-bars"></div>
        </div>
    </header>
    <!-- header section ends  -->

    <?php if (!empty($report1->Errors) && (in_array("Fail database", $report1->Errors) || in_array("Childreport not found", $report1->Errors))) {
        display_errors($report1->Errors);
    } else {
    ?>

        <!-- <div class="row h4 p-1 bg-primary">
        <div class="col-2 text-center  ">Child Report</div>
        <div class="col-8 text-capitalized bg-primary text-center "><?php //echo $ChildId 
                                                                    ?></div>
        <div class="col bg-primary text-center"><button type="button" id="back" onclick="goBack()" class="btn btn-dark m1-2">BACK</button></div>
        <div class="col bg-primary text-center"><a href="./controllers/logout.php" class="btn btn-danger m1-2">Log Out</a></div>
    </div> -->


        <?php
        if (!empty($report1->Errors)) {
            display_errors($report1->Errors);
        }
        ?>

        <div class="container mt-5 px-5 ">
            <div class="row">
                <div class="col-xl-2 h4">Name</div>
                <div class="col-xl-1 h4">:-</div>
                <div class="col-xl-2 h4"><?php echo $name ?></div>
            </div>
            <div class="row">
                <div class="col-xl-2 h4">Id</div>
                <div class="col-xl-1 h4">:-</div>
                <div class="col-xl-2 h4"><?php echo $ChildId ?></div>
            </div>
            <div class="row">
                <div class="col-xl-2 h4">Age</div>
                <div class="col-xl-1 h4">:-</div>
                <div class="col-xl-2 h4"><?php echo $age ?> months</div>
            </div>
            <div class="row">
                <div class="col-xl-2 h4">Guardian</div>
                <div class="col-xl-1 h4">:-</div>
                <div class="col-xl-2 h4"><?php echo $guardian ?></div>
            </div>
            <div class="row">
                <div class="col-xl-2 h4">Birth Place</div>
                <div class="col-xl-1 h4">:-</div>
                <div class="col-xl-2 h4"><?php echo $birth_place ?></div>
            </div>
        </div>
        <hr style="margin-top: 5%; border: 1px solid blue;">

        <!-- ----------------------------------------------------------------------Manager ----------------------------------------------------------------------------->
        <?php
        if (!strcmp($user, "manager")) { ?>
            <form action='child_report.php' method='post'>
                <input type='hidden' name='ChildId' value=<?php echo $ChildId ?>>
                <input type='hidden' name='last_vaccination' value=<?php echo $last_vaccination ?>>
                <div class='container mt-5 col-10 px-5 border border-dark border-3'>
                    <label for='exampleDataList' class='form-label h2 mt-4'>Edit vaccination details</label>

                    <div class='input-group mb-4'>
                        <div class='input-group-prepend'>
                            <label class='input-group-text' for='inputGroupSelect01'>Select Vaccine</label>
                        </div>
                        <select class='col custom-select' name='edit_vaccine' id='edit_vaccine' onchange='editVaccination(event)'>
                            <option value='-1'>Choose...</option>
                            <option value='0'>BCG Vaccine</option>
                            <option value='1'>Triple Vaccine</option>
                            <option value='2'>Triple/Polio Vaccine</option>
                            <option value='3'>MMR Vaccine</option>
                            <option value='4'>Japanese Encephalitis Vaccine</option>
                            <option value='5'>Dual Polio Vaccine</option>
                            <option value='6'>Hepatitis A, B Vaccine</option>
                            <option value='7'>Anti Rabies Vaccine</option>
                            <option value='8'>Chicken Pox Vaccine</option>
                            <option value='9'>Meningicoccal Vaccine</option>
                        </select>
                    </div>
                    <form>
                        <div class='row'>
                            <div class='col-2 mt-1'>Date of vaccination :</div>
                            <div class='col-2'>
                                <input type='date' class='form-control bg-light border-dark' placeholder='Date of Vaccination' id='edit_date' name='edit_date' value=<?php echo $edit_date ?>>
                            </div>
                            <div class='col-2 mt-1'>Place of vaccination :</div>
                            <div class='col-2'>
                                <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Place of Vaccination' id='edit_place' name='edit_place' value=<?php echo $edit_place ?>>
                            </div>
                            <div class='col-2 mt-1'>Next vaccination :</div>
                            <div class='col-2'>
                                <input type='date' class='form-control bg-light border-dark' placeholder='Next Vaccination' id="edit_NVdate" name='edit_NVdate' value=<?php echo $edit_NVdate ?>>
                            </div>
                        </div>
                    </form>
                    <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Comments on Vaccination' id='edit_comment' name='edit_comment' value=<?php echo $edit_comment ?>>
                    <div class=' col-11 text-end mb-4'>
                        <button type='submit' class='btn btn-warning px-4 m1-2 rounded ' name='edit' value='submit'>Edit</button>
                    </div>
                </div>;
            <?php
        }
            ?>
        <!-- ----------------------------------------------------------------------Manager ----------------------------------------------------------------------------->


        <!-- ----------------------------------------------------------------------Midwife ----------------------------------------------------------------------------->
            <?php
            if (!strcmp($user, "midwife")) { ?>
                <form action='child_report.php' method='post'>
                    <input type='hidden' name='ChildId' value=<?php echo $ChildId ?>>
                    <input type='hidden' name='last_vaccination' value=<?php echo $last_vaccination ?>>
                    <div class='container mt-5 col-10 px-5 border border-dark border-3'>
                        <label for='exampleDataList' class='form-label h2 mt-4'>Add vaccination details</label>

                        <div class='input-group mb-4'>
                            <div class='input-group-prepend'>
                                <label class='input-group-text' for='inputGroupSelect01'>Select Vaccine</label>
                            </div>
                            <select class='col custom-select' name='add_vaccine' id='add_vaccine'>
                                <option value='-1'>Choose...</option>
                                <option value='0' id=0>BCG Vaccine</option>
                                <option value='1' id=1>Triple Vaccine</option>
                                <option value='2' id=2>Triple/Polio Vaccine</option>
                                <option value='3' id=3>MMR Vaccine</option>
                                <option value='4' id=4>Japanese Encephalitis Vaccine</option>
                                <option value='5' id=5>Dual Polio Vaccine</option>
                                <option value='6' id=6>Hepatitis A, B Vaccine</option>
                                <option value='7' id=7>Anti Rabies Vaccine</option>
                                <option value='8' id=8>Chicken Pox Vaccine</option>
                                <option value='9' id=9>Meningicoccal Vaccine</option>
                            </select>
                        </div>

                        <form>
                            <div class='row'>
                                <div class='col-2 mt-1'>Date of vaccination :</div>
                                <div class='col-2'>
                                    <input type='date' class='form-control bg-light border-dark' placeholder='Date of Vaccination' name='add_Vdate' value=<?php echo $add_Vdate ?>>
                                </div>
                                <div class='col-2 mt-2'>Place of vaccination :</div>
                                <div class='col-2'>
                                    <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Place of Vaccination' name='add_place' value=<?php echo $add_place ?>>
                                </div>
                                <div class='col-2 mt-2'>Next vaccination :</div>
                                <div class='col-2'>
                                    <input type='date' class='form-control bg-light border-dark' placeholder='Next Vaccination' name='add_NVdate' value=<?php echo $add_NVdate ?>>
                                </div>
                            </div>
                        </form>
                        <div class='row'>
                            <div class='col mt-1'>Comment &emsp;:</div>
                            <div class='col-10'>
                                <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Comments on Vaccination' name='add_comment' value=<?php echo $add_comment ?>>
                            </div>
                        </div>
                        <div class=' col-11 text-end mb-4'>
                            <button type='submit' class='btn btn-warning px-4 m1-2 rounded ' name='add_V' value='submit'>Add</button>
                        </div>
                    </div>;
                <?php
            }
                ?>
        <!-- ----------------------------------------------------------------------Midwife ----------------------------------------------------------------------------->

                <div class="container mt-5">
                    <table class="table table-bordered border-5 border-dark table-hover">
                        <thead>
                            <tr>
                                <th class="border-3">Vaccine Name</th>
                                <th class="text-center border-3">Date of Vaccination</th>
                                <th class="text-center border-3">Place of Vaccination</th>
                                <th class="text-center border-3">Preventable diseases</th>
                                <th class="border-3">Comments on Vaccination</th>
                            </tr>
                        </thead>
                        <tbody class="border-3">
                            <?php
                            $report2->showVaccinations();
                            ?>
                        </tbody>
                    </table>
                </div>
                <hr style="margin-top: 5%; border: 1px solid blue;">
                <?php
                if (!strcmp($user, "midwife")) { ?>
                    <form action='child_report.php' method='post' id="weightTable">
                        <input type='hidden' name='ChildId' value=<?php echo $ChildId ?>>
                        <input type='hidden' name='added_weights' value=<?php echo implode(',', $weights) ?>>
                        <div class='container mt-5 col-4 px-5 border border-dark border-3'>
                            <label for='exampleDataList' class='form-label h2 mt-4'>Add weight details</label>
                            <form>
                                <div class='row'>
                                    <div class='col mt-1'>Date of Weight check &emsp;:</div>
                                    <div class='col'>
                                        <input type='date' class='form-control bg-light border-dark' placeholder='Date of Weight check' name='add_Wdate' value=<?php echo $add_Wdate ?>>
                                    </div>
                                </div>
                                <div class='row mt-3'>
                                    <div class='col mt-2'>Weight of the child &emsp;&emsp;:</div>
                                    <div class='col'>
                                        <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='weight' name='add_weight' value=<?php echo $add_weight ?>>
                                    </div>
                                </div>
                            </form>
                            <div class=' col-11 text-end mb-4'>
                                <button type='submit' class='btn btn-warning px-4 m1-2 rounded ' name='add_W' value='submit'>Add</button>
                            </div>
                        </div>
                    <?php
                }
                    ?>

                    <div class="container col-4 pt-5 pb-5 px-5">
                        <table class="table table-bordered border-5 border-dark table-hover">
                            <thead>
                                <tr class="border-3">
                                    <th class="col-md-2 border-3 text-center">Date of weight added</th>
                                    <th class="col-2 border-3 text-center">Weight</th>
                                </tr>
                            </thead>
                            <tbody class="border-3">
                                <?php
                                $report2->showWeight();
                                ?>
                            </tbody>
                        </table>
                    </div>

                    <div>
                        <canvas id="myChart" style="width:100%;max-width:1200px;margin:auto;margin-bottom:5%"></canvas>
                    </div>

                    </form>
                    <script>
                        var xValues = [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60];
                        new Chart("myChart", {
                            type: "line",
                            data: {
                                labels: xValues,
                                BoderColor: "black",
                                datasets: [{
                                        backgroundColor: "rgba(255, 0, 0,0.1)",
                                        data: [3.4, 4.3, 5.2, 6, 6.7, 7.3, 7.8, 8.3, 8.7, 9.1, 9.5, 9.8, 10.1, 10.3, 10.5, 10.8, 11, 11.3, 11.5, 11.7, 11.9, 12.1, 12.3, 12.5, 12.7, 12.9, 13.1, 13.3, 13.5, 13.7, 13.8, 14, 14.2, 14.3, 14.4, 14.6, 14.7, 14.9, 15.1, 15.3, 15.5, 15.7, 15.9, 16.1, 16.3, 16.5, 16.6, 16.8, 17, 17.2, 17.3, 17.5, 17.7, 17.8, 18, 18.1, 18.3, 18.4, 18.5, 18.7, 18.8],
                                        borderColor: "red",
                                        label: "over weight",
                                        fill: true
                                    }, {
                                        backgroundColor: "rgba(0, 0, 0,0.3)",
                                        data: [2.3, 2.9, 3.4, 4, 4.6, 5.1, 5.6, 6, 6.4, 6.7, 7.1, 7.3, 7.6, 7.8, 8, 8.2, 8.4, 8.5, 8.7, 8.9, 9, 9.2, 9.3, 9.5, 9.6, 9.8, 9.9, 10.1, 10.2, 10.3, 10.5, 10.6, 10.8, 10.9, 11.1, 11.2, 11.3, 11.4, 11.6, 11.7, 11.8, 11.9, 12.1, 12.2, 12.3, 12.4, 12.6, 12.7, 12.8, 12.9, 13, 13.2, 13.3, 13.4, 13.5, 13.6, 13.7, 13.8, 13.875, 13.95, 14],
                                        label: "under weight",
                                        borderColor: "black",
                                        fill: true
                                    },
                                    {
                                        data: <?php echo $report2->getWeightArray(); ?>,
                                        connectNullData: true,
                                        borderColor: "green",
                                        label: "weight of the child",
                                        fill: false
                                    }
                                ]
                            },
                            options: {
                                legend: {
                                    display: true,
                                    labels: {
                                        fontColor: 'black',
                                        fontSize: 18
                                    }
                                },
                                scales: {
                                    xAxes: [{
                                        display: true,
                                        gridLines: {
                                            display: true,
                                            lineWidth: 1,
                                            color: 'black'
                                        },
                                        ticks: {
                                            fontColor: "black",
                                        },
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Months',
                                            fontSize: 18,
                                            fontColor: 'black'
                                        }
                                    }],
                                    yAxes: [{
                                        display: true,
                                        gridLines: {
                                            display: true,
                                            lineWidth: 2,
                                            color: 'black'
                                        },
                                        ticks: {
                                            fontColor: "black",
                                        },
                                        scaleLabel: {
                                            display: true,
                                            labelString: 'Weight',
                                            fontSize: 18,
                                            fontColor: 'black'
                                        }
                                    }]
                                }
                            }
                        });
                    </script>

                    <script type="text/javascript">
                        document.getElementById('add_vaccine').value = "<?php echo ($add_vaccine == '') ? -1 : $add_vaccine;; ?>";
                    </script>
                    <script type="text/javascript">
                        document.getElementById('edit_vaccine').value = "<?php echo ($edit_vaccine == '') ? -1 : $edit_vaccine;; ?>";
                    </script>
                    <script type="text/javascript">
                        document.getElementById('edit_NVdate').value = "<?php echo ($edit_vaccine == '') ? -1 : $edit_vaccine;; ?>";
                    </script>

                    <script>
                        function editVaccination(e) {
                            var vaccine_data = <?php echo json_encode($vaccine_data); ?>;
                            var vacccine = vaccine_data[e.target.value];
                            const arr = vacccine.split("_");
                            const date = arr[0].split("/");
                            document.getElementById("edit_date").value = date[0].concat("-", date[1], "-", date[2]);
                            if (arr[1] === undefined) {
                                document.getElementById("edit_place").value = '';
                            } else {
                                document.getElementById("edit_place").value = arr[1];
                            }
                            if (arr[1] === undefined) {
                                document.getElementById("edit_comment").value = '';
                            } else {
                                document.getElementById("edit_comment").value = arr[2];
                            }
                        };
                    </script>

                    <script>
                        for (let index = 0; index < <?php echo $last_vaccination; ?>; index++) {
                            document.getElementById(index).hidden = true;
                        }
                    </script>
                    <script>
                        function editVaccination(e) {
                            document.getElementById("back").href = function() {
                                let user = <?php echo json_encode($_SESSION['role']); ?>;
                                if (user == "midwife") {
                                    "midwife.php";
                                } else if (user == "manager") {
                                    "child report.php";
                                } else if (user = "parent") {
                                    "dashboard.php";
                                }
                            };
                        }
                    </script>
                    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

                <?php } ?>

</body>

</html>