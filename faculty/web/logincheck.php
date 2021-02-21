<?php 
$error='';
$err=0;
include('dbconnect.php');
if(isset($_POST['submit']))
   {
        $reg_id=$_POST['reg_id'];
        $password=$_POST['pass'];
		$password=md5($password);
        $sql=mysqli_query($con,"select * from user where reg_id='$reg_id' and password='$password' ");
        $count=mysqli_num_rows($sql);
       if($count==1)
       {    $x=mysqli_fetch_array($sql);
            $reg_id=$x['reg_id'];
            session_start();
            $_SESSION['login_user']=$reg_id;
           $sql1=mysqli_query($con,"select * from student_details where reg_id='$reg_id'");
        $pcount=mysqli_num_rows($sql1);
            $acount=mysqli_num_rows(mysqli_query($con,"select * from hscmark where reg_id='$reg_id'"));
            $dcount=mysqli_num_rows(mysqli_query($con,"select * from dipmarks where reg_id='$reg_id'"));
            $rcount=mysqli_num_rows(mysqli_query($con,"select * from resume where reg_id='$reg_id'"));
           $count=mysqli_num_rows($sql);
           if($pcount==0 && $rcount==0)
           {
            
            header('location:changepassword.php');
           }
        else
        {
           if( $pcount==1 && $rcount==1 )
           {
               if(($acount==0 && $dcount==1) || ($acount==1 && $dcount==0))
                {
                   header('location:home.php');
                }
               else
               {
               header('location:personal_details.php'); 
               }
           } 
           else
           {
            header('location:personal_details.php');   
           } 
       }
       }
       $sql1=mysqli_query($con,"select * from admin where reg_id='$reg_id' and password='$password' ");
       $count1=mysqli_num_rows($sql1);
       if($count1==1)
       {
           $x=mysqli_fetch_array($sql1);
            $reg_id=$x['reg_id'];
            session_start();
            $_SESSION['login_user']='admin';
			$_SESSION['login']=$reg_id;
             header('location:admin.php');
       }
       #else
       #{
       	#$sql2=mysqli_query($con,"select * from guest where g_id='$reg_id' and pwd='$password'");
		#$count2=mysqli_num_rows($sql2);
		#if($count2==1){
		#	$x=mysqli_fetch_array($sql2);
		#	$gid=$x['g_id'];
		#	session_start();
        #    $_SESSION['guest_user']=$gid;
        #    header('location:welcome_guest.php');
		#}
		
		else{
			print '<script type="text/javascript">'; 
			print 'alert("Error: Invalid Credentials.");'; 
			print 'window.location.href = "login.php";';
			print '</script>';  
		}
		
           
	}
?>