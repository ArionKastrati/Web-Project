<?php 

    if(isset($_POST['submit'])){

        $fullname = $_POST["fullname"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $pwdRepeat = $_POST["pwdrepeat"];
        $userRole = "Normal User";
        $adminRole = "Admin";

        require_once "../db/db-inc.php";
        require_once "functions.inc.php";

        if(emptyInputSignup($fullname, $username, $email, $password, $pwdRepeat) !== false){
            header('location: ../register.php?error=emptyinput');
        exit();
        }

        if(invalidUsername($username) !== false){
            header('location: ../register.php?error=invalidusername');
        exit();
        }

        if(invalidEmail($email) !== false){
            header('location: ../register.php?error=invalidemail');
        exit();
        }

        if(pwdMatch($password, $pwdRepeat) !== false){
            header('location: ../register.php?error=pwdsdontmatch');
        exit();
        }

        if(usernameExists($conn, $username, $email) !== false){
            header('location: ../register.php?error=usernametaken');
        exit();
        }


        createUser($conn, $username, $fullname, $email, $password, $userRole);
    }
    else{
        header('location: ../register.php');
        exit();
    }