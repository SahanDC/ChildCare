<?php
include_once('config/db.php');

// if (!isset($_SESSION['login'])) {
//     header("Location: ./login.php");
// }

// print_r($_POST);// print_r($_POST);
$ChildId;
$name = '';
$age = '';
$guardian = '';
$birth_place = '';
$user = $_SESSION['role'];
//$user = "manager";
//$user = "parent";
$last_vaccination;
$vaccine_data = array();
$vaccine = array("BCG Vaccine", "Triple Vaccine", "Triple/Polio Vaccine", "MMR Vaccine", "Japanese Encephalitis Vaccine", "Dual Polio Vaccine", "Hepatitis A, B Vaccine (there are separate vaccines for both A and B as well)", "Anti Rabies Vaccine", "Chicken Pox Vaccine", "Meningicoccal Vaccine");
$database_fields = array('BCG', 'Triple', 'Triple_Polio', 'MMR', 'Japanese_Encephalitis', 'Dual_Polio', 'Hepatitis_AB', 'Anti_Rabies', 'Chicken_Pox', 'Meningicoccal');
$prevents = array("Tuberculosis", "Diptheria/Tetanus/Whooping Cough", "Diptheria/Tetanus/Whooping Cough and Polio", "Measles, Mumps and Rubella", "Japanese Encephalitis", "Polio", "Hepatitis A+B", "Rabies", "Chicken Pox", "Meningitis");
$weights = array();

$edit_vaccine = '';
$edit_date = '';
$edit_NVdate = '';
$edit_place = '';
$edit_comment = '';
$add_vaccine = '';
$add_Vdate = '';
$add_NVdate = '';
$add_place = '';
$add_comment = '';
$add_Wdate = '';
$add_weight = '';
$errors = array();
// print_r($_GET);

function check_req_fields($req_fields)
{
    // checks required fields
    $errors = array();

    foreach ($req_fields as $field) {
        if (empty(trim($_POST[$field]))) {
            $errors[] = $field . ' is required.';
        }
    }
    return $errors;
}

function display_errors($errors)
{
    // format and displays form errors
    echo '<div class="container col-6 text-center bg-danger bg-opacity-75 p-3 rounded">';
    echo '<b>There were error(s) on your form.</b><br>';
    foreach ($errors as $error) {
        $error = ucfirst(str_replace("_", " ", $error));
        echo $error . '<br>';
    }
    echo '</div>';
}

if (isset($_GET['ChildId'])) {
    $ChildId = $_GET['ChildId'];
    //echo $ChildId;
}

if (isset($_POST['edit'])) {
    $last_vaccination = $_POST['last_vaccination'];
    $edit_vaccine = $_POST['edit_vaccine'];
    $edit_date = trim($_POST['edit_date']);
    $edit_NVdate = trim($_POST['edit_NVdate']);
    $edit_place = trim($_POST['edit_place']);
    $edit_comment = trim($_POST['edit_comment']);
    $ChildId = $_POST['ChildId'];
    //echo $edit_vaccine;
    $req_fields = array('edit_date', 'edit_place', 'add_NVdate');
    if ($edit_vaccine != '-1') {
        $errors = array_merge($errors, check_req_fields($req_fields));
        $edit_field = date("Y/m/d", strtotime($edit_date)) . '_' . $edit_place . '_' . $edit_comment;
        //echo $edit_field;
        if (strlen($edit_field) > 200) {
            array_push($errors, "Comment is too long.");
        }
        $ChildId = mysqli_real_escape_string($connection, $ChildId);
        $query = "SELECT * FROM child_report WHERE ChildId = {$ChildId} LIMIT 1";
        $result_set = mysqli_query($connection, $query);
        //print_r($result_set);
        if ($result_set) {
            if (!(mysqli_num_rows($result_set) == 1)) {
                array_push($errors, "Child does not found.");
            }
        }
        if (empty($erors)) {
            $edit_field = mysqli_real_escape_string($connection, $edit_field);
            $query =  "UPDATE child_report SET {$database_fields[(int)$edit_vaccine]} = '{$edit_field}' WHERE ChildId = {$ChildId} LIMIT 1";
            // TO DO:   put the updated next vaccination date to the database
            $result = mysqli_query($connection, $query);
            if (!$result) {
                // NOTquery successful
                $errors[] = 'Failed to modify the record.';
            } else {
                $edit_vaccine = '-1';
                $edit_date = '';
                $edit_place = '';
                $edit_comment = '';
            }
        }
    } else {
        array_push($errors, "Choose a vaccine.");
    }
    //print_r($errors);

}

