<?php 
ob_start(); 
include "header1.php";

$sql = "SELECT F_NAME,M_NAME,L_NAME,EMP_NO,EMP_TYPE,pic,mt_emp.DEPT_ID,mt_grade_mst.DESIGNATION,mt_dept_mst.dept_nm 
		FROM mt_emp  INNER JOIN mt_grade_mst 
		ON mt_emp.GRADE_ID = mt_grade_mst.GRADE_ID  
		INNER JOIN mt_dept_mst ON mt_emp.dept_id = mt_dept_mst.dept_id   WHERE Emp_no = '" . $_SESSION['Emp_no'] . "'";
$result = mysqli_query($conn , $sql)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row = mysqli_fetch_array($result))
		 {
			
		 		$firstname = $row['F_NAME'];
		 		$middlename = $row['M_NAME'];
		 		$lastname = $row['L_NAME'];
		 		$emp_no  = $row['EMP_NO'];
		 		$designation = $row['DESIGNATION'];
		 		$department1 = $row['dept_nm'];
		 		$emp_type = $row['EMP_TYPE'];
				$profile = $row['pic'];
				$dept_id = $row['DEPT_ID'];
		}
}


$FORM_ID="";
if(isset($_GET['id']))
{
$FORM_ID = $_GET['id'];  
echo $FORM_ID;
}

if($_SERVER['REQUEST_METHOD'] == "POST")
{
  if (isset($_POST['delete']))
{
    //$remark = $_POST['hod_remark'];
    $l_id = $_POST['delete'];

    $date = date("Y-m-d");

$sql1 = "SELECT * FROM mt_appraisal WHERE  FORM_ID = '$l_id'  ";
$result = mysqli_query($conn , $sql1)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
		while ($row1 = mysqli_fetch_array($result))
		 {
       
		 		$hod_app = $row1['HOD_APPROVED'];
		 		$pr_app = $row1['PRINCIPAL_APPROVED'];
		 		$cancel_flag = $row1['Cancel_Flg'];
		 	
}
}

    if((  $hod_app =="Pending"  ) &&  ( $pr_app =="Pending"  )  &&  ( $cancel_flag!="YES"  ))
    {
    $query = "UPDATE mt_appraisal SET HOD_APPROVED = 'Cancelled',PRINCIPAL_APPROVED = 'Cancelled',Cancel_Flg  = 'YES'
                     WHERE FORM_ID = '$l_id' ";
    $res = mysqli_query($conn , $query);
    if($res)
    {
              echo "<script type='text/javascript'>  window.onload = function(){alert(\"Appplication is cancelled\");}</script>";
              
    }  
    else
    {
      echo "something went wrong please refresh page";
    }}
    else {
     
      echo "<script type='text/javascript'>  window.onload = function(){alert(\"sorry action has already be done on this leave\");}</script>";
    	
    }
}
}


?>

<?php

$query = "SELECT * FROM mt_appraisal where 
            EMP_NO  ='$emp_no'";

