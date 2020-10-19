<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta charset="utf-8">
  <title>ADMIN HOME PAGE</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
 <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
 
<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
  <!-- Favicons -->
 <link href="img/favicon.png" rel="icon">
  <link href="img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,700,700i|Poppins:300,400,500,700" rel="stylesheet">

<!-- Bootstrap CSS File -->
  <link href="lib/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  
  <!-- Libraries CSS Files -->
  <link href="lib/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
  <link href="lib/animate/animate.min.css" rel="stylesheet">

  <!-- Main Stylesheet File -->
  <link href="css/style.css" rel="stylesheet">
  
  <style>
  
  .errorWrap
		{
		color:red;
		padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		
		.successWrap
		{
			padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		color:green;
		}
		.look
{
	font-size:168%;
	color: white;
}

		</style>
</head>
<script>
$(document).ready(function(){
			$("#lempid").change(function(){
				var leid = $("#lempid").val();
				$.ajax({
					url: 'loademp.php',
					method: 'post',
					data: 'leid=' + leid
				}).done(function(employees){
					console.log(employees);
					employees = JSON.parse(employees);
					$('#employees').empty();
					employees.forEach(function(employee){
						$('#employees').append('<option>' + employee.FirstName +' '+ employee.LastName + '</option>')
					})
				})
			})
			})
</script>
<body>



<section id="addclleaves">
	  <div class="container wow fadeIn">
	  <div class="section-header">
<br> <div class="section-title">Add CL Leaves</div>
       <br>  
	  
	  </div>
	  </DIV>
	  
	 <form align="center" class="col s12" name="adminleaves" method="post"  action="adminaddleaves.php">
	   <?php if(isset($error1)){?> <div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php }
					
    else if(isset($_SESSION['msg1'])){?><div class="successWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>
		<br>
		
		<div class="input-field col s12"><label>Select EmpID</label>
				<select name='lempid' class="custom-select" id="lempid">
					<option selected="" disabled="">Select EmpID</option>
					<?php 
					require 'loademp.php';
					$lempid = loademployees();
					foreach ($lempid as $empid) {
					echo "<option id='".$empid[EmpId]."' value='".$empid[EmpId]."'>".$empid[EmpId]."</option>";
				}
			 ?>
   </select></div>
   <br>
<div class="form-group">
<label class="input-field col s12" for="employees">Faculty Name</label>
<div class="input-field col s12">
<select class="form-control" id="employees" name="employees">
		        <option selected="" disabled="">Faculty Name</option>           	
		     </select>
		
</div>
</div>
   <div>
   Leave type
<select  class="custom-select" name="leavetype" id="leavetype" onchange = "Showtext()" autocomplete="off">
	<option value="">Select leave type...</option>
		<?php 
		$sql = "SELECT  LeaveType from tblleavetype";
		$query = $dbh -> prepare($sql);
		$query->execute();
		$results=$query->fetchAll(PDO::FETCH_OBJ);
		$cnt=1;
		if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->LeaveType);?></option>
<?php }} ?>
</select>
	</div>
	<div>
    Month
<select  class="custom-select" name="month" id="month" onchange = "Showtext()" autocomplete="off">
	<option value="">Month</option> 
	<option value="january">January</option>
	<option value="february">February</option>
	<option value="march">March</option>
	<option value="april">April</option>
	<option value="may">May</option>
	<option value="june">June</option>
	<option value="july">July</option>
	<option value="august">August</option>
	<option value="september">September</option>
	<option value="october">October</option>
	<option value="november">November</option>
	<option value="december">December</option>
</select>
	</div>
	<div>
 Date
<input placeholder="" id="mask1" class="form-control" name="date" class="masked" type="date" data-inputmask="'alias': 'date'" required>
</div>
	<br>
	<div>
		Leave Count
	<input class="form-control" type="number" name="leavecount" min="1" max="10">
	</div>
	<br>
	<div class="input-field col s12">
	<button type="submit" name="addleaves" class="waves-effect waves-light btn indigo m-b-xs">ADD</button>
	<button type="reset" name="" class="waves-effect waves-light btn indigo m-b-xs">RESET</button>
	</div>
</form>
	 </section>
	  <!-- JavaScript Libraries -->
  <script src="lib/jquery/jquery.min.js"></script>
  <script src="lib/jquery/jquery-migrate.min.js"></script>
  <script src="lib/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="lib/easing/easing.min.js"></script>
  <script src="lib/wow/wow.min.js"></script>
  <script src="lib/waypoints/waypoints.min.js"></script>
  <script src="lib/counterup/counterup.min.js"></script>
  <script src="lib/superfish/hoverIntent.js"></script>
  <script src="lib/superfish/superfish.min.js"></script>

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Main Javascript File -->
  <script src="js/main.js"></script>
	 </body>
	 </html>