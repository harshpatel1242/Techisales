<?php


ob_start(); 
include_once  "header1.php";
$l="";
if(isset($_GET['id']))
{
$l = $_GET['id'];	
}


$query = "SELECT * FROM mt_appraisal WHERE FORM_ID=$l";
$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
   while ($row = mysqli_fetch_array($result))
   {  
      $emp_no=$row['EMP_NO']; 
      $applied_date = $row['APPLIED_ON'];
      $avg_p1 = $row['avg_1'];
      $avg_p2 = $row['avg_2'];
      $avg_p3  = $row['avg_3'];
      $t1 = $row['t1'];
      $t2 = $row['t2'];
      $t3 = $row['t3'];
      $tt = $row['tt'];  
      $f_mcq= $row['fmcq'];
      $sw= $row['sw'];
      $reason = $row['reason'];
      $total=$row['total']; 
      $grade=$row['grade']; 

   }
}
$query = "SELECT * FROM mt_emp WHERE EMP_NO=$emp_no";
$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
   while ($row = mysqli_fetch_array($result))
   {
      $firstname = $row['F_NAME'];
      $middlename = $row['M_NAME'];
      $lastname = $row['L_NAME'];

   }
}

if($avg_p1 >=81){ $pm1=1.0; $pmp1="Excellent"; }  elseif($avg_p1>=61  && $avg_p1<=80){ $pm1=0.7; $pmp1="Good";}   elseif($avg_p1>=41  && $avg_p1<=60){ $pm1=0.5; $pmp1="Average";}  else{ $pm1=0.2; $pmp1= "Poor";} 
if($avg_p2 >=81){ $pm2=1.0; $pmp2="Excellent"; }  elseif($avg_p2>=61  && $avg_p2<=80){ $pm2=0.7; $pmp2="Good";}   elseif($avg_p2>=41  && $avg_p2<=60){ $pm2=0.5; $pmp2="Average";}  else{ $pm2=0.2; $pmp2= "Poor";}
if($avg_p3 >=81){ $pm3=1.0; $pmp3="Excellent"; }  elseif($avg_p3>=61  && $avg_p3<=80){ $pm3=0.7; $pmp3="Good";}   elseif($avg_p3>=41  && $avg_p3<=60){ $pm3=0.5; $pmp3="Average";}  else{ $pm3=0.2; $pmp3= "Poor";} 
$m1=$m2=$m3=5;

