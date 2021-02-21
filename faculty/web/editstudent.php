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
$type=$data['type'];
if($data['type']=='hsc')
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
<script>
function calculate()
{
	var sscmarks = document.getElementById("sscmarks").value;
	var sscoutoff = document.getElementById("sscoutoff").value;
	var sscpercentage = sscmarks*100/sscoutoff;
	sscpercentage = Math.round(sscpercentage * 100) / 100;
	document.getElementById("sscpercentage").value = sscpercentage;
	var type='<?php echo $type ?>';
	if(type=="hsc")
	{
		var hscmarks = document.getElementById("hscmarks").value;
		var hscoutoff = document.getElementById("hscoutoff").value;
		var hscpercentage = hscmarks*100/hscoutoff;
		hscpercentage = Math.round(hscpercentage * 100) / 100;
		document.getElementById("hscpercentage").value = hscpercentage;
		var sem1marks = document.getElementById("sem1marks").value;
		var sem1outoff = document.getElementById("sem1outoff").value;
		var sem2marks = document.getElementById("sem2marks").value;
		var sem2outoff = document.getElementById("sem2outoff").value;
		var sem3marks = document.getElementById("sem3marks").value;
		var sem3outoff = document.getElementById("sem3outoff").value;
		var sem4marks = document.getElementById("sem4marks").value;
		var sem4outoff = document.getElementById("sem4outoff").value;
		var sem5marks = document.getElementById("sem5marks").value;
		var sem5outoff = document.getElementById("sem5outoff").value;
		var sem6marks = document.getElementById("sem6marks").value;
		var sem6outoff = document.getElementById("sem6outoff").value;
		var sem7marks = document.getElementById("sem7marks").value;
		var sem7outoff = document.getElementById("sem7outoff").value;
		var sem8marks = document.getElementById("sem8marks").value;
		var sem8outoff = document.getElementById("sem8outoff").value;
		if(sem1marks=="")
			sem1marks=0;
		if(sem2marks=="")
			sem2marks=0;
		if(sem3marks=="")
			sem3marks=0;
		if(sem4marks=="")
			sem4marks=0;
		if(sem5marks=="")
			sem5marks=0;
		if(sem6marks=="")
			sem6marks=0;
		if(sem7marks=="")
			sem7marks=0;
		if(sem8marks=="")
			sem8marks=0;
		if(sem1outoff=="")
			sem1outoff=0;
		if(sem2outoff=="")
			sem2outoff=0;
		if(sem3outoff=="")
			sem3outoff=0;
		if(sem4outoff=="")
			sem4outoff=0;
		if(sem5outoff=="")
			sem5outoff=0;
		if(sem6outoff=="")
			sem6outoff=0;
		if(sem7outoff=="")
			sem7outoff=0;
		if(sem8outoff=="")
			sem8outoff=0;
		var totalmarks = parseInt(sem1marks) + parseInt(sem2marks) + parseInt(sem3marks) + parseInt(sem4marks) + parseInt(sem5marks) + parseInt(sem6marks) + parseInt(sem7marks) + parseInt(sem8marks);
		var totaloutoff = parseInt(sem1outoff) + parseInt(sem2outoff) + parseInt(sem3outoff) + parseInt(sem4outoff) + parseInt(sem5outoff) + parseInt(sem6outoff) + parseInt(sem7outoff) + parseInt(sem8outoff);
		var degreepointer = totalmarks/totaloutoff;
		degreepointer = Math.round(degreepointer * 100) / 100;
		document.getElementById("totalmarks").value = totalmarks;
		document.getElementById("totaloutoff").value = totaloutoff;
		document.getElementById("degreepointer").value = degreepointer;
	}
	if(type=="diploma")
	{
		var year1marks = document.getElementById("year1marks").value;
		var year1outoff = document.getElementById("year1outoff").value;
		var year2marks = document.getElementById("year2marks").value;
		var year2outoff = document.getElementById("year2outoff").value;
		var year3marks = document.getElementById("year3marks").value;
		var year3outoff = document.getElementById("year3outoff").value;
		var totaldmarks = parseInt(year1marks) + parseInt(year2marks) + parseInt(year3marks);
		var totaldoutoff = parseInt(year1outoff) + parseInt(year2outoff) + parseInt(year3outoff); 
		var diplomapercentage = totaldmarks*100/totaldoutoff;
		diplomapercentage = Math.round(diplomapercentage * 100) / 100;
		document.getElementById("totaldmarks").value = totaldmarks;
		document.getElementById("totaldoutoff").value = totaldoutoff;
		document.getElementById("diplomapercentage").value = diplomapercentage;
		var sem3marks = document.getElementById("sem3marks").value;
		var sem3outoff = document.getElementById("sem3outoff").value;
		var sem4marks = document.getElementById("sem4marks").value;
		var sem4outoff = document.getElementById("sem4outoff").value;
		var sem5marks = document.getElementById("sem5marks").value;
		var sem5outoff = document.getElementById("sem5outoff").value;
		var sem6marks = document.getElementById("sem6marks").value;
		var sem6outoff = document.getElementById("sem6outoff").value;
		var sem7marks = document.getElementById("sem7marks").value;
		var sem7outoff = document.getElementById("sem7outoff").value;
		var sem8marks = document.getElementById("sem8marks").value;
		var sem8outoff = document.getElementById("sem8outoff").value;
		if(sem3marks=="")
			sem3marks=0;
		if(sem4marks=="")
			sem4marks=0;
		if(sem5marks=="")
			sem5marks=0;
		if(sem6marks=="")
			sem6marks=0;
		if(sem7marks=="")
			sem7marks=0;
		if(sem8marks=="")
			sem8marks=0;
		if(sem1outoff=="")
			sem1outoff=0;
		if(sem2outoff=="")
			sem2outoff=0;
		if(sem3outoff=="")
			sem3outoff=0;
		if(sem4outoff=="")
			sem4outoff=0;
		if(sem5outoff=="")
			sem5outoff=0;
		if(sem6outoff=="")
			sem6outoff=0;
		if(sem7outoff=="")
			sem7outoff=0;
		if(sem8outoff=="")
			sem8outoff=0;
		var totalmarks = parseInt(sem3marks) + parseInt(sem4marks) + parseInt(sem5marks) + parseInt(sem6marks) + parseInt(sem7marks) + parseInt(sem8marks);
		var totaloutoff = parseInt(sem3outoff) + parseInt(sem4outoff) + parseInt(sem5outoff) + parseInt(sem6outoff) + parseInt(sem7outoff) + parseInt(sem8outoff);
		var degreepointer = totalmarks/totaloutoff;
		alert(totalmarks);
		degreepointer = Math.round(degreepointer * 100) / 100;
		document.getElementById("totalmarks").value = totalmarks;
		document.getElementById("totaloutoff").value = totaloutoff;
		document.getElementById("degreepointer").value = degreepointer;
	}
}
</script>
<!--//Metis Menu -->
<style>
.button {
  background-color: #4CAF50; /* Green */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.button1 {
  background-color: #f44336; /* Red */
  border: none;
  color: white;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}
