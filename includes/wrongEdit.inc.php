<?php 

if(isset($_GET["edit"]))
if($_GET["edit"] == "error-emptyinput"){
    echo "<p style= 'color: orange; position:relative; left: 18% ' > Fill in the fields! </p>";
}

else if($_GET["edit"] == "error-invalidusername"){
    echo "<p style= 'color: red; position:relative; left: 3% ' > Ivalid username, choose a proper username! </p>";
}

else if($_GET["edit"] == "error-invalidemail"){
    echo "<p style= 'color: red; position:relative; left: 7%' > Invalid email, choose a proper email! </p>";
}

else if($_GET["edit"] == "error-pwdsdontmatch"){
    echo "<p style= 'color: red; position:relative; left: 12% ' > Passwords do not match! </p>";
}