$result = mysqli_query($conn , $query)or die( mysqli_error($conn));
if (mysqli_num_rows($result) > 0) 
{
	
?>


<!DOCTYPE html>
<html>
<head>
	<title></title>
  <style type="text/css">
    
  </style>
</head>
<body>
  <div id="page-wrapper">
      <div class="main-page">
        <div class="tables">
          
          <div class="panel-body widget-shadow">
           <h4>Employee Applied leave</h4>
            <table class="table">
            <?php if($role == "employee"){ ?>
              <thead >
                <tr>
                  <th>FORM ID </th>
                  <th>DATE</th>
                  <th>HOD REMARKS</th>
                  <th>HOD APPROVAL STATUS</th>
                  <th>PRINCIPAL REMARKS</th>
                  <th>PRINCIPAL APPROVAL STATUS</th>
                  <th>Action</th>    

                </tr>
              </thead>
            <?php } ?>
            <?php if($role == "hod"){ ?>
              <thead >
                <tr>
                  <th>FORM ID </th>
                  <th>DATE</th>
                  <th>PRINCIPAL REMARKS</th>
                  <th>PRINCIPAL APPROVAL STATUS</th>
                  <th>Action</th>    

                </tr>
              </thead>
            <?php } ?>
             
  
  <?php
  while ($row = mysqli_fetch_array($result))
     {
          $_SESSION['EMP_NO'] = $row['EMP_NO'];
          
          $_SESSION['applied_on'] = $row['APPLIED_ON'];


  ?>
   <?php if($role == "employee"){  ?>
   <tbody>
                <tr>
               
                <form method="POST" onsubmit=" confirm('Are you sure you want to delete this applied form?');" >
                 
                  <td><?php echo $row['FORM_ID']; ?></td>
                  <td><?php echo $row['APPLIED_ON']; ?></td>               
                  <td><?php echo $row['HOD_REMARKS']; ?></td>
                  <td><?php echo $row['HOD_APPROVED']; ?></td>
                  <td><?php echo $row['PRINCIPAL_REMARKS']; ?></td>
                  <td><?php echo $row['PRINCIPAL_APPROVED']; 
                  if (($row['HOD_APPROVED'] == "Pending") && ($row['PRINCIPAL_APPROVED'] == "Pending")  )
                  {
                  
                    $showDivFlag=true;  $update_flag = false;
                  
                  }
                  elseif  (($row['HOD_APPROVED'] == "Review") || ($row['PRINCIPAL_APPROVED'] == "Review")  ){
                    $showDivFlag=false;   $update_flag = TRUE;
                  }
                  else { $showDivFlag=false;   $update_flag = false;}
                  ?></td>
                  <td>
                  
                  <button type="submit" id="button"  class=" btn btn-info" name="delete" value="<?php echo $row['FORM_ID'] ?>"
                   style="background: orange;color: white; text-align: center;display:<?php if($showDivFlag == TRUE)  {  echo "block";  }  else{ echo "none";  } ?>">
                   Delete</button>

                   <?php if ( $update_flag == TRUE){
                                 echo "<a href='f1_update.php?id=" . $row['FORM_ID'] . "'>Update</a>";                       
                           }
                               ?>

                   </td>
                   </form>
                </tr>
    </tbody>
    <?php   }    ?>
    <?php if($role == "hod"){  ?>
   <tbody>
                <tr>
               
                <form method="POST" onsubmit=" confirm('Are you sure you want to delete this applied form?');" >
                 
                  <td><?php echo $row['FORM_ID']; ?></td>
                  <td><?php echo $row['APPLIED_ON']; ?></td>               
                  
                  <td><?php echo $row['PRINCIPAL_REMARKS']; ?></td>
                  <td><?php echo $row['PRINCIPAL_APPROVED']; 
                  if (($row['PRINCIPAL_APPROVED'] == "Pending")  )
                  {                 
                    $showDivFlag=true;    $update_flag = false;                 
                  }
                  elseif (($row['PRINCIPAL_APPROVED'] == "Review")  ){
                    $showDivFlag=false;   $update_flag = TRUE;
                  }
                  else { $showDivFlag=false;   $update_flag = false;}

                  ?></td>
                  <td>
                  
                  <button type="submit" id="button"  class=" btn btn-info" name="delete" value="<?php echo $row['FORM_ID'] ?>"
                   style="background: orange;color: white; text-align: center;display:<?php if($showDivFlag == TRUE)  {  echo "block";  }  else{ echo "none";  } ?>">
                   Delete</button>
                   
                    <?php if ( $update_flag == TRUE){
                                 echo "<a href='f1_update.php?id=" . $row['FORM_ID'] . "'>Update</a>";                       
                           }
                               ?>

                   </td>
                   </form>
                </tr>
    </tbody>
    <?php   }    ?>
    <?php
}
}

?>
  
</table>
</div>
</div>
</div>
</div>
 

</body>
</html>
