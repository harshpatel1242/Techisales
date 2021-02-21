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
              WHERE college_db.subject_table.teacher1_id = $empname OR  college_db.subject_table.teacher2_id= $empname OR  college_db.subject_table.teacher3_id = $empname";
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

              $dummy=number_format($row['Avg_result'], 2);
              array_push($avg_past,$dummy);
              $dummy=number_format($row['greater_than_avg'], 2);
              array_push($greater_than_avg,$dummy);
             


          

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

  $applied_date = $_POST['date'];
	$emp_no = $_SESSION['Emp_no'];
	$hod_status = 'Pending';
	$pr_status = "Pending";







	$conn = mysqli_connect('localhost','root' ,'','faculty' );
  if(!$conn){
  die('Could not Connect My Sql:' .mysql_error());
  }

  if (isset($_POST['submit']))
  {

  $query = "INSERT INTO mt_appraisal (EMP_NO,APPLIED_ON,HOD_APPROVED,PRINCIPAL_APPROVED) 
        VALUES (?,?,?,?)";

				$stmt = mysqli_prepare($conn, $query);
				if ($stmt){
          mysqli_stmt_bind_param($stmt, "ssss",$param_emp_no ,$param_applied_on,$param_hod_status,$param_pr_status);

          $param_emp_no = $emp_no;    $param_hod_status = $hod_status;    $param_pr_status = $pr_status;    $param_applied_on = $applied_date;

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

  </script>

</head>
<body onload="displayPhase1();">
<!-- //header-ends -->
		<!-- main content start-->

		<div id="page-wrapper">
			<div class="main-page" style="margin-top: -50px;">
				<div class="forms" >
					<div class="form-grids row widget-shadow" data-example-id="basic-forms"> 	
					
          <form class="form-horizontal" method="POST" action="#"  >          
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
                          <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[0]"; ?>">
                          </div>
                          </td>

                          <td >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                          <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[0]"; ?>">
                          </div>	
                          </td>

                          <td  >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                          <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[0]"; ?>">
                          </div>
                          </td>

                          <td  >
                          <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                          <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[0]";?>">
                          </div>
                          </td>	

                          <td  >
                          <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                          <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php $p1[0]=($lec_engaged[0]/$lec_targeted[0])*100; $p1[0]=number_format($p1[0], 2) ; echo "$p1[0]"; ?>">
                          </div>
                          </td>	

                        </tr>	
                        <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[1]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[1]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[1]"; ?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[1]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php $p1[1]=($lec_engaged[1]/$lec_targeted[1])*100; $p1[1]=number_format($p1[1], 2) ;  echo "$p1[1]"; ?>">
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[2]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[2]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[2]"; ?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[2]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php $p1[2]=($lec_engaged[2]/$lec_targeted[2])*100; $p1[2]=number_format($p1[2], 2) ;  echo "$p1[2]"; ?>">
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[3]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[3]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$lec_targeted[3]"; ?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo"$lec_engaged[3]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder=""  value="<?php $p1[3]=($lec_engaged[3]/$lec_targeted[3])*100; $p1[3]=number_format($p1[3], 2) ;  echo "$p1[3]"; ?>">
                        </div>
                        </td>	

                      </tr>	
                        </table>
                      
                          <br>

                          <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder=""  readonly>
                              </div>
                              
                            
                            
                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" 	readonly>
                              </div>
                              
                            
                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder=""
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
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
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[0]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[0]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[0]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[0]"; ?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[0]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p2[0] =($students_present[0]/$no_of_students[0])*100;  $p2[0]=number_format($p2[0], 2) ;  echo "$p2[0]";?>">
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                      
                          
                      <td >
                      <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[1]"; ?>">
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[1]"; ?>">
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[1]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[1]"; ?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[1]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p2[1] =($students_present[1]/$no_of_students[1])*100;  $p2[1]=number_format($p2[1], 2) ; echo "$p2[1]";?>">
                        </div>
                        </td>	

                    </tr>	
                    <tr  >
                      
                          
                      <td >
                      <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[2]"; ?>">
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[2]"; ?>">
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[2]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[2]"; ?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[2]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p2[2] =($students_present[2]/$no_of_students[2])*100;  $p2[2]=number_format($p2[2], 2) ; echo "$p2[2]";?>">
                        </div>
                        </td>	

                    </tr>	
                    <tr  >
                      
                          
                      <td >
                      <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[3]"; ?>">
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[3]"; ?>">
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[3]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[3]"; ?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[3]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p2[3] =($students_present[3]/$no_of_students[3])*100;  $p2[3]=number_format($p2[3], 2) ; echo "$p2[3]";?>">
                        </div>
                        </td>	


                    </tr>	
                    <tr  >
                
                      <td >
                      <div style="display:<?php if($size <5)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                      <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[4]"; ?>">
                      </div>
                      </td>

                      <td >
                      <div style="display:<?php if($size <5)  {  echo "none";  }  else{ echo "block";  } ?>;">
                      <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[4]"; ?>">
                      </div>	
                      </td>

                      <td  >
                        <div style="display:<?php if($size <5)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$no_of_students[4]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <5)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$lec_engaged[4]"; ?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <5)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo "$students_present[4]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <5)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p2[4] =($students_present[4]/$no_of_students[4])*100;  $p2[4]=number_format($p2[4], 2) ; echo "$p2[4]";?>">
                        </div>
                        </td>	


                    </tr>	
                    </table>

                            <br>

                            <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder=""  readonly>
                              </div>
                              


                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" 	readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder=""
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
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
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[0]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[0]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[0]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[0]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <1)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p3[0]=($greater_than_avg[0]/$avg_past[0])*100 ;  $p3[0]=number_format($p3[0], 2) ; echo "$p3[0]";?>">
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[1]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[1]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[1]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[1]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <2)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p3[1]=($greater_than_avg[1]/$avg_past[1])*100 ;  $p3[1]=number_format($p3[1], 2);  echo "$p3[1]";?>">
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[2]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[2]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[2]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[2]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <3)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p3[2]=($greater_than_avg[2]/$avg_past[2])*100 ;  $p3[2]=number_format($p3[2], 2);  echo "$p3[2]";?>">
                        </div>
                        </td>	

                      </tr>	
                      <tr  >
                        
                            
                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo "$class[3]"; ?>">
                        </div>
                        </td>

                        <td >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo "$subjects[3]"; ?>">
                        </div>	
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;" >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo "$avg_past[3]";?>">
                        </div>
                        </td>

                        <td  >
                        <div style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo "$greater_than_avg[3]";?>">
                        </div>
                        </td>	

                        <td  >
                        <div  style="display:<?php if($size <4)  {  echo "none";  }  else{ echo "block";  } ?>;">
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php $p3[3]=($greater_than_avg[3]/$avg_past[3])*100 ;  $p3[3]=number_format($p3[2], 2);  echo "$p3[3]";?>">
                        </div>
                        </td>	

                      </tr>	

                    </table>
                            <br>

                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder=""  readonly>
                              </div>
                              


                              <label for="employee no." class="col-sm-2 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" 	readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder=""
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
                                readonly>
                              </div>
                            </div> 

                                    <div class="form-group">
                                    <label for="designation" class="col-sm-2 control-label" style="margin-left:0px;">Total Weight 1 :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
                                readonly>
                              </div>
                              


                              <label for="designation" class="col-sm-2 control-label">Total Weight 2:</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
                                readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-7px;">Total Weight 3:</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label"  style="margin-left:-7px;">Result Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder=""
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
                                              <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 2</span><span class="percentage" id="progress-bar-value">10%</span>
                                              <div class="clearfix"></div>	
                                            </div>
                                            <div class="progress progress-striped active">
                                              <div class="bar green" id="progress-bar"  value="0" max="100" style="width:10%"></div>
                                            </div>
                                </div>
                                
                                <div class="form-group">
                                <label for="Title" class="col-sm-2 control-label" >Other performance :</label><br><br>

                                <label for="Title" class="col-sm-3 control-label" >Class Room Planning and Control  :</label>
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
                                  <label for="Title" class="control-label" >Planning of lessons throughout the academic year  :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" name="mcq1" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq1" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq1" value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq1" value="0.4"> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Effective communication of subject matter and clarity of speech :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" name="mcq2" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq2" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq2"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq2" value="0.4"> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Management of lecture and class control :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq3" value="0.4"> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Involvement of students in learning process :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq4" value="0.4"> Poor</label></div>
                                   </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Use of media such as charts, models, transparencies, OHP, VCR ,TV :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq5" value="0.4"> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-3 control-label" >Students Guidance and Counseling  :</label>
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
                                  <label for="Title" class="control-label" >Guidance to students  about  books and literature :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq6" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Guidance about higher education / career planning :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq7" value="0.4"> Poor</label></div>
                                 
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Guidance about job opportunities / entrepreneurship :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq8" value="0.4"> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Guidance for preparing for interviews / personality development :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq9" value="0.4"> Poor</label></div>
                                   </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Guidance for independent study technique :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq10" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-3 control-label" >Assignments / Evaluation  :</label>
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
                                  <label for="Title" class="control-label" >Giving assignments regularly and assessing promptly :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq11" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Maintaining quality and standard of questions / evaluation :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq12" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >	Providing feed back to the students about shortcomings :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq13" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Innovation in paper setting / evaluation :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq14" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Record keeping of students profile :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq15" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-3 control-label" >Co-curricular Activities  :</label>
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
                                  <label for="Title" class="control-label" >Consultancy and testing in the appropriate of work area or Organizing continuing education programmers for revenue generation:</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq16" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Organizing cultural programmers / sports / extra curricular activities etc :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq17" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Organizing industrial visits / study tours for students or taking interest in NCC / NSS / blood donation / plantation / medical camps :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq18" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Contribution to maintain student  discipline in general :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq19" value="0.4"> Poor</label></div>
                                 </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Ability to work as a resource person :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20" value="2.0"> Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20" value="1.4"> Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20"value="1.0"> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq20" value="0.4"> Poor</label></div>
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
                                                <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 3</span><span class="percentage" id="progress-bar-value">20%</span>
                                                <div class="clearfix"></div>	
                                              </div>
                                              <div class="progress progress-striped active">
                                                <div class="bar green" id="progress-bar"  value="0" max="100" style="width:20%"></div>
                                              </div>
                                  </div>                              
                                  <p> phase 3 </p>

                                  <div class="form-group">

                                  <label for="Title" class="col-sm-4 control-label" >Curriculum / learning resources development  :</label>
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
                                    <label for="Title" class="control-label" >Interest shows in Curriculum development  or preparation of syllabus :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq21" value="0.4"> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 2  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" >Preparing question banks :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq22" value="0.4"> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>	
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 3  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" >Motivating students for use of computers :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq23" value="0.4"> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 4  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" >Giving handouts / upkeep of laboratory manuals / writing books :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq24" value="0.4"> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>	
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 5  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" >Preparations of computer software as a teaching aid :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq25" value="0.4"> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>		
                                  </table>

                                

                                <div class="form-group">

                                <label for="Title" class="col-sm-4 control-label" >Seminars / Training  :</label>
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
                                  <label for="Title" class="control-label" >	Use of library books , periodicals , journals etc :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq26" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Attendance in seminars / conferences / workshops :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq27" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Writing articles in state or national level periodicals :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq28" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Delivering speech in other institutions :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq29" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Memberships of professional bodies , awards and honors :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq30" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-4 control-label" >Administrative Functions  :</label>
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
                                  <label for="Title" class="control-label" >Contribution to conduct of gymkhana activities / procurement of equipment :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq31" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Worked as examination / gathering / admission in charge :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq32" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Maintenance of building / electrical installations / water supply / computers / equipments etc. or worked as rector / assistant, rector / warden :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq33" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Worked as in- charge for housekeeping / environmental hygienic/ cleanness of class room / premises/ gardens/ security :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq34" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Interest taken in activities related to canteen , CO- operative stores etc. or willingness to take up higher responsibility or any responsibility :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35" value="2.0"> Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35" value="1.4"> Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35"value="1.0"> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq35" value="0.4"> Poor</label></div>
                                    </div>
                                  </td>
                                </tr>		
                                </table>



                                              
                                
                                <label for="Concerned with lab" class="col-sm-3 control-label">Are you concerned with Laboratory work :</label>
                                <div class="col-sm-5">
                                  <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" id="cwl" name="decide" value ="1" 
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

                                          <!-- the switching function does not work -->
                                        
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
                                              <label for="Title" class="control-label" id="cwl-l1">Planned laboratory instruction including management of practical’s :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" value="2.0"> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" value="1.4"> Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36"value="1.0"> Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" value="0.4"> Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 2  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l2">Uniform converge of term work and guidance for writing journals :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" value="2.0"> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" value="1.4"> Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37"value="1.0"> Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" value="0.4"> Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>	
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 3  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l3">Checking of journals and making continuous assessment of term work :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" value="2.0"> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" value="1.4"> Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38"value="1.0"> Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" value="0.4"> Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 4  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id="cwl-l4" >Preparation and display of instructional material, charts, models, etc :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" value="2.0"> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" value="1.4"> Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39"value="1.0"> Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" value="0.4"> Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>	
                                            <tr>
                                              <td style="width:3%;">				
                                              <label for="Title" class=" control-label"> 5  </label>
                                              </td>

                                              <td style="width:15%;">
                                              <div >
                                              <label for="Title" class="control-label" id ="cwl-l5">Planning and procurement of consumable required for practical :</label>
                                              </div>
                                              </td>

                                              <td  style="width:15%;">
                                              <div >
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" value="2.0"> Excellent</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" value="1.4"> Good</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40"value="1.0"> Average</label></div>
                                                <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" value="0.4"> Poor</label></div>
                                              </div>
                                              </td>
                                            </tr>
                                            </table>    
                                          
                                <div class="form-group" >
                                  <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                  
                                  <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Previous"  name="" onclick="displayPhase2() " >
                                  <input type="submit" id="button" class="col-sm-2 btn btn-info"  
										              value="Submit"  name="submit" onclick=" return confirm('Are you sure you want to submit this form?');" >                                  </div>

                                </div>

              </div><!-- end of phase 3 -->

              <div id="phase4">
                                  <div style="margin-left:40%;margin-right:40%">
                                                                <div class="task-info" >
                                                                  <span class="task-desc" style="font-size:15px;">Form Filled</span><span class="task-desc" style="margin-left:15%;margin-right:15%;font-size:15px;" id="phase-value">Phase 4</span><span class="percentage" id="progress-bar-value">30%</span>
                                                                  <div class="clearfix"></div>	
                                                                </div>
                                                                <div class="progress progress-striped active">
                                                                  <div class="bar green" id="progress-bar"  value="0" max="100" style="width:30%"></div>
                                                                </div>
                                  </div>                               
                                  <p> phase 4 </p>

                                <div class="form-group" >
                                    <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                    
                                    <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Previous"  name="" onclick="displayPhase3() " >
                                    <input type="" id="button" class="col-sm-2 btn btn-info"  style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Next"  name="" onclick=" displayPhase5()" >
                                    
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
		