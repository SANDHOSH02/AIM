<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="/css/login.css">
</head>


<body>
<video autoplay muted loop class="background-video">
    <source src="/asstes/vid/backvid10.mp4" type="video/mp4">
    
</video>



<div class="login">

    <div class="content">
        <h2>LOGIN</h2>

        <form action="login.php" method="POST">
    <label for="username">Username</label>
    <input id="username" name="username" type="text" placeholder="Username" required>

    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="Password" required>

    <button type="submit">Login</button>
</form>

    </div>
</div>

<?php 
  
  $servername = "localhost";
  $username = "root";
  $password = "";
  $database = "ghost-game";
  
  // Create connection
  $conn = new mysqli($servername, $username, $password, $database);
  
  if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
  }
  
  if ($_SERVER["REQUEST_METHOD"] === "POST") {
      $user = isset($_POST['username']) ? $_POST['username'] : null;
      $pass = isset($_POST['password']) ? $_POST['password'] : null;
  
      if (!empty($user) && !empty($pass)) {
          
          $sql = "SELECT password FROM users WHERE username = ?";
          $stmt = $conn->prepare($sql);
          $stmt->bind_param("s", $user);
          $stmt->execute();
          $stmt->bind_result($hashed_password);
          $stmt->fetch();
  
          if ($hashed_password && password_verify($pass, $hashed_password)) {
              echo "Login successful!";
              
              header("Location: home.php");
              exit;
          } else {
              echo "Invalid username or password.";
          }
  
          $stmt->close();
      } else {
          echo "Please fill in all fields.";
      }
  }
  
  $conn->close();
 
  
 

?>

<script src="js/login.js"></script>
</body>
</html>