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
$query = mysqli_query($con, "select MIN(sscpercentage) from hscmark");
$data = mysqli_fetch_assoc($query);
$sscmin= $data['MIN(sscpercentage)'];
$sscmin=round($sscmin);
$query = mysqli_query($con, "select MIN(sscpercentage) from dipmarks");
$data = mysqli_fetch_assoc($query);
$sscdmin= $data['MIN(sscpercentage)'];
$sscdmin=round($sscdmin);
if($sscmin>$sscdmin)
	$sscmin=$sscdmin;
$query = mysqli_query($con, "select MIN(hscpercentage) from hscmark");
$data = mysqli_fetch_assoc($query);
$hscmin= $data['MIN(hscpercentage)'];
$hscmin=round($hscmin);
$query = mysqli_query($con, "select MIN(diplomapercentage) from dipmarks");
$data = mysqli_fetch_assoc($query);
$diplomamin= $data['MIN(diplomapercentage)'];
$diplomamin=round($diplomamin);
$query = mysqli_query($con, "select MIN(degreepointer) from hscmark");
$data = mysqli_fetch_assoc($query);
$degreepointermin= $data['MIN(degreepointer)'];
$degreepointermin=round($degreepointermin);
$query = mysqli_query($con, "select MIN(degreepointer) from dipmarks");
$data = mysqli_fetch_assoc($query);
$degreepointerdmin= $data['MIN(degreepointer)'];
$degreepointerdmin=round($degreepointerdmin);
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
				<h2 class="title1">Criteria</h2>
				<div class="panel-info widget-shadow">
						<form action="search_result.php" method="get" class="form-horizontal">
							<div class="row">
								<div class="col-sm-12">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-2 control-label">Student name</label>
										<div class="col-sm-10">
											<input type="text" class="form-control" name="stname" id="inputEmail3" placeholder="Student Name">
										</div>
									</div>
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Branch</label>
										<div class="col-sm-8">
											<input type="checkbox" name="branch[]" value="elec" checked> Electronics &nbsp;
											<input type="checkbox" name="branch[]" value="comp" checked> Computer &nbsp;
											<input type="checkbox" name="branch[]" value="it" checked> IT &nbsp;
											<input type="checkbox" name="branch[]" value="extc" checked> EXTC &nbsp;
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Type</label>
										<div class="col-sm-8">
											<input type="checkbox" name="type[]" value="h" checked> HSC
											<input type="checkbox" name="type[]" value="d" checked> Diploma
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">SSC Percentage (>=)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="sscpercentage" value="<?php echo $sscmin?>" >
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Degree CGPI (>=)</label>
										<div class="col-sm-4">
											<input type="text" class="form-control col-sm-6" name="degree" value="<?php echo $degreepointermin?>" > 
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control col-sm-6" name="degree1" value="10" >
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Sem 3 Onwards CGPI (>=)</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="sem3onward" value="<?php echo $degreepointerdmin?>">
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="sem3onward1" value="10">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Live KT (<=)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="livekt" value="0" id="livekt" >
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label"> No Of Attempts(<=)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="attempts" id="attempt" value="0">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">IS Placed</label>
										<div class="col-sm-8">
											Not Placed <Input type = "Radio" name="isplaced" value="n" checked> &nbsp; &nbsp;
											Placed <Input type = "Radio" name="isplaced" value="y"> &nbsp; &nbsp;
											Any <Input type = "Radio" name="isplaced" value="b">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">IS Defaulter</label>
										<div class="col-sm-8">
											Yes <Input type="Radio" name="isdefaulter" value="y"> &nbsp; &nbsp;
											No <Input type="Radio" name ="isdefaulter" value="n" checked>
										</div>
									</div>
									<div class="form-group">
										<div class="col-sm-8">	<input type="checkbox" id="not" /> Kt's Not Applicable</div>
									</div>  
								</div>
								<div class="col-sm-6">
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Gender</label>
										<div class="col-sm-8">
											<input type="checkbox" name="gender[]" value="male" checked> Male &nbsp;
											<input type="checkbox" name="gender[]" value="female" checked> Female &nbsp;
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">Passing year</label>
										<div class="col-sm-8">
											<select class="form-control" name="passyear" required>
												<option value="2021">2021</option>
												<option value="2020">2020</option>
												<option value="2019">2019</option>
												<option value="2018">2018</option>
												<option value="2017">2017</option>
												<option value="2016">2016</option>
											</select>
										</div>
									</div>
									<div class="form-group">
										<label for="inputPassword3" class="col-sm-4 control-label">HSC Percentage (>=)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="hscpercentage" value="<?php echo $hscmin?>" >
										</div>	
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Diploma Percentage (>=)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="diplomapercentage" value="<?php echo $diplomamin?>">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Drops</label>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="drops" id="drops" value="0" >
										</div>
										<div class="col-sm-4">
											<input type="text" class="form-control" name="drops1" id="drops1" value="10" >
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Dead KT (<=)</label>
										<div class="col-sm-8">
											<input type="text" class="form-control" name="deadkt" id="deadkt" value="0" >
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Priority</label>
										<div class="col-sm-8">
											CRP <Input type = "Radio" name="priority" value="crp"  checked> &nbsp; &nbsp;
											HS <Input type = "Radio" name="priority" value="higher_studies"> &nbsp; &nbsp;
											Entrepreneur <Input type = "Radio" name="priority" value="entrepreneur">
											Any <Input type = "Radio" name="priority" value="">
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Relocation</label>
										<div class="col-sm-8">
											Ready <Input type = "Radio" name="relocation" value="y"> &nbsp; &nbsp;
											Not Ready <Input type = "Radio" name="relocation" value="n"> &nbsp; &nbsp;
											Any <Input type = "Radio" name="relocation" value="b" checked>
										</div>
									</div>
									<div class="form-group">
										<label for="inputEmail3" class="col-sm-4 control-label">Bond</label>
										<div class="col-sm-8">
											Ready <Input type = "Radio" name="bond" value="y" > &nbsp; &nbsp;
											Not Ready <Input type = "Radio" name="bond" value="n"> &nbsp; &nbsp;
											Any <Input type = "Radio" name="bond" value="b" checked>
										</div>
									</div>
								</div>
							</div>
							<div class="box-footer">
									<input type="reset" class="btn btn-danger pull-right" value="Reset" style="margin-left:10px" />
									<input type="submit" class="btn btn-info pull-right" name="search" id="search" value="Search">
							</div>
							<div class="clearfix"> </div>
						</form>
					</div>
				</div>
			</div>
		<!-- main content send->
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
			
			$(document).ready(function(){
	$("#not").click(function(){
		if (this.checked) {
			
			$("#attempt").val('100');
			$("#livekt").val('100');
			$("#deadkt").val('100');
			
			$("#attempt").attr('readonly','true');
			$("#livekt").attr('readonly','true');
			$("#deadkt").attr('readonly','true');
		}
		else{
			
			$("#attempt").val('0');
			$("#livekt").val('0');
			$("#deadkt").val('0');
			
			$("#attempt").removeAttr('readonly');
			$("#livekt").removeAttr('readonly');
			$("#deadkt").removeAttr('readonly');	
		}
	})
})
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