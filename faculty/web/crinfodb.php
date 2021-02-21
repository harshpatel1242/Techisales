<?php
ob_start();
session_start();
if(isset($_POST['update']))
{
	$cname=$_POST['cname'];
	$year=$_POST['year'];
	$type = implode("",$_POST["type"]);
	echo $type;
	if($type=='hdb')
		$type='a';
	if($type=='hd')
		$type='hd';
	$gender = implode("",$_POST["gender"]);
	if($gender='fm')
		$gender='b';
	$ssc=$_POST['ssc'];
	$hsc=$_POST['hsc'];
	$diploma=$_POST['diploma'];
	$degree=$_POST['degree'];
	$deadkt=$_POST['deadkt'];
	$livekt=$_POST['livekt'];
	$drops=$_POST['drops'];
	$package=$_POST['package'];
	$bond=$_POST['bond'];
	$relocation=$_POST['relocation'];
	$remarks=$_POST['remarks'];
	include('dbconnect.php');
	$sqq=mysqli_query($con,"select * from company_info where c_id='$cname'");
	$count=mysqli_num_rows($sqq);
	if($count<1)
	{
		$i=mysqli_query($con,"insert into company_info (c_id,type,gender,ssc,hsc,diploma,degree,deadkt,livekt,drops,package,bond,relocation,remarks) values ('$cname','$type','$gender','$ssc','$hsc','$diploma','$degree','$deadkt','$livekt','$drops','$package','$bond','$relocation','$remarks')");
	}
	else
	{
		mysqli_query($con,"update company_info set type='$type',gender='$gender',ssc='$ssc',hsc='$hsc',diploma='$diploma',degree='$degree',deadkt='$deadkt',livekt='$livekt',drops='$drops',package='$package',bond='$bond',relocation='$relocation',remarks='$remarks' where c_id='$cname'");	
	}
	header('location: admin.php');
}
?>