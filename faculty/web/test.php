<?php
ob_start();
session_start();
if(!(isset($_SESSION['login_user'])))
{
	header("location: index.php");
}
if($_SESSION['login_user']!='admin')
{
	header("location: index.php");
}
include('dbconnect.php');
$reg_id=$_SESSION['login_user'];
$query = mysqli_query($con, "select * from admin where reg_id='$reg_id'");
$data = mysqli_fetch_assoc($query);
$uname=$data['uname'];



$out='';
$to='';
$st_mobile='';
$company='';
$i=1;
$stname='ganesh';
if($stname!=''|| $stname!=null){
	$sql=mysqli_query($con,"select * from student_details where stname like '%$stname%' order by division,r_number ASC");
	$count=mysqli_num_rows($sql);
	while ($s=mysqli_fetch_array($sql)) {
		$x='';
		$placed='';
		$company_id=$s['company_id'];
		$c=mysqli_fetch_array(mysqli_query($con,"select * from company where c_id='$company_id'"));
		$placed=$c['cname'];
		if($placed=="")
		    $placed='No';
		$reg_id=$s['reg_id'];
		$to.=''.$reg_id.';';
		$type=$s['type'];
		if($type=='hsc'){$x=mysqli_fetch_array(mysqli_query($con,"select * from hscmark where reg_id='$reg_id'"));$hscpercent=$x['hscpercentage'];}
								else{$x=mysqli_fetch_array(mysqli_query($con,"select * from dipmarks where reg_id='$reg_id'"));$hscpercent=$x['diplomapercentage'];}
								if($s['branch']=='elec')
										$branchd='Electronics Engineering';
									if($s['branch']=='comp')
										$branchd='Computer Engineering';
									if($s['branch']=='it')
										$branchd='Information Technology';
									if($s['branch']=='extc')
										$branchd='Electronics & Telecommunication Engineering';
									$out.='
								<tr>
									<td>'.$i.'</td>
						            <td><a href="viewstudent.php?id='.$reg_id.'">'.$reg_id.'</a></td>
						            <td>'.$s['stname'].'</td>
						            <td>'.$x['degreepointer'].'</td>
						            <td>'.$hscpercent.'</td>
						            <td>'.$x['sscpercentage'].'</td>
						            <td>'.$s['st_mobile'].'</td>
						            <td>'.$s['pemailid'].'</td>
									<td>'.$branchd.'</td>
									<td>'.$s['division'].'</td>
						            <td>'.$s['type'].'</td>
						            <td>'.$s['relocation'].'</td>
									<td>'.$s['bond'].'</td>
						            <td>'.$placed.'</td>
						        </tr>
								';
								$i++;
	}
}
else{
	$tt=0;
	$gt=0;
	$st_type='';
	$st_gender='';
	$ssc=0;
	$hsc=0;
	$degree0=0;
	$degree1=10;
	$sem3onward=0;
	$sem3onward1=10;
	$livekt=100;
	$isplaced='n';
	$isdefaulter='n';
	$passyear=2019;
	$diplomapercentage=0;
	$drops0=0;
    $drops1=10;
	$deadkt=100;
	$attempts=100;
	$priority='';
	$relocation='y';
	$bond='y';
	$branch='comp';
	$type='hsc';
	$gender='male';
	foreach ($type as $t) {
		$tt=$tt+1;
			if($tt==1){
				$st_type=$t;	
			}
			else{
				$tt=0;
			}
	}
	foreach ($gender as $g) {
		$gt=$gt+1;
		if($gt==1){
				$st_gender=$g;	
			}
			else{
				$gt=0;
			}		
	}
	foreach ($branch as $b) {
		$sq='';
		if($gt==1 && $tt==0)
		{
			if($priority!='')
			    $sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and priority='$priority' and gender='$st_gender' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'");
			else
    			$sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and gender='$st_gender' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'");
		}
		if($gt==0 && $tt==1)
		{
			if($priority!='')
			    $sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and priority='$priority' and type='$st_type' and branch='$b' and passyear='$passyear'  and defaulter='$isdefaulter'");
			else
    			$sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and type='$st_type' and branch='$b' and passyear='$passyear'  and defaulter='$isdefaulter'");
    	}
		if($gt==1 && $tt==1)
		{
			if($priority!='')
			    $sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and priority='$priority' and type='$st_type' and gender='$st_gender' and branch='$b' and passyear='$passyear'  and defaulter='$isdefaulter'");
			else
    			$sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and type='$st_type' and gender='$st_gender' and branch='$b' and passyear='$passyear'  and defaulter='$isdefaulter'");
    	}
		if($gt==0 && $tt==0)
		{
			if($priority!='')
			    $sq=mysqli_query($con,"select * from student_details where relocation='$relocation' and bond='$bond' and priority='$priority' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'");
			else
    		{	
			$sqlfront="select * from student_details where relocation='$relocation' and bond='$bond' and branch='$b' and passyear='$passyear' and defaulter='$isdefaulter'";
			$sq=mysqli_query($con,$sqlfront);
			}
		}
		$count=mysqli_num_rows($sq);
		if($count>0){

			while ($v=mysqli_fetch_array($sq)) {
				$reg_id=$v['reg_id'];
				$type=$v['type'];
				if($type=="hsc"){
					$sql=mysqli_query($con,"select * from hscmark where reg_id='$reg_id' and sscpercentage>='$ssc' and hscpercentage>='$hsc' and (degreepointer BETWEEN ".$degree0." AND ".$degree1.") and (drops BETWEEN ".$drops0." AND ".$drops1.") and livekt<='$livekt' and deadkt<='$deadkt' and attempts<='$attempts'   ");
				}
				if($type=="diploma"){
					$sql=mysqli_query($con,"select * from dipmarks where reg_id='$reg_id' and sscpercentage>='$ssc' and diplomapercentage>='$diplomapercentage' and (degreepointer BETWEEN ".$sem3onward." AND ".$sem3onward1.") and (drops BETWEEN ".$drops0." AND ".$drops1.") and livekt<='$livekt' and deadkt<='$deadkt' and attempts<='$attempts' ");
				}
				$co=mysqli_num_rows($sql);
				
				if($co==1){
					 if($isplaced!="b"){
					 	$sq1=mysqli_query($con,"select * from student_details where reg_id='$reg_id' and placed='$isplaced'");
					 	$c=mysqli_num_rows($sq1);
					 
					 	if($c==1){
					 		while ($s=mysqli_fetch_array($sq1)) {
									
								$reg_id=$s['reg_id'];
								$to.=''.$reg_id.';';
								$x='';
								$placed='';
								$company_id=$s['company_id'];
								$c=mysqli_fetch_array(mysqli_query($con,"select * from company where c_id='$company_id'"));
								$placed=$c['cname'];		
								if($placed=="")
		                            $placed='No';
								$type=$s['type'];
								$hscpercent='';
								if($type=='hsc'){$x=mysqli_fetch_array(mysqli_query($con,"select * from hscmark where reg_id='$reg_id'"));$hscpercent=$x['hscpercentage'];}
								else{$x=mysqli_fetch_array(mysqli_query($con,"select * from dipmarks where reg_id='$reg_id'"));$hscpercent=$x['diplomapercentage'];}
								if($s['branch']=='elec')
										$branchd='Electronics Engineering';
									if($s['branch']=='comp')
										$branchd='Computer Engineering';
									if($s['branch']=='it')
										$branchd='Information Technology';
									if($s['branch']=='extc')
										$branchd='Electronics & Telecommunication Engineering';
									$out.='
								<tr>
									<td>'.$i.'</td>
						            <td><a href="viewstudent.php?id='.$reg_id.'">'.$reg_id.'</a></td>
						            <td>'.$s['stname'].'</td>
						            <td>'.$x['degreepointer'].'</td>
						            <td>'.$hscpercent.'</td>
						            <td>'.$x['sscpercentage'].'</td>
						            <td>'.$s['st_mobile'].'</td>
						            <td>'.$s['emailid'].'</td>
						            <td>'.$branchd.'</td>
						            <td>'.$s['division'].'</td>
						            <td>'.$s['type'].'</td>
									<td>'.$s['relocation'].'</td>
									<td>'.$s['bond'].'</td>
						            <td>'.$placed.'</td>
						        </tr>
								';
								$i++;
							}
					 	}
					 	
					 }
					 else{
					 	$sq1=mysqli_query($con,"select * from student_details where reg_id='$reg_id'");
							$c=mysqli_num_rows($sq1);
						 	if($c==1){
						 		while ($s=mysqli_fetch_array($sq1)) {
									$reg_id=$s['reg_id'];
									$to.=''.$reg_id.';';
									$x='';
                                    $placed='';
                                    $company_id=$s['company_id'];
                                    $c=mysqli_fetch_array(mysqli_query($con,"select * from company where c_id='$company_id'"));
                                    $placed=$c['cname'];
		                            if($placed=="")
		                                $placed='No';
									$type=$s['type'];
									$hscpercent='';
									if($type=='hsc'){$x=mysqli_fetch_array(mysqli_query($con,"select * from hscmark where reg_id='$reg_id'"));$hscpercent=$x['hscpercentage'];}
									else{$x=mysqli_fetch_array(mysqli_query($con,"select * from dipmarks where reg_id='$reg_id'"));$hscpercent=$x['diplomapercentage'];}
									if($s['branch']=='elec')
										$branchd='Electronics Engineering';
									if($s['branch']=='comp')
										$branchd='Computer Engineering';
									if($s['branch']=='it')
										$branchd='Information Technology';
									if($s['branch']=='extc')
										$branchd='Electronics & Telecommunication Engineering';
									$out.='
									<tr>
									<td>'.$i.'</td>
							            <td><a href="viewstudent.php?id='.$reg_id.'">'.$reg_id.'</a></td>
							            <td>'.$s['stname'].'</td>
							            <td>'.$x['degreepointer'].'</td>
						           		<td>'.$hscpercent.'</td>
						           		<td>'.$x['sscpercentage'].'</td>
						           		<td>'.$x['livekt'].'</td>
						                <td>'.$s['emailid'].'</td>
										<td>'.$branchd.'</td>
							            <td>'.$s['division'].'</td>
							            <td>'.$s['relocation'].'</td>
										<td>'.$s['bond'].'</td>
										<td>'.$s['type'].'</td>
                                        <td>'.$placed.'</td>
							        </tr>
									';
									$i++;
								}
						 	}
					 }
					 
				}
			}
		}
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TechJunkGigs</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" 
integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u"
 crossorigin="anonymous">
    <link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
</head>
<body>
    <div class="container" style="margin-top: 20px">
	<h1>TechJunkGigs</h1>
	<hr></hr>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-striped">
                <thead>
                <tr>
                	<th>Sr No.</th>
                  	<th>Reg ID</th>
                	<th>Name</th>
                	<th>Degree Pointer</th>
                	<th>HSC / Diploma</th>
                	<th>SSC</th>
                	<th>Mobile</th>
                	<th>Email ID</th>
                	<th>Branch</th>
                	<th>Div</th>
                	<th>Type</th>
					<th>Relocate</th>
					<th>Bond</th>
                	<th>Placed</th>
                </tr>
                </thead>
                <tbody>
                <?php echo $out ?>
                </tbody>
                <tfoot>
                <tr>
                    <th>Sr No.</th>
                    <th>Reg ID</th>
                	<th>Name</th>
                	<th>Degree Pointer</th>
                	<th>HSC / Diploma</th>
                	<th>SSC</th>
                	<th>Mobile</th>
                	<th>Email ID</th>
                	<th>Branch</th>
                	<th>Div</th>
                	<th>Type</th>
                	<th>Relocate</th>
					<th>Bond</th>
                	<th>Placed</th>
                </tr>
                </tfoot>
             </table>
            </div>
        </div>
    </div>
    <script
            src="http://code.jquery.com/jquery-3.2.1.min.js"
            integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
            crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
	<script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>
	<script type="text/javascript">
        $(document).ready(function() {
            $(".table").DataTable({    
            });
        });
    </script>
</body>
</html>