<?php

//This script will handle login

session_start();


// check if the user is already logged in

require_once "config.php";
require_once "config1.php";

$emp_no = $pan_no = "";
$err = $err1 ="";
$login_button = '';
$_SESSION['user_email_address'] = '';

if(isset($_GET["code"]))
{
    
    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);


    if(!isset($token['error']))
    {
        
        $google_client->setAccessToken($token['access_token']);

        
        $_SESSION['access_token'] = $token['access_token'];


        $google_service = new Google_Service_Oauth2($google_client);

        
        $data = $google_service->userinfo->get();

       /* 
        if(!empty($data['given_name']))
        {
        $_SESSION['user_first_name'] = $data['given_name'];
        }

        if(!empty($data['family_name']))
        {
        $_SESSION['user_last_name'] = $data['family_name'];
        }
        */
        if(!empty($data['email']))
        {
        $_SESSION['user_email_address'] = $data['email'];
        $dummyemail =  $data['email'];
     
        }
        /*
        if(!empty($data['gender']))
        {
        $_SESSION['user_gender'] = $data['gender'];
        }
        */
        if(!empty($data['picture']))
        {
        $_SESSION['user_image'] = $data['picture'];
        }
                           
                            
    }                                
}
if(!isset($_SESSION['access_token']))
{

 $login_button = '<a href="'.$google_client->createAuthUrl().'">Login With Google</a>';
}

/*
if(isset($_SESSION['access_token'])){


}        
 */       // if request method is post
if ($_SERVER['REQUEST_METHOD'] == "POST")
{
    
    if (isset($_POST['submit']))
    {
        
        if(empty(trim(isset($_POST['Emp_no']))) || empty(trim(isset($_POST['Pan_no']))))
        {
            $err = "Please enter username + password";
            
        }
        else{
        }
            $emp_no = trim($_POST['Emp_no']);
            $pan_no = trim($_POST['Pan_no']);
        }



        if(empty($err))
        {
            $sql = "SELECT EMP_NO ,PAN_NO  FROM mt_emp WHERE Emp_no = ?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $emp_no;
            $hashed_password = password_hash($pan_no, PASSWORD_DEFAULT);
            
            
            // Try to execute this statement
            if(mysqli_stmt_execute($stmt))
            {
                mysqli_stmt_store_result($stmt);
                if(mysqli_stmt_num_rows($stmt) == 1)
                        {
                            mysqli_stmt_bind_result($stmt,$emp_no, $pan_no);
                            if(mysqli_stmt_fetch($stmt))
                            {
                                
                                if(password_verify($pan_no, $hashed_password))
                                {
                                    // this means the password is corrct. Allow user to login
                                    //session_start();
                                    $sql1 = "SELECT * FROM mt_emp WHERE  EMP_NO = '$emp_no'";
                                    $result = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
                                    if (mysqli_num_rows($result) > 0) 
                                    {
                                            while ($row1 = mysqli_fetch_array($result))
                                            {
                                                    $designation1 = $row1['DESIGNATION'];
                                    }
                                    }

                                if($designation1 == 'hod')
                                {
                                        $_SESSION["Emp_no"] = $emp_no;
                                        $_SESSION["loggedin"] = true;

                                
         
                                    header("location: hod.php");
                                }
                                elseif($designation1 == 'principal')
                                {
                                        $_SESSION["Emp_no"] = $emp_no;
                                        $_SESSION["loggedin"] = true;

                                
         
                                    header("location: principal.php");
                                }
                                elseif($designation1 == 'admin')
                                {
                                        $_SESSION["Emp_no"] = $emp_no;
                                        $_SESSION["loggedin"] = true;

                                
         
                                    header("location: admin.php");
                                }
                                else
                                {
                                        $_SESSION["Emp_no"] = $emp_no;
                                        $_SESSION["loggedin"] = true;

                                
         
                                    header("location: emp_status.php");
                                }
                                    
                                }
                            }

                        }
                else
                {
                    $err1 ="please enter valid username and password";
                    echo "<script type='text/javascript'> window.onload = function(){alert(\"$err1\");}</script>";
                

                }
            

            }
        }    

}



?>


