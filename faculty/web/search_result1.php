<?php
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
	$type=$_GET['type'];
	$gender=$_GET['gender'];
echo "ssc:".$ssc;
echo "hsc:".$hsc;
echo "min:".$degree0;
echo "max:".$degree1;
echo "min:".$sem3onward;
echo "max:".$sem3onward1;
echo "live:".$livekt;
echo $isplaced;
echo $isdefaulter;
echo $passyear;
echo $diplomapercentage;
echo $drops0;
echo $drops1;
echo $deadkt;
echo $attempts;
echo $priority;
echo $relocation;
echo $bond;
print_r ($branch);
print_r ($type);
print_r ($gender);
foreach ($type as $t) {
	foreach ($gender as $g) {
	foreach ($branch as $b) {
		$sql='';
		if($priority!='')
		{
			if($relocation=="b" && $bond=="b")
				$sql="select * from student_details where type='$t' and gender='$g' and priority='$priority' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
			if($relocation=="b" && $bond!="b")
				$sql="select * from student_details where bond='$bond' and type='$t' and gender='$g' and priority='$priority' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
			if($relocation!="b" && $bond=="b")
				$sql="select * from student_details where relocation='$relocation' and type='$t' and gender='$g' and priority='$priority' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
		}	
		else
    	{
			if($relocation=="b" && $bond=="b")
				$sql="select * from student_details where type='$t' and gender='$g' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
			if($relocation=="b" && $bond!="b")
				$sql="select * from student_details where bond='$bond' and type='$t' and gender='$g' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
			if($relocation!="b" && $bond=="b")
				$sql="select * from student_details where relocation='$relocation' and type='$t' and gender='$g' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
		}
		echo $sql;
}}}
?>