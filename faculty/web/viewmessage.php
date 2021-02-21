<?php
session_start();
include'dbconnect.php';
$reg_id=$_SESSION['login_user'];
$mail_id=$_GET['id'];
$sql=mysqli_query($con,"select * from message where mail_id='$mail_id'");
$x=mysqli_fetch_assoc($sql);
$cout='';
$company=$x['company_id'];
if($company!="" || $company!=null){
	$cout='<a href="registerc.php?id='.$mail_id.'" target="_blank"><b><u>Click here</b></u></a> to register.';
}
else {
	$cout='';
}
$sql1=mysqli_query($con,"select * from attach where mail_id='$mail_id'");
$x1=mysqli_fetch_assoc($sql1);
$attach='';
$mail_id1=$x1['mail_id'];
$att=$x1['attach'];
if($att!=""|| $att!=null)
{
    $attach='<a href="'.$att.'" target="_blank"><b><u>Attachment</b></u></a>';
}
else{
$attach='';
}
?>
<div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><?php echo $x['subject'] ?></h4>
      </div>
      <div class="modal-body">
        <p><?php echo $x['message'] ?></p>
        <?php echo $cout ?>
          <?php echo $attach ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>