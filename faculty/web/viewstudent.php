<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<?php
ob_start();
session_start();
if(!(isset($_SESSION['login_user'])))
{
	header("location: index.php");
}
if($_SESSION['login_user']!='admin')
{
	header("location: index.php");
}
include('dbconnect.php');
$reg_id=$_SESSION['login'];
$query = mysqli_query($con, "select * from admin where reg_id='$reg_id'");
$data = mysqli_fetch_assoc($query);
$uname=$data['uname'];
$role=$data['role'];
$reg_id=$_GET['id'];
if($reg_id!="")
{
$query = mysqli_query($con, "select * from student_details where reg_id='$reg_id'");
$data = mysqli_fetch_assoc($query);
if($data['type']=='h')
{
	$query1 = mysqli_query($con, "select * from hscmark where reg_id='$reg_id'");
	$data1 = mysqli_fetch_assoc($query1);
}
else
{
	$query1 = mysqli_query($con, "select * from dipmarks where reg_id='$reg_id'");
	$data1 = mysqli_fetch_assoc($query1);
}
}
else
{
}
?>
<!DOCTYPE HTML>
<html>
<head>
<title>SAKEC - PlaceMate</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<link rel="shortcut icon" type="image/x-icon" href="favicon.png"/>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS -->

 <!-- side nav css file -->
 <link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
 <!-- side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
