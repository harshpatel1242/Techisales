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

	$out='';
	$to='';
	$st_mobile='';
	$company='';
	$i=1;
	$ssc=$_GET['sscpercentage'];
	$hsc=$_GET['hscpercentage'];
	$degree0=$_GET['degree'];
	$degree1=$_GET['degree1'];
	$sem3onward=$_GET['sem3onward'];
	$sem3onward1=$_GET['sem3onward1'];
	$livekt=$_GET['livekt'];
	$isplaced=$_GET['isplaced'];
	$isdefaulter=$_GET['isdefaulter'];
	$passyear=$_GET['passyear'];
	$diplomapercentage=$_GET['diplomapercentage'];
	$drops0=$_GET['drops'];
    $drops1=$_GET['drops1'];
	$deadkt=$_GET['deadkt'];
	$attempts=$_GET['attempts'];
	$priority=$_GET['priority'];
	$relocation=$_GET['relocation'];
	$bond=$_GET['bond'];
	$branch=$_GET['branch'];
	$gender=$_GET['gender'];
	$type=$_GET['type'];
	include('dbconnect.php');
	foreach ($branch as $b) {
		if($relocation=='b' && $bond=='b' && $gender=='fm' && $type=='hb')
		{
			$query=mysqli_query($con,"select * from student_details where priority='$priority' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'");
		}
		$count=mysqli_num_rows($query);
		if($count>0){
			while ($v=mysqli_fetch_array($query)) {
				$reg_id=$v['reg_id'];
				$type=$v['type'];
				if($type=="h"){
					$sql=mysqli_query($con,"select * from hscmark where reg_id='$reg_id' and sscpercentage>='$ssc' and hscpercentage>='$hsc' and (degreepointer BETWEEN ".$degree0." AND ".$degree1.") and (drops BETWEEN ".$drops0." AND ".$drops1.") and livekt<='$livekt' and deadkt<='$deadkt' and attempts<='$attempts'   ");
				}
				if($type=="d"){
					$sql=mysqli_query($con,"select * from dipmarks where reg_id='$reg_id' and sscpercentage>='$ssc' and diplomapercentage>='$diplomapercentage' and (degreepointer BETWEEN ".$sem3onward." AND ".$sem3onward1.") and (drops BETWEEN ".$drops0." AND ".$drops1.") and livekt<='$livekt' and deadkt<='$deadkt' and attempts<='$attempts' ");
				}
				$co=mysqli_num_rows($sql);
				if($co==1){
					 if($isplaced!="b"){
					 	$sq1=mysqli_query($con,"select * from student_details where reg_id='$reg_id' and placed='$isplaced'");
					 	$c=mysqli_num_rows($sq1);
						if($c==1){
					 		while ($s=mysqli_fetch_array($sq1)) {
									
								$reg_id=$s['reg_id'];
								$to.=''.$reg_id.';';
								$x='';
								$placed='';
								$company_id=$s['company_id'];
								$c=mysqli_fetch_array(mysqli_query($con,"select * from company where c_id='$company_id'"));
								$placed=$c['cname'];		
								if($placed=="")
		                            $placed='No';
								$type=$s['type'];
								$hscpercent='';
								if($type=='h'){
									$x=mysqli_fetch_array(mysqli_query($con,"select * from hscmark where reg_id='$reg_id'"));$hscpercent=$x['hscpercentage'];
									}
								if($type="d"){
									$x=mysqli_fetch_array(mysqli_query($con,"select * from dipmarks where reg_id='$reg_id'"));$hscpercent=$x['diplomapercentage'];
									}
								if($s['branch']=='elec')
										$branchd='Electronics Engineering';
									if($s['branch']=='comp')
										$branchd='Computer Engineering';
									if($s['branch']=='it')
										$branchd='Information Technology';
									if($s['branch']=='extc')
										$branchd='Electronics & Telecommunication Engineering';
									$out.='
								<tr>
									<td>'.$i.'</td>
						            <td><a href="viewstudent.php?id='.$reg_id.'">'.$reg_id.'</a></td>
						            <td>'.$s['stname'].'</td>
						            <td>'.$x['degreepointer'].'</td>
						            <td>'.$hscpercent.'</td>
						            <td>'.$x['sscpercentage'].'</td>
						            <td>'.$s['st_mobile'].'</td>
						            <td>'.$s['emailid'].'</td>
						            <td>'.$branchd.'</td>
						            <td>'.$s['division'].'</td>
						            <td>'.$s['type'].'</td>
									<td>'.$placed.'</td>
						        </tr>
								';
								$i++;
							}
					 	}
					 }
					 else{
					 	$sq1=mysqli_query($con,"select * from student_details where reg_id='$reg_id'");
							$c=mysqli_num_rows($sq1);
						 	if($c==1){
						 		while ($s=mysqli_fetch_array($sq1)) {
									$reg_id=$s['reg_id'];
									$to.=''.$reg_id.';';
									$x='';
                                    $placed='';
                                    $company_id=$s['company_id'];
                                    $c=mysqli_fetch_array(mysqli_query($con,"select * from company where c_id='$company_id'"));
                                    $placed=$c['cname'];
		                            if($placed=="")
		                                $placed='No';
									$type=$s['type'];
									$hscpercent='';
									if($type=='h'){$x=mysqli_fetch_array(mysqli_query($con,"select * from hscmark where reg_id='$reg_id'"));$hscpercent=$x['hscpercentage'];}
									else{$x=mysqli_fetch_array(mysqli_query($con,"select * from dipmarks where reg_id='$reg_id'"));$hscpercent=$x['diplomapercentage'];}
									if($s['branch']=='elec')
										$branchd='Electronics Engineering';
									if($s['branch']=='comp')
										$branchd='Computer Engineering';
									if($s['branch']=='it')
										$branchd='Information Technology';
									if($s['branch']=='extc')
										$branchd='Electronics & Telecommunication Engineering';
									$out.='
									<tr>
									<td>'.$i.'</td>
							            <td><a href="viewstudent.php?id='.$reg_id.'">'.$reg_id.'</a></td>
							            <td>'.$s['stname'].'</td>
							            <td>'.$x['degreepointer'].'</td>
						           		<td>'.$hscpercent.'</td>
						           		<td>'.$x['sscpercentage'].'</td>
						           		<td>'.$x['livekt'].'</td>
						                <td>'.$s['emailid'].'</td>
										<td>'.$branchd.'</td>
							            <td>'.$s['division'].'</td>
							            <td>'.$s['type'].'</td>
                                        <td>'.$placed.'</td>
							        </tr>
									';
									$i++;
								}
						 	}
					 }
					 
				}
			}
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
<link rel="shortcut icon" type="image/x-icon" href="favicon.png"/>
<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href='https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css' />
<link href='https://cdn.datatables.net/buttons/1.5.6/css/buttons.dataTables.min.css'/>
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
				<div class="panel-info widget-shadow">
					<h4 class="title2">Student List</h4>
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>Sr No.</th>
										<th>Reg ID</th>
										<th>Name</th>
										<th>Degree Pointer</th>
										<th>HSC / Diploma</th>
										<th>SSC</th>
										<th>Mobile</th>
										<th>Email ID</th>
										<th>Branch</th>
										<th>Div</th>
										<th>Type</th>
										<th>Placed</th>
									</tr>
								</thead>
								<tbody>
								<?php echo $out ?>
								</tbody>
								<tfoot>
								<tr>
									<th>Sr No.</th>
									<th>Reg ID</th>
									<th>Name</th>
									<th>Degree Pointer</th>
									<th>HSC / Diploma</th>
									<th>SSC</th>
									<th>Mobile</th>
									<th>Email ID</th>
									<th>Branch</th>
									<th>Div</th>
									<th>Type</th>
									<th>Placed</th>
								</tr>
								</tfoot>
							</table>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<br><br><label for="input requiredEmail3" class="col-md-2 control-label">Subject</label>
								<div class="col-md-10">
									<input required type="text" class="form-control" name="subject" id="input requiredEmail3" >
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<br><label for="input requiredEmail3" class="col-md-2 control-label">Company Registration</label>
								<div class="col-md-10">
									<select id="cname" name="cname" class="form-control">
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
					</div>
				</div>
				<div class="clearfix"> </div>
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
	<script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	
	<script type="text/javascript">
    $(document).ready(function() {
    $('.table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
		{
			extend: 'excel',
			title: 'Search Students',
		},
		{
			extend: 'print',
			title: 'Search Students',
		}
        ]
    } );
} );
    </script>
</body>
</html>