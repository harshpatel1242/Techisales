<?php
require_once "config1.php";
session_start();
unset($_SESSION['Emp_no']);
unset($_SESSION['access_token']);
unset($_SESSION['user_image']);
unset($_SESSION['user_email_address']);
unset($dummyemail);
$google_client->revokeToken();
unset($_SESSION);
session_destroy();
header("Location: index.php");
exit;
?>