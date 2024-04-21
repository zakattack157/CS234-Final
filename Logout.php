<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['message']);
unset($_SESSION['pfp']);
unset($_SESSION['time']);
header('Location: LandingPage.php');
exit();
