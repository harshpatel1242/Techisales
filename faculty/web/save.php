<?php 
if(isset($_POST['submit']))
   {
        $reg_id=$_POST['reg_id'];
		$stname=$_POST['stname'];
		$faname=$_POST['faname'];
		$moname=$_POST['moname'];
		$dob=$_POST['dob'];
		$st_mobile=$_POST['st_mobile'];
		$pa_mobile=$_POST['pa_mobile'];
		$r_number=$_POST['r_number'];
		$division=$_POST['division'];
		$branch=$_POST['branch'];
		$emailid=$_POST['emailid'];
		$pemailid=$_POST['pemailid'];
		$type=$_POST['type'];
		$gender=$_POST['gender'];
		$passyear=$_POST['passyear'];
		$mentor_name=$_POST['mentor_name'];
		$mentor_email=$_POST['mentor_email'];
		$priority=$_POST['priority'];
		$relocation=$_POST['relocation'];
		$bond=$_POST['bond'];
		$sscmarks=$_POST['sscmarks'];
		$sscoutoff=$_POST['sscoutoff'];
		$sscpercentage=$_POST['sscpercentage'];
		if($type=="hsc")
			{
				$hscmarks=$_POST['hscmarks'];
				$hscoutoff=$_POST['hscoutoff'];
				$hscpercentage=$_POST['hscpercentage'];
				$sem1marks=$_POST['sem1marks'];
				$sem1outoff=$_POST['sem1outoff'];
				$sem2marks=$_POST['sem2marks'];
				$sem2outoff=$_POST['sem2outoff'];
			}
		if($type=="diploma")
			{
				$year1marks=$_POST['year1marks'];
				$year1outoff=$_POST['year1outoff'];
				$year2marks=$_POST['year2marks'];
				$year2outoff=$_POST['year2outoff'];
				$year3marks=$_POST['year3marks'];
				$year3outoff=$_POST['year3outoff'];
				$totaldmarks=$_POST['totaldmarks'];
				$totaldoutoff=$_POST['totaldoutoff'];
				$diplomapercentage=$_POST['diplomapercentage'];
			}
		$sem3marks=$_POST['sem3marks'];
		$sem3outoff=$_POST['sem3outoff'];
		$sem4marks=$_POST['sem4marks'];
		$sem4outoff=$_POST['sem4outoff'];
		$sem5marks=$_POST['sem5marks'];
		$sem5outoff=$_POST['sem5outoff'];
		$sem6marks=$_POST['sem6marks'];
		$sem6outoff=$_POST['sem6outoff'];
		$sem7marks=$_POST['sem7marks'];
		$sem7outoff=$_POST['sem7outoff'];
		$sem8marks=$_POST['sem8marks'];
		$sem8outoff=$_POST['sem8outoff'];
		$livekt=$_POST['livekt'];
		$deadkt=$_POST['deadkt'];
		$attempts=$_POST['attempts'];
		$drops=$_POST['drops'];
		$totalmarks=$_POST['totalmarks'];
		$totaloutoff=$_POST['totaloutoff'];
		$degreepointer=$_POST['degreepointer'];
		echo $sscmarks;
		echo $reg_id;
		echo $stname;
		echo $faname;
		echo $moname;
		echo $dob;
		echo $st_mobile;
		echo $pa_mobile;
		echo $r_number;
		echo $division;
		echo $branch;
		echo $emailid;
		echo $pemailid;
		echo $type;
		echo $gender;
		echo $passyear;
		echo $mentor_name;
		echo $mentor_email;
		echo $priority;
		echo $relocation;
		echo $bond;
   }
?>