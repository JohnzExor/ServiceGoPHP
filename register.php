<?php
if (isset($_POST['submit'])) {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $servername = "localhost";
  $db_username = "root";
  $db_password = "";
  $dbname = "servicego_db";
  $conn = new mysqli($servername, $db_username, $db_password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
  $stmt->bind_param("ss", $username, $email);
  $stmt->execute();
  $result = $stmt->get_result();
  if ($result->num_rows > 0) {
    echo "Username or email already exists. Please try again.";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, username, email, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $firstname, $lastname, $username, $email, $password);
    $stmt->execute();
    echo "Registration successful!";
    header('location: ./homepage.php');
  }

  $stmt->close();
  $conn->close();
} else {
  ?>
  <h1 class="page-title">Register</h1>
  <form class="account-template" method="post">
    <label>Firstname:</label>
    <input class="txtBox" type="text" name="firstname" placeholder="Juan" required><br>
    <label>Lastname:</label>
    <input class="txtBox" type="text" name="lastname" placeholder="Delacruz" required><br>
    <label>Username:</label>
    <input class="txtBox" type="text" name="username" required placeholder="Juandela124"><br>
    <label>Email:</label>
    <input class="txtBox" type="email" name="email" required placeholder="juandelacruz@email.com"><br>
    <label>Password:</label>
    <input class="txtBox" type="password" name="password" placeholder="juan2345" required><br>
    <label>
      <input type="checkbox" id="terms-checkbox" name="terms" required> I accept the 
      <a href="#" id="show-terms">Terms and Conditions</a>
    </label><br>
    <input class="submitBtn" type="submit" name="submit" value="Register">
    <p>Already have an account? <a href="?action=login" id="show-login">Login</a></p>
  </form>

  <div id="terms-modal" class="terms-modal page-template">
    <h2>Terms & Conditions</h2>
    <div style="height: 300px; overflow-y: scroll;">
    <p>
        Your Use of ServiceGoYou may not use any "deep-link ", "page-scrape', 
        "robot', "spider or other automatic device, program,algorithm or methodology, 
        or any similar or equivalent manual process, to access, acquire, copy or 
        monitorany portion of the Site or any Content, or in any way reproduce or 
        circumvent the navigational structure orpresentation of the Site or any Content, 
        to obtain or attempt to obtain any materials, documents or information through 
        any means not purposely made availble through the Site.ServiceGo reserves the 
        right to bar any such activity.You may not attempt to gain unauthorized access 
        to any portion or feature of the Site, or any other systems or networks connected 
        to the Site or to any of the services offered on or through the Site, by hacking, 
        password "mining" or any other llegitimate means.You may not probe, scan or test the 
        vulnerability of the Site or any network connected to the Site, nor breach the security 
        or authentication measures on the Site or any network connected to the Site.You may not 
        reverse look-up, trace or seek to trace any information on any other user of or visitor 
        to the Site, or any other customer of ServiceGo including any ServiceGo account not owned 
        by you, to its source, or exploit the Site or any service or information made available 
        or offered by or through the Site, in any way where the purpose is to reveal any information, 
        including but not fimited to personal identification or information, other than your own 
        information, as provided for by the Site.You may not pretend that you are, of that you 
        represent, someone else, or impersonate any otherindividual or entity.You may not use the 
        Site or any Content for any purpose that is unlawful or prohibited by these Terms of use, 
        or to solicit the performance of any illegal activity or other activity which infringes the 
        rights of ServiceGo.
    </p>
    </div>
    <button id="accept-terms">I Accept</button>
    <button id="close-terms">Close</button>
  </div>

  <script>
    document.getElementById("show-terms").addEventListener("click", function() {
      document.getElementById("terms-modal").style.display = "block";
    });

    document.getElementById("close-terms").addEventListener("click", function() {
      document.getElementById("terms-modal").style.display = "none";
    });

    document.getElementById("accept-terms").addEventListener("click", function() {
      document.getElementById("terms-modal").style.display = "none";
      document.getElementById("terms-checkbox").checked = true;
    });
  </script>
  <?php
}
?>
