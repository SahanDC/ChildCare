<?php include('./controllers/register.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="./css/styles.css">
    <title>Register</title>
</head>

<body>

    <!-- <div class="App"> -->
    <!-- <div class="vertical-center"> -->
    <!-- <div class="container"> -->
    <section class="min-vh-100 d-flex align-items-center" style="background-color: #eee;">
        <div class="container v-100">
            <div class="row d-flex justify-content-center align-items-center h-100 my-3">
                <div class="col-md-12 col-lg-9 col-xl-8">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body py-sm-5 py-md-5 px-lg-0">
                            <div class="row justify-content-center">
                                <div class="col-md-12 col-lg-9 col-xl-8 order-2 order-lg-1">

                                    <p class="text-center h4 fw-bold mb-4 mx-1 mx-md-4"><a class="text-dark bor" href="./index.php" style="text-decoration: none;">Child Care</a></p>

                                    <form class="row g-3" action="" method="post">
                                        <!-- <h4><a class="text-dark bor" href="./index.php" style="text-decoration: none;">Child Care</a></h4> -->

                                        <?php echo $email_exist; ?>
                                        <?php echo $email_verify_err; ?>
                                        <?php echo $email_verify_success; ?>

                                        <div class="form-group col-md-6">
                                            <label>First name</label>
                                            <input type="text" class="form-control" name="firstname" id="firstName" value="<?php echo isset($_POST["firstname"]) ? $_POST["firstname"] : ''; ?>" <?php if ($fNameEmptyErr || $f_NameErr) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> />

                                            <div id="emailHelpBlock" class="form-text">
                                                Enter parent's first name. Only letters and white space allowed.
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>Last name</label>
                                            <input type="text" class="form-control" name="lastname" id="lastName" value="<?php echo isset($_POST["lastname"]) ? $_POST["lastname"] : ''; ?>" <?php if ($lNameEmptyErr || $l_NameErr) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> />
                                            <div id="emailHelpBlock" class="form-text">
                                                Enter parent's last name. Only letters and white space allowed.
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Email</label>
                                            <input type="email" class="form-control" name="email" id="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" <?php if ($emailEmptyErr || $_emailErr) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> />
                                            <div id="emailHelpBlock" class="form-text">
                                                You need to activate your child care account using this email.
                                            </div>

                                        </div>

                                        <div class="form-group">
                                            <label>Mobile</label>
                                            <input type="text" class="form-control" name="mobilenumber" id="mobilenumber" value="<?php echo isset($_POST["mobilenumber"]) ? $_POST["mobilenumber"] : ''; ?>" <?php if ($mobileEmptyErr || $_mobileErr) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> />

                                            <div id="mobileHelpBlock" class="form-text">
                                                Your mobile number must be 10 digits long.
                                            </div>

                                        </div>

                                        <div class="form-group mb-3">
                                            <label>Password</label>
                                            <input type="password" class="form-control" name="password" id="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>" aria-describedby="passwordHelpBlock" <?php if ($passwordEmptyErr || $_passwordErr) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> />

                                            <div id="passwordHelpBlock" class="form-text">
                                                Your password must be 6-20 characters long, contain atleast one special chacter, lowercase, uppercase and a digit.
                                            </div>

                                        </div>

                                        <button type="submit" name="submit" id="submit" class="text-dark border-light btn btn-dark btn-lg btn-block" style="background-color: #e3f2fd">Sign up
                                        </button>
                                        <br>
                                        <a href="./login.php" style="text-decoration: none;"> Already registered?</a>
                                    </form>

                                </div>
                                <!-- <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

                                </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- </div> -->
    <!-- </div> -->
    <!-- </div> -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>