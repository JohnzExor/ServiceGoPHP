<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f0c0338da3.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./style.css">
    <title>Home | ServiceGo</title>
</head>
<body>
    <section>
        <div class="homepage" style="background-image: url(./images/background.jpg)">

            <div class="page-description">
                <h2>ServiceGo</h2>
                <p>Our goal is to provide professional and instant services 
                    to our customers. If you need services right at your doorsteps, 
                    ServiceGo will be ready to go!
                </p>
            </div>

            <div class="account">
                <?php
                session_start();

                if (isset($_SESSION['username'])) {
                    ?>
                    <h1 class="user-name"><?php echo $_SESSION['username'];?></h1>
                    <p class="name"><?php echo $_SESSION['firstname'].' '.$_SESSION['lastname']; ?></p>
                    <ul>
                        <li>
                            <a class="home-choices" href="./index.php">Services</a>
                            <a class="home-choices" onclick="toggleBookings()">Bookings</a>
                            <a class="home-choices" href="logout.php">Logout</a>
                        </li>
                    </ul>
                    
                    <?php

                } else {
                    if (isset($_GET['action']) && $_GET['action'] === 'register') {
                        include('./register.php');
                    } else {
                        include('./login.php');
                    }
                }
                ?>
            </div>
            <div class="booked-panel page-template" id="booked-panel">
                <i class="fa fa-times" aria-hidden="true" onclick="closeBookings()"></i>
                <?php 
                    include './bookings.php'
                ?>
            </div>
        </div>
    </section>
    <footer>
        <p class="copyright">Copyright © 2023, ServiceGo, All rights Reserved.</p>
    </footer>
    <script>
        function toggleBookings() {
            let bookedPanel = document.getElementById('booked-panel');
            bookedPanel.style.display = "block";
        }

        function closeBookings() {
            document.getElementById('booked-panel').style.display = 'none';
        }
    </script>
</body>
</html>