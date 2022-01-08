<?php include('./controllers/login.php'); ?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="css/loginStyle.css">
    
    <title>Login</title>
    <script>
        // var popup_msg = document.getElementById("popup_msg");
        // document.getElementById("sign_in").addEventListener("click", function() {
        //     popup_msg.classList.remove("d-none");
        // });
    </script>
</head>

<body>

    <section class="min-vh-100 align-items-right">
        <div class="container v-100">
            <div class="row justify-content-right align-items-right h-100 my-3">
                <div class="col-lg-5 col-xl-5"></div>
                <div class="col-lg-6 col-xl-6">
                    <div class="card text-black" style="border-radius: 25px;">
                        <div class="card-body p-md-5">
                            <div class="row justify-content-center">
                                <div class="col-md-10 col-lg-10 col-xl-10 order-2 order-lg-1">

                                    <p class=" text-center h4 fw-bold mb-4 mx-1 mx-md-4"><a class="text-dark bor" href="./index.php" style="text-decoration: none;">Child Care</a></p>

                                    <form class="row g-3" action="" method="post">
                                        <!-- <h4><a class="text-dark" href="./index.php" style="text-decoration: none;">Child Care</a></h4> -->

                                        <?php if ($accountNotExistErr || $emailPwdErr || $verificationRequiredErr) {
                                            echo $accountNotExistErr;
                                            echo $emailPwdErr;
                                            echo $verificationRequiredErr;
                                        } else {
                                        ?> <div class="border rounded border-dark alert alert-light text-center" style="display:inline-block;">
                                                Welcome to child care!
                                            </div>
                                        <?php } ?>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="email" class="form-control" name="email_signin" id="email_signin" value="<?php echo isset($_POST["email_signin"]) ? $_POST["email_signin"] : ''; ?>" <?php if ($email_empty_err) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> placeholder="Enter your email" />
                                            </div>
                                        </div>

                                        <div class="d-flex flex-row align-items-center mb-4">
                                            <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                            <div class="form-outline flex-fill mb-0">
                                                <input type="password" class="form-control" name="password_signin" id="password_signin" value="<?php echo isset($_POST["password_signin"]) ? $_POST["password_signin"] : ''; ?>" <?php if ($pass_empty_err) { ?> style="box-shadow: 0 0 5px #CC0000;" <?php } ?> placeholder="Enter your password" />
                                            </div>
                                        </div>


                                        <!-- Button trigger modal -->
                                        <button type="submit" name="login" id="sign_in" class="text-dark border-light btn btn-dark btn-lg btn-block" style="background-color: #e3f2fd">Sign
                                            in</button>


                                        <a href="./signup.php" style="text-decoration: none;"> Haven't an account?</a>
                                    </form>
                                </div>
                                <!-- <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                                    <img src="https://mdbootstrap.com/img/Photos/new-templates/bootstrap-registration/draw1.png" class="img-fluid" alt="Sample image">

                                </div> -->
                                <!-- Modal -->
                                <div class="modal-fullscreen fade d-none" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" id="popup_msg">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Logging to Manager account</h5>
                                                <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
                                            </div>
                                            <div class="modal-body">
                                                Sending notifications to parents...
                                            </div>
                                            <!-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                </div> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>