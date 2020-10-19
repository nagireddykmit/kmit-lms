<?php 
session_start();
error_reporting(0);
include('includes/config.php');
?>
<!DOCTYPE html>	
<html>
<head> 
<title>Employee Leaves Information</title>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
</head>
<body>
	    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('adminheader.php');
		?>
     </header><!-- #header -->
	
	<style>
  .container {
    padding: 40px 40px;
  }
  th,td{
	  text-align:center;
  }
</style>
<div class="container">
<div class="container-fluid">
	<h2 style="font-family:Georgia;color:#000000;" align="center">EMPLOYEE LEAVES INFORMATION</h2>
	<font size=3.5 face="">
<table class="table table-striped table-responsive table-bordered" cellspacing="0" style="table-layout: auto;width: 100%;" >
<tbody>
<tr>
<td colspan="10" style="background-color:coral;">
<h5 style="font-family:verdana;"><b>Employee Name:
<?php
$empid=$_GET['empid'];
$sql = "SELECT * from tblemployees where empid=:empid";
$query = $dbh->prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                           
 <?php echo strtoupper($result->FirstName." ".$result->LastName); ?>
<?php }} ?></b></h5>
</td>
</tr>
<tr>
<th style="font-family:Georgia;">MONTH</th>
<th style="font-family:Georgia;">CL</th>			
<th style="font-family:Georgia;">CCL</th>
<th style="font-family:Georgia;">OD</th>
<th style="font-family:Georgia;">AL</th>
<th style="font-family:Georgia;">TOTAL LEAVES</th>
<th style="font-family:Georgia;">NO OF LATES</th>
<th style="font-family:Georgia;">AVAILED LEAVES</th>
<th style="font-family:Georgia;">REMAINING LEAVES</th>
<th style="font-family:Georgia;">LOP</th>
</tr>
<tr style="font-family:Georgia;">
<td style="font-weight:bold;">JAN</td>
<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from january where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">FEB</td>

<td><!--cl--><?php
$empid=$_GET['empid'];
$sql = "SELECT * from february where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">MAR</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from march where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">APR</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from april where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">MAY</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from may where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">JUN</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from june where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">JUL</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from july where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">AUG</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from august where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">SEP</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from september where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">OCT</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from october where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold;">NOV</td>

<td><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from november where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>

<?php }} ?>
</tr>
<tr style="font-family:Georgia;">
  
<td style="font-weight:bold">DEC</td>

<td ><!--cl--><?php
session_start();
error_reporting(0);
include('includes/config.php');	
$empid=$_GET['empid'];
$sql = "SELECT * from december where empid=:empid";
$query = $dbh -> prepare($sql);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               
?>
<?php if($result->cl<0)
      echo 0.0;
  else 
	echo htmlentities($result->cl) ?></td>
<!--ccl-->
<td><?php echo htmlentities($result->ccl)?></td>
<!--od-->
<td><?php echo htmlentities($result->od)?></td>
<!--al-->
<td><?php echo htmlentities($result->al)?></td>
<!--total-->
<td><?php echo ($tot=$result->icl+$result->iccl)?></td>
<!-- no of lates-->
<td> <?php echo htmlentities($result->lates)?></td>
<!--avail-->
<td><?php echo htmlentities($result->avail)?></td>
<!--remaining-->
<td><?php 
      $remain=($tot-($result->avail));
	  if(($remain)<0)
      echo 0;
  
  else
	echo ($remain);
	  ?>
</td>
<!--lop-->
<td><?php 
		if(($remain)>=0)
		{
			if($result->lates>2)
		  echo $result->lop+intval($result->lates/3)*0.5;
		  else
		  echo $result->lop;
		}
  
  else if(($remain)<0)
  {
    if($result->lates>2)
    echo abs($remain)+$result->lop+intval($result->lates/3)*0.5;
    else
    echo abs($remain)+$result->lop;
  }
?>
</td>
<?php }} ?>
</tr>
</tbody>
</table>
</div>
<pre><h4 style="font-family:Georgia;">CL:CASUAL LEAVE   	 CCL:COMPENSATORY LEAVE 		 OD:ON DUTY LEAVE 		AL:ACADEMIC LEAVE</h4></pre>
<style>
th {
	  font-size: 15px;
	  cursor: pointer;
	  background-color:#c0ded9;
}
</style>
</body>
</html>