if (isset($_POST['add_V'])) {
    $last_vaccination = $_POST['last_vaccination'];
    $add_vaccine = $_POST['add_vaccine'];
    $add_Vdate = $_POST['add_Vdate'];
    $add_NVdate = $POST['add_NVdate'];
    $add_place = $_POST['add_place'];
    $add_comment = $_POST['add_comment'];
    $ChildId = $_POST['ChildId'];
    $req_fields = array('add_Vdate', 'add_place');
    if ($add_vaccine != '-1') {
        $errors = array_merge($errors, check_req_fields($req_fields));
        $add_field = date("Y/m/d", strtotime($add_Vdate)) . '_' . $add_place . '_' . $add_comment;
        //echo $add_field;
        if (strlen($add_field) > 200) {
            array_push($errors, "Comment is too long.");
        }
        $ChildId = mysqli_real_escape_string($connection, $ChildId);
        $query = "SELECT * FROM child_report WHERE ChildId = {$ChildId} LIMIT 1";
        $result_set = mysqli_query($connection, $query);
        //print_r($result_set);
        if ($result_set) {
            if (!(mysqli_num_rows($result_set) == 1)) {
                array_push($errors, "Child does not found.");
            }
        }
        if (empty($errors)) {
            $edit_field = mysqli_real_escape_string($connection, $add_field);
            $query =  "UPDATE child_report SET {$database_fields[(int)$add_vaccine]} = '{$add_field}' WHERE ChildId = {$ChildId} LIMIT 1";
            // TO DO:   put the next vaccination date to the database
            $result = mysqli_query($connection, $query);
            if (!$result) {
                // NOTquery successful
                $errors[] = 'Failed to modify the record.';
            } else {
                $add_vaccine = '-1';
                $add_Vdate = '';
                $add_place = '';
                $add_comment = '';
            }
        }
    } else {
        array_push($errors, "Choose a vaccine.");
    }
    //print_r($errors);
}

if (isset($_POST['add_W'])) {
    $add_Wdate = $_POST['add_Wdate'];
    $add_weight = $_POST['add_weight'];
    $ChildId = $_POST['ChildId'];
    $added_weights = $_POST['added_weights'];
    $req_fields = array('add_Wdate', 'add_weight');
    $errors = array_merge($errors, check_req_fields($req_fields));
    $add_Wfield = $added_weights . ',' . date("Y/m/d", strtotime($add_Wdate)) . '_' . $add_weight;
    //echo $add_field;
    $ChildId = mysqli_real_escape_string($connection, $ChildId);
    $query = "SELECT * FROM child_report WHERE ChildId = {$ChildId} LIMIT 1";
    $result_set = mysqli_query($connection, $query);
    //print_r($result_set);
    if ($result_set) {
        if (!(mysqli_num_rows($result_set) == 1)) {
            array_push($errors, "Child does not found.");
        }
    }
    if (empty($errors)) {
        $add_Wfield = mysqli_real_escape_string($connection, $add_Wfield);
        $query =  "UPDATE child_report SET Weight = '{$add_Wfield}' WHERE ChildId = {$ChildId} LIMIT 1";
        $result = mysqli_query($connection, $query);
        if (!$result) {
            // NOTquery successful
            $errors[] = 'Failed to modify the record.';
        } else {
            $add_Wdate = '';
            $add_weight = '';
        }
    }
    //print_r($errors);
}



$ChildId = mysqli_real_escape_string($connection, $ChildId);
$query = "SELECT * FROM child_report WHERE ChildId = {$ChildId} LIMIT 1";

$result_set = mysqli_query($connection, $query);
//print_r($result_set);

