<?php
	require_once "header1.php";
	$error = '';
	$list_flag = 0;
?>

<!DOCTYPE html>
<html>
	<head>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.bundle.min.js"></script>
		<title> Faculty appraisal</title>

		<style type="text/css">			
			.body {
				height:100%;
				
			}
			.container {
				color: #E8E9EB;
				background: #222;
				border: #555652 1px solid;
				padding: 10px;
				height: 600px;
				width:500px;
			}
		</style>
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
						<form method="POST" class="form-horizontal">
							<div class="form-grids " data-example-id="basic-forms"> 	
							<div class="form-group">

								<div class="col-sm-2">
									<input type="text" id='autocomplete1'  name="atd_empname" class="form-control1" placeholder="Employee Name" >
								</div>
								<div  class="col-sm-2" style="width:12%;">
								<input type="text" id='selectuser_id1' name="atd_emp_no" class="form-control1" placeholder="Employee No" readonly/> 
								</div>
								<!--							
								<div class="col-sm-2" style="width:11%;"><input type="date" name="pick_date" id="pick_date" class=" form-control1" placeholder="start date" ></div>
								<div class="col-sm-2" style="width:11%;"><input type="date" name="drop_date" id="drop_date" class=" form-control1" placeholder="end date" ></div> -->
								
								
								<div class="col-sm-1"><input type="submit" style="background: #5bc0de;color: white; text-align: center;" class=" btn btn-info"
								name="search" value="search record"></div>
							</div>
							</div>
							</form> 

							 
							<?php


							if(isset($_POST['search']))
							{
							
							$chk_emp_no = $_POST['atd_emp_no'];
							$chk_empname = $_POST['atd_empname'];
							$list_flag = 0;
							$error = '';
							// if flag set execute these 
										// this code is usd to check all data if user enters employee name
										
					
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
									}
									}
					
							// compare role, department and set flag
							if($chk_role == "principal" || $chk_role == "admin" )
								{
								$list_flag = 2; $error = "Sorry, you are not allowed to search for this person !";
								}
							if(($role == 'hod' || $role == 'employee') && $chk_role == 'hod')
							{
								$list_flag = 2; $error = "Sorry, you are not allowed to search for this person !";
							}
							elseif($role !='principal')
							{ 
							  if($chk_dept_id != $dept_id) 
							  {
								$list_flag = 1; $error = "Sorry, you can search for employees under your department only !" ;
							  
							  }
							}
																				
							// write all quries
							// convert all csv files nn data base
							$data1 = 3;
							$data2 = 5;

							$data3 = 4;
							$data4 = 6;

							$data5 = 7;
							$data6 = 8;

							$data7 = 2;
							$data8 = 3;
							
							$data9 = 8;
							$data10 = 10;

							$data11= 4;
							$data12= 9;

							$data13= 8;
							$data14= 8;

							$data15= 4;
							$data16= 8;

							$data17= 8;
							$data18= 9;

							$data19= 9;
							$data20= 7;
							
							/*
							$sql = "SELECT * FROM mt_emp WHERE EMP_NO like '$chk_emp_no'";
							$result = mysqli_query($conn , $sql)or die( mysqli_error($conn));
							//loop through the returned data
							while ($row = mysqli_fetch_array($result)) {

								$data1 = $data1 . '"'. $row['Education'].'",';
								$data2 = $data2 . '"'. $row['JobLevel'] .'",';

								$data3 = $data3 . '"'. $row['StandardHours'].'",';
								$data4 = $data4 . '"'. $row['PercentSalaryHike'] .'",';

								$data5 = $data5 . '"'. $row['YearsAtCompany'].'",';
								$data6 = $data6 . '"'. $row['JobSatisfaction'] .'",';

								$data7 = $data7 . '"'. $row['YearsWithCurrManager'].'",';
								$data8 = $data8 . '"'. $row['WorkLifeBalance'] .'",';

								$data9 = $data9 . '"'. $row['TotalWorkingYears'].'",';
								$data10 = $data10 . '"'. $row['JobInvolvement'] .'",';

								$data11 = $data11. '"'. $row['YearsAtCompany'].'",';
								$data12= $data12. '"'. $row['YearsSinceLastPromotion'] .'",';
								
								$data13= $data13. '"'. $row['TrainingTimesLastYear'].'",';
								$data14= $data14. '"'. $row['PerformanceRating'] .'",';

								$data15= $data15. '"'. $row['PerformanceRating'].'",';
								$data16= $data16. '"'. $row['PercentSalaryHike'] .'",';

								$data17= $data17. '"'. $row['PerformanceRating'].'",';
								$data18= $data18. '"'. $row['MonthlyIncome'] .'",';

								$data19= $data19. '"'. $row['JobInvolvement'].'",';
								$data20= $data20. '"'. $row['PercentSalaryHike'] .'",';
							}	
							$data1 = trim($data1,",");
							$data2 = trim($data2,",");

							$data3 = trim($data3,",");
							$data4 = trim($data4,",");	

							$data5 = trim($data5,",");
							$data6 = trim($data6,",");

							$data7 = trim($data7,",");
							$data8 = trim($data8,",");

							$data9 = trim($data9,",");
							$data10 = trim($data10,",");

							$data11= trim($data11,",");
							$data12= trim($data12,",");

							$data13= trim($data13,",");
							$data14= trim($data14,",");
							
							$data15= trim($data15,",");
							$data16= trim($data16,",");

							$data17= trim($data17,",");
							$data18= trim($data18,",");

							$data19= trim($data19,",");
							$data20= trim($data20,",");
*/
							$res = exec("python ml.py $chk_emp_no");
							$result_array = json_decode($res);
							
						}
					
						?>
						<!--Pf Rating Meter-->
						<div style="margin-left: 500px;display:<?php if( $list_flag == 0  ){ echo "block"; }  else{ echo "none"; }?>;">
							<div class="gauge" style=" width: 100%; max-width: 250px;  font-size: 32px; color: #004033;  font-family: Roboto, sans-serif;">
								<div class="gauge__body" style="width: 100%;height: 0; padding-bottom: 50%;  background: #b4c0be;  position: relative;border-top-left-radius: 100% 200%;border-top-right-radius: 100% 200%;  overflow: hidden;">
									<div class="gauge__fill" style="  position: absolute;  top: 100%; left: 0;  width: inherit;  height: 100%;  background: #009578;  transform-origin: center top;  transform: rotate(0.25turn);  transition: transform 0.2s ease-out;"></div>
									<div class="gauge__cover" style=" width: 75%;  height: 150%;  background: #ffffff;  border-radius: 50%;  position: absolute;  top: 25%;  left: 50%;  transform: translateX(-50%);  /* Text */  display: flex;  align-items: center;  justify-content: center;  padding-bottom: 25%;  box-sizing: border-box;">
								
								</div>
								</div>
							</div>
						</div>
						<script>
							const gaugeElement = document.querySelector(".gauge");

								function setGaugeValue(gauge, value) {
								if (value < 0 || value > 1) {
									return;
								}
									// used to ratotae speed ddial
								gauge.querySelector(".gauge__fill").style.transform = `rotate(${
									value / 2
								}turn)`;
								// used to set value
								gauge.querySelector(".gauge__cover").textContent = `${
									value * 100
								}%`;
								}

								setGaugeValue(gaugeElement, 0.25*<?php echo intval($result_array);?>);
						</script>		
							<div class="alert alert-warning" role="alert" style ="display:<?php if( $list_flag != 0  ){ echo "block"; }  else{ echo "none"; }?>;">
									<?php echo "$error" ;?>
							</div>

							<div style ="display:<?php if( $list_flag == 0  ){ echo "block"; }  else{ echo "none"; }?>;">
									<div class="hight-chat charts">
										<div class="col-md-6 w3ls-high charts-grids">
											<div class="hightchat-grid">
												<h4 class="title">Education Vs JobLevel</h4>
												<div>
													<canvas id="chart1"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-6 agileits-high charts-grids"> 
											<div class="hightchat-grid1">  
												<h4 class="title">Standard Hours Vs Percent Salary Hike</h4>
												<div>
													<canvas id="chart2"></canvas>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>

									<div class="hight-chat charts">
										<div class="col-md-6 w3ls-high charts-grids">
											<div class="hightchat-grid">
												<h4 class="title">Years At Company</h4>
												<div>
													<canvas id="chart3"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-6 agileits-high charts-grids"> 
											<div class="hightchat-grid1">  
												<h4 class="title">Years With Current Manager Vs WorkLife balance</h4>
												<div>
													<canvas id="chart4"></canvas>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="hight-chat charts">
										<div class="col-md-6 w3ls-high charts-grids">
											<div class="hightchat-grid">
												<h4 class="title">Toatal Working Hours Vs Job Involvement</h4>
												<div>
													<canvas id="chart5"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-6 agileits-high charts-grids"> 
											<div class="hightchat-grid1">  
												<h4 class="title">Yeasrs At Company Vs Years Since Last Promotion</h4>
												<div>
													<canvas id="chart6"></canvas>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="hight-chat charts">
										<div class="col-md-6 w3ls-high charts-grids">
											<div class="hightchat-grid">
												<h4 class="title">Overall Assesment</h4>
												<div>
													<canvas id="chart7"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-6 agileits-high charts-grids"> 
											<div class="hightchat-grid1">  
												<h4 class="title">Performance Rating Vs Percent Salary Hike</h4>
												<div>
													<canvas id="chart8"></canvas>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
									<div class="hight-chat charts">
										<div class="col-md-6 w3ls-high charts-grids">
											<div class="hightchat-grid">
												<h4 class="title">Work Life Balance Vs Job Satisfaction</h4>
												<div>
													<canvas id="chart9"></canvas>
												</div>
											</div>
										</div>
										<div class="col-md-6 agileits-high charts-grids"> 
											<div class="hightchat-grid1">  
												<h4 class="title">Job Involvement Vs Percent Salary Hike</h4>
												<div>
													<canvas id="chart10"></canvas>
												</div>
											</div>
										</div>
										<div class="clearfix"></div>
									</div>
								</div>
							<script>

						    	


								var ctx1 = document.getElementById("chart1").getContext('2d');
								var myChart = new Chart(ctx1, {
								type: 'horizontalBar',
								data: {
									
									datasets: 
									[{
										label: 'Education',
										data: [<?php echo $data1; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'JobLevel',
										data: [<?php echo $data2; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});

							var ctx2 = document.getElementById("chart2").getContext('2d');
								var myChart = new Chart(ctx2, {
								type: 'bar',
								data: {
									//labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'StandardHours',
										data: [<?php echo $data3; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'PercentSalaryHike',
										data: [<?php echo $data4; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});


							var ctx3 = document.getElementById("chart3").getContext('2d');
								var myChart = new Chart(ctx3, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'YearsAtCompany',
										data: [<?php echo $data5; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'JobSatisfaction',
										data: [<?php echo $data6; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});


							var ctx4 = document.getElementById("chart4").getContext('2d');
								var myChart = new Chart(ctx4, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'YearsAtCompany',
										data: [<?php echo $data7; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'WorkLifeBalance',
										data: [<?php echo $data8; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});


							var ctx5 = document.getElementById("chart5").getContext('2d');
								var myChart = new Chart(ctx5, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'TotalWorkingYears ',
										data: [<?php echo $data9; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'JobInvolvement',
										data: [<?php echo $data10; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});

							var ctx6 = document.getElementById("chart6").getContext('2d');
								var myChart = new Chart(ctx6, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'YearsAtCompany',
										data: [<?php echo $data11; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'YearsSinceLastPromotion',
										data: [<?php echo $data12; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});

								var ctx7 = document.getElementById("chart7").getContext('2d');
								var myChart = new Chart(ctx7, {
								type: 'radar',
								data: {
										labels: ['job involvent', 'job satisfaction' , 'work life balance', 'enviroment satifaction','years at company'],
										datasets: 
										[{

											data: [20, 10, 4, 2, 3],
											backgroundColor: 'transparent',
											borderColor:'rgba(255,99,132)',
											borderWidth: 3
										}]
									},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});
								

							var ctx8 = document.getElementById("chart8").getContext('2d');
								var myChart = new Chart(ctx8, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'PerformanceRating',
										data: [<?php echo $data15; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'PercentSalaryHike',
										data: [<?php echo $data16; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});

							var ctx9 = document.getElementById("chart9").getContext('2d');
								var myChart = new Chart(ctx9, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'WorkLifeBalance',
										data: [<?php echo $data17; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'JobSatisfaction',
										data: [<?php echo $data18; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});


							var ctx10 = document.getElementById("chart10").getContext('2d');
								var myChart = new Chart(ctx10, {
								type: 'bar',
								data: {
								//	labels: [1,2,3,4,5,6,7,8,9],
									datasets: 
									[{
										label: 'JobInvolvement',
										data: [<?php echo $data19; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(255,99,132)',
										borderWidth: 3
									},

									{
										label: 'PercentSalaryHike',
										data: [<?php echo $data20; ?>],
										backgroundColor: 'transparent',
										borderColor:'rgba(0,255,255)',
										borderWidth: 3	
									}]
								},
							
								options: {responsive: true,scales: { xAxes: [{ maxBarThickness: 85,ticks: {beginAtZero: true} }],yAxes: [{ticks: {beginAtZero: true}}]}}});

							</script>
			
		</div>
						
	</body>
</html>