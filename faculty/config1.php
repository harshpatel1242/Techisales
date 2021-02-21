<?php
//start session on web page

//config.php

//Include Google Client Library for PHP autoload file
require_once 'vendor/autoload.php';

//Make object of Google API Client for call Google API
$google_client = new Google_Client();

//Set the OAuth 2.0 Client ID
$google_client->setClientId('699809993505-7pn1ubb8t3nq7jpulag5049dap3629i0.apps.googleusercontent.com');

//Set the OAuth 2.0 Client Secret key
$google_client->setClientSecret('XbCipUWjam_Bt4I0lu5XGmMm');

//Set the OAuth 2.0 Redirect URI
$google_client->setRedirectUri('http://localhost/faculty/index.php');
// to get the email and profile 
$google_client->addScope('email');

$google_client->addScope('profile');
?>