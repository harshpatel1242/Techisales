<?php

require_once "header1.php";
// all quries for calling data
$subjects=array();
$div=array();
$yrs=array();
$class=array();
$lec_targeted=array();
$lec_engaged=array();
$no_of_students=array();
$students_present=array();
$avg_past=array();
$greater_than_avg=array();
$p1=array();
$p2=array();
$p3=array();

  

  $search1 = "SELECT  college_db.subject_table.subject_no,college_db.subject_table.subject_name, college_db.subject_table.division, college_db.subject_table.semester,
                      sh2019_attendance_db.attendance_based_subject.subject_no,
                      sh2019_attendance_db.attendance_based_subject.Lectures_targeted, sh2019_attendance_db.attendance_based_subject.Lectures_Enaged ,
                      sh2019_attendance_db.attendance_based_subject.No_of_Students, sh2019_attendance_db.attendance_based_subject.Students_Present, 
                      sh2019_attendance_db.attendance_based_subject.Avg_result, sh2019_attendance_db.attendance_based_subject.greater_than_avg
              
              FROM college_db.subject_table INNER JOIN sh2019_attendance_db.attendance_based_subject
              ON college_db.subject_table.subject_no = sh2019_attendance_db.attendance_based_subject.subject_no
              WHERE sh2019_attendance_db.attendance_based_subject.EMP_NO = '$empname' ";
  $result_search1 = mysqli_query($conn , $search1)or die( mysqli_error($conn));
        if (mysqli_num_rows($result_search1) > 0) 
        {    
          $size=mysqli_num_rows($result_search1);
          while ($row = mysqli_fetch_array($result_search1))
          {   
              
              array_push($subjects, $row['subject_name']);
              array_push($div, $row['division']);
              array_push($lec_targeted,$row['Lectures_targeted']);
              array_push($lec_engaged,$row['Lectures_Enaged']);
              array_push($no_of_students,$row['No_of_Students']);
              array_push($students_present,$row['Students_Present']);

              $dummy1=number_format($row['Avg_result'], 2);
              array_push($avg_past,$dummy1);
              $dummy2=number_format($row['greater_than_avg'], 2);
              array_push($greater_than_avg,$dummy2);
              
              $p=($row['Lectures_Enaged']/$row['Lectures_targeted'])*100; $p=number_format($p, 2) ;
              array_push($p1,$p);
              $p =($row['Students_Present']/$row['No_of_Students'])*100;  $p=number_format($p, 2) ;
              array_push($p2,$p);
              $p=($dummy2 /$dummy1)*100 ;  $p=number_format($p, 2) ;
              array_push($p3,$p);
          

              // $sub= $row['subject_name'];
                //$divi = $row['division'];
                $sem = $row['semester'];


                if($sem == 1 || $sem == 2 )
                {
                  $yr = "FE";
                }
                elseif($sem == 3 || $sem == 4 )
                {
                  $yr = "SE";
                }
                elseif($sem == 5 || $sem == 6 )
                {
                  $yr = "TE";
                }
                elseif($sem == 7 || $sem == 8 )
                {
                  $yr = "BE";
                }
                else{ $yr="Null";}
                array_push($yrs, $yr);
                $c=$yr." ".$row['division']." ";
                array_push($class,$c);
            }
            
        }

        $avg_p1 = array_sum($p1)/$size;  $avg_p1=number_format($avg_p1, 2);
        $avg_p2 = array_sum($p2)/$size;  $avg_p2=number_format($avg_p2, 2);
        $avg_p3 = array_sum($p3)/$size;  $avg_p3=number_format($avg_p3, 2);
        if($avg_p1 >=81){ $pm1=1.0; $pmp1="Excellent"; }  elseif($avg_p1>=61  && $avg_p1<=80){ $pm1=0.7; $pmp1="Good";}   elseif($avg_p1>=41  && $avg_p1<=60){ $pm1=0.5; $pmp1="Average";}  else{ $pm1=0.2; $pmp1= "Poor";} 
        if($avg_p2 >=81){ $pm2=1.0; $pmp2="Excellent"; }  elseif($avg_p2>=61  && $avg_p2<=80){ $pm2=0.7; $pmp2="Good";}   elseif($avg_p2>=41  && $avg_p2<=60){ $pm2=0.5; $pmp2="Average";}  else{ $pm2=0.2; $pmp2= "Poor";}
        if($avg_p3 >=81){ $pm3=1.0; $pmp3="Excellent"; }  elseif($avg_p3>=61  && $avg_p3<=80){ $pm3=0.7; $pmp3="Good";}   elseif($avg_p3>=41  && $avg_p3<=60){ $pm3=0.5; $pmp3="Average";}  else{ $pm3=0.2; $pmp3= "Poor";} 
        $m1=$m2=$m3=5;
        $t1=$pm1*$m1; $t1=number_format($t1, 2);
        $t2=$pm2*$m2; $t2=number_format($t2, 2);
        $t3=$pm3*$m3; $t3=number_format($t3, 2);
        $tt=$t1+$t2+$t3; $tt=number_format($tt, 2);

        echo "<script type='text/javascript'>  window.onload = function(){alert(\"$size\");}</script>";
        echo "$size";


        
