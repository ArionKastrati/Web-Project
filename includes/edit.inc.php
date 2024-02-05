<?php 
    if(isset($_POST["save"])){

        require "../db/db-inc.php";
        require "functions.inc.php";

        $fullname = $_POST["fullname"];
        $username = $_POST['username'];
        $email = $_POST["email"];
        $password = $_POST["password"];
        $pwdRepeat = $_POST["pwdRepeat"];
        $profilePic = $_POST["profilePic"];


        if(emptyInputEdit($fullname, $username, $email, $password, $pwdRepeat) !== false){
            header('location: ../profile.php?edit=error-emptyinput');
        exit();
        }

        if(invalidUsername($username) !== false){
            header('location: ../profile.php?edit=error-invalidusername');
        exit();
        }

        if(invalidEmail($email) !== false){
            header('location: ../profile.php?edit=error-invalidemail');
        exit();
        }

        if(pwdMatch($password, $pwdRepeat) !== false){
            header('location: ../profile.php?edit=error-pwdsdontmatch');
        exit();
        }

        editUserData($conn, $username, $fullname, $email, $password);

        changeProfilePic($conn, $profilePic);
    }
    else{

    }