<?php 

    // Sign up functions
    function emptyInputSignup($fullname, $username, $email, $password, $pwdRepeat){
        $result;
        if(empty($fullname) || empty($username) || empty($email) || empty($password) || empty($pwdRepeat)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidUsername($username){
        $result;
        if(!preg_match("/^[a-zA-Z0-9]*$/", $username)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function invalidEmail($email){
        $result;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function pwdMatch($password, $pwdRepeat){
        $result;
        if($password !== $pwdRepeat){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function usernameExists($conn, $username, $email){
        $sql = "SELECT * FROM tblusers WHERE username = ? OR email = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location: ../register.php?error=stmtfailed');
            exit();
        }
        mysqli_stmt_bind_param($stmt, "ss", $username, $email);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function usernameExistsLogin($conn, $username){
        $sql = "SELECT * FROM tblusers WHERE username = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location: ../register.php?error=stmtfailed');
            exit();
        }
        mysqli_stmt_bind_param($stmt, "s", $username);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return false;
        }
        else{
            $result = true;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function wrongUsername($conn, $username, $password){
        $sql = "SELECT * FROM tblusers WHERE username = ? AND hashedPassword = ?";
        $stmt = mysqli_stmt_init($conn);

        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location: ../register.php?error=stmtfailed');
            exit();
        }

        mysqli_stmt_bind_param($stmt, "ss", $username, $password);
        mysqli_stmt_execute($stmt);

        $resultData = mysqli_stmt_get_result($stmt);

        if($row = mysqli_fetch_assoc($resultData)){
            return $row;
        }
        else{
            $result = false;
            return $result;
        }

        mysqli_stmt_close($stmt);
    }

    function  createUser($conn, $username, $fullname, $email, $password, $userRole){
        $sql = "INSERT INTO tblusers(username, fullname, email, hashedPassword, user_role) VALUES(?, ?, ?, ?, ?);";
        $stmt = mysqli_stmt_init($conn);
       
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header('location: ../register.php?error=stmtfailed');
            exit();
        }

        $normalUser = "Normal user";

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        mysqli_stmt_bind_param($stmt, "sssss", $username, $fullname, $email, $hashedPassword, $normalUser);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        header('location: ../register.php?error=none');
        exit();
    }

    


    //Login functions    
    function emptyInputLogin($username, $password){
        $result;
        if(empty($username) || empty($password)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function generateUniqueToken() {
        return uniqid();
    }
    

    function loginUser($conn, $username, $password){
        $usernameExists = usernameExists($conn, $username, $username); // Logjika OR ne funksionin me larte me emrin e njejt ne lejon qe njera prej 
                                                                       // dy kushteve te plotesohet qe useri ose te vendos emailin ose usernamein
        if($usernameExists === false){
            header("Location ../login.php?error=worngdata");
            exit();
        }

        $hashedPassword = $usernameExists["hashedPassword"]; // Pasi qe usernameExist eshte nje funksion qe merr te dhenat ne metoden asocc 
                                                            // ne mund te marrim emrin e nje kolone ne db dhe me nxierr te dhena prej saj
        $plainPassword = password_verify($password, $hashedPassword);

        if($plainPassword === false){
            header("Location: ../login.php?error=wrongdata");
            exit();
        }

        else if($plainPassword === true){
            session_start();
            $_SESSION["fullname"] = $usernameExists["fullname"];
            $_SESSION["userid"] = $usernameExists["user_id"];
            $_SESSION["username"] = $usernameExists["username"];
            $_SESSION["profilePic"] = $usernameExists["profile_pic"];
            $_SESSION["email"] = $usernameExists["email"];
            $_SESSION["user_role"] = $usernameExists["user_role"];
            $_SESSION["password"] = $password;

            $token = generateUniqueToken(); // Generate a unique token
            setcookie('auth_token', $token, time() + (1440)); // Set cookie for 1 hour


            if($usernameExists["user_role"] == "Normal user"){
                header("Location: ../index.php?");
                exit();
            }
            else if($usernameExists["user_role"] == "Admin"){
                header("Location: ../admin/adminDashboard.php");
                exit();
            }
            exit();
        }
    }

    function editUserData($conn, $username, $fullname, $email, $password){
        $usernameExists = usernameExists($conn, $username, $username);
        $_SESSION['userid'] = $usernameExists["user_id"];
        if(isset($_POST["save"])){
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $query = "UPDATE tblusers
                      SET username = '$username', fullname = '$fullname', email = '$email', hashedPassword = '$hashedPassword'
                      WHERE user_id = ".$_SESSION['userid']."";
            $resutls = mysqli_query($conn, $query);

            if($results){
                echo "Data updated successfully";
            }
            else {
                echo "Data not updated";
            }
            mysqli_close($conn);
            

            header("location: ../profile.php?edit=false");
            exit();
    }
}

    //Edit data functions


    function emptyInputEdit($fullname, $username, $email, $password, $pwdRepeat){
        $result;
        if(empty($fullname) || empty($username) || empty($email) || empty($password) || empty($pwdRepeat)){
            $result = true;
        }
        else{
            $result = false;
        }
        return $result;
    }

    function addFavorites($conn, $userId, $username, $bookId){
        if (isset($_POST['favbtn'])) {
            // Insert the favorite into the tblfavorites table
            // Prepare the statement
            $stmt = mysqli_prepare($conn, "INSERT INTO tblfavorites (user_id, username, book_id) VALUES (?, ?, ?)");
        
            if ($stmt) {
                // Bind the values to the statement
                if (mysqli_stmt_bind_param($stmt, "isi", $userId, $username, $bookId)) {
                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Success
                        echo "Statement executed successfully.";
                        header("location: ../shop.php");
                        exit();
                    } else {
                        // Check for duplicate primary key error
                        if (mysqli_errno($conn) === 1062) {
                            // Duplicate primary key error occurred
                            echo "Duplicate primary key error. This favorite already exists.";
                            header("location: ../shop.php");
                            exit();
                        } else {
                            // Error during execution
                            echo "Error executing statement: " . mysqli_stmt_error($stmt);
                            header("location: ../shop.php");
                            exit();
                        }
                    }
                } else {
                    // Error binding parameters
                    echo "Error binding parameters: " . mysqli_stmt_error($stmt);
                    header("location: ../shop.php");
                    exit();
                }
        
                mysqli_stmt_close($stmt);
            } else {
                // Error preparing statement
                echo "Error preparing statement: " . mysqli_error($conn);
                header("location: ../shop.php");
                exit();
            }
        }        

            header("location: ../shop.php");
            exit();
        }
    
    function justArrivedAddFavorites($conn, $userId, $username, $bookId){
        if (isset($_POST['favbtn'])) {
            // Insert the favorite into the tblfavorites table
            // Prepare the statement
            $stmt = mysqli_prepare($conn, "INSERT INTO tblfavorites (user_id, username, book_id) VALUES (?, ?, ?)");
        
            if ($stmt) {
                // Bind the values to the statement
                if (mysqli_stmt_bind_param($stmt, "isi", $userId, $username, $bookId)) {
                    // Execute the statement
                    if (mysqli_stmt_execute($stmt)) {
                        // Success
                        echo "Statement executed successfully.";
                        header("location: ../shop.php");
                        exit();
                    } else {
                        // Check for duplicate primary key error
                        if (mysqli_errno($conn) === 1062) {
                            // Duplicate primary key error occurred
                            echo "Duplicate primary key error. This favorite already exists.";
                            header("location: ../shop.php");
                            exit();
                        } else {
                            // Error during execution
                            echo "Error executing statement: " . mysqli_stmt_error($stmt);
                            header("location: ../shop.php");
                            exit();
                        }
                    }
                } else {
                    // Error binding parameters
                    echo "Error binding parameters: " . mysqli_stmt_error($stmt);
                    header("location: ../shop.php");
                    exit();
                }
        
                mysqli_stmt_close($stmt);
            } else {
                // Error preparing statement
                echo "Error preparing statement: " . mysqli_error($conn);
                header("location: ../shop.php");
                exit();
            }
        
            header("location: ../index.php");
            exit();
        }
    }
function createSendEmail(){
    require __DIR__ . '/vendor/autoload.php';

    $credentialsPath = "C:\Users\Admin\Desktop\client_secret_838510638977-gchqcq492gu7ue3st54i7cdqki1dgm7t.apps.googleusercontent.com.json";

    function getClient($credentialsPath, $clientId, $clientSecret)
    {
        $client = new Google\Client();
        $client->setApplicationName('Gmail API PHP');
        $client->setScopes(Google\Service\Gmail::MAIL_GOOGLE_COM);
        $client->setAuthConfig($credentialsPath);
        $client->setAccessType('offline');
        $client->setPrompt('select_account consent');
        $client->setClientId($clientId);
        $client->setClientSecret($clientSecret);
    
        $tokenPath = 'path/to/token.json';
        if (file_exists($tokenPath)) {
            $accessToken = json_decode(file_get_contents($tokenPath), true);
            $client->setAccessToken($accessToken);
        } else {
            // If no token found, initiate the authorization flow
            $authUrl = $client->createAuthUrl();
            header('Location: ' . $authUrl);
            exit;
        }
    
        // Refresh the token if it's expired
        if ($client->isAccessTokenExpired()) {
            $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            file_put_contents($tokenPath, json_encode($client->getAccessToken()));
        }
    
        return $client;
    }
}
    /**
     * $sender derguesi i emailes.
     * $recipient marresi.
     * $subject Email subject.
     * $message Email body message.
     */
    function createMessage($sender, $recipient, $subject, $message)
    {
        $email = 'From: ' . $sender . "\r\n";
        $email .= 'To: ' . $recipient . "\r\n";
        $email .= 'Subject: ' . $subject . "\r\n";
        $email .= 'MIME-Version: 1.0' . "\r\n";
        $email .= 'Content-Type: text/plain; charset=utf-8' . "\r\n";
        $email .= 'Content-Transfer-Encoding: 7bit' . "\r\n\r\n";
        $email .= $message;
    
        return base64url_encode($email);
    }
    
    /**
     *
     * $data The data to encode with Base64.
     * 
     */
    function base64url_encode($data)
    {
        return rtrim(strtr(base64_encode($data), '+/', '-_'), '=');
    }
    
    function sendEmail($credentialsPath, $clientId, $clientSecret, $recipientEmail, $username, $password)
{
    $client = getClient($credentialsPath, $clientId, $clientSecret);
    
    // Define your email and the login notification message
    $senderEmail = 'dion.kastrati@student.uni-pr.edu';
    $subject = 'Login Notification';
    $message = 'You have successfully logged in to your account.';
    
    // Create the Gmail service
    $service = new Google\Service\Gmail($client);
    
    // Prepare the email
    $email = new Google\Service\Gmail\Message();
    $email->setRaw(createMessage($senderEmail, $recipientEmail, $subject, $message));
    
    // Send the email
    $service->users_messages->send('me', $email);
    
    echo 'Login notification sent successfully!';
}

function loginUserAndSendEmail($conn, $username, $password, $credentialsPath, $clientId, $clientSecret, $recipientEmail)
{
    loginUser($conn, $username, $password);
    sendEmail($credentialsPath, $clientId, $clientSecret, $recipientEmail, $username, $password);

    }