<!DOCTYPE html>
<html>
<head>
	<title>login form for faculty apparisal </title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
<link rel="icon" href="sakec.PNG">

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS-->
<link href="css/font-awesome.css" rel="stylesheet">

<script src="jquery.js"></script> 
    <script> 
    $(function(){
      $("#includedContent").load("header1.html"); 
    });
    </script>  
</head>
<body>
 <div id="includedContent"></div>
	<div id="header-full">
			<header id="header">
				<div id="masthead">
					<div id="branding" role="banner">
							<img id="bg_image" alt=""  style="width: 100%; height: 100px; max-width: 100%;" title="" src="http://www.shahandanchor.com/home/wp-content/uploads/SKAEC-New_Header.png">	<div id="header-container">
				</div>			<div style="clear:both;"></div>
			</div><!-- #branding -->
		<a id="nav-toggle"><span>&nbsp;</span></a>
			<nav id="access" role="navigation">
	</nav>
</div>

</header>



<div id="page-wrapper">
			<div class="main-page login-page " style="width: 35%; height: 50%;">
				<h2 class="title1">Login</h2>
				<div class="widget-shadow">
					<div class="login-body">
						<form action="" method="POST" autocomplete="off">
							<input type="text" class="user" name="Emp_no" placeholder="Enter Your Employee no" required="" style="width: 470px; padding: 10px;padding-left: 35px; border-width: 1px;">
							<input type="password" name="Pan_no" class="lock" placeholder="Enter your pan number" required=""  style="margin-top: 20px;">

							<div class="forgot-grid">
								<label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Remember me</label>
								<div class="forgot">
									<a href="#">forgot password?</a>
								</div>
								<div class="clearfix"> </div>
							</div>
							<input type="submit" name="submit" value="Sign In">
                            <?php 
                            if($login_button == '')
                            {
                             //echo '<h3><a href="logout.php">Logout</h3></div>';

                             $sql1 = "SELECT * FROM mt_emp WHERE  EMAIL_ID like '$dummyemail' ;";
                            
                                     $result = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
                                     if (mysqli_num_rows($result) > 0) 
                                     {       echo "inside quary";
                                             while ($row1 = mysqli_fetch_array($result))
                                             {
                                                     $designation2 = $row1['DESIGNATION'];
                                                     $emp_no= $row1['EMP_NO'];
                                             }
                                     }
                                     
                                    if(mysqli_num_rows($result) > 0) 
                                    {

        
                                                        if($designation2 == 'hod')
                                                        {
                                                            $_SESSION["Emp_no"] = $emp_no;
                                                            $_SESSION["loggedin"] = true;

                                                        header("location: hod.php");
                                                    }
                                                    elseif($designation2 == 'principal')
                                                    {
                                                            $_SESSION["Emp_no"] = $emp_no;
                                                            $_SESSION["loggedin"] = true;

                                                        header("location: principal.php");
                                                    }
                                                    elseif($designation2 == 'admin')
                                                    {
                                                            $_SESSION["Emp_no"] = $emp_no;
                                                            $_SESSION["loggedin"] = true;

                                                        header("location: admin.php");
                                                    }
                                                    elseif($designation2 == 'employee')
                                                    {
                                                            $_SESSION["Emp_no"] = $emp_no;
                                                            $_SESSION["loggedin"] = true;

                                                        header("location: emp_status.php");
                                                    }
                                                    else 
                                                    {
                                                        echo "looks like ur email isnt registeered in organization";
                                                    }
                                    }
                            }        
                            else{
                                echo '<div align="center">'.$login_button . '</div>';
                            }
                            ?>
						</form>
					</div>
				</div>
				

			</div>
		</div>
		<br>
		<br>
		<br>
<div id="footer2" style="background: #6495Ed; height: 100px;">
		
			<div id="site-copyright" style="margin-top: 20px; margin-left: 30%; padding: 20px; font-size: 12px; color: black;">Shah &amp; Anchor Kutchhi Engineering College<br>
Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br>
© Shah &amp; Anchor Kutchhi Engineering College.</div>	<!-- #site-info -->
				
		</div><!-- #footer2 -->	
	</div>

</body>
</html>