

<?php 
ob_start(); 
require_once "header1.php";

$FORM_ID="";
if(isset($_GET['id']))
{
$FORM_ID = $_GET['id'];  
echo $FORM_ID;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{   
  

  if (isset($_POST['approved']))
{
    //$remark = $_POST['hod_remark'];
    $l_id = $_POST['approved'];
    $remark = $_POST['prn_remark'];
    $date = date("Y-m-d");

   
    $query = "UPDATE mt_appraisal SET PRINCIPAL_APPROVED = 'Approved',PRINCIPAL_APPROVED_DATE = '$date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname' WHERE FORM_ID =$l_id  " ;
   $res = mysqli_query($conn , $query);
      
    
    if($res)
    {
              echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is approved\");}</script>";
              header("location:principal.php");
    }
    else
    {
      echo "something went wrong please refresh page";
    }


}

  if (isset($_POST['rejected']))
{
    $remark = $_POST['prn_remark'];
    $l_id = $_POST['rejected'];
    $date = date('Y-m-d');
  
    $query = "UPDATE mt_appraisal SET PRINCIPAL_APPROVED = 'Review',PRINCIPAL_APPROVED_DATE='$date',PRINCIPAL_REMARKS='$remark',PR_APP_ID='$empname' WHERE FORM_ID = $l_id";
    $res = mysqli_query($conn , $query);
    
    
    if($res)
    {
      echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is rejected\");}</script>";
      header("location:principal.php");
    }
    else
    {
      echo "something went wrong please refresh page";
    }


}

}

?>
<!DOCTYPE html>
<html>
<head>
  <title></title>
  	<!-- Script -->
    <script src='jquery-3.1.1.min.js' type='text/javascript'></script>

    <!-- jQuery UI -->
    <link href='jquery-ui.min.css' rel='stylesheet' type='text/css'>
    <script src='jquery-ui.min.js' type='text/javascript'></script>
	<!-- Script -->
	
<script type='text/javascript'>
    $( function() {
  
        $( "#autocomplete1" ).autocomplete({
            source: function( request, response ) {
                
                $.ajax({
                    url: "fetchData.php",
                    type: 'post',
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function( data ) {
                        response( data );
                    }
                });
            },
            select: function (event, ui) {
                $('#autocomplete1').val(ui.item.label); // display the selected text
                $('#selectuser_id1').val(ui.item.value); // save selected id to input
			
                return false;
            }
        });

    });
</script>

  
</head>
<body>
<div id="page-wrapper">
      <div class="main-page">
        <div class="tables">         
          <div class="panel-body widget-shadow">  
              <form method="POST" class="form-horizontal">
              <div class="form-grids " data-example-id="basic-forms"> 	
              <div class="form-group">
                  

                  <div class="col-sm-2">
                    <input type="text" id='autocomplete1'  name="atd_empname" class="form-control1" placeholder="Employee Name" >
                  </div>
                  <div  class="col-sm-2">
                  <input type="text" id='selectuser_id1' name="atd_emp_no" class="form-control1" placeholder="Employee No" readonly/> 
                  </div>							
               <!--   <div class="col-sm-2" style="width:10%;"><input type="date" name="pick_date" id="pick_date" class=" form-control1" placeholder="start date" ></div>
                  <div class="col-sm-2" style="width:10%;"><input type="date" name="drop_date" id="drop_date" class=" form-control1" placeholder="end date" ></div> -->
                  <div class="col-sm-1" >
                      <select name="depatment" id="department" class=" form-control1">
                        <option value="8">IT</option>
                        <option value="5">COMPUTER</option>
                        <option value="6">EXTC</option>
                        
                      </select>
                  </div>
                  <div class="col-sm-1"><input type="submit" style="background: #5bc0de;color: white; text-align: center;" class=" btn btn-info"
                  name="search" value="search record"></div>
              </div>
              </div>
              </form> 
 
<?php


if(isset($_POST['search']))
{
/*$pick_date = $_POST['pick_date'];
$drop_date = $_POST['drop_date']; */
$chk_emp_no = $_POST['atd_emp_no'];
$chk_empname = $_POST['atd_empname'];
$department = $_POST['depatment'];
$list_flag = 0;
$error = '';
// if flag set execute these 
            // this code is usd to check all data if user enters employee name
            if($chk_emp_no != "")
            {
                 // if name is entered
                  // detch all data to compare
                  $check = "SELECT * FROM mt_emp WHERE EMP_NO like '$chk_emp_no'";
                  $result_check = mysqli_query($conn , $check)or die( mysqli_error($conn));
                        if (mysqli_num_rows($result_check) > 0) 
                        {    
                          while ($row = mysqli_fetch_array($result_check))
                          {   
                              $chk_role = $row['DESIGNATION'];
                              $chk_dept = $row['DEPARTMENT'];
                              $chk_dept_id = $row['DEPT_ID'];
                              $chk_role = $row['DESIGNATION'];
                          }
                        }
                
                // compare role, department and set flag
                if($chk_dept_id != $department)
                {
                  $list_flag = 1; $error = "Sorry, departments dont match !" ;
                }
                if($chk_role == "principal" || $chk_role == "admin" )
                {
                  $list_flag = 2; $error = "Sorry, you are not allowed to search for this person !";
                }
            }
            
            else{ // if no name is ented
              $chk_emp_no = "%%" ;
              $chk_role  = "%%" ;
            }
            // the code tp check all data if user enters employee name ends here
            
          
            /*  if($pick_date=="" || $drop_date==""){
                if($pick_date=="")  { $pick_date=date('2000-01-01');  }
                if($drop_date=="")  { $drop_date= date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day"));  } }  */

 
                /*    
                $query = "SELECT mt_appraisal.* , mt_emp.*
                FROM mt_appraisal  INNER JOIN mt_emp 
                ON mt_appraisal.EMP_NO = mt_emp.EMP_NO  
                WHERE mt_appraisal.EMP_NO = '$chk_emp_no'
                AND (mt_appraisal.HOD_APPROVED='Approved' AND mt_appraisal.PRINCIPAL_APPROVED = 'Pending')
               # AND mt_emp.DESIGNATION != 'principal' AND mt_emp.DESIGNATION != 'admin' # to display error
                AND mt_emp.DEPT_ID = '$department'
                AND ( mt_appraisal.APPLIED_ON  Between '$pick_date' AND '$drop_date' )  order by mt_appraisal.APPLIED_ON  ";
                
                */
                /*   
                $query = "SELECT * FROM mt_appraisal  WHERE  HOD_APPROVED ='Pending' 
                          AND EMP_NO IN (SELECT EMP_NO like '$chk_emp_no' FROM mt_emp WHERE DESIGNATION != 'principal' AND DESIGNATION != 'admin' )
                          AND ( APPLIED_ON  Between '$pick_date' AND '$drop_date' )  order by APPLIED_ON  ";
            
                */
                $query = "SELECT mt_appraisal.*, mt_emp.*
                          FROM mt_appraisal  INNER JOIN mt_emp 
                          ON mt_appraisal.EMP_NO = mt_emp.EMP_NO  
                          WHERE ((mt_appraisal.HOD_APPROVED='Approved' AND mt_appraisal.PRINCIPAL_APPROVED = 'Pending' AND mt_emp.DESIGNATION = 'employee')
                                OR  ( mt_appraisal.PRINCIPAL_APPROVED = 'Pending' AND mt_emp.DESIGNATION = 'hod'))
                          AND mt_appraisal.EMP_NO LIKE '$chk_emp_no'
                          AND mt_emp.DEPT_ID = '$department'
                          AND mt_emp.DESIGNATION != 'principal' AND mt_emp.DESIGNATION != 'admin' 
                           ";
                $result = mysqli_query($conn , $query)or die( mysqli_error($conn));

            
            
}
  else
  {         $list_flag = 0;
            $error = '';
        /*    $pick_date = date('2000-01-01');
            $drop_date = date('Y-m-d',strtotime(date("Y-m-d", mktime()) . " + 365 day")); */

            $query = "SELECT mt_appraisal.*, mt_emp.*
                      FROM mt_appraisal  INNER JOIN mt_emp 
                      ON mt_appraisal.EMP_NO = mt_emp.EMP_NO  
                      WHERE ((mt_appraisal.HOD_APPROVED='Approved' AND mt_appraisal.PRINCIPAL_APPROVED = 'Pending' AND mt_emp.DESIGNATION = 'employee')
                            OR  ( mt_appraisal.PRINCIPAL_APPROVED = 'Pending' AND mt_emp.DESIGNATION = 'hod'))
                      AND mt_emp.DESIGNATION != 'principal' AND mt_emp.DESIGNATION != 'admin' 
                      ";
            

            $result = mysqli_query($conn , $query)or die( mysqli_error($conn));
  }
  ?>
  <!-- <h3 class="hdg">Alerts</h3>   -->
  <div class="alert alert-warning" role="alert" style ="display:<?php if( $list_flag != 0){ echo "block"; }  else{ echo "none"; }?>;">
                      <?php echo "$error" ;?>
                  </div>
        
  <?php
if (mysqli_num_rows($result) > 0) 
{
		
?>
		
   
</body>
</html>


<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style type="text/css"> 
  body
    {
      height:100%;
    }
    </style>
</head>
<body>
            <div style ="display:<?php if( $list_flag == 0){ echo "block"; }  else{ echo "none"; }?>;">
           <h4>Employee Applied Appraisal</h4>
           
            <table class="table" style="overflow:scroll;">
              <thead>
                <tr>
                  <th>EMP NAME</th>
                  <th>PART I,II,III</th>
                  <th>PART IV</th>
                  <th style = "width:60px;"> SPECIAL WEIGHT</th>
                  <th>TOTAL</th>
                  <th>GRADE</th>       
                  <th>Remark</th>
                  <th>Action</th>              
                </tr>
              </thead>
              <?php
  while ($row = mysqli_fetch_array($result))
     {
          $_SESSION['EMP_NO'] = $row['EMP_NO'];
          $_SESSION['FORM_ID'] = $row['FORM_ID'];          
          $_SESSION['applied_on'] = $row['APPLIED_ON'];
          
  ?>
   <tbody>
                <tr>
               
                <form  class="form-horizontal" method="POST" action="#" >
                  <td><?php echo $row['F_NAME']; echo "   "; echo $row['L_NAME']; ?></td>
                  <td><input type="text" class="form-control1" style="width:80px;" name="tt" id ="tt"  value="<?php echo $row['tt']; ?>" readonly></td>
                  <td><input type="text" class="form-control1" style="width:55px;" name="fmcq" id ="fmcq"  value="<?php echo $row['fmcq']; ?>" readonly></td>


                  <td><input type="text" class="form-control1" style="height:40px;width:60px;" placeholder="" name="sw" id ="sw" value="<?php echo $row['sw']; ?>" readonly ></td>
                 <td><input type="text" class="form-control1" style="height:40px;width:50px;" placeholder="" name="total" id="total" value="<?php echo $row['total']; ?>" readonly></td>
                  <td><input type="text" class="form-control1" style="height:40px;width:150px;" placeholder="" name="grade" id="grade" value="<?php echo $row['grade']; ?>" readonly></td>

                  
                 
                 

                  
                  <td><textarea rows="1" style="height:40px;" placeholder="type remark ... " name="prn_remark" ></textarea></td>
                  <td>
                  <?php 
                 
                                 
                    echo "<a href='f1_pr.php?id=" . $row['FORM_ID'] . "'>view</a>";                       
                  
                  ?>
                   <button type="submit" id="button" class="col-sm-2 btn btn-info" name="approved" value="<?php echo $row['FORM_ID'] ?>"
                   style="background:#5cb85c;color: black;width: 35%; text-align: center;color:#FFFFFF;"
                   onclick=" return confirm('Are you sure you want to submit this form?');">Approve</button><span>  </span>
                  <button type="submit" id="button" class="col-sm-2 btn btn-info" name="rejected" value="<?php echo $row['FORM_ID'] ?>" 
                  style="background: #fd5c63;color: black;width: 35%; margin-left: 10px; text-align: center; margin-right: 10px;color:#FFFFFF; "
                  onclick=" return confirm('Are you sure you want to submit this form?');">Review</button></td>
                  </form>
                 
                </tr>
                </tbody>

      
<?php
}
}

ob_flush();?>

</table>
</div>
<div class="filter_data">
  
</div>

</div>
</div>
</div>
</div>

</body>
</html>
