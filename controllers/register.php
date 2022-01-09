<?php

include('config/db.php');

// Swiftmailer library
require_once './lib/vendor/autoload.php';

// Error & success messages
global $email_exist, $f_NameErr, $l_NameErr, $_emailErr, $_mobileErr, $_passwordErr;
global $fNameEmptyErr, $lNameEmptyErr, $emailEmptyErr, $mobileEmptyErr, $passwordEmptyErr, $email_verify_err, $email_verify_success;

$_first_name = $_last_name = $_email = $_mobile_number = $_password = $_role = "";

if (isset($_POST["submit"])) {
    $firstname     = $_POST["firstname"];
    $lastname      = $_POST["lastname"];
    $email         = $_POST["email"];
    $mobilenumber  = $_POST["mobilenumber"];
    $password      = $_POST["password"];

    // check if email already exist
    $email_check_query = mysqli_query($connection, "SELECT * FROM user WHERE email = '{$email}' ");
    $rowCount = mysqli_num_rows($email_check_query);

    $email_manager_query =  mysqli_query($connection, "SELECT * FROM manager WHERE email = '{$email}' ");
    $email_midwife_query =  mysqli_query($connection, "SELECT * FROM midwife WHERE email = '{$email}' ");


    if (mysqli_num_rows($email_manager_query) > 0) {
        $role = 'manager';
    } else if (mysqli_num_rows($email_midwife_query) > 0) {
        $role = 'midwife';
    } else {
        $role = 'parent';
    }

    // PHP validation
    // Verify if form values are not empty
    if (!empty($firstname) && !empty($lastname) && !empty($email) && !empty($mobilenumber) && !empty($password)) {

        if ($rowCount > 0) {
            $email_exist = '
                    <div class="alert alert-danger text-center" role="alert">
                        User with email already exist!
                    </div>
                ';
        } else {
            // clean the form data before sending to database
            $_first_name = mysqli_real_escape_string($connection, $firstname);
            $_last_name = mysqli_real_escape_string($connection, $lastname);
            $_email = mysqli_real_escape_string($connection, $email);
            $_mobile_number = mysqli_real_escape_string($connection, $mobilenumber);
            $_password = mysqli_real_escape_string($connection, $password);
            $_role = mysqli_real_escape_string($connection, $role);

            // perform validation
            if (!preg_match("/^[a-zA-Z ]*$/", $_first_name)) {
                $f_NameErr = true;
            }
            if (!preg_match("/^[a-zA-Z ]*$/", $_last_name)) {
                $l_NameErr = true;
            }
            if (!filter_var($_email, FILTER_VALIDATE_EMAIL)) {
                $_emailErr = true;
            }
            if (!preg_match("/^[0][0-9]{9}+$/", $_mobile_number)) {
                $_mobileErr = true;
            }
            if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $_password)) {
                $_passwordErr = true;
            }

            // Store the data in db, if all the preg_match condition met
            if ((preg_match("/^[a-zA-Z ]*$/", $_first_name)) && (preg_match("/^[a-zA-Z ]*$/", $_last_name)) &&
                (filter_var($_email, FILTER_VALIDATE_EMAIL)) && (preg_match("/^[0][0-9]{9}+$/", $_mobile_number)) &&
                (preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{8,20}$/", $_password))
            ) {

                // Generate random activation token
                $token = md5(rand() . time());

                // Password hash
                $password_hash = password_hash($password, PASSWORD_BCRYPT);

                // Query
                $sql = "INSERT INTO user (firstname, lastname, email, mobilenumber, password, token, is_active,
                    date_time, role) VALUES ('{$firstname}', '{$lastname}', '{$email}', '{$mobilenumber}', '{$password_hash}', 
                    '{$token}', '0', now(), '{$role}')";

                // Create mysql query
                $sqlQuery = mysqli_query($connection, $sql);

                if (!$sqlQuery) {
                    die("MySQL query failed!" . mysqli_error($connection));
                }

                // Send verification email
                if ($sqlQuery) {
                    $msg = 'Click on the activation link to verify your email. <br><br>
                          <a href="http://localhost/ChildCare/user_verification.php?token=' . $token . '"> Click here to verify email</a>
                        ';

                    // Create the Transport
                    $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                        ->setUsername('childcare.cse@gmail.com')
                        ->setPassword('childcare19');

                    // Create the Mailer using your created Transport
                    $mailer = new Swift_Mailer($transport);

                    // Create a message
                    $message = (new Swift_Message('Child Care - Email Verification'))
                        ->setFrom([$email => $firstname . ' ' . $lastname])
                        ->setTo($email)
                        ->addPart($msg, "text/html")
                        ->setBody('Hello! User');

                    // Send the message
                    $result = $mailer->send($message);

                    if (!$result) {
                        $email_verify_err = '<div class="alert alert-danger text-center">
                                    Verification email coud not be sent!
                            </div>';
                    } else {
                        $email_verify_success = '<div class="alert alert-success text-center">
                                Verification email has been sent!
                            </div>';
                    }
                }
            }
        }
    } else {
        if (empty($firstname)) {
            $fNameEmptyErr = true;
        }
        if (empty($lastname)) {
            $lNameEmptyErr = true;
        }
        if (empty($email)) {
            $emailEmptyErr = true;
        }
        if (empty($mobilenumber)) {
            $mobileEmptyErr = true;
        }
        if (empty($password)) {
            $passwordEmptyErr = true;
        }
    }
}