if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $mcq1=  $_POST['mcq1'];   $mcq2=  $_POST['mcq2'];   $mcq3=  $_POST['mcq3'];   $mcq4=  $_POST['mcq4'];   $mcq5=  $_POST['mcq5'];
  $mcq6=  $_POST['mcq6'];   $mcq7=  $_POST['mcq7'];   $mcq8=  $_POST['mcq8'];   $mcq9=  $_POST['mcq9'];   $mcq10= $_POST['mcq10'];

  $mcq11=  $_POST['mcq11'];   $mcq12=  $_POST['mcq12'];   $mcq13=  $_POST['mcq13'];   $mcq14=  $_POST['mcq14'];   $mcq15=  $_POST['mcq15'];
  $mcq16=  $_POST['mcq16'];   $mcq17=  $_POST['mcq17'];   $mcq18=  $_POST['mcq18'];   $mcq19=  $_POST['mcq19'];   $mcq20=  $_POST['mcq20'];

  $mcq21=  $_POST['mcq21'];   $mcq22=  $_POST['mcq22'];   $mcq23=  $_POST['mcq23'];   $mcq24=  $_POST['mcq24'];   $mcq25=  $_POST['mcq25'];
  $mcq26=  $_POST['mcq26'];   $mcq27=  $_POST['mcq27'];   $mcq28=  $_POST['mcq28'];   $mcq29=  $_POST['mcq29'];   $mcq30=  $_POST['mcq30'];

  $mcq31=  $_POST['mcq31'];   $mcq32=  $_POST['mcq32'];   $mcq33=  $_POST['mcq33'];   $mcq34=  $_POST['mcq34'];   $mcq35=  $_POST['mcq35'];
  $mcq36=  $_POST['mcq36'];   $mcq37=  $_POST['mcq37'];   $mcq38=  $_POST['mcq38'];   $mcq39=  $_POST['mcq39'];   $mcq40=  $_POST['mcq40'];   $decide=$_POST['decide'];

  
  $f_mcq= $mcq1  + $mcq2 + $mcq3 + $mcq4 + $mcq5 + $mcq6 + $mcq7 + $mcq8 + $mcq9 + $mcq10  + $mcq11  + $mcq12  + $mcq13  + $mcq14  +  $mcq15 + $mcq16  +   $mcq17 +  $mcq18 +  $mcq19 +  $mcq20   
          + $mcq21  +   $mcq22  +  $mcq23   +  $mcq24  +  $mcq25  + $mcq26  +   $mcq27  +   $mcq28  + $mcq29  + $mcq30
          + $mcq31  +   $mcq32  +  $mcq33   +  $mcq34  +  $mcq35  + $mcq36  +   $mcq37  +   $mcq38  + $mcq39  + $mcq40; 

  $sw = $_POST['sw'];    $reason_sw = $_POST['reason_sw'];     $total = $_POST['total'];   $grade = $_POST['grade1']; 

  $applied_date = $_POST['date'];
  $emp_no = $_SESSION['Emp_no'];
 
  $hod_status = 'Pending';    $pr_status = "Pending";


	$conn = mysqli_connect('localhost','root' ,'','faculty' );
  if(!$conn){
  die('Could not Connect My Sql:' .mysql_error());
  }

  if (isset($_POST['submit']))
  {

  $query = "INSERT INTO mt_appraisal (EMP_NO,APPLIED_ON,HOD_APPROVED,PRINCIPAL_APPROVED,avg_1,avg_2,avg_3,t1,t2,t3,tt,fmcq,sw,reason,total,grade) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";

				$stmt = mysqli_prepare($conn, $query);
				if ($stmt){
          mysqli_stmt_bind_param($stmt, "ssssssssssssssss",$param_emp_no ,$param_applied_on,$param_hod_status,$param_pr_status,$param_avg_p1,$param_avg_p2,$param_avg_p3,$param_t1,$param_t2,$param_t3,$param_tt,$param_f_mcq, $param_sw,$param_reason,$param_total,$param_grade);

          $param_emp_no = $emp_no;    $param_hod_status = $hod_status;    $param_pr_status = $pr_status;    $param_applied_on = $applied_date;    $param_f_mcq = $f_mcq;
          $param_avg_p1=$avg_p1;      $param_avg_p2=$avg_p2;    $param_avg_p3=$avg_p3;  $param_t1=$t1;  $param_t2=$t2;  $param_t3=$t3;  $param_tt=$tt;
          $param_sw=$sw;      $param_total=$total;    $param_grade=$grade;    $param_reason = $reason_sw;
          if (mysqli_stmt_execute($stmt))
      {
       // echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
      }
      else
      {
        echo "Something went wrong in 1st query... cannot redirect!";
      }
  
      mysqli_stmt_close($stmt);
        }

$count="SELECT 	FORM_ID FROM mt_appraisal";
$counter = mysqli_query($conn , $count)or die( mysqli_error($conn));
    if(mysqli_num_rows($counter))
    {
      while ($row = mysqli_fetch_array($counter))
      {
      $last_id = $row['FORM_ID'];
      }
    }


for( $i = 0; $i<$size; $i++ ) {


  // engaging lectures query
      $query = "INSERT INTO engaging_lectures (FORM_ID,class,sub,lectures_targeted,lectures_engaged,percent) 
      VALUES (?,?,?,?,?,?)";

      $stmt = mysqli_prepare($conn, $query);
      if ($stmt){
      mysqli_stmt_bind_param($stmt, "ssssss",$param_form_id ,$param_class,$param_sub,$param_lectures_targeted,$param_lectures_engaged,$param_percent);

      $param_form_id = $last_id;    $param_class = $class[$i];    $param_sub = $subjects[$i];   
      $param_lectures_targeted = $lec_targeted[$i];   $param_lectures_engaged= $lec_engaged[$i];   $param_percent= $p1[$i];   
      if (mysqli_stmt_execute($stmt))
      {
      // echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
      }
      else
      {
        echo "Something went wrong in 1st query of for loop $i th time ... cannot redirect!";
      }

      mysqli_stmt_close($stmt);
        }

        // attendence query       

      $query1 = "INSERT INTO attendance_students (FORM_ID,class,sub,no_of_students,lecture_engaged,student_present,percent) 
      VALUES (?,?,?,?,?,?,?)";

      $stmt1 = mysqli_prepare($conn, $query1);
      if ($stmt1){
      mysqli_stmt_bind_param($stmt1, "sssssss",$param_form_id,$param_class,$param_sub,$param_no_of_students,$param_lectures_engaged,$param_student_present,$param_percent);

      $param_form_id = $last_id;                      $param_class = $class[$i];                  $param_sub = $subjects[$i];   $param_student_present=$students_present[$i];
      $param_no_of_students = $no_of_students[$i];   $param_lectures_engaged= $lec_engaged[$i];   $param_percent= $p2[$i];   
      if (mysqli_stmt_execute($stmt1))
      {
      // echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
      }
      else
      {
        echo "Something went wrong in 2st query of for loop $i th time ... cannot redirect!";
      }

      mysqli_stmt_close($stmt1);
        }

      // result query       

      $query1 = "INSERT INTO result_of_students (FORM_ID,class,sub,avg_three_yrs,pecent_greater_avg,percent) 
      VALUES (?,?,?,?,?,?)";

      $stmt1 = mysqli_prepare($conn, $query1);
      if ($stmt1){
      mysqli_stmt_bind_param($stmt1, "ssssss",$param_form_id,$param_class,$param_sub,$param_avg_three_yrs,$param_pecent_greater_avg,$param_percent);

      $param_form_id = $last_id;                      $param_class = $class[$i];                              $param_sub = $subjects[$i];   
      $param_avg_three_yrs=$avg_past[$i];     $param_pecent_greater_avg = $greater_than_avg[$i];      $param_percent= $p3[$i];   
      if (mysqli_stmt_execute($stmt1))
      {
      // echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
      }
      else
      {
        echo "Something went wrong in 3st query of for loop $i th time ... cannot redirect!";
      }

      mysqli_stmt_close($stmt1);
        }

}


$query2="INSERT INTO  mcq (FORM_ID, mcq1,mcq2,mcq3,mcq4,mcq5,  mcq6,mcq7,mcq8,mcq9,mcq10,
                                    mcq11,mcq12,mcq13,mcq14,mcq15,  mcq16,mcq17,mcq18,mcq19,mcq20,
                                    mcq21,mcq22,mcq23,mcq24,mcq25,  mcq26,mcq27,mcq28,mcq29,mcq30,
                                    mcq31,mcq32,mcq33,mcq34,mcq35,  mcq36,mcq37,mcq38,mcq39,mcq40,  decide)

        VALUES (?,  ?,?,?,?,?,  ?,?,?,?,?,  ?,?,?,?,?,  ?,?,?,?,?,  ?,?,?,?,?,  ?,?,?,?,?,  ?,?,?,?,?,  ?,?,?,?,?  ,?)";
