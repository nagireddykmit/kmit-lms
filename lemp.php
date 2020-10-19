<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<html>
<head>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.2.1.js"></script>
  
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/ui-lightness/jquery-ui.css">

<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js" integrity="sha256-T0Vest3yCU7pafRw9r+settMBX6JkKN06dqBnpQ8d30=" crossorigin="anonymous"></script>
<script type="text/javascript">
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
</head>
<body>
<form>
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
		</select>
   </select></div>
   <br>
   <br>
<div class="input-field col s12">
<label class="control-label col-sm-2" for="employees">Faculty Name</label>
<select class="form-control" id="employees" name="employees">
		        <option selected="" disabled="">Faculty Name</option>           	
		     </select>
</div>
</form>
</body>
</html>