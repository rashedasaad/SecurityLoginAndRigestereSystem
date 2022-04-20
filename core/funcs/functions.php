<?php
session_start();
include_once "../database/DB.php";

class signup extends randomUserId
{

    public function registration($tabel, $email, $password, $passwordConfirm, $MsgIfThePassIsNotTheSame, $MsgIfThereIsAccount)
    {

        $random = new randomUserId;
        mysql_escape_string($email);
        mysql_escape_string($password);
        mysql_escape_string($passwordConfirm);
        global $con;
        $regex = "/^[a-zA-Z\d\._]+@[a-zA-Z\d\._]+\.[a-zA-Z\d\.]{2,}+$/";
        $user_email = filter_var($email, FILTER_VALIDATE_EMAIL);
        $user_email = preg_match($regex, $email);
        $user_pass = password_hash($password, PASSWORD_DEFAULT);

        $ema = strip_tags($user_email);
        $pass = strip_tags($user_pass);



        if (!empty($ema) && !empty($pass)) {

            $query = "SELECT * FROM $tabel WHERE email='$email'";
            $result = mysqli_query($con, $query);
            $row = mysqli_num_rows($result);
            if ($row == 0) {
                if ($password === $passwordConfirm) {

                    $user_id =  $random->random_num(20);
                    $query = "INSERT INTO user(user_id,email, password) VALUES('$user_id','$email','$pass')";
                    mysqli_query($con, $query);
                    header("Location: http://localhost/SecurityLoginAndRigestereSystem/core/router/login.php");
                    die;
                } else {

                    echo $MsgIfThePassIsNotTheSame;
                }
            } else {

                echo $MsgIfThereIsAccount;
            }
        } else {
            echo "please type in";
        }
    }
}




if (!empty($_POST['token'])) {
    if (hash_equals($_SESSION['token'], $_POST['token'])) {
        // Proceed to process the form data
    } else {
        // Log this as a warning and keep an eye on these attempts
    }
}

class loginpage
{
    public function login($tabel, $email, $password, $csrf_token, $homepath)
    {
        global $con;

        $user_email = $email;
        $user_pass = $password;

        $email = strip_tags($user_email);
        $pass = strip_tags($user_pass);
        $el = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!empty($csrf_token)) {
            if (hash_equals($_SESSION['csrf_token'], $csrf_token)) {
                if (!empty($user_email) && !empty($user_pass)) {


                    $query = "SELECT * FROM  $tabel WHERE email = '$el' LIMIT 1 ";


                    $result = mysqli_query($con, $query);


                    if ($result) {

                        if ($result && mysqli_num_rows($result) > 0) {

                            $user_data = mysqli_fetch_assoc($result);

                            if (password_verify($pass, $user_data['password'])) {
                                session_regenerate_id(true);

                                $_SESSION['user_id'] = $user_data['user_id'];

                                header("Location: " . $homepath);

                                exit();
                            }
                            return 1;
                        } else {
                            echo "Chech if the password is correct or the email";
                        }
                    }
                } else {

                    echo "write in the input";
                }
            }
        }
    }
}

class randomUserId
{


    public function random_num($length)
    {

        if ($length < 5) {
            $length = 5;
        }
        $len = rand(111212342342343411, $length);

        return $len;
    }
}

class check
{


    public function check_login($Table,$IfNotLoginLink)
    {

        global $con;
        if (isset($_SESSION['user_id'])) {

            $id = $_SESSION['user_id'];
            $query = "select * from $Table where user_id = '$id' limit 1";
            $result = mysqli_query($con, $query);

            if ($result && mysqli_num_rows($result) > 0) {

                $user_data = mysqli_fetch_assoc($result);
                return $user_data;
            }
        }

        header("Location: $IfNotLoginLink");
        die;
    }
}

class Security
{

    public function csrf()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        $token = $_SESSION['csrf_token'];
    }
    public function Validation($inputpost)
    {
        $regex = "/^[a-zA-Z\s0-9\d\.]+$/";
        preg_match($regex, $inputpost);
    }
}
