<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <script src="https://kit.fontawesome.com/f0c0338da3.js" crossorigin="anonymous"></script>
    <title>ServiceGo</title>
</head>
<body>
    <nav>
        <ul>
            <label for="logo">ServiceGo</label>
            <li>
                <a href="#contact">Contact</a>
                <div class="nav-account">

                    <?php 
                    session_start();
                    if(isset($_SESSION['username'])) {
                        echo "<a href='./homepage.php'>".$_SESSION['username']."</a>";
                    } else {
                        echo "<a href='./homepage.php'>Login</a>";
                    }
                    ?>

                </div>
            </li>
        </ul>
    </nav>
    <section id="services">
        <?php 
            include 'services.php';
        ?>
    </section>
    <footer id="contact">
        <div class="contact-details">
                <div class="contact-title">
                    <h1>Get in touch</h1>
                    <p>Want to get in touch? We'd love to hear from you. 
                        Here's how you can reach us..</p>
                </div>
                <div class="contact-details-container">
                    <div class="contact-details-person">
                        <p class="title">Talk to Sales</p>
                        <p class="description">Interested in ServiceGo software? 
                                Just pick up the phone to chat with a member of our sales team.</p>
                            <p class="number">+63123456789</p>
                    </div>
                    <div class="customer-support">
                        <p class="title">Contact Customer Support</p>
                        <p class="description">Sometimes you need a little help from 
                                your friends. Or a ServiceGo support rep. Don't worry... we're here 
                                to help you.
                        </p>
                    </div>
                </div>
        </div>
    </footer>
    </div>
</body>
</html>