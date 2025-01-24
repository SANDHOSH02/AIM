<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>


<video autoplay muted loop class="background-video">
    <source src="/asstes/vid/backvid10.mp4" type="video/mp4">
    
</video>



<div class="login">

    <div class="content">
        <h2>signup</h2>
        <form action="signup.php" method="POST">
    <label for="username">Username</label>
    <input id="username" name="username" type="text" placeholder="Username" required>

    <label for="password">Password</label>
    <input id="password" name="password" type="password" placeholder="Password" maxlength="8" required>

    <button type="submit">Signup</button>
</form>


       

    </div>
</div>








<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "ghost-game";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user = isset($_POST['username']) ? $_POST['username'] : null;
    $pass = isset($_POST['password']) ? $_POST['password'] : null;

   
    if (!empty($user) && !empty($pass)) {
        
        $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

        
        $sql = "INSERT INTO users (username, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $user, $hashed_password);

        if ($stmt->execute()) {
            echo "";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill in all fields.";
    }
}

$conn->close();
?>









<?php 
  
 

  ?>
</body>
</html>