.button:hover{
    background: #337ab7;
}
.button1:hover{
    background: #337ab7;
}
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
		<form name="myform" onsubmit="calculate()" action="save.php" method="post">
			<div class="main-page general">
				<h2 class="title1"><?php echo $data['stname']?>'s Detail&nbsp;&nbsp;&nbsp;<?php if($role=='A') echo '<a href="editstudent.php"><img src="edit.png" width="3%"></a>';?></h2>
				<div class="panel-info widget-shadow">
					<h4 class="title2">Profile</h4>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Student Name</label>
									<div class="col-md-8">
										<input type="text" size="30" name="stname" value="<?php echo $data['stname']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Father Name</label>
									<div class="col-md-8">
										<input type="text" size="30" name="faname" value="<?php echo $data['faname']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Mother Name</label>
									<div class="col-md-8">
										<input type="text" size="30" name="moname" value="<?php echo $data['moname']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Date of Birth</label>
									<div class="col-md-8">
										<input type="text" size="30" name="dob" value="<?php echo $data['dob']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Student's Mobile</label>
									<div class="col-md-8">
										<input type="text" size="30" name="st_mobile" value="<?php echo $data['st_mobile']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Parent's Mobile</label>
									<div class="col-md-8">
										<input type="text" size="30" name="pa_mobile" value="<?php echo $data['pa_mobile']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">SAKEC Email ID</label>
									<div class="col-md-8">
										<input type="text" size="30" name="pemailid" value="<?php echo $data['pemailid']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Degree Start Year</label>
									<div class="col-md-8">
										<input type="text" size="30" name="sy" value="<?php echo $data1['sy']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Mentor Name</label>
									<div class="col-md-8">
										<input type="text" size="30" name="mentor_name" value="<?php echo $data['mentor_name']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Priority</label>
									<div class="col-md-8">
										<select name="priority" size="1">
											<option  value="crp" <?php if($data['priority']=="crp") echo 'selected="selected"'; ?> >Campus Recruitment Process</option>
											<option  value="higher_studies" <?php if($data['priority']=="higher_studies") echo 'selected="selected"'; ?> >Higher Study</option>
											<option  value="entrepreneur" <?php if($data['priority']=="entrepreneur") echo 'selected="selected"'; ?> >Entrepreneurship</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Registration No</label>
									<div class="col-md-8">
										<?php echo $reg_id; ?>
										<input type="hidden" name="reg_id" value="<?php echo $reg_id; ?>">
										<input type="hidden" name="type" value="<?php echo $type; ?>">
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
										<select name="branch" size="1">
											<option  value="elec" <?php if($data['branch']=="elec") echo 'selected="selected"'; ?> >Electronics Engineering</option>
											<option  value="comp" <?php if($data['branch']=="comp") echo 'selected="selected"'; ?> >Computer Engineering</option>
											<option  value="it" <?php if($data['branch']=="it") echo 'selected="selected"'; ?> >Information Technology</option>
											<option  value="extc" <?php if($data['branch']=="extc") echo 'selected="selected"'; ?> >Electronics & Telecommunication Engineering</option>
										</select>
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Division</label>
									<div class="col-md-8">
										<input type="text" size="30" name="division" value="<?php echo $data['division']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Roll Number</label>
									<div class="col-md-8">
										<input type="text" size="30" name="r_number" value="<?php echo $data['r_number']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Gender</label>
									<div class="col-md-8">
										<input type="radio" name="gender" <?=$data['gender']=="male" ? "checked" : ""?> value="male">Male
										<input type="radio" name="gender" <?=$data['gender']=="female" ? "checked" : ""?> value="female">Female
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Alternate Email ID</label>
									<div class="col-md-8">
										<input type="text" size="30" name="emailid" value="<?php echo $data['emailid']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Degree End Year</label>
									<div class="col-md-8">
										<input type="text" size="30" name="passyear" value="<?php echo $data['passyear']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Mentor Email</label>
									<div class="col-md-8">
										<input type="text" size="30" name="mentor_email" value="<?php echo $data['mentor_email']; ?>">
									</div>
								</div>
								<br>
								<div class="form-group">
									<label for="inputEmail3" class="col-md-4 control-label">Relocation/Bond</label>
									<div class="col-md-8">
										<select name="relocation" size="1">
											<option  value="y" <?php if($data['relocation']=="y") echo 'selected="selected"'; ?> >Ready to Relocate</option>
											<option  value="n" <?php if($data['relocation']=="n") echo 'selected="selected"'; ?> >Can not Relocate</option>
										</select>
										<select name="bond" size="1">
											<option  value="y" <?php if($data['bond']=="y") echo 'selected="selected"'; ?> >Ready to sign Bond</option>
											<option  value="n" <?php if($data['bond']=="n") echo 'selected="selected"'; ?> >Can not sign Bond</option>
										</select>
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
						<br>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">SSC Marks</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="5" id="sscmarks" name="sscmarks" value="<?php echo $data1['sscmarks']; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">SSC Out Off</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="5" id="sscoutoff" name="sscoutoff" value="<?php echo $data1['sscoutoff']; ?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">SSC Percentage</label>
									<div class="col-md-6">
										<input type="text" size="5" id="sscpercentage" name="sscpercentage" value="<?php echo $data1['sscpercentage']; ?>" readonly>
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
							<br>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">HSC Marks</label>
										<div class="col-md-6">
											<input onchange="calculate()" type="text" size="5" id="hscmarks" name="hscmarks" value="<?php echo $data1['hscmarks']; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">HSC Out Off</label>
										<div class="col-md-6">
											<input onchange="calculate()" type="text" size="5" id="hscoutoff" name="hscoutoff" value="<?php echo $data1['hscoutoff']; ?>">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">HSC Percentage</label>
										<div class="col-md-6">
											<input type="text" size="5" id="hscpercentage" name="hscpercentage" value="<?php echo $data1['hscpercentage']; ?>" readonly>
										</div>
									</div>
								</div>
							</div>
							<?php
							}
							?>
						<br>
						<?php
						if($data['type']=='diploma')
							{
							?>
							<div class="row">
								<h4 class="title3">Diploma</h4>
								<br>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">Year 1</label>
										<div class="col-md-6">
											<input onchange="calculate()" type="text" size="3" id="year1marks" name="year1marks" value="<?php 
											if($data1['year1marks']>0)
											{
												echo $data1['year1marks'];
											}
											?>">
											/
											<input onchange="calculate()" type="text" size="3" id="year1outoff" name="year1outoff" value="<?php 
											if($data1['year1marks']>0)
											{
												echo $data1['year1outoff'];
											}
											?>">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">Year 2</label>
										<div class="col-md-6">
											<input onchange="calculate()" type="text" size="3" id="year2marks" name="year2marks" value="<?php 
											if($data1['year2marks']>0)
											{
												echo $data1['year2marks'];
											}
											?>">
											/
											<input onchange="calculate()" type="text" size="3" id="year2outoff" name="year2outoff" value="<?php 
											if($data1['year2marks']>0)
											{
												echo $data1['year2outoff'];
											}
											?>">
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">Year 3</label>
										<div class="col-md-6">
											<input onchange="calculate()" type="text" size="3" id="year3marks" name="year3marks" value="<?php 
											if($data1['year3marks']>0)
											{
												echo $data1['year3marks'];
											}
											?>">
											/
											<input onchange="calculate()" type="text" size="3" id="year3outoff" name="year3outoff" value="<?php 
											if($data1['year3marks']>0)
											{
												echo $data1['year3outoff'];
											}
											?>">
										</div>
									</div>
								</div>
								<br><br><br>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">Total Marks</label>
										<div class="col-md-6">
											<input type="text" size="5" id="totaldmarks" name="totaldmarks" value="<?php 
												echo $data1['totaldmarks']; 
											?>" readonly>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">Total Outoff</label>
										<div class="col-md-6">
											<input type="text" size="5" id="totaldoutoff" name="totaldoutoff" value="<?php 
												echo $data1['totaldoutoff']; 
											?>" readonly>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="inputEmail3" class="col-md-6 control-label">Diploma %</label>
										<div class="col-md-6">
											<input type="text" size="5" id="diplomapercentage" name="diplomapercentage" value="<?php 
												echo $data1['diplomapercentage']; 
											?>" readonly>
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
						<br>
						<?php
						if($type=="hsc")
						{
						?>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 1</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem1marks" name="sem1marks" value="<?php 
										if($data1['sem1marks']>0)
										{
											echo $data1['sem1marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem1outoff" name="sem1outoff" value="<?php 
										if($data1['sem1marks']>0)
										{
											echo $data1['sem1outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 2</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem2marks" name="sem2marks" value="<?php 
										if($data1['sem2marks']>0)
										{
											echo $data1['sem2marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem2outoff" name="sem2outoff" value="<?php 
										if($data1['sem2marks']>0)
										{
											echo $data1['sem2outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 3</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem3marks" name="sem3marks" value="<?php 
										if($data1['sem3marks']>0)
										{
											echo $data1['sem3marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem3outoff" name="sem3outoff" value="<?php 
										if($data1['sem3marks']>0)
										{
											echo $data1['sem3outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 4</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem4marks" name="sem4marks" value="<?php 
										if($data1['sem4marks']>0)
										{
											echo $data1['sem4marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem4outoff" name="sem4outoff" value="<?php 
										if($data1['sem4marks']>0)
										{
											echo $data1['sem4outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<br><br><br>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 5</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem5marks" name="sem5marks" value="<?php 
										if($data1['sem5marks']>0)
										{
											echo $data1['sem5marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem5outoff" name="sem5outoff" value="<?php 
										if($data1['sem5marks']>0)
										{
											echo $data1['sem5outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 6</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem6marks" name="sem6marks" value="<?php 
										if($data1['sem6marks']>0)
										{
											echo $data1['sem6marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem6outoff" name="sem6outoff" value="<?php 
										if($data1['sem6marks']>0)
										{
											echo $data1['sem6outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 7</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem7marks" name="sem7marks" value="<?php 
										if($data1['sem7marks']>0)
										{
											echo $data1['sem7marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem7outoff" name="sem7outoff" value="<?php 
										if($data1['sem7marks']>0)
										{
											echo $data1['sem7outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 8</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem8marks" name="sem8marks" value="<?php 
										if($data1['sem8marks']>0)
										{
											echo $data1['sem8marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem8outoff" name="sem8outoff" value="<?php 
										if($data1['sem8marks']>0)
										{
											echo $data1['sem8outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<br><br><br>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Total C*G</label>
									<div class="col-md-6">
										<input type="text" size="5" id="totalmarks" name="totalmarks" value="<?php 
											echo $data1['totalmarks']; 
										?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Total C</label>
									<div class="col-md-6">
										<input type="text" size="5" id="totaloutoff" name="totaloutoff" value="<?php 
											echo $data1['totaloutoff']; 
										?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Pointer</label>
									<div class="col-md-6">
										<input type="text" size="5" name="degreepointer" id="degreepointer" value="<?php 
											echo $data1['degreepointer']; 
										?>" readonly>
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
						<?php
						}
						?>
						<?php
						if($type=="diploma")
						{
						?>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 3</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem3marks" name="sem3marks" value="<?php 
										if($data1['sem3marks']>0)
										{
											echo $data1['sem3marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem3outoff" name="sem3outoff" value="<?php 
										if($data1['sem3marks']>0)
										{
											echo $data1['sem3outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 4</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem4marks" name="sem4marks" value="<?php 
										if($data1['sem4marks']>0)
										{
											echo $data1['sem4marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem4outoff" name="sem4outoff" value="<?php 
										if($data1['sem4marks']>0)
										{
											echo $data1['sem4outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 5</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem5marks" name="sem5marks" value="<?php 
										if($data1['sem5marks']>0)
										{
											echo $data1['sem5marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem5outoff" name="sem5outoff" value="<?php 
										if($data1['sem5marks']>0)
										{
											echo $data1['sem5outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<br><br><br>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 6</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem6marks" name="sem6marks" value="<?php 
										if($data1['sem6marks']>0)
										{
											echo $data1['sem6marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem6outoff" name="sem6outoff" value="<?php 
										if($data1['sem6marks']>0)
										{
											echo $data1['sem6outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 7</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem7marks" name="sem7marks" value="<?php 
										if($data1['sem7marks']>0)
										{
											echo $data1['sem7marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem7outoff" name="sem7outoff" value="<?php 
										if($data1['sem7marks']>0)
										{
											echo $data1['sem7outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Semester 8</label>
									<div class="col-md-6">
										<input onchange="calculate()" type="text" size="3" id="sem8marks" name="sem8marks" value="<?php 
										if($data1['sem8marks']>0)
										{
											echo $data1['sem8marks'];
										}
										?>">
										/
										<input onchange="calculate()" type="text" size="3" id="sem8outoff" name="sem8outoff" value="<?php 
										if($data1['sem8marks']>0)
										{
											echo $data1['sem8outoff'];
										}
										?>">
									</div>
								</div>
							</div>
							<br><br><br>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Total C*G</label>
									<div class="col-md-6">
										<input type="text" size="5" id="totalmarks" name="totalmarks" value="<?php 
											echo $data1['totalmarks']; 
										?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Total C</label>
									<div class="col-md-6">
										<input type="text" size="5" id="totaloutoff" name="totaloutoff" value="<?php 
											echo $data1['totaloutoff']; 
										?>" readonly>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Pointer</label>
									<div class="col-md-6">
										<input type="text" size="5" name="degreepointer" id="degreepointer" value="<?php 
											echo $data1['degreepointer']; 
										?>" readonly>
									</div>
								</div>
							</div>
						<?php
						}
						?>
					</div>
						<br>
						<div class="row">
						<h4 class="title3">KT Details</h4>
						<br>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Live KT</label>
									<div class="col-md-6">
										<input type="text" size="5" name="livekt" value="<?php echo $data1['livekt'] ?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Dead KT</label>
									<div class="col-md-6">
										<input type="text" size="5" name="deadkt" value="<?php echo $data1['deadkt'] ?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Attempts</label>
									<div class="col-md-6">
										<input type="text" size="5" name="attempts" value="<?php echo $data1['attempts'] ?>">
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<label for="inputEmail3" class="col-md-6 control-label">Drop</label>
									<div class="col-md-6">
										<input type="text" size="5" size="5" name="drops" value="<?php echo $data1['drops'] ?>">
									</div>
								</div>
							</div>
						</div>
					<center><input class="button" type="submit" name="submit" value="Update"><input  class="button1" type="reset" name="reset" value="Reset"></center>
					<div class="clearfix"> </div>
				</div>
			</div>
		</form>
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
					classie.toggle( showLeftPush, 'readonly' );
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