$query = "SELECT * FROM mcq WHERE FORM_ID=$l";
$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
  while ($row = mysqli_fetch_array($result))
  {
  $mcq1=  $row['mcq1'];   $mcq2=  $row['mcq2'];   $mcq3=  $row['mcq3'];   $mcq4=  $row['mcq4'];   $mcq5=  $row['mcq5'];
  $mcq6=  $row['mcq6'];   $mcq7=  $row['mcq7'];   $mcq8=  $row['mcq8'];   $mcq9=  $row['mcq9'];   $mcq10= $row['mcq10'];

  $mcq11=  $row['mcq11'];   $mcq12=  $row['mcq12'];   $mcq13=  $row['mcq13'];   $mcq14=  $row['mcq14'];   $mcq15=  $row['mcq15'];
  $mcq16=  $row['mcq16'];   $mcq17=  $row['mcq17'];   $mcq18=  $row['mcq18'];   $mcq19=  $row['mcq19'];   $mcq20=  $row['mcq20'];

  $mcq21=  $row['mcq21'];   $mcq22=  $row['mcq22'];   $mcq23=  $row['mcq23'];   $mcq24=  $row['mcq24'];   $mcq25=  $row['mcq25'];
  $mcq26=  $row['mcq26'];   $mcq27=  $row['mcq27'];   $mcq28=  $row['mcq28'];   $mcq29=  $row['mcq29'];   $mcq30=  $row['mcq30'];

  $mcq31=  $row['mcq31'];   $mcq32=  $row['mcq32'];   $mcq33=  $row['mcq33'];   $mcq34=  $row['mcq34'];   $mcq35=  $row['mcq35'];
  $mcq36=  $row['mcq36'];   $mcq37=  $row['mcq37'];   $mcq38=  $row['mcq38'];   $mcq39=  $row['mcq39'];   $mcq40=  $row['mcq40'];   $decide=$row['decide'];

  
  }
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  $pr_date=$_POST['pr_date'];
  $remark = $_POST['pr_remark'];
 
  if (isset($_POST['approved']))
{  
    $query = "UPDATE mt_appraisal SET HOD_APPROVED = 'Approved',HOD_APPROVED_DATE = '$pr_date',HOD_REMARKS='$remark',HOD_APP_ID	='$empname'
                   WHERE FORM_ID = '$l' ";
    $res = mysqli_query($conn , $query);
    if($res)
		{
										   
			echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
			header("location:hod.php");
	
	}		
	else
	{
	echo "something went wrong in executing query ";
	}					
}
	if (isset($_POST['Rejected']))
{
  
  $query = "UPDATE mt_appraisal SET  HOD_APPROVED = 'Review',HOD_APPROVED_DATE = '$pr_date',HOD_REMARKS='$remark',HOD_APP_ID	='$empname'
  WHERE FORM_ID = '$l' ";
$res = mysqli_query($conn , $query);
 
    if($res)
    {
				echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is rejected\");}</script>";
			  header("location:hod.php");
    
    }
    else
    {
    echo "something went wrong in executing query ";
    }			
}
ob_flush();


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
                            value="<?php echo "$applied_date";?>" readonly>
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

                       <?php
                            $query = "SELECT * FROM engaging_lectures WHERE FORM_ID=$l";
             
                        
                            $result = mysqli_query($conn , $query)or die( mysqli_error($conn));
                            if (mysqli_num_rows($result) > 0) 
                            {
                       ?>

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
                        <?php 
                      
                          while ($row = mysqli_fetch_array($result))
                          {

                        ?>
                       
                        <tr  >                         
                          <td >
                          <div >
                          <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo $row['class']; ?>" readonly>
                          </div>
                          </td>

                          <td >
                          <div >
                          <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo $row['sub']; ?>" readonly>
                          </div>	
                          </td>

                          <td  >
                          <div  >
                          <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo $row['lectures_targeted']; ?>" readonly>
                          </div>
                          </td>

                          <td  >
                          <div >
                          <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo $row['lectures_engaged']; ?>" readonly>
                          </div>
                          </td>	

                          <td  >
                          <div  >
                          <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo $row['percent']; ?>" readonly>
                          </div>
                          </td>	

                        </tr>   
                        <?php
                          }
                        }
                        ?>    
                        </table>

                        
                      
                          <br>

                          <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder="" value="<?php echo "$avg_p1"; ?>" readonly>
                              </div>
                              
                            
                            
                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" value="<?php echo "$pm1"; ?>"	readonly>
                              </div>
                              
                            
                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder="" value="<?php echo "$m1"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t1"; ?>"
                                readonly>
                              </div>
                            </div> 

                            <label for="Title" class="col-sm-4 control-label" >Performance of Attendance of Students :</label>
                            
                            <?php
                              $query = "SELECT * FROM attendance_students WHERE FORM_ID=$l";
             
                        
                              $result = mysqli_query($conn , $query)or die( mysqli_error($conn));
                              if (mysqli_num_rows($result) > 0) 
                              {
                        ?>


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
                              <th>Percent 
                              </th>
                              
                            </tr>

                            <?php 
                                
                                while ($row = mysqli_fetch_array($result))
                                {

                              ?>
                            <tr  >
                        <td >
                        <div  >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo $row['class']; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div >
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo $row['sub']; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div  >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo $row['no_of_students']; ?>"readonly>
                        </div>
                        </td>

                        <td  >
                        <div >
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo $row['lecture_engaged']; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div >
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo $row['student_present']; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div >
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo $row['percent']; ?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <?php
                          }
                        }
                        ?>                      
                    </table>

                            <br>

                            <div class="form-group">
                              <label for="name" class="col-sm-1 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder="" value="<?php echo "$avg_p2"; ?>"  readonly>
                              </div>
                              


                              <label for="employee no." class="col-sm-3 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" value="<?php echo "$pm2"; ?>"	readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder="" value="<?php echo "$m2"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t2"; ?>"
                                readonly>
                              </div>
                            </div> 
                            
                            <?php
                              $query = "SELECT * FROM result_of_students WHERE FORM_ID=$l";
             
                        
                              $result = mysqli_query($conn , $query)or die( mysqli_error($conn));
                              if (mysqli_num_rows($result) > 0) 
                              {
                        ?>

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
                              <th>Percent
                              </th>
                              
                            </tr>
                            <?php 
                                
                                while ($row = mysqli_fetch_array($result))
                                {
                              ?>
                            <tr  >                        
                        <td >
                        <div >
                        <input type="text" class="form-control1" name="class1" placeholder="" value="<?php echo $row['class']; ?>" readonly>
                        </div>
                        </td>

                        <td >
                        <div >
                        <input type="text" class="form-control1" name="subject1" placeholder="" value="<?php echo $row['sub']; ?>" readonly>
                        </div>	
                        </td>

                        <td  >
                        <div  >
                        <input type="text" class="form-control1" name="lt1" placeholder="" value="<?php echo $row['avg_three_yrs']; ?>" readonly>
                        </div>
                        </td>

                        <td  >
                        <div >
                        <input type="text" class="form-control1" name="le1" placeholder="" value="<?php echo $row['pecent_greater_avg']; ?>" readonly>
                        </div>
                        </td>	

                        <td  >
                        <div  >
                        <input type="text" class="form-control1" name="p1" placeholder="" value="<?php echo $row['percent']; ?>" readonly>
                        </div>
                        </td>	

                      </tr>	
                      <?php
                                }
                              }
                      ?>
                    </table>
                            <br>

                            <div class="form-group">
                              <label for="name" class="col-sm-2 control-label" >Average :</label>
                              <div class="col-sm-1">
                                <input  type="text" class="form-control1" name="avg" id="avg" placeholder="" value="<?php echo "$avg_p3"; ?>" readonly>
                              </div>
                              


                              <label for="employee no." class="col-sm-2 control-label">Performance / Multiplying Factor</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="pm" id="pm" placeholder="" value="<?php echo "$pm3"; ?>"	readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Max Weightage :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="mw" id="mw" placeholder="" value="<?php echo "$m3"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-8px;">Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t3"; ?>"
                                readonly>
                              </div>
                            </div> 

                                    <div class="form-group">
                                    <label for="designation" class="col-sm-2 control-label" style="margin-left:0px;">Total Weight 1 :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t1"; ?>"
                                readonly>
                              </div>
                              


                              <label for="designation" class="col-sm-2 control-label">Total Weight 2:</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t2"; ?>"
                                readonly>
                              </div>
                              

                              <label for="designation" class="col-sm-2 control-label" style="margin-left:-7px;">Total Weight 3:</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$t3"; ?>"
                                readonly>
                              </div>

                              <label for="designation" class="col-sm-2 control-label"  style="margin-left:-7px;">Result Total Weight :</label>
                              <div class="col-sm-1">
                                <input type="text" class="form-control1" name="tw" id="tw" placeholder="" value="<?php echo "$tt"; ?>"
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

                                <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;">Class Room Planning and Control  :</label>
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
                                  <label for="Title" class="control-label"  style="text-align:left;">Planning of lessons throughout the academic year  :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="1" <?php if($mcq1==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="1" <?php if($mcq1==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="1" <?php if($mcq1==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="1" <?php if($mcq1==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Effective communication of subject matter and clarity of speech :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="2" <?php if($mcq2==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="2" <?php if($mcq2==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="2" <?php if($mcq2==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="2" <?php if($mcq2==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Management of lecture and class control :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="3" <?php if($mcq3==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="3" <?php if($mcq3==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="3" <?php if($mcq3==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="3" <?php if($mcq3==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Involvement of students in learning process :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="4" <?php if($mcq4==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="4" <?php if($mcq4==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="4" <?php if($mcq4==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="4" <?php if($mcq4==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Use of media such as charts, models, transparencies, OHP, VCR ,TV :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="5" <?php if($mcq5==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="5" <?php if($mcq5==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="5" <?php if($mcq5==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="5" <?php if($mcq5==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;">Students Guidance and Counseling  :</label>
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
                                  <label for="Title" class="control-label" style="text-align:left;">Guidance to students  about  books and literature :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="6" <?php if($mcq6==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="6" <?php if($mcq6==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="6" <?php if($mcq6==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="6" <?php if($mcq6==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Guidance about higher education / career planning :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="7" <?php if($mcq7==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="7" <?php if($mcq7==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="7" <?php if($mcq7==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="7" <?php if($mcq7==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Guidance about job opportunities / entrepreneurship :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="8" <?php if($mcq8==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="8" <?php if($mcq8==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="8" <?php if($mcq8==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="8" <?php if($mcq8==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Guidance for preparing for interviews / personality development :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="9" <?php if($mcq9==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="9" <?php if($mcq9==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="9" <?php if($mcq9==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="9" <?php if($mcq9==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Guidance for independent study technique :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="10" <?php if($mcq10==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="10" <?php if($mcq10==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="10" <?php if($mcq10==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="10" <?php if($mcq10==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;" >Assignments / Evaluation  :</label>
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
                                  <label for="Title" class="control-label" style="text-align:left;">Giving assignments regularly and assessing promptly :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="11" <?php if($mcq11==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="11" <?php if($mcq11==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="11" <?php if($mcq11==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="11" <?php if($mcq11==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label" style="text-align:left;"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" >Maintaining quality and standard of questions / evaluation :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="12" <?php if($mcq12==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="12" <?php if($mcq12==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="12" <?php if($mcq12==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="12" <?php if($mcq12==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >	Providing feed back to the students about shortcomings :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="13" <?php if($mcq13==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="13" <?php if($mcq13==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="13" <?php if($mcq13==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="13" <?php if($mcq13==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Innovation in paper setting / evaluation :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="14" <?php if($mcq14==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="14" <?php if($mcq14==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="14" <?php if($mcq14==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="14" <?php if($mcq14==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Record keeping of students profile :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="15" <?php if($mcq15==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="15" <?php if($mcq15==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="15" <?php if($mcq15==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="15" <?php if($mcq15==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;" >Co-curricular Activities  :</label>
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
                                  <label for="Title" class="control-label" style="text-align:left;" >Consultancy and testing in the appropriate of work area or Organizing continuing education programmers for revenue generation:</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="16" <?php if($mcq16==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="16" <?php if($mcq16==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="16" <?php if($mcq16==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="16" <?php if($mcq16==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Organizing cultural programmers / sports / extra curricular activities etc :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="17" <?php if($mcq17==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="17" <?php if($mcq17==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="17" <?php if($mcq17==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="17" <?php if($mcq17==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Organizing industrial visits / study tours for students or taking interest in NCC / NSS / blood donation / plantation / medical camps :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="18" <?php if($mcq18==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="18" <?php if($mcq18==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="18" <?php if($mcq18==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="18" <?php if($mcq18==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Contribution to maintain student  discipline in general :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="19" <?php if($mcq19==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="19" <?php if($mcq19==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="19" <?php if($mcq19==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="19" <?php if($mcq19==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Ability to work as a resource person :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="20" <?php if($mcq20==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="20" <?php if($mcq20==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="20" <?php if($mcq20==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="20" <?php if($mcq20==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
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

                                  <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;" >Curriculum / learning resources development  :</label>
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
                                    <label for="Title" class="control-label"  style="text-align:left;">Interest shows in Curriculum development  or preparation of syllabus :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="21" <?php if($mcq21==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="21" <?php if($mcq21==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="21" <?php if($mcq21==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="21" <?php if($mcq21==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 2  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" style="text-align:left;">Preparing question banks :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="22" <?php if($mcq22==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="22" <?php if($mcq22==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="22" <?php if($mcq22==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="22" <?php if($mcq22==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>	
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 3  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" style="text-align:left;">Motivating students for use of computers :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="23" <?php if($mcq23==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="23" <?php if($mcq23==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="23" <?php if($mcq23==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="23" <?php if($mcq23==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 4  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" style="text-align:left;">Giving handouts / upkeep of laboratory manuals / writing books :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="24" <?php if($mcq24==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="24" <?php if($mcq24==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="24" <?php if($mcq24==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="24" <?php if($mcq24==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                    </div>       
                                    </td>
                                  </tr>	
                                  <tr>
                                    <td style="width:3%;">				
                                    <label for="Title" class=" control-label"> 5  </label>
                                    </td>

                                    <td style="width:15%;">
                                    <div >
                                    <label for="Title" class="control-label" style="text-align:left;">Preparations of computer software as a teaching aid :</label>
                                    </div>
                                    </td>

                                    <td  style="width:15%;">
                                    <div >
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="25" <?php if($mcq25==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="25" <?php if($mcq25==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="25" <?php if($mcq25==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                      <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="25" <?php if($mcq25==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                    </div>
                                    </td>
                                  </tr>		
                                  </table>

                                

                                <div class="form-group">

                                <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;">Seminars / Training  :</label>
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
                                  <label for="Title" class="control-label" style="text-align:left;">	Use of library books , periodicals , journals etc :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="26" <?php if($mcq26==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="26" <?php if($mcq26==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="26" <?php if($mcq26==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="26" <?php if($mcq26==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Attendance in seminars / conferences / workshops :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="27" <?php if($mcq27==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="27" <?php if($mcq27==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="27" <?php if($mcq27==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="27" <?php if($mcq27==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Writing articles in state or national level periodicals :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="28" <?php if($mcq28==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="28" <?php if($mcq28==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="28" <?php if($mcq28==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="28" <?php if($mcq28==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Delivering speech in other institutions :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="29" <?php if($mcq29==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="29" <?php if($mcq29==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="29" <?php if($mcq29==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="29" <?php if($mcq29==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Memberships of professional bodies , awards and honors :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="30" <?php if($mcq30==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="30" <?php if($mcq30==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="30" <?php if($mcq30==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="30" <?php if($mcq30==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>

                                <div class="form-group">

                                <label for="Title" class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;" >Administrative Functions  :</label>
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
                                  <label for="Title" class="control-label" style="text-align:left;" >Contribution to conduct of gymkhana activities / procurement of equipment :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="31" <?php if($mcq31==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="31" <?php if($mcq31==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="31" <?php if($mcq31==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="31" <?php if($mcq31==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Worked as examination / gathering / admission in charge :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="32" <?php if($mcq32==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="32" <?php if($mcq32==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="32" <?php if($mcq32==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="32" <?php if($mcq32==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;">Maintenance of building / electrical installations / water supply / computers / equipments etc. or worked as rector / assistant, rector / warden :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="33" <?php if($mcq33==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="33" <?php if($mcq33==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="33" <?php if($mcq33==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="33" <?php if($mcq33==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Worked as in- charge for housekeeping / environmental hygienic/ cleanness of class room / premises/ gardens/ security :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="34" <?php if($mcq34==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="34" <?php if($mcq34==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="34" <?php if($mcq34==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="34" <?php if($mcq34==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" style="text-align:left;" >Interest taken in activities related to canteen , CO- operative stores etc. or willingness to take up higher responsibility or any responsibility :</label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="35" <?php if($mcq35==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="35" <?php if($mcq35==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="35" <?php if($mcq35==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="35" <?php if($mcq35==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>		
                                </table>


                              <script>
                              function change(){
                                if(_(cwl).value=="Yes"){
                                          _("cwl-l1").innerHTML= "Planned laboratory instruction including management of practical’s :" ; 
                                          _("cwl-l2").innerHTML= "Uniform converge of term work and guidance for writing journals :" ;
                                          _("cwl-l3").innerHTML= "Checking of journals and making continuous assessment of term work :" ;
                                          _("cwl-l4").innerHTML= "Preparation and display of instructional material, charts, models, etc :" ;
                                          _("cwl-l5").innerHTML= "Planning and procurement of consumable required for practical :" ;  
                                }
                                else{
                                          _("cwl-l1").innerHTML= "Arranging special lectures of eminent person :" ; 
                                          _("cwl-l2").innerHTML= "Conducting special classes for low profit students :" ;
                                          _("cwl-l3").innerHTML= "Attitude towards maintaining cleanliness and aesthetics :" ;
                                          _("cwl-l4").innerHTML= "Interaction with teachers teaching subject other than his own discipline :" ;
                                          _("cwl-l5").innerHTML= "Preparation and display of instructional material :" ;  

                                }

                              }
                              </script>

<?php
$y1="Planned laboratory instruction including management of practical’s :";
$y2="Uniform converge of term work and guidance for writing journals :" ;
$y3="Checking of journals and making continuous assessment of term work :" ;
$y4="Preparation and display of instructional material, charts, models, etc :" ;
$y5="Planning and procurement of consumable required for practical :" ;  
$n1= "Arranging special lectures of eminent person :" ; 
$n2="Conducting special classes for low profit students :" ;
$n3="Attitude towards maintaining cleanliness and aesthetics :" ;
$n4="Interaction with teachers teaching subject other than his own discipline :" ;
$n5="Preparation and display of instructional material :" ;  

?>
                                              
                                
                                <label for="Concerned with lab"  class="col-sm-6 control-label" style ="text-align:left;padding-left:100px;">Are you concerned with Laboratory work :</label>
                                <div class="col-sm-5">
                                  <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" id="cwl" name="cwl" value ="Yes" 
                                  <?php if($decide==1){echo "checked"; } else{echo "disabled";} ?>
                                 
                                  > Yes</label></div>
                                  <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio" id="cwl" name="cwl" value ="No"  
                                  <?php if($decide==0){echo "checked"; } else{echo "disabled";} ?>
                                
                                  > No</label></div>
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
                                  <label for="Title" class="control-label" id="cwl-l1" style="text-align:left;"><?php if($decide==1){echo "$y1"; } else{echo "$n1";}?></label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" <?php if($mcq36==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" <?php if($mcq36==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" <?php if($mcq36==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq36" <?php if($mcq36==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 2  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" id="cwl-l2" style="text-align:left;"><?php if($decide==1){echo "$y2"; } else{echo "$n2";}?></label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" <?php if($mcq37==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" <?php if($mcq37==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" <?php if($mcq37==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq37" <?php if($mcq37==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 3  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" id="cwl-l3" style="text-align:left;"><?php if($decide==1){echo "$y3"; } else{echo "$n3";}?></label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" <?php if($mcq38==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" <?php if($mcq38==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" <?php if($mcq38==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq38" <?php if($mcq38==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 4  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" id="cwl-l4" style="text-align:left;"><?php if($decide==1){echo "$y4"; } else{echo "$n4";}?></label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" <?php if($mcq39==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" <?php if($mcq39==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" <?php if($mcq39==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq39" <?php if($mcq39==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>	
                                <tr>
                                  <td style="width:3%;">				
                                  <label for="Title" class=" control-label"> 5  </label>
                                  </td>

                                  <td style="width:15%;">
                                  <div >
                                  <label for="Title" class="control-label" id ="cwl-l5" style="text-align:left;"><?php if($decide==1){echo "$y5"; } else{echo "$n5";}?></label>
                                  </div>
                                  </td>

                                  <td  style="width:15%;">
                                  <div >
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" <?php if($mcq40==2.0){echo "checked";} else{echo "disabled";} ?> > Excellent</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" <?php if($mcq40==1.4){echo "checked";} else{echo "disabled";} ?> > Good</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" <?php if($mcq40==1.0){echo "checked";} else{echo "disabled";} ?>> Average</label></div>
                                    <div class="radio-inline" style="margin-left:15px;margin-right:15px;"><label><input type="radio"  name="mcq40" <?php if($mcq40==0.4){echo "checked";} else{echo "disabled";} ?>> Poor</label></div>
                                  </div>
                                  </td>
                                </tr>
                                </table>    
                                          
                                <div class="form-group" >
                                  <div class="col-sm-10" style="margin-left:12%;margin-right:12%;">
                                  
                                  <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"value="Previous"  name="" onclick="displayPhase2() " >
                                  <input type="" id="button" class="col-sm-2 btn btn-info" style="margin-left:15%;margin-right:15%;background: #ffb121;"  value="Next"  name="" onclick="displayPhase4()" >                                  
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
                                      <input type="text" class="form-control1" name="fmcq" id="fmcq" value='<?php echo "$f_mcq";?>' readonly 	>
                                    </div>
                                    
                                    
                                  </div>
                                    
                                    
                                    <div class="form-group">
                                      <label for="designation" class="col-sm-2 control-label"  style="text-align:left;padding-left:40px;">special weight :</label>
                                      <div class="col-sm-2">
                                      <input type="text" class="form-control1" name="sw" id="sw" placeholder="" value='<?php echo "$sw";?>'  readonly>
                                      </div>
                                      <label for="designation" class="col-sm-1 control-label" >reason :</label>
                                      <div class="col-sm-6">
                                      <input type="text" class="form-control1" name="reason_sw" id="reason_sw" value='<?php echo "$reason";?>'   readonly>
                                      </div>
                                      

                                    </div> 

                                    <div class="form-group">
                                      <label for="designation" class="col-sm-2 control-label" >Total  :</label>
                                        <div class="col-sm-2">
                                          <input type="text" class="form-control1" name="total" id="total" value='<?php echo "$total";?>' readonly>
                                        </div>

                                        <label for="designation" class="col-sm-1 control-label" >Grade  :</label>
                                        <div class="col-sm-6">
                                          
                                        
                                          <input type="text" class="form-control1" name="grade1" id="grade1" value='<?php echo "$grade";?>' readonly>
                                        </div>
                                    </div>

                                  <div class="form-group">
                                    <label for="name" class="col-sm-1 control-label" >remarks :</label>
                                    <div class="col-sm-6">
                                      <input  type="text" class="form-control1" name="pr_remark"  id="pr_remark"  placeholder=""  >
                                    </div>
                                    <label for="date" class="col-sm-1 control-label" style="" >Date :</label>
                                    <div class="col-sm-2" >
                                      <input type="date" class="form-control1" id="date" placeholder=""name="pr_date" id="pr_date"
                                      value="<?php echo date("Y-m-d");?>" readonly>
                                    </div>
                
                                  </div> 



                                  <div class="form-group" >
                                    <div class="col-sm-10" style="margin-left: 20%;margin-top: 30px;">
                                      <input type="submit" id="button" class="col-sm-2 btn btn-info" name="approved" value="Approved" style="background: lightgreen;color: black;"
                                      onclick=" return confirm('Are you sure you want to submit this form?');">
                                     

                                     
                                      <input type="submit" id="button" style="margin-left: 25%;background: red;color: black;"  name="Rejected"
                                      class="col-sm-2 btn btn-info" value="Review" onclick=" return confirm('Are you sure you want to submit this form?');">

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
		