<?php

// Database connection
include('config/db.php');

// Swiftmailer library
require_once './lib/vendor/autoload.php';

if (isset($_SESSION['login'])) {
    header("Location: ./dashboard.php");
}
global $wrongPwdErr, $accountNotExistErr, $emailPwdErr, $verificationRequiredErr, $email_empty_err, $pass_empty_err, $notification_err, $notification_success;

if (isset($_POST['login'])) {
    $email_signin        = $_POST['email_signin'];
    $password_signin     = $_POST['password_signin'];

    // clean data 
    $user_email = filter_var($email_signin, FILTER_SANITIZE_EMAIL);
    $pswd = mysqli_real_escape_string($connection, $password_signin);

    // Query if email exists in db
    $sql = "SELECT * From user WHERE email = '{$email_signin}' ";
    $query = mysqli_query($connection, $sql);
    $rowCount = mysqli_num_rows($query);

    // If query fails, show the reason 
    if (!$query) {
        die("SQL query failed: " . mysqli_error($connection));
    }

    if (!empty($email_signin) && !empty($password_signin)) {
        if (!preg_match("/^(?=.*\d)(?=.*[@#\-_$%^&+=§!\?])(?=.*[a-z])(?=.*[A-Z])[0-9A-Za-z@#\-_$%^&+=§!\?]{6,20}$/", $pswd)) {
            $wrongPwdErr = '<div class="alert alert-danger">
                        Password should be between 6 to 20 charcters long, contains atleast one special chacter, lowercase, uppercase and a digit.
                    </div>';
        }
        // Check if email exist
        if ($rowCount <= 0) {
            $accountNotExistErr = '<div class="alert alert-warning text-center ">
                        User account does not exist
                    </div>';
        } else {
            // Fetch user data and store in php session
            while ($row = mysqli_fetch_array($query)) {
                $id            = $row['id'];
                $firstname     = $row['firstname'];
                $lastname      = $row['lastname'];
                $email         = $row['email'];
                $mobilenumber   = $row['mobilenumber'];
                $pass_word     = $row['password'];
                $token         = $row['token'];
                $is_active     = $row['is_active'];
                $role          = $row['role'];
            }

            // Verify password
            $password = password_verify($password_signin, $pass_word);

            // Allow only verified user
            if ($is_active == '1') {
                if ($email_signin == $email && $password_signin == $password) {
                    if ($role == 'parent') {
                        header("Location: ./dashboard.php");
                    }
                    if ($role == 'midwife') {
                        header("Location: ./midwife.php");
                    }
                    if ($role == 'manager') {

                        $child_reports = $connection->query("SELECT * FROM child_report ORDER BY Birthday ASC");
                        if ($child_reports->num_rows > 0) {
                            // $i = 0;
                            while ($row = $child_reports->fetch_assoc()) {
                                if (14 >= (strtotime($row['NVD']) - strtotime(date("Y-m-d", time()))) / 86400 && !$row['Notified_V']) {
?>
                                    <!-- <script type="text/javascript">
                                        $(document).ready(function() {
                                            $('#myModal').modal('show');
                                        });
                                    </script> -->
<?php
                                    $parent_req = $connection->query("SELECT * FROM user WHERE id = '{$row['GuardianId']}'");
                                    if ($parent_req->num_rows > 0) {
                                        while ($parent = $parent_req->fetch_assoc()) {
                                            $parent_email = $parent['email'];
                                        }

                                        $msg = 'Next vaccination of ' . $row['Name'] . ' is on ' . $row['NVD'];

                                        // Create the Transport
                                        $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                                            ->setUsername('childcare.cse@gmail.com')
                                            ->setPassword('childcare19');

                                        // Create the Mailer using your created Transport
                                        $mailer = new Swift_Mailer($transport);
                                        // Create a message
                                        $message = (new Swift_Message('Child Care - Vaccination'))
                                            ->setFrom([$parent_email => 'Child Care'])
                                            ->setTo($parent_email)
                                            ->addPart($msg, "text/html")
                                            ->setBody('Hello! User');

                                        // Send the message
                                        $result = $mailer->send($message);

                                        if (!$result) {
                                            $notification_err = '<div class="alert alert-danger text-center">
                                            Notification emails coud not be sent!
                                            </div>';
                                        } else {
                                            $connection->query("UPDATE child_report SET Notified_V = '1' WHERE ChildId = '{$row['ChildId']}'");
                                            $notification_success = '<div class="alert alert-success text-center">
                                            Notification emails have been sent!
                                            </div>';
                                        }
                                    }
                                }
                                if ($row['Weight'] != '' || $row['Weight'] != NULL) {
                                    $split = explode(',', $row['Weight']);
                                    $last_weight_record = end($split);
                                    $split = explode('_', $last_weight_record);
                                    $last_weight_date = array_shift($split);

                                    if (14 <= (strtotime(date("Y-m-d", time())) - strtotime($last_weight_date)) / 86400 && !$row['Notified_W']) {

                                        $parent_req = $connection->query("SELECT * FROM user WHERE id = '{$row['GuardianId']}'");
                                        if ($parent_req->num_rows > 0) {
                                            while ($parent = $parent_req->fetch_assoc()) {
                                                $parent_email = $parent['email'];
                                            }

                                            $msg = 'Next recording of weight of ' . $row['Name'] . ' is on ' . date('Y-m-d', strtotime($last_weight_date . ' + 28 days'));

                                            // Create the Transport
                                            $transport = (new Swift_SmtpTransport('smtp.gmail.com', 465, 'ssl'))
                                                ->setUsername('childcare.cse@gmail.com')
                                                ->setPassword('childcare19');

                                            // Create the Mailer using your created Transport
                                            $mailer = new Swift_Mailer($transport);
                                            // Create a message
                                            $message = (new Swift_Message('Child Care - Recording of Weight'))
                                                ->setFrom([$parent_email => 'Child Care'])
                                                ->setTo($parent_email)
                                                ->addPart($msg, "text/html")
                                                ->setBody('Hello! User');

                                            // Send the message
                                            $result = $mailer->send($message);

                                            if (!$result) {
                                                $notification_err = '<div class="alert alert-danger text-center">
                                            Notification emails coud not be sent!
                                            </div>';
                                            } else {
                                                $connection->query("UPDATE child_report SET Notified_W = '1' WHERE ChildId = '{$row['ChildId']}'");
                                                $notification_success = '<div class="alert alert-success text-center">
                                            Notification emails have been sent!
                                            </div>';
                                            }
                                        }
                                    }
                                } // $i += 1;
                            }
                        }
                        header("Location: ./manager.php");
                    }

                    $_SESSION['id'] = $id;
                    $_SESSION['firstname'] = $firstname;
                    $_SESSION['lastname'] = $lastname;
                    $_SESSION['email'] = $email;
                    $_SESSION['mobilenumber'] = $mobilenumber;
                    $_SESSION['token'] = $token;
                    $_SESSION['login'] = 1;
                    $_SESSION['role'] = $role;
                    $_SESSION['viewer'] = '';
                } else {
                    $emailPwdErr = '<div class="alert alert-danger text-center">
                    Password incorrect
                    </div>';
                }
            } else {
                $verificationRequiredErr = '<div class="alert alert-warning text-center">
                            Account verification is required for login
                        </div>';
            }
        }
    } else {
        if (empty($email_signin)) {
            $email_empty_err = true;
        }

        if (empty($password_signin)) {
            $pass_empty_err = true;
        }
    }
}