<style>
body{
    font-family: "Times New Roman", Times, serif;
}
</style>
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<?php include('header_admin.php');?>  
		<!--left-fixed -navigation-->
		
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div class="profile_details_left"><!--notifications of menu start -->
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">
				
				
				<!--search-box-->
				<div class="search-box">
				</div><!--//end-search-box-->
				<div class="profile_details">		
					<ul>
						<li class="dropdown profile_details_drop">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
								<div class="profile_img">	
									<span class="prfil-img"><img src="images/2.jpg" alt=""> </span> 
									<div class="user-name">
										<p><?php echo $_SESSION['login']?></p>
										<span><?php echo $uname?></span>
									</div>
									<i class="fa fa-angle-down lnr"></i>
									<i class="fa fa-angle-up lnr"></i>
									<div class="clearfix"></div>	
								</div>	
							</a>
							<ul class="dropdown-menu drp-mnu">
								<li> <a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
							</ul>
						</li>
					</ul>
				</div>
				
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<div class="main-page general">
				<h2 class="title1"><?php echo $data['stname']?>'s Detail                        <?php if($role=='A') echo '<a href="editstudent.php?id='.$_GET['id'].'"><img src="edit.png" width="3%"></a>';?></h2>
				<div class="panel-info widget-shadow">
					<h4 class="title2">Profile</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Student Name</label>
									<div class="col-md-8">
										<?php echo $data['stname']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Father Name</label>
									<div class="col-md-8">
										<?php echo $data['faname']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Mother Name</label>
									<div class="col-md-8">
										<?php echo $data['moname']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Date of Birth</label>
									<div class="col-md-8">
										<?php echo $data['dob']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Student's Mobile</label>
									<div class="col-md-8">
										<?php echo $data['st_mobile']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Parent's Mobile</label>
									<div class="col-md-8">
										<?php echo $data['pa_mobile']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">SAKEC Email ID</label>
									<div class="col-md-8">
										<?php echo $data['pemailid']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Degree Start Year</label>
									<div class="col-md-8">
										<?php echo $data1['sy']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Mentor Name</label>
									<div class="col-md-8">
										<?php echo $data['mentor_name']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Priority</label>
									<div class="col-md-8">
										<?php 
										if($data['priority']=='crp')
											echo "Campus Recruitment Process";
										if($data['priority']=='higher_studies')
											echo "Higher Study";
										if($data['priority']=='entrepreneur')
											echo "Entrepreneurship";
										?>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Registration No</label>
									<div class="col-md-8">
										<?php echo $reg_id; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Smart Card No</label>
									<div class="col-md-8">
										<?php echo $data['smart_card']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Branch</label>
									<div class="col-md-8">
										<?php 
										if($data['branch']=="elec")
											echo "Electronics Engineering";
										if($data['branch']=="comp")
											echo "Computer Engineering";
										if($data['branch']=="it")
											echo "Information Technology";
										if($data['branch']=="extc")
											echo "Electronics & Telecommunication Engineering";
										?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Division</label>
									<div class="col-md-8">
										<?php echo $data['division']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Roll Number</label>
									<div class="col-md-8">
										<?php echo $data['r_number']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Gender</label>
									<div class="col-md-8">
										<?php 
										if($data['gender']=='female')
											echo 'Female';
										else
											echo 'Male';
										?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Alternate Email ID</label>
									<div class="col-md-8">
										<?php echo $data['emailid']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Degree End Year</label>
									<div class="col-md-8">
										<?php echo $data['passyear']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Mentor Email</label>
									<div class="col-md-8">
										<?php echo $data['mentor_email']; ?>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Relocation/Bond</label>
									<div class="col-md-8">
										<?php 
										if($data['relocation']=='y')
											echo "Ready to Relocate";
										else
											echo "Can not Relocate";
										echo "&nbsp;/&nbsp;";
										if($data['bond']=='y')
											echo "Ready to sign Bond";
										else
											echo "Can not sign Bond";
										?>
									</div>
								</div>
							</div>
							<div class="clearfix"> </div>
						</div>
				</div>
				<hr>
				<div class="panel-info widget-shadow">
					<h4 class="title2">Academics</h4>
						<div class="row">
						<h4 class="title3">SSC</h4>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">SSC Marks</label>
									<div class="col-md-6">
										<?php echo $data1['sscmarks']; ?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">SSC Out Off</label>
									<div class="col-md-6">
										<?php echo $data1['sscoutoff']; ?>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">SSC Percentage</label>
									<div class="col-md-6">
										<?php echo $data1['sscpercentage']; ?>
									</div>
								</div>
							</div>
						</div>
						<br>
						<?php
						if($data['type']=='hsc')
							{
							?>
							<div class="row">
							<h4 class="title3">HSC</h4>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">HSC Marks</label>
										<div class="col-md-6">
											<?php echo $data1['hscmarks']; ?>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">HSC Out Off</label>
										<div class="col-md-6">
											<?php echo $data1['hscoutoff']; ?>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">HSC Percentage</label>
										<div class="col-md-6">
											<?php echo $data1['hscpercentage']; ?>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
						<br>
						<div class="row">
						<h4 class="title3">Degree</h4>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 1</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem1marks']>0)
										{
											echo $data1['sem1marks'];echo "/";echo $data1['sem1outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 2</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem2marks']>0)
										{
											echo $data1['sem2marks'];echo "/";echo $data1['sem2outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 3</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem3marks']>0)
										{
											echo $data1['sem3marks'];echo "/";echo $data1['sem3outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 4</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem4marks']>0)
										{
											echo $data1['sem4marks'];echo "/";echo $data1['sem4outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<br><br>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 5</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem5marks']>0)
										{
											echo $data1['sem5marks'];echo "/";echo $data1['sem5outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 6</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem6marks']>0)
										{
											echo $data1['sem6marks'];echo "/";echo $data1['sem6outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 7</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem7marks']>0)
										{
											echo $data1['sem7marks'];echo "/";echo $data1['sem7outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 8</label>
									<div class="col-md-6">
										<?php 
										if($data1['sem8marks']>0)
										{
											echo $data1['sem8marks'];echo "/";echo $data1['sem8outoff']; 
										}
										?>
									</div>
								</div>
							</div>
							<br><br>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Total C*G</label>
									<div class="col-md-6">
										<?php 
											echo $data1['totalmarks']; 
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Total C</label>
									<div class="col-md-6">
										<?php 
											echo $data1['totaloutoff']; 
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Pointer</label>
									<div class="col-md-6">
										<?php 
											echo $data1['degreepointer']; 
										?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label"></label>
									<div class="col-md-6">
									</div>
								</div>
							</div>
						</div>
						<div class="row">
						<h4 class="title3">KT Details</h4>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Live KT</label>
									<div class="col-md-6">
										<?php echo $data1['livekt'] ?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Dead KT</label>
									<div class="col-md-6">
										<?php echo $data1['deadkt'] ?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Attempts</label>
									<div class="col-md-6">
										<?php echo $data1['attempts'] ?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Drop</label>
									<div class="col-md-6">
										<?php echo $data1['drops'] ?>
									</div>
								</div>
							</div>
						</div>
					<div class="clearfix"> </div>
				</div>
			</div>
		</div>
		<!--footer-->
		<?php include('footer.php'); ?>
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //side nav js -->
	
	<!-- Classie --><!-- for toggle left push menu script -->
		<script src="js/classie.js"></script>
		<script>
			var menuLeft = document.getElementById( 'cbp-spmenu-s1' ),
				showLeftPush = document.getElementById( 'showLeftPush' ),
				body = document.body;
				
			showLeftPush.onclick = function() {
				classie.toggle( this, 'active' );
				classie.toggle( body, 'cbp-spmenu-push-toright' );
				classie.toggle( menuLeft, 'cbp-spmenu-open' );
				disableOther( 'showLeftPush' );
			};
			
			function disableOther( button ) {
				if( button !== 'showLeftPush' ) {
					classie.toggle( showLeftPush, 'disabled' );
				}
			}
		</script>
	<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
</body>
</html>