$stmt2= mysqli_prepare($conn, $query2);
if ($stmt2)
{		  
      mysqli_stmt_bind_param($stmt2, "ssssssssssssssssssssssssssssssssssssssssss",$param_last_id,
      $param_mcq1,     $param_mcq2,    $param_mcq3,    $param_mcq4,    $param_mcq5,
      $param_mcq6,     $param_mcq7,    $param_mcq8,    $param_mcq9,    $param_mcq10,

      $param_mcq11,     $param_mcq12,    $param_mcq13,    $param_mcq14,    $param_mcq15,
      $param_mcq16,     $param_mcq17,    $param_mcq18,    $param_mcq19,    $param_mcq20,

      $param_mcq21,     $param_mcq22,    $param_mcq23,    $param_mcq24,    $param_mcq25,
      $param_mcq26,     $param_mcq27,    $param_mcq28,    $param_mcq29,    $param_mcq30,

      $param_mcq31,     $param_mcq32,    $param_mcq33,    $param_mcq34,    $param_mcq35,
      $param_mcq36,     $param_mcq37,    $param_mcq38,    $param_mcq39,    $param_mcq40,  $param_decide
    );
      // Set these parameters

      $param_last_id =$last_id ;    $param_decide=$decide;
      $param_mcq1=$mcq1;    $param_mcq2=$mcq2;    $param_mcq3=$mcq3;    $param_mcq4=$mcq4;    $param_mcq5=$mcq5;
      $param_mcq6=$mcq6;    $param_mcq7=$mcq7;    $param_mcq8=$mcq8;    $param_mcq9=$mcq9;    $param_mcq10=$mcq10;

      $param_mcq11=$mcq11;    $param_mcq12=$mcq12;    $param_mcq13=$mcq13;    $param_mcq14=$mcq14;    $param_mcq15=$mcq15;
      $param_mcq16=$mcq16;    $param_mcq17=$mcq17;    $param_mcq18=$mcq18;    $param_mcq19=$mcq19;    $param_mcq20=$mcq20;

      $param_mcq21=$mcq21;    $param_mcq22=$mcq22;    $param_mcq23=$mcq23;    $param_mcq24=$mcq24;    $param_mcq25=$mcq25;
      $param_mcq26=$mcq26;    $param_mcq27=$mcq27;    $param_mcq28=$mcq28;    $param_mcq29=$mcq29;    $param_mcq30=$mcq30;

      $param_mcq31=$mcq31;    $param_mcq32=$mcq32;    $param_mcq33=$mcq33;    $param_mcq34=$mcq34;    $param_mcq35=$mcq35;
      $param_mcq36=$mcq36;    $param_mcq37=$mcq37;    $param_mcq38=$mcq38;    $param_mcq39=$mcq39;    $param_mcq40=$mcq40;

  
      // Try to execute the query
      if (mysqli_stmt_execute($stmt2))
      {
        echo "<script type='text/javascript'>  window.onload = function(){alert(\"data inserted succesfully\");}</script>";
      }
      else
      {
        echo "Something went wrong in 3rd query... cannot redirect!";
      }
  
      mysqli_stmt_close($stmt2); 
  }

}
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>APPLICATION FOR APPRAISAL</title>
	<!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
	<!-- Script -->	
  <script>
          
        function _(x){
            return document.getElementById(x);
          }
        
        function __(x){
          return document.getElementByName(x);
        }
         
        function displayPhase1(){
              _("phase1").style.display = "block";
              _("phase2").style.display = "none";
              _("phase3").style.display = "none";
              _("phase4").style.display = "none";
              _("phase5").style.display = "none";

              _("progress-bar").style.width="0%";
              _("phase-value").textContent="Phase 1";
              _("progress-bar-value").textContent="0%";
        }

        function  displayPhase2(){
              _("phase1").style.display = "none";
              _("phase2").style.display = "block";
              _("phase3").style.display = "none";
              _("phase4").style.display = "none";
              _("phase5").style.display = "none";
              _("progress-bar").style.width="10%";
              _("phase-value").textContent="Phase 2";
              _("progress-bar-value").textContent="10%";
          } 

        function  displayPhase3(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "block";
            _("phase4").style.display = "none";
            _("phase5").style.display = "none";
            

            _("progress-bar").style.width="20%";
            _("phase-value").textContent="Phase 3";
            _("progress-bar-value").textContent="20%";
        } 

        function  displayPhase4(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "none";
            _("phase4").style.display = "block";
            _("phase5").style.display = "none";
     

            _("progress-bar").style.width="30%";
            _("phase-value").textContent="Phase 3";
            _("progress-bar-value").textContent="30%";
        } 

        function  displayPhase5(){
            _("phase1").style.display = "none";
            _("phase2").style.display = "none";
            _("phase3").style.display = "none";
            _("phase4").style.display = "none";
            _("phase5").style.display = "block";
           

            _("progress-bar").style.width="40%";
            _("phase-value").textContent="Phase 5";
            _("progress-bar-value").textContent="40%";
        } 

      

        function totalmcq(){
          
          var ans,ans1;
          var mcq1,mcq2,mcq3,mcq4,mcq5,mcq6,mcq7,mcq8,mcq9,mcq10,mcq11,mcq12,mcq13,mcq14,mcq15,mcq16,mcq17,mcq18,mcq19,mcq20,mcq21,mcq22,mcq23,mcq24,mcq25,mcq26,mcq27,mcq28,mcq29,mcq30,mcq31,mcq32,mcq33,mcq34,mcq35,mcq36,mcq37,mcq38,mcq39,mcq40 =0;
          var dum = document.querySelector('#form1').elements;
          // this is the radionodelist.value you can check it on mdn  //mcq 19, dosesnt display 21-25-average, 
          mcq1 = parseFloat(dum.mcq1.value);   mcq2 = parseFloat(dum.mcq2.value);   mcq3 = parseFloat(dum.mcq3.value);  mcq4 = parseFloat(dum.mcq4.value);   mcq5 = parseFloat(dum.mcq5.value); 
          mcq6 = parseFloat(dum.mcq6.value);   mcq7 = parseFloat(dum.mcq7.value);   mcq8 = parseFloat(dum.mcq8.value);  mcq9 = parseFloat(dum.mcq9.value);   mcq10 = parseFloat(dum.mcq10.value); 

          mcq11 = parseFloat(dum.mcq11.value);   mcq12 = parseFloat(dum.mcq12.value);   mcq13 = parseFloat(dum.mcq13.value);  mcq14 = parseFloat(dum.mcq14.value);   mcq15 = parseFloat(dum.mcq15.value); 
          mcq16 = parseFloat(dum.mcq16.value);   mcq17 = parseFloat(dum.mcq17.value);   mcq18 = parseFloat(dum.mcq18.value);  mcq19 = parseFloat(dum.mcq19.value);   mcq20 = parseFloat(dum.mcq20.value);

          mcq21 = parseFloat(dum.mcq21.value);   mcq22 = parseFloat(dum.mcq22.value);   mcq23 = parseFloat(dum.mcq23.value);  mcq24 = parseFloat(dum.mcq24.value);   mcq25 = parseFloat(dum.mcq25.value); 
          mcq26 = parseFloat(dum.mcq26.value);   mcq27 = parseFloat(dum.mcq27.value);   mcq28 = parseFloat(dum.mcq28.value);  mcq29 = parseFloat(dum.mcq29.value);   mcq30 = parseFloat(dum.mcq30.value); 
          
          mcq31 = parseFloat(dum.mcq31.value);   mcq32 = parseFloat(dum.mcq32.value);   mcq33 = parseFloat(dum.mcq33.value);  mcq34 = parseFloat(dum.mcq34.value);   mcq35 = parseFloat(dum.mcq35.value); 
          mcq36 = parseFloat(dum.mcq36.value);   mcq37 = parseFloat(dum.mcq37.value);   mcq38 = parseFloat(dum.mcq38.value);  mcq39 = parseFloat(dum.mcq39.value);   mcq40 = parseFloat(dum.mcq40.value); 
          
          ans1 =  mcq1 + mcq2 + mcq3 + mcq4 + mcq5 + mcq6 + mcq7 + mcq8 + mcq9 + mcq10 + mcq11 + mcq12 + mcq13 + mcq14 + mcq15 + mcq16 + mcq17 + mcq18 + mcq19 + mcq20 + mcq21 + mcq22 + mcq23 + mcq24 + mcq25 + mcq26 + mcq27 + mcq28 + mcq29 + mcq30 + mcq31 + mcq32 + mcq33 + mcq34 + mcq35 + mcq36 + mcq37 + mcq38 + mcq39 + mcq40 ;
           ans = ans1.toFixed(2);
         
          _('fmcq').value= ans;
        }

        

        function grade(){
            var num0,num1,num2,num3,num4,g;
            num0=parseFloat(_('fmcq').value); 
            num1=parseFloat(_('sw').value); 
            num2= parseFloat(_('tt').value); 
            num4= num0+num1+num2;
            num3 = num4.toFixed(2);
            _("total").value = num3;
            if(num3>80  && num3<=100)   {  g  =   "Outstanding";  }
            else if(num3>70 && num3<=80){  g  =   "Very Good";  }
            else if(num3>60 && num3<=70){  g  =   "Positively Good";  }
            else if(num3>50 && num3<=60){  g  =   "Good";  }
            else if(num3>34 && num3<=50){  g  =   "Average";  } 
            else                        {  g  =   "Below Average";  } 
            return g;
        }

        function calculate(){
          if(_("sw")){
                _("grade1").value =grade();
            } 
        }
       
    

  </script>

