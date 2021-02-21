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
if(isset($_GET['c_id']))
	{
		$c_id=$_GET['c_id'];
		$sq0=mysqli_query($con,"select * from company where c_id='$c_id'");
		$count=mysqli_num_rows($sq0);
		$result0=mysqli_fetch_assoc($sq0);
		$cname=$result0['cname'];
		$year=$result0['year'];
		$sq1=mysqli_query($con,"select * from company_info where c_id='$c_id'");
		$count=mysqli_num_rows($sq1);
		$result=mysqli_fetch_assoc($sq1);
		if($count>0)
		{
			$type=$result['type'];
			$gender=$result['gender'];
			$ssc=$result['ssc'];
			$hsc=$result['hsc'];
			$diploma=$result['diploma'];
			$degree=$result['degree'];
			$deadkt=$result['deadkt'];
			$livekt=$result['livekt'];
			$drops=$result['drops'];
			$package=$result['package'];
			$bond=$result['bond'];
			$relocation=$result['relocation'];
			$remarks=$result['remarks'];
		}
		else
		{
			$type='a';
			$gender='b';
			$ssc='';
			$hsc='';
			$diploma='';
			$degree='';
			$deadkt='';
			$livekt='';
			$drops='';
			$package='';
			$bond='';
			$relocation='';
			$remarks='';
		}
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
<script>
function myFunction() {
  var c_id=document.getElementById("cname").value;
  window.location.href = "crinfo.php?c_id="+c_id;
}
</script>
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
						<li class="dropsdown profile_details_drops">
							<a href="#" class="dropsdown-toggle" data-toggle="dropsdown" aria-expanded="false">
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
							<ul class="dropsdown-menu drp-mnu">
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
				<h2 class="title1">Company Criteria</h2>
				<div class="panel-info widget-shadow">
				<div class="row">
					<form name="formname" action="crinfodb.php" method="post">
					<div class="col-md-12">
						<div class="form-group">
							<label for="input requiredEmail3" class="col-md-3 control-label">Company Name</label>
							<div class="col-md-9">
								<select id="cname"  onchange="myFunction()" id="cname" name="cname" class="form-control">
									<option value="">---Select Company---</option>
									<?php
									$sql=mysqli_query($con,"select * from company where c_id!='999' order by ccode ASC");
									while($row=mysqli_fetch_array($sql))
									{
										if($row['c_id']==$_GET['c_id'])
										{
											echo "<option selected value=$row[c_id]>$row[cname]($row[ccode])</option>";
										}
										else
										{
											echo "<option value=$row[c_id]>$row[cname]($row[ccode])</option>";
										}
									  }
									?>
								</select>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Eligible Year</label>
							<div class="col-md-9">
								<input required type="text" class="form-control" name="year" id="input requiredEmail3" value="<?php echo $year;?>" readonly>
							</div>
						</div>
					</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Type</label>
									<div class="col-md-9">
										<input type="checkbox" name="type[]" <?php if($type=="h"||$type=="hd"||$type=="a") {echo "checked";}?> value="h">HSC
										<input type="checkbox" name="type[]" <?php if($type=="d"||$type=="hd"||$type=="a") {echo "checked";}?> value="d">Diploma
										<input type="checkbox" name="type[]" <?php if($type=="b"||$type=="a") {echo "checked";}?> value="b">HSC+Diploma
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Gender</label>
									<div class="col-md-9">
										<input type="checkbox" name="gender[]" <?php if($gender=="f"||$gender=="b") {echo "checked";}?> value="f">Female
										<input type="checkbox" name="gender[]" <?php if($gender=="m"||$gender=="b") {echo "checked";}?> value="m">Male
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">SSC</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="ssc" id="input requiredEmail3"  value="<?php echo $ssc; ?>" placeholder="SSC Percentage">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">HSC</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="hsc" id="input requiredEmail3"  value="<?php echo $hsc; ?>" placeholder="HSC Percentage">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Diploma</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="diploma" id="input requiredEmail3"  value="<?php echo $diploma; ?>" placeholder="Diploma Percentage">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">CGPA</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="degree" id="input requiredEmail3"  value="<?php echo $degree; ?>" placeholder="Enter Degree CGPA">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Live KT</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="livekt" id="input requiredEmail3"  value="<?php echo $livekt; ?>" placeholder="No of Live KTs">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Dead KT</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="deadkt" id="input requiredEmail3"  value="<?php echo $deadkt; ?>" placeholder="No of Dead KTs">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">drops</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="drops" id="input requiredEmail3"  value="<?php echo $drops; ?>" placeholder="No of dropss">
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Package</label>
									<div class="col-md-9">
										<input required type="text" class="form-control" name="package" id="input requiredEmail3"  value="<?php echo $package; ?>" placeholder="Enter Package in LPA">
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Bond</label>
									<div class="col-md-9">
										<input required type="radio" name="bond" <?=$bond=="y" ? "checked" : ""?> value="y">Yes &nbsp; &nbsp;
										<input required type="radio" name="bond" <?=$bond=="n" ? "checked" : ""?> value="n">No
										<Input required type="Radio" name="bond" <?=$bond=="b" ? "checked" : ""?> value="b">Any 
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Relocation</label>
									<div class="col-md-9">
										<input required type="radio" name="relocation" <?=$relocation=="y" ? "checked" : ""?> value="y">Yes &nbsp; &nbsp;
										<input required type="radio" name="relocation" <?=$relocation=="n" ? "checked" : ""?> value="n">No
										<input required type="radio" name="relocation" <?=$relocation=="b" ? "checked" : ""?> value="b">Any
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<br><br><label for="input requiredEmail3" class="col-md-3 control-label">Remarks</label>
								<div class="col-md-9">
									<input required type="text" class="form-control" name="remarks" id="input requiredEmail3"  value="<?php echo $remarks; ?>" placeholder="Anything else">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="input requiredEmail3" class="col-md-3 control-label"></label>
								<div class="col-md-9">
								</div>
							</div>	
						</div>
						<div class="box-footer">
									<input required type="reset" class="btn btn-danger pull-right" value="Reset" style="margin-left:10px" />
									<input required type="submit" class="btn btn-info pull-right" name="update" id="update" value="Update">
						</div>	
					<div class="clearfix"> </div>
					</form>
				</div>
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