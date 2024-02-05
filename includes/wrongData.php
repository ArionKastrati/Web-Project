<?php 

    if(isset($_GET["error"]))
    if($_GET["error"] == "emptyinput"){
        echo "<p style= 'color: orange; position:relative; left: 18% ' > Fill in the fields! </p>";
    }

    else if($_GET["error"] == "invalidusername"){
        echo "<p style= 'color: red; position:relative; left: 3% ' > Ivalid username, choose a proper username! </p>";
    }

    else if($_GET["error"] == "invalidemail"){
        echo "<p style= 'color: red; position:relative; left: 7%' > Invalid email, choose a proper email! </p>";
    }

    else if($_GET["error"] == "pwdsdontmatch"){
        echo "<p style= 'color: red; position:relative; left: 12% ' > Passwords do not match! </p>";
    }

    else if($_GET["error"] == "usernametaken"){
        echo "<p style= 'color: red; position:relative; right: 2% '>  Username or email already exists, choose another one! </p>";
    }
    else if ($_GET["error"] == "stmtfailed"){
        echo "<p style= 'color: red; position:relative; left: 8% ' > Something went wrong, try again! </p>";
    }
    else if($_GET["error"] == "none"){
        echo "<p style = 'color: green;  position:relative; left: 18% '> You signed up! </p>";
    }
    else if($_GET["error"] == "wrongdata"){
        echo "<p style = 'color: red; position:relative; left: 9% '> Incorrect username or password! </p>";
    }
    else if($_GET["error"] == "nodata"){
        echo "<p style = 'color: red; position:relative; left: 9% '> This user do not exist, Sign up? </p>";
    }


    