</head>
<body onload="displayPhase1();">
<!-- //header-ends -->
		<!-- main content start-->

		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
          <form class="form-horizontal" method="POST" action="#"   enctype="multipart/form-data" id="form1" name="form1">          
                        <h2 style="text-align: center; margin-top: 5px;font-sixe:30px;">APPLICATION FOR APPRAISAL</h2><br>
                      

              <div id="phase1"> 
                              <div style="margin-left:40%;margin-right:40%">
                                            <div class="task-info" >
                                              <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 1</span><span class="percentage" id="progress-bar-value">0%</span>
                                              <div class="clearfix"></div>	
                                            </div>
                                            <div class="progress progress-striped active">
                                              <div class="bar green" id="progress-bar"  value="0" max="100" style="width:0%"></div>
                                            </div>
                                </div>
     

                                <div class="form-group">
                          <label for="date" class="col-sm-9 control-label" style="" >Date :</label>
                          <div class="col-sm-2" >
                            <input type="date" class="form-control1" id="date" placeholder="" name="date"
                            value="<?php echo date("Y-m-d");?>" readonly>
                          </div>
                        </div>
                        <div class="form-group">
                          <label for="name" class="col-sm-1 control-label" >Name :</label>
                          <div class="col-sm-2">
                            <input  type="text" class="form-control1" id="firstname" placeholder="First Name" value="<?php echo "$firstname   $middlename   $lastname" ;?>" readonly>
                          </div>
                          
                        
                        
                          <label for="employee no." class="col-sm-2 control-label">Employee no.</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control1" id="designation" placeholder="employee number" value="<?php echo "$emp_no" ;?>"	readonly>
                          </div>
                          
                        
                          <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Designation :</label>
                          <div class="col-sm-2">
                            <input type="text" class="form-control1" id="designation" placeholder="Designation"
                            value="<?php echo "$designation" ;?>" readonly>
                          </div>
                        </div> 
                        

                  
          
                       


                        <label for="Title" class="col-sm-4 control-label" >Performance of engaging Lectures / Practicals :</label>
                        
                        <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                        <tr>
                          
                          <th>Class
                          </th>
                          <th>Subject
                          </th>
                          <th>Lectures Targeted
                          </th>
                          <th>Lectures Enaged
                          </th>	
                          <th>Percentage 
                          </th>
                          
                        </tr>
                       
                        <tr  >
                        
                            
                          <td >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                          <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[0]"; ?>" readonly>
                          </div>
                          </td>

                          <td >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                          <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[0]"; ?>" readonly>
                          </div>	
                          </td>

                          <td  >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                          <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[0]"; ?>" readonly>
                          </div>
                          </td>

                          <td  >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                          <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[0]";?>" readonly>
                          </div>
                          </td>	

                          <td  >
                          <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                          <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php  echo "$p1[0]"; ?>" readonly>
                          </div>
                          </td>	

                        </tr>	
                        <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[1]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[1]"; ?>"readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[1]"; ?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[1]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php   echo "$p1[1]"; ?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[2]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[2]"; ?>"readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[2]"; ?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[2]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php echo "$p1[2]"; ?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[3]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[3]"; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[3]"; ?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[3]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php   echo "$p1[3]"; ?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                        </table>
                      
                          <br>

                            
                          <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg_p1" id="avg_p1" placeholder="" value="<?php echo "$avg_p1"; ?>" readonly>
                              </div>
                              
                            
                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" value="<?php    echo "$pmp1";?>"	readonly>
                              </div>
                              
                            
                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder="" value="<?php  echo "$m1"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="t1" id="t1" placeholder="" value="<?php echo "$t1";?>"
                                readonly>
                              </div>
                            </div> 

                            <label for="Title" class="col-sm-4 control-label" >Performance of Attendance of Students :</label>
                            
                            
 

                            <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                            <tr>
                              
                              <th>Class
                              </th>
                              <th>Subject
                              </th>
                              <th>No of Students
                              </th>
                              <th>Lectures Enaged
                              </th>	
                              <th>Students Present 
                              </th>
                              <th>Average attendance 
                              </th>
                              
                            </tr>

                            
                            <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[0]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[0]"; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[0]";?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[0]"; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[0]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php   echo "$p2[0]";?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                      
                          
                      <td >
                      <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[1]"; ?>" readonly>
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[1]"; ?>" readonly>
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[1]";?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[1]"; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[1]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$p2[1]";?>" readonly>
                        </div>
                        </td>	

                    </tr>	
                    <tr  >
                      
                          
                      <td >
                      <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[2]"; ?>" readonly>
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[2]"; ?>" readonly>
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[2]";?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[2]"; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[2]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php  echo "$p2[2]";?>" readonly>
                        </div>
                        </td>	

                    </tr>	
                    <tr  >
                      
                          
                      <td >
                      <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[3]"; ?>"readonly>
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[3]"; ?>" readonly>
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[3]";?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[3]"; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[3]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php  echo "$p2[3]";?>" readonly>
                        </div>
                        </td>	


                    </tr>	
                    
                    </table>



                            <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg_p2" id="avg_p2" placeholder="" value="<?php echo "$avg_p2"; ?>" readonly>
                              </div>
                              


                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder=""  value="<?php echo "$pmp2";?>"	readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder="" value="<?php  echo "$m2"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="t2" id="t2" placeholder=""  value="<?php  echo "$t2";?>"
                                readonly>
                              </div>
                            </div> 

                          


                            <label for="Title" class="col-sm-4 control-label" >Performance of Result of Students :</label>

                            <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                            <tr>
                             
                              <th>Class
                              </th>
                              <th>Subject
                              </th>
                              <th>Avg result for past 3 yrs
                              </th>
                              <th>Percent of students scoring greater than avg
                              </th>	
                              <th> average
                              </th>	
                              
                              
                            </tr>
                            <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[0]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[0]"; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[0]";?>"readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[0]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php  echo "$p3[0]";?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[1]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[1]"; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input  readonlytype="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[1]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[1]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php  echo "$p3[1]";?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[2]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[2]"; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[2]";?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[2]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php  echo "$p3[2]";?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[3]"; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[3]"; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[3]";?>"  readonly>
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[3]";?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$p3[3]";?>" readonly>
                        </div>
                        </td>	

                      </tr>	

                    </table>
                            <br>
                
                            <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg_p3" id="avg_p3" placeholder="" value="<?php  echo "$avg_p3"; ?>" readonly>
                              </div>
                              


                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder=""  value="<?php echo "$pmp3";?>"	readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder="" value="<?php  echo "$m3"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="t3" id="t3" placeholder=""  value="<?php  echo "$t3";?>"
                                readonly>
                              </div>
                            </div> 

                            <div class="form-group">
                              <label for="designation" class="col-sm-2 control-label" style="margin-left:0px;">Total Weight 1 :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t1";?>"
                                readonly>
                              </div>
                              


                              <label for="designation" class="col-sm-2 control-label">Total Weight 2:</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t2";?>"
                                readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-7px;">Total Weight 3:</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t3";?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label"  style="margin-left:-7px;">Result Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""  value="<?php  echo "$tt";?>"
                                readonly>
                              </div>
                            </div> 


                            

                            <br>
                                <div class="form-group" >
                                                <div class="col-sm-10"style="margin-left: 35%;">
                                  <input type="" id="button" class="col-sm-2 btn btn-info"  style="background: #ffb121;"
                                    value="Next"  name="" onclick=" displayPhase2()" >
                                    
                                  </div>
                                  
                       </div>
                            
                  </div> <!-- end of phase 1 -->
                  
                  <div id="phase2" style="display:none;">

                                <div style="margin-left:40%;margin-right:40%">
                                            <div class="task-info" >
                                              <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 2</span><span class="percentage" id="progress-bar-value">25%</span>
                                              <div class="clearfix"></div>	
                                            </div>
                                            <div class="progress progress-striped active">
                                              <div class="bar green" id="progress-bar"  value="0" max="100" style="width:25%"></div>
                                            </div>
                                </div>
                                
                                <div class="form-group">
                                <label for="Title" class="col-sm-2 control-label" >Other performance :</label><br><br>

                                <label for="Title" class="col-sm-5 control-label"  style ="text-align:left;padding-left:100px;" >Class Room Planning and Control  :</label>
                                </div>
                                <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                <tr>
                                  <th style="width:3%;"> Srno
                                  </th>
                                  <th>Performance indicator  to be assessed 
                                  </th>
                                  <th>Evaluation by Reporting Officer
                                  </th>
                                    
                                  
                                  
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 1  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Planning of lessons throughout the academic year  :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" name="mcq1"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq1" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq1" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq1" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;" >Effective communication of subject matter and clarity of speech :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" name="mcq2"   value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq2" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq2" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq2" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Management of lecture and class control :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Involvement of students in learning process :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                   </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Use of media such as charts, models, transparencies, OHP, VCR ,TV :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5"value="1.0" > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-5 control-label" style ="text-align:left;padding-left:100px;">Students Guidance and Counseling  :</label>
                                </div>
                                <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                <tr>
                                  <th style="width:3%;"> Srno
                                  </th>
                                  <th>Performance indicator  to be assessed 
                                  </th>
                                  <th>Evaluation by Reporting Officer
                                  </th>
                                    
                                  
                                  
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 1  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;" >Guidance to students  about  books and literature :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Guidance about higher education / career planning :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label" > 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Guidance about job opportunities / entrepreneurship :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label" style ="text-align:left;"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Guidance for preparing for interviews / personality development :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9"value="1.0"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                   </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Guidance for independent study technique :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-3 control-label" style ="text-align:left;padding-left:100px;">Assignments / Evaluation  :</label>
                                </div>
                                <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                <tr>
                                  <th style="width:3%;"> Srno
                                  </th>
                                  <th>Performance indicator  to be assessed 
                                  </th>
                                  <th>Evaluation by Reporting Officer
                                  </th>
                                    
                                  
                                  
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 1  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;" >Giving assignments regularly and assessing promptly :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Maintaining quality and standard of questions / evaluation :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">	Providing feed back to the students about shortcomings :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;" >Innovation in paper setting / evaluation :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;" >Record keeping of students profile :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-3 control-label" style ="text-align:left;padding-left:100px;">Co-curricular Activities  :</label>
                                </div>
                                <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                <tr>
                                  <th style="width:3%;"> Srno
                                  </th>
                                  <th>Performance indicator  to be assessed 
                                  </th>
                                  <th>Evaluation by Reporting Officer
                                  </th>
                                    
                                  
                                  
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 1  </label>
                                  </td>

                                  <td style="width:100%; float:left">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Consultancy and testing in the appropriate of work area or Organizing continuing education  programmers for revenue generation:</label>
                                 
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Organizing cultural programmers / sports / extra curricular activities etc:</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"  required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:100%; float:left;">
                                  <div >
                                  <label for="Title" class="control-label" style ="text-align:left;">Organizing industrial visits / study tours for students or taking interest in NCC / NSS / blood donation / plantation / medical camps :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;">Contribution to maintain student  discipline in general :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19" value="1.0" onchange="totalmcq();" onclick="totalmcq();"   > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;" >Ability to work as a resource person :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                 </div>
                                  </td>
                                </tr>		
                                </table>


                                <div class="form-group" >
                                  <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                  
                                  <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Previous"  name="" onclick="displayPhase1() " >
                                  <input type="" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Next"  name="" onclick=" displayPhase3()" >
                                  
                                  </div>

                                </div>
                            
              </div> <!-- end of phase 2 -->
                  
              
              <div id="phase3">

                                    <div style="margin-left:40%;margin-right:40%">
                                              <div class="task-info" >
                                                <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 3</span><span class="percentage" id="progress-bar-value">50%</span>
                                                <div class="clearfix"></div>	
                                              </div>
                                              <div class="progress progress-striped active">
                                                <div class="bar green" id="progress-bar"  value="0" max="100" style="width:50%"></div>
                                              </div>
                                  </div>                              
                              
                                  <div class="form-group">

                                  <label for="Title" class="col-sm-5 control-label" style ="text-align:left;padding-left:100px;">Curriculum / learning resources development  :</label>
                                  </div>
                                  <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                  <tr>
                                    <th style="width:3%;"> Srno
                                    </th>
                                    <th>Performance indicator  to be assessed 
                                    </th>
                                    <th>Evaluation by Reporting Officer
                                    </th>
                                      
                                    
                                    
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 1  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label"  style ="text-align:left;">Interest shows in Curriculum development  or preparation of syllabus :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 2  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label"  style ="text-align:left;">Preparing question banks :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                  </tr>	
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 3  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label"  style ="text-align:left;">Motivating students for use of computers :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                  </div>
                                  </td>
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 4  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label"  style ="text-align:left;">Giving handouts / upkeep of laboratory manuals / writing books :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                      <div >
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                  </tr>	
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 5  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label"  style ="text-align:left;">Preparations of computer software as a teaching aid :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                      <div >
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                        <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                      </td>
                                  </tr>		
                                  </table>

                                

                                <div class="form-group">

                                <label for="Title" class="col-sm-4 control-label" style ="text-align:left;padding-left:100px;">Seminars / Training  :</label>
                                </div>
                                <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                <tr>
                                  <th style="width:3%;"> Srno
                                  </th>
                                  <th>Performance indicator  to be assessed 
                                  </th>
                                  <th>Evaluation by Reporting Officer
                                  </th>
                                    
                                  
                                  
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 1  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;">	Use of library books , periodicals , journals etc :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;">Attendance in seminars / conferences / workshops :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;" >Writing articles in state or national level periodicals :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;" >Delivering speech in other institutions :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;" >Memberships of professional bodies , awards and honors :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"  required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-5 control-label" style ="text-align:left;padding-left:100px;">Administrative Functions  :</label>
                                </div>
                                <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                <tr>
                                  <th style="width:3%;"> Srno
                                  </th>
                                  <th>Performance indicator  to be assessed 
                                  </th>
                                  <th>Evaluation by Reporting Officer
                                  </th>
                                    
                                  
                                  
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 1  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;" >Contribution to conduct of gymkhana activities / procurement of equipment :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;">Worked as examination / gathering / admission in charge :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"  required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:100%; float:left;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;" >Maintenance of building / electrical installations / water supply / computers / equipments etc. or worked as rector / assistant, rector / warden :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:100%;float:left;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;"  >Worked as in- charge for housekeeping / environmental hygienic/ cleanness of class room/</label>
                                  <label> premises/ gardens/ security :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:100%; float:left;">
                                  <div >
                                  <label for="Title" class="control-label"  style ="text-align:left;"  >Interest taken in activities related to canteen , CO- operative stores etc. or willingness to take  up higher responsibility or any responsibility :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                    </div>
                                  </td>
                                </tr>		
                                </table>



                                              
                                
                                <label for="Concerned with lab" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;">Are you concerned with Laboratory work :</label>
                                <div class="col-sm-5">
                                  <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" id="cwl" name="decide" value ="1" required
                                            onclick='_("cwl-l1").innerHTML= "Planned laboratory instruction including management of practical’s :" ; 
                                                    _("cwl-l2").innerHTML= "Uniform converge of term work and guidance for writing journals :" ;
                                                    _("cwl-l3").innerHTML= "Checking of journals and making continuous assessment of term work :" ;
                                                    _("cwl-l4").innerHTML= "Preparation and display of instructional material, charts, models, etc :" ;
                                                    _("cwl-l5").innerHTML= "Planning and procurement of consumable required for practical :" ;  '
                                            > Yes</label>
                                    </div>
                                  <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" id="cwl" name="decide" value ="0"  
                                            onclick='_("cwl-l1").innerHTML= "Arranging special lectures of eminent person :" ; 
                                                    _("cwl-l2").innerHTML= "Conducting special classes for low profit students :" ;
                                                    _("cwl-l3").innerHTML= "Attitude towards maintaining cleanliness and aesthetics :" ;
                                                    _("cwl-l4").innerHTML= "Interaction with teachers teaching subject other than his own discipline :" ;
                                                    _("cwl-l5").innerHTML= "Preparation and display of instructional material :" ;  '
                                            > No</label>
                                    </div>
                                </div>   

                                         
                                        
                                              <table class="table form-group" style="margin-left:5%;margin-right:5%;width:90%;" >
                                            <tr>
                                              <th style="width:3%;"> Srno
                                              </th>
                                              <th>Performance indicator  to be assessed 
                                              </th>
                                              <th>Evaluation by Reporting Officer
                                              </th>
                                                
                                              
                                              
                                            </tr>
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 1  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l1" style="text-align:left;">Planned laboratory instruction including management of practical’s :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 2  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l2" style="text-align:left;">Uniform converge of term work and guidance for writing journals :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>	
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 3  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l3" style="text-align:left;">Checking of journals and making continuous assessment of term work :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"    required> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 4  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l4" style="text-align:left;">Preparation and display of instructional material, charts, models, etc :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" value="1.4" onchange="totalmcq();" onclick="totalmcq();"  > Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" value="1.0" onchange="totalmcq();" onclick="totalmcq();"  > Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" value="0.4" onchange="totalmcq();" onclick="totalmcq();"  > Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>	
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 5  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id ="cwl-l5" style="text-align:left;">Planning and procurement of consumable required for practical :</label>
                                              </div>
                                              </td>
                                             
                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  id = "mcq40" name="mcq40"  value="2.0" onchange="totalmcq();" onclick="totalmcq();"   required > Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  id = "mcq40" name="mcq40" value="1.4" onchange="totalmcq();" onclick="totalmcq();" > Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  id = "mcq40" name="mcq40" value="1.0" onchange="totalmcq();" onclick="totalmcq();" > Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  id = "mcq40" name="mcq40" value="0.4" onchange="totalmcq();" onclick="totalmcq();" > Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>
                                            </table>    
                                          
                                <div class="form-group" >
                                  <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                  
                                  <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Previous"  name="" onclick="displayPhase2() " >
                                  <input type="" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Next"  name="" onclick=" displayPhase4();  "  >
                               
                                  </div>

                                </div>

              </div><!-- end of phase 3 -->

         
        <div id="phase4">
              
              <div style="margin-left:40%;margin-right:40%">
                                            <div class="task-info" >
                                              <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 4</span><span class="percentage" id="progress-bar-value">75%</span>
                                              <div class="clearfix"></div>	
                                            </div>
                                            <div class="progress progress-striped active">
                                              <div class="bar green" id="progress-bar"  value="0" max="100" style="width:75%"></div>
                                            </div>
              </div>                               
            
              <div class="form-group">
                <label for="name" class="col-sm-2 control-label" >total weight of phase 1 :</label>
                <div class="col-sm-1">
                  <input  type="text" class="form-control1" name="avg" id="avg" placeholder=""  value='<?php echo "$t1";?>' readonly>
                </div>
                
                <label for="employee no." class="col-sm-2 control-label">total weight of phase 2</label>
                <div class="col-sm-1">
                  <input type="text" class="form-control1" name="pm" id="pm" placeholder="" value='<?php echo "$t2";?>' 	readonly>
                </div>
                
                <label for="employee no." class="col-sm-2 control-label">total weight of phase 3</label>
                <div class="col-sm-1">
                  <input type="text" class="form-control1" name="pm" id="pm" placeholder="" value='<?php echo "$t3";?>' 	readonly>
                </div>
              </div>

              <div class="form-group">
                <label for="name" class="col-sm-4 control-label" style="text-align:left;padding-left:40px;" >total weight other than other performance  :</label>
                <div class="col-sm-2">
                  <input  type="text" class="form-control1" name="tt" id="tt" placeholder=""  value='<?php echo "$tt";?>' readonly>
                </div>
                
                <label for="employee no." class="col-sm-3 control-label">total weight in other performance :</label>
                <div class="col-sm-2">
                  <input type="text" class="form-control1" name="fmcq" id="fmcq" placeholder="" readonly 	>
                </div>
                
                
              </div>
                
                
                <div class="form-group">
                  <label for="designation" class="col-sm-2 control-label"  style="text-align:left;padding-left:40px;">special weight :</label>
                  <div class="col-sm-2">
                  <input type="text" class="form-control1" name="sw" id="sw" placeholder="" onchange = "calculate();"
                  onclick ="calculate();"  required>
                  </div>
                  <label for="designation" class="col-sm-1 control-label" >reason :</label>
                  <div class="col-sm-6">
                  <input type="text" class="form-control1" name="reason_sw" id="reason_sw" placeholder=""   required>
                  </div>
                  

                </div> 

                <div class="form-group">
                  <label for="designation" class="col-sm-2 control-label" >Total  :</label>
                    <div class="col-sm-2">
                      <input type="text" class="form-control1" name="total" id="total" placeholder=""
                      readonly>
                    </div>

                    <label for="designation" class="col-sm-1 control-label" >Grade  :</label>
                    <div class="col-sm-3">
                      
                    
                      <input type="text" class="form-control1" name="grade1" id="grade1" >
                    </div>
                </div>
              



              <div class="form-group" >
                <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                
                <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Previous"  name="" onclick="displayPhase3() " >
                


                <input type="submit" id="button" class="col-sm-2 btn btn-info"  style="margin-left:5%;"
                                      value="Submit"  name="submit" onclick=" return confirm('Are you sure you want to submit this form?');" >             
                </div>
              
            </div>

</div>

            </form>
          </div>
        </div>
      </div>
    </div>
          <!--footer-->
          <div id="footer2" style="background: #6495Ed; height: 100px;">
      
                  <div id="site-copyright" style="margin-top: 20px; margin-left: 30%; padding: 20px; font-size: 12px; color: black;">Shah &amp; Anchor Kutchhi Engineering College<br>
            Mahavir Education Trust Chowk, W. T. Patil Marg, Near Dukes Company, Chembur, Mumbai- 400 088.<br>
            © Shah &amp; Anchor Kutchhi Engineering College.</div>	<!-- #site-info -->
                    
                </div><!-- #footer2 -->	
	  </div>
	

   
</body>
</html>
		