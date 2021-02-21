<?php 
ob_start();
session_start();
if(isset($_POST['save']) || isset($_POST['savec']))
   {
        $cname=$_POST['cname'];
		$year=$_POST['year'];
		$campus=$_POST['campus'];
		include('dbconnect.php');
		echo $year;
		echo $campus;
		$s="select * from company where year='$year' and campus='$campus'";
		$sql=mysqli_query($con,$s);
		$data=mysqli_fetch_assoc($sql);
		$c_id=$data['c_id'];
		$counter=mysqli_num_rows($sql);
		if($counter==0)
			$counter=1;
		$counter = sprintf("%02d", $counter);
		$ccode=$year%100;
		$ccode=$ccode.$campus.$counter;
		$result = mysqli_query($con,"INSERT INTO company (cname, year, campus, ccode,status) VALUES ('$cname','$year','$campus','$ccode','S')");
		$s="select * from company where ccode='$ccode'";
		$sql=mysqli_query($con,$s);
		$data=mysqli_fetch_assoc($sql);
		$c_id=$data['c_id'];
		if($result)
			if($_POST['save'])
				header('location: admin.php');
			else
				header("location: crinfo.php?c_id=$c_id");
   }
?>