if ($result_set) {
    if (mysqli_num_rows($result_set) == 1) {
        // user found
        $result = mysqli_fetch_assoc($result_set);
        //print_r($result);
        $name = $result['Name'];
        $age = round((strtotime(date("Y-m-d", time())) - strtotime($result['Birthday'])) / (60 * 60 * 24 * 30));
        $guardian = $result['Guardian'];
        $birth_place = $result['BirthPlace'];
        $vaccine_data   = array($result['BCG'], $result['Triple'], $result['Triple_Polio'], $result['MMR'], $result['Japanese_Encephalitis'], $result['Dual_Polio'], $result['Hepatitis_AB'], $result['Anti_Rabies'], $result['Chicken_Pox'], $result['Meningicoccal']);
        for ($v = 0; $v < count($vaccine_data); $v++) {
            if (empty($vaccine_data[$v])) {
                $last_vaccination = $v;
                break;
            }
        }
        $weights = explode(',', $result['Weight']);
        //print_r($weights);
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
    <title>Document</title>
    <style>
        body {
            background-color: white;
        }
    </style>
</head>

<body>
    <div class="row h4 p-1 bg-primary">
        <div class="col-2 text-center  ">Child Report</div>
        <div class="col-8 text-capitalized bg-primary text-center "><?php echo $ChildId ?></div>
        <div class="col bg-primary text-center"><button type="button"  id = "back" onclick="goBack(this)" class="btn btn-dark m1-2">BACK</button></div>
        <!-- <div class="col bg-primary text-center"><button type="button" onclick=location.href = "./controllers/logout.php" class="btn btn-danger m1-2">Log out</button></div> -->
        <div class="col bg-primary text-center"><a href="./controllers/logout.php" class="btn btn-danger m1-2">Log Out</a></div>
    </div>

    <?php
    if (!empty($errors)) {
        display_errors($errors);
    }
    ?>

    <div class="container mt-5 px-5 ">
        <div class="row">
            <div class="col h3">Name &emsp;&emsp; :- &emsp;<?php echo $name ?></div>
        </div>
        <div class="row">
            <div class="col h3">Age &emsp;&emsp;&emsp; :- &emsp;<?php echo $age ?> months</div>
        </div>
        <div class="row">
            <div class="col h3">Guardian &ensp;&nbsp; :- &emsp;<?php echo $guardian ?></div>
        </div>
        <div class="row">
            <div class="col h3">Birth place &nbsp;:- &emsp;<?php echo $birth_place ?></div>
        </div>
    </div>
    </div>

    <?php
    if (!strcmp($user, "manager")) {?>
        <form action='child_report.php' method='post'>
            <input type='hidden' name='ChildId' value=<?php echo $ChildId ?>>
            <input type='hidden' name='last_vaccination' value=<?php echo $last_vaccination ?>>
            <div class='container mt-5 col-10 px-5 border border-dark border-3'>
            <label for='exampleDataList' class='form-label h2 mt-4'>Edit vaccination details</label>

            <div class='input-group mb-4'> 
            <div class='input-group-prepend'>
                <label class='input-group-text' for='inputGroupSelect01'>Select Vaccine</label>
            </div>
            <select class='col custom-select' name ='edit_vaccine' id='edit_vaccine'  onchange='editVaccination(event)''>
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
                        <input type='date' class='form-control bg-light border-dark' placeholder='Date of Vaccination' id='edit_date' name='edit_date' value=<?php echo $edit_date ?> >
                        </div>
                        <div class='col-2 mt-1'>Place of vaccination :</div>
                        <div class='col-2'>
                        <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Place of Vaccination' id='edit_place' name='edit_place' value=<?php echo $edit_place ?> >
                        </div>
                        <div class='col-2 mt-1'>Next vaccination :</div>
                        <div class='col-2'>
                        <input type='date' class='form-control bg-light border-dark' placeholder='Next Vaccination' name='edit_NVdate' value= <?php echo $edit_NVdate ?> >
                        </div>
                    </div>
                </form>
                <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Comments on Vaccination' id='edit_comment' name='edit_comment' value=<?php echo $edit_comment ?> >
                <div class=' col-11 text-end mb-4'>
                    <button type='submit' class='btn btn-warning px-4 m1-2 rounded ' name='edit' value='submit'>Edit</button>
                </div>
            </div>;
    <?php
    }
    ?>

    <?php
    if (!strcmp($user, "midwife")) {?>
        <form action='child_report.php' method='post'>
            <input type='hidden' name='ChildId' value=<?php echo $ChildId ?>>
            <input type='hidden' name='last_vaccination' value=<?php echo $last_vaccination ?>>
            <div class='container mt-5 col-10 px-5 border border-dark border-3'>
            <label for='exampleDataList' class='form-label h2 mt-4'>Add vaccination details</label>

            <div class='input-group mb-4'> 
            <div class='input-group-prepend'>
                <label class='input-group-text' for='inputGroupSelect01'>Select Vaccine</label>
            </div>
            <select class='col custom-select' name ='add_vaccine' id='add_vaccine''>
            <option value='-1' >Choose...</option>
            <option value='0' id= 0 >BCG Vaccine</option>
            <option value='1' id= 1 >Triple Vaccine</option>
            <option value='2' id= 2 >Triple/Polio Vaccine</option>
            <option value='3' id= 3 >MMR Vaccine</option>
            <option value='4' id= 4 >Japanese Encephalitis Vaccine</option>
            <option value='5' id= 5 >Dual Polio Vaccine</option>
            <option value='6' id= 6 >Hepatitis A, B Vaccine</option>
            <option value='7' id= 7 >Anti Rabies Vaccine</option>
            <option value='8' id= 8 >Chicken Pox Vaccine</option>
            <option value='9' id= 9 >Meningicoccal Vaccine</option>
            </select>
            </div>
    
                <form>
                    <div class='row'>
                        <div class='col-2 mt-1'>Date of vaccination :</div>
                        <div class='col-2'>
                        <input type='date' class='form-control bg-light border-dark' placeholder='Date of Vaccination' name='add_Vdate' value=<?php echo $add_Vdate ?> >
                        </div>
                        <div class='col-2 mt-2'>Place of vaccination :</div>
                        <div class='col-2'>
                        <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Place of Vaccination' name='add_place' value= <?php echo $add_place ?> >
                        </div>
                        <div class='col-2 mt-2'>Next vaccination :</div>
                        <div class='col-2'>
                        <input type='date' class='form-control bg-light border-dark' placeholder='Next Vaccination' name='add_NVdate' value= <?php echo $add_NVdate ?> >
                        </div>
                    </div>
                </form>
                <div class='row'>
                <div class='col mt-1'>Comment  &emsp;:</div>
                <div class='col-10'>
                <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='Comments on Vaccination' name='add_comment' value=<?php echo $add_comment ?> >
                </div>
                </div>
                <div class=' col-11 text-end mb-4'>
                    <button type='submit' class='btn btn-warning px-4 m1-2 rounded ' name='add_V' value='submit'>Add</button>
                </div>
            </div>;
    <?php
    }
    ?>
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
                for ($i = 0; $i < 10; $i++) {
                    echo "<tr class=' border-2'>
                        <td class='col-2 text-break'> $vaccine[$i] </td>";
                    if (strcmp($vaccine_data[$i], "")) {
                        $curr_vaccine = explode("_", $vaccine_data[$i]);
                        echo "<td class='col-2 border-2 text-break text-center'> $curr_vaccine[0]</td>";
                        echo "<td class='col-2 border-2 text-break text-center'> $curr_vaccine[1]</td>";
                    } else {
                        echo "<td class=' border-2'> </td>
                            <td class=' border-2' > </td>";
                    }
                    echo "<td class='col-2 border-2 text-break'> $prevents[$i] </td>";
                    if (strcmp($vaccine_data[$i], "")) {
                        if (strlen($curr_vaccine[2]) == 0) {
                            echo "<td class='col-2 border-2 text-center'> - </td>";
                        } else {
                            echo "<td class='col-2 border-2 text-break'> $curr_vaccine[2]</td>";
                        }
                    } else {
                        echo "<td class=' border-2' > </td>";
                    }
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <?php
    if (!strcmp($user, "midwife")) {
        echo "<form action='child_report.php' method='post'>
            <input type='hidden' name='ChildId' value='" . $ChildId . "'>
            <input type='hidden' name='added_weights' value='" . implode(',', $weights) . "'>
            <div class='container mt-5 col-4 px-5 border border-dark border-3'>
            <label for='exampleDataList' class='form-label h2 mt-4'>Add weight details</label>
                <form>
                    <div class='row'>
                        <div class='col mt-1'>Date of Weight check  &emsp;:</div>
                        <div class='col'>
                        <input type='date' class='form-control bg-light border-dark' placeholder='Date of Weight check' name='add_Wdate' value='" . $add_Wdate . "' >
                        </div>
                    </div>
                    <div class='row mt-3'>
                    <div class='col mt-2'>Weight of the child &emsp;&emsp;:</div>
                        <div class='col'>
                        <input type='text' class='form-control mb-4 bg-light border-dark' placeholder='weight' name='add_weight' value='" . $add_weight . "' >
                        </div>
                    </div>
                </form>
                <div class=' col-11 text-end mb-4'>
                    <button type='submit' class='btn btn-warning px-4 m1-2 rounded ' name='add_W' value='submit'>Add</button>
                </div>
            </div>";
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
                $var_date;
                $weight_chart = "[";
                if ($weights[0] != '') {
                    for ($j = 0; $j < count($weights); $j++) {
                        $curr_weights = explode("_", $weights[$j]);
                        if ($j > 0) {
                            $diff = round(abs(strtotime($curr_weights[0]) - $var_date) / (30 * 24 * 60 * 60));
                            for ($k = 0; $k < $diff - 1; $k++) {
                                $weight_chart .= null;
                                $weight_chart .= ",";
                            }
                        }
                        $weight_chart .= $curr_weights[1] . ",";
                        $var_date = strtotime($curr_weights[0]);
                        echo "<tr class='border-2'>
                                <td class='col-2 border-2 text-break'> $curr_weights[0] </td>
                                <td class='col-2 border-2 text-break'> $curr_weights[1] </td>
                                </tr>";
                    }
                }
                $weight_chart .= "]";
                // print_r($weight_chart);
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
                        data: <?php echo $weight_chart ?>,
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
    <script type="text/javascript">
        let user =<?php echo json_encode($_SESSION['role']) ;?>;
        document.getElementById("back").onclick = function () {
            if (user === "midwife") {
                location.href = "midwife.php";
            }else if(user === "manager"){
                location.href = "requests.php";
            }else if (user = "parent") {
                location.href = "dashboard.php"
            }
    };
</script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

</body>

</html>