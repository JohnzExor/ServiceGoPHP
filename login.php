<?php
if(isset($_SESSION['username'])) {
  header('Location: homepage.php');
  exit;
}
if(isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  $servername = "localhost";
  $db_username = "root";
  $db_password = "";
  $dbname = "servicego_db";
  $conn = new mysqli($servername, $db_username, $db_password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
  $stmt->bind_param("s", $username);
  $stmt->execute();
  $result = $stmt->get_result();

  if($result->num_rows == 1) {
    $row = $result->fetch_assoc();
    if(password_verify($password, $row['password'])) {
      $_SESSION['user_id'] = $row['user_id'];
      $_SESSION['firstname'] = $row['firstname'];
      $_SESSION['lastname'] = $row['lastname'];
      $_SESSION['service_id'] = $row['service_id'];
      $_SESSION['rating'] = $row['rating'];
      $_SESSION['content'] = $row['content'];
      $_SESSION['username'] = $username;
      if(isset($_POST['remember'])) {
        setcookie('username', $username, time()+60*60*24*30);
      }
      header('Location: homepage.php');
      exit;
    } else {
      echo "Invalid username or password.";
    }
  } else {
    echo "Invalid username or password.";
  }

  $stmt->close();
  $conn->close();
}
?>
<h1 class="page-title">Login</h1>
<form class="account-template" method="post">
  <label>Username:</label>
  <input class="txtBox" type="text" name="username" placeholder="juandela124" required><br>
  <label>Password:</label>
  <input class="txtBox" type="password" name="password" placeholder="Juan2345" required><br>
  <label>Remember me:</label>
  <input type="checkbox" name="remember"><br>
  <input class="submitBtn" type="submit" name="submit" value="Login">
  <p>Dont have account? <a href="?action=register" id="show-register">Create an Account</a></p>
</form>