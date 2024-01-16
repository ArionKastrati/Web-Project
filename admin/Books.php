<!DOCTYPE html>
<html>
<head>
	<title>Books</title>
    <link rel="stylesheet" href="UserStyle.css">
	    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
	    function RegUser() {
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

  const toggleButton = document.querySelector('.button-3');
  const toggleButton2 = document.querySelector('.button-33');

  toggleButton.addEventListener('click', toggleForm);
  toggleButton2.addEventListener('click', toggleForm2);

  // Check if the submit event listeners are already attached
  if (!form.dataset.submitListenerAttached) {
    // Handle form submission using Ajax
    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent form submission

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

    // Mark the form with a custom attribute to indicate the listener is attached
    form.dataset.submitListenerAttached = true;
  }

  // Check if the submit event listeners are already attached
  if (!form2.dataset.submitListenerAttached) {
    // Handle form2 submission using Ajax
    form2.addEventListener('submit', function(event) {
      const formData = new FormData(form2);

      fetch(form2.action, {
        method: form2.method,
        body: formData
      })
        .then(response => response.text())
        .then(data => {

          location.reload(); // Reload the page to update the table
        })
        .catch(error => {
          console.error('Error:', error);
        });
    });

    form2.dataset.submitListenerAttached = true;
  }
}
    </script>
</head>
<body>
	<h1>Books</h1>
    <div style="display:inline-block;" class="buttons2">
    <button class="button-3" onclick="RegUser()">New</button>
    <button class="button-33" onclick="RegUser()">Delete</button>

    </div>

    <form id="forma2" method="POST" action="./Books.php" style="display: none;">
    <label for="id">ID to delete:</label>
    <input type="text" name="id" id="id" required>
    <button class="sub" type="submit" name="delete">Delete</button>
</form>
<form class="forma" style="display: none;" action="./Books.php" method="POST">
    <h3>Create new Book</h3>
    <label for="title">Title:</label>
    <input type="text" id="title" name="book_title"><br><br>
    
    <label for="aid">Author ID:</label>
    <input type="text" id="aid" name="author_id"><br><br>

    <label for="Price">Price:</label>
    <input type="text" id="Price" name="price"><br><br>

    <label for="Genre">Genre:</label>
    <input type="text" id="Genre" name="genre"><br><br>

    <label for="Quantity">Quantity:</label>
    <input type="text" id="Quantity" name="quantity"><br><br>

    <label for="photo">Photo (Online Link):</label>
    <input type="text" id="photo" name="photo"><br><br>

    <label for="Published">Published:</label>
    <input type="text" id="Published" name="year_released"><br><br>

    <label for="Arrival">Arrival date:</label>
    <input type="text" id="Arrival" name="arrival_date" value="<?php $t=time(); echo(date("Y-m-d",$t)); ?>"><br><br>

    <input class="sub" type="hidden" name="submit" value="submit">
    <input class="sub" type="submit" value="Submit">
</form>

	<table class="tbl">
		<tr class="tr">
			<th>ID</th>
			<th>Title</th>
			<th>Author ID</th>
            <th>Price</th>
			<th>Genre</th>
			<th>Quantity</th>
            <th>Published</th>
            <th>Arrival Date</th>
		</tr>
		<?php
            $dbServerName = "localhost:3307";
            $dbUsername = "root";
            $dbPassword = "";
            $dbName = "web2-database";
            
            // Create connection
            $conn = new mysqli($dbServerName, $dbUsername, $dbPassword, $dbName);

            $sql = "SELECT * FROM tblbooks;";
            $result = mysqli_query($conn, $sql);
            $resultCheck = mysqli_num_rows($result);
            $genre;

            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                  switch($row['genre']){
                    case 1:
                      $genre = "Novel";
                      break;
                    case 2:
                      $genre = "Drame";
                      break;
                    case 3:
                      $genre = "Action";
                      break;
                    case 4:
                      $genre = "Thriller";
                      break;
                    case 5:
                      $genre = "Fantasy";
                      break;
                    case 6;
                      $genre = "Mister";
                      break;
                    default:
                      $genre = "Undefined";
                      break;
                  }
                    echo "<tr>";
                    echo "<td>" . $row['book_id'] . "</td>";
                    echo "<td>" . $row['book_title'] . "</td>";
                    echo "<td>" . $row['author_id'] . "</td>";
                    echo "<td>" . $row['price'] . "</td>";
                    echo "<td>" . $genre . "</td>";
                    echo "<td>" . $row['quantity'] . "</td>";
                    echo "<td>" . $row['year_released'] . "</td>";
                    echo "<td>" . $row['arrival_date'] . "</td>";
                    echo "</tr>";
                }
            } 

            if(isset($_POST['submit'])) {
              if(isset($_POST["book_title"]) && isset($_POST["author_id"]) && isset($_POST["price"]) && isset($_POST["genre"]) && isset($_POST["quantity"]) && isset($_POST["year_released"]) && isset($_POST["arrival_date"])) {
                  $book_title = $_POST["book_title"];
                  $author_id = $_POST["author_id"];
                  $price = $_POST["price"];
                  $genre = $_POST["genre"];
                  $book_photo = $_POST["photo"];
                  $quantity = $_POST["quantity"];
                  $year_released = $_POST["year_released"];
                  $arrival_date = $_POST["arrival_date"];
                
                  $sql = "INSERT INTO tblbooks (book_title, author_id, price, genre,book_photo , quantity,year_released,arrival_date) VALUES ('$book_title', '$author_id', '$price', '$genre', '$book_photo' ,'$quantity','$year_released','$arrival_date')";
                  mysqli_query($conn , $sql);
            
                  // Close the connection
                  mysqli_close($conn);
          exit();
          
              } else {
                 
              }
          }
           if (isset($_POST['delete'])) {
            $id = $_POST["id"];
        
            $sql = "DELETE FROM tblbooks WHERE book_id = $id";
            mysqli_query($conn, $sql);
            mysqli_close($conn);

            exit();
        }
          
		?>
	</table>
</body>
</html>
