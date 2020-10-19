<?php
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>
<html>
<head> 
<title>View Employees</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
  <script src="https://www.w3schools.com/lib/w3.js"></script>
<link href="https://www.w3schools.com/w3css/4/w3.css" rel="stylesheet" />

</head>
<body>
<form name="report" method="post">
<table class="table table-striped table-responsive table-bordered">
<tr>
<td>
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
</td>
<td colspan="9">
<select  name="department" autocomplete="off">
<option value="">Department...</option>
<?php $sql = "SELECT DepartmentName from tbldepartments";
$query = $dbh -> prepare($sql);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->DepartmentName);?>"><?php echo htmlentities($result->DepartmentName);?></option>
<?php }} ?>
</select>
</td>

</tr>
<tr>
<td>Empid</td>
<td>Employee Name</td>
<td>cl</td>
<td>ccl</td>
<td>od</td>
<td>al</td>
<td>total</td>
<td>Availed</td>
<td>Remaining Leaves</td>
<td>LOP</td>
</tr>
</table>
</form>
</body>
</html>