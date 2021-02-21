<?php
session_start();
unset($_SESSION['login_user']);
unset($_SESSION['login']);
header("location:index.php");
?>