<?php
session_start();
unset($_SESSION['username']);
session_destroy();
setcookie('username', '', time()-3600);
header('Location: homepage.php');
exit;
?>
