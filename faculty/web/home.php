<?php
ob_start();
session_start();
if(!(isset($_SESSION['login_user'])))
{
header("location: index.php");
}
?>
<?php
$reg_id = $_SESSION['login_user'];
include('dbconnect.php');
$query = mysqli_query($con, "select * from user where reg_id='$reg_id'");
$rows = mysqli_num_rows($query);
$data = mysqli_fetch_assoc($query);
$uname=$data['uname'];
$message_out='';
$a=mysqli_query($con,"select * from message_list where user_id='$reg_id' order by mail_id+0 DESC ");
while($b=mysqli_fetch_array($a))
{
$mail_id=$b['mail_id'];
$c=mysqli_query($con,"select * from message where mail_id='$mail_id' ");
$d = mysqli_fetch_assoc($c);
$message=$d['message'];
$message = substr($message, 0, 100);
$send_date=date('d M , Y',strtotime($d['send_date']));
$message_out.='
	<tr>
	    <td class="mailbox-subject"><a href="#" class="view-message" id="'.$mail_id.'" style="color:#333"><b>'.$d['subject'].'</b> - '.$message.'...</a></td>
	    <td class="mailbox-date" style="text-align:right">'.$send_date.'</td>
    </tr>
    ';
}
mysqli_close($con);
?>
<!DOCTYPE HTML>
<html>
<head>
<title>SAKEC - PlaceMate</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Glance Design Dashboard Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
SmartPhone Compatible web template, free WebDesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<link rel="icon" type="image/png" href="favicon.png">
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>

<!-- Bootstrap Core CSS -->
<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />

<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />

<!-- font-awesome icons CSS -->
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- //font-awesome icons CSS-->

<!-- side nav css file -->
<link href='css/SidebarNav.min.css' media='all' rel='stylesheet' type='text/css'/>
<!-- //side nav css file -->
 
 <!-- js-->
<script src="js/jquery-1.11.1.min.js"></script>
<script src="js/modernizr.custom.js"></script>

<!--webfonts-->
<link href="//fonts.googleapis.com/css?family=PT+Sans:400,400i,700,700i&amp;subset=cyrillic,cyrillic-ext,latin-ext" rel="stylesheet">
<!--//webfonts--> 

<!-- chart -->
<script src="js/Chart.js"></script>
<!-- //chart -->

<!-- Metis Menu -->
<script src="js/metisMenu.min.js"></script>
<script src="js/custom.js"></script>
<link href="css/custom.css" rel="stylesheet">
<!--//Metis Menu -->
</head> 
<body class="cbp-spmenu-push">
	<div class="main-content">
	<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
		<!--left-fixed -navigation-->
		<aside class="sidebar-left">
      <nav class="navbar navbar-inverse">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".collapse" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="index.html">SAKEC<span class="dashboard_text">PlaceMate</span></a></h1>
          </div>
          <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="sidebar-menu">
              <li class="treeview">
                <a href="home.php">
                <i class="fa fa-envelope"></i> <span>Inbox</span>
                </a>
              </li>
			  <li class="treeview">
                <a href="logout.php">
                <i class="fa fa-laptop"></i>
                <span>Logout</span>
                </a>
              </li>
          </div>
          <!-- /.navbar-collapse -->
      </nav>
    </aside>
	</div>
		<!--left-fixed -navigation-->
		<!-- header-starts -->
		<div class="sticky-header header-section ">
			<div class="header-left">
				<!--toggle button start-->
				<button id="showLeftPush"><i class="fa fa-bars"></i></button>
				<!--toggle button end-->
				<div><!--notification menu starts-->
				</div>
				<!--notification menu end -->
				<div class="clearfix"> </div>
			</div>
			<div class="header-right">	
				<!--search-box-->
				<div class="search-box">
				</div><!--//end-search-box-->
				<div class="profile_details">		
					<div class="profile_img">	
						<span class="prfil-img"><img src="images/user1.png" alt=""> </span> 
						<div class="user-name">
							<p><?php echo $reg_id; ?></p>
							<span><?php echo $uname; ?></span>
						</div>
					</div>	
				</div>
				<div class="clearfix"> </div>				
			</div>
			<div class="clearfix"> </div>	
		</div>
		<!-- //header-ends -->
		<!-- main content start-->
		<div id="page-wrapper">
			<h3>Inbox</h3>
			<div class="box box-primary">
				<div class="box-body no-padding">
					<div class="table-responsive mailbox-messages">
						<table class="table table-hover table-striped">
							<tbody>
								<?php echo $message_out ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div id="myModal" class="modal fade" role="dialog">
				<div class="modal-dialog">
					<!-- Modal content-->
				</div>
			</div>
		</div>
		<!-- ./wrapper -->
		<!-- jQuery 2.1.4 -->
<script src="jQuery-2.1.4.min.js"></script>
<!-- FastClick -->
<script src="fastclick.js"></script>
<!-- AdminLTE App -->
<script src="app.min.js"></script>
<!-- iCheck -->
<script src=" plugins/iCheck/icheck.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src=" demo.js"></script>
		<script>
		$(document).ready(function(){
			$(".view-message").click(function(){
				var id=$(this).attr('id');
				$.ajax({
					type:"GET",
					url:"viewmessage.php?id="+id,
					cache:false,
					success:function(data){
						$("#myModal>div").empty();
						$("#myModal>div").append(data);
						$("#myModal").modal();
					}
				})
			})
		})
		</script>		
    </div>	
	<!--//footer-->
	<div class="footer">
	   <p>&copy; Shah & Anchor Kutchhi Engineering College. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank">Training & Placement Department</a></p>		
	</div>
	<!--footer-->
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
			<!-- //Classie --><!-- //for toggle left push menu script -->
		
	<!--scrolling js-->
	<script src="js/jquery.nicescroll.js"></script>
	<script src="js/scripts.js"></script>
	<!--//scrolling js-->
	
	<!-- side nav js -->
	<script src='js/SidebarNav.min.js' type='text/javascript'></script>
	<script>
      $('.sidebar-menu').SidebarNav()
    </script>
	<!-- //for index page weekly sales java script -->
	
	
	<!-- Bootstrap Core JavaScript -->
   <script src="js/bootstrap.js"> </script>
	<!-- //Bootstrap Core JavaScript -->
</body>
</html>