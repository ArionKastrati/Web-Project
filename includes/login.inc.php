<?php 

if(isset($_POST["submit"])){
    $username = $_POST["username"];
    $password = $_POST["password"];
    // $email = $_POST["email"];


    require_once "../db/db-inc.php";
    require_once "functions.inc.php";

    if(emptyInputLogin($username, $password) !== false){
        header('location: ../login.php?error=emptyinput');
        exit();
    }

    if(usernameExistsLogin($conn, $username) !== false){
        header('location: ../login.php?error=nodata');
        exit();
    }
    
    $credentialsPath = 'C:\Users\Admin\Desktop\client_secret_838510638977-gchqcq492gu7ue3st54i7cdqki1dgm7t.apps.googleusercontent.com.json';
    $clientId = '838510638977-gchqcq492gu7ue3st54i7cdqki1dgm7t.apps.googleusercontent.com';
    $clientSecret = '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';
    $recipientEmail = "dionk3333@gmail.com";

    createSendEmail();

    loginUserAndSendEmail($conn, $username, $password, $credentialsPath, $clientId, $clientSecret, $recipientEmail);

}
else{
    header("Location: ../login.php");
    exit();
}