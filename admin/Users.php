<!DOCTYPE html>
<html>
<head>
	<title>Users</title>
    <link rel="stylesheet" href="UserStyle.css">
    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <script>
  // Attach event listeners only once
  document.addEventListener('DOMContentLoaded', function() {
    const toggleButton = document.querySelector('.button-3');
    toggleButton.addEventListener('click', toggleForm);

    const toggleButton2 = document.querySelector('.button-33');
    toggleButton2.addEventListener('click', toggleForm2);

    const form = document.querySelector('.forma');
    const form2 = document.querySelector('#forma2');

    function toggleForm() {
      if (form.style.display === 'none') {
        form.style.display = 'block';
      } else {
        form.style.display = 'none';
      }
    }

    function toggleForm2() {
      if (form2.style.display === 'none') {
        form2.style.display = 'block';
      } else {
        form2.style.display = 'none';
      }
    }

    // Handle form submission using Ajax
    document.querySelector('form.forma').addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission

      const form = this;
      const formData = new FormData(form);

      fetch(form.action, {
        method: form.method,
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          // Handle the response (if needed)
          // You can update the table here
          location.reload(); // Reload the page to update the table
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });

    // Handle form2 submission using Ajax
    document.querySelector('form#forma2').addEventListener('submit', function(event) {

      const form = this;
      const formData = new FormData(form);

      fetch(form.action, {
        method: form.method,
        body: formData
      })
        .then(response => response.text())
        .then(data => {
          // Handle the response (if needed)
          // You can update the table here
          location.reload(); // Reload the page to update the table
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });
  });
</script>
</head>
<body>

	<h1>Users</h1>
    <div style="display:inline-block" class="buttons">
    <button class="button-3" onclick="RegUser()">New</button>
    <button class="button-33" onclick="RegUser()">Delete</button>

    </div>

    <form id="forma2" method="POST" action="./Users.php" style="display: none;">
    <label for="id">ID to delete:</label>
    <input type="text" name="id" id="id" required>
    <button class="sub" type="submit" name="delete">Delete</button>
</form>
    <form class="forma" style="display: none;" action="./Users.php" method="POST">
    <h3>Create new user</h3>
    <label for="username">Username:</label>
    <input type="text" id="username" name="username"><br><br>
    
    <label for="fullname">Full Name:</label>
    <input type="text" id="fullname" name="fullname"><br><br>

    <label for="email">Email:</label>
    <input type="text" id="email" name="email"><br><br>

    <label for="password">Password:</label>
    <input type="password" id="password" name="password"><br><br>

    <label for="user_role">User Role:</label>
    <select id="user_role" name="user_role">
        <option value="Normal user">Normal user</option>
        <option value="Admin">Admin</option>
    </select><br><br>
    <input class="sub" type="hidden" name="submit" value="submit">
    <input class="sub" type="submit" value="Submit">
</form>

	<table class="tbl">
		<tr class="tr">
			<th>ID</th>
      <th>Username</th>
      <th>Full name</th>
      <th>Email</th>
			<th>Password</th>
			<th>Role</th>
      <th>Register Date</th>

		</tr>
		<?php
            $dbServerName = "localhost:3306";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "web-database";
            
            // Create connection
            $conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);
			// Select data from database
			$sql = "SELECT * FROM tblusers;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['username'] . "</td>";
                    echo "<td>" . $row['fullname'] . "</td>";
                    echo "<td>" . $row['email'] . "</td>";
                    echo "<td>" . $row['hashedPassword'] . "</td>";
                    echo "<td>" . $row['user_role'] . "</td>";
                    echo "<td>" . $row['reg_date'] . "</td>";
                    echo "</tr>";
                }
            } 
            if(isset($_POST['submit'])){

                $fullname = $_POST["fullname"];
                $username = $_POST["username"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $userRole = "Normal User";
                $adminRole = "Admin";
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                $sql = "INSERT INTO tblusers (fullname, username, email, hashedPassword, user_role) VALUES ('$fullname', '$username', '$email', '$hashedPassword', '$userRole')";
                // Execute the query
                mysqli_query($conn , $sql);
            
                // Close the connection
                mysqli_close($conn);
        exit();
        
            }
            if (isset($_POST['delete'])) {
              $id = $_POST["id"];
          
              $sql = "DELETE FROM tblusers WHERE user_id = $id";
              mysqli_query($conn, $sql);
          
              // Close the connection
              mysqli_close($conn);

              exit();
          }
            
		?>
	</table>
</body>
</html>
