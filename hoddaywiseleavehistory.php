<?php
session_start();
error_reporting(0);
include('includes/config.php');

 ?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
		<title>Employee | Leave History</title>
		<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
		<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
		<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
	<style>
		.errorWrap {
		padding: 10px;
		margin: 0 0 20px 0;
		background: #fff;
		border-left: 4px solid #dd3d36;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
		.succWrap{
		padding: 10px;
		margin: 0 0 20px 0;
		background: #fff;
		border-left: 4px solid #5cb85c;
		-webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
		}
	</style>
		<script>
		function myFunction() {
  var x = document.getElementById("display_data");
  var month=document.getElementById("fromdate").value;
  location.replace('hoddaywisevar.php?month='+month);
}
</script>
    </head>
    <body bgcolor="lightblue">
	    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('hodheader.php');
		?>
     </header><!-- #header -->
     
	 <div class="container">
                    
	<div class="card-content">
	<h2 style="font-family:Georgia;color:#000000;" align="center">Employees Day Wise Leaves History</h2>

	<label for="fromdate" style="font-family:Georgia;color:#2F4F4F;font-size:20px">Select Date</label>
    	<input required type="date" class="form-control" style="width:200px;align:center;" name="fromdate" id="fromdate" title="Choose your desired date" onchange="myFunction()"/>
		<br> 				   
		<?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
		<?php 
			$selectdate=$_SESSION['selectdate'];
			if($selectdate==NULL)
				$selectdate=date("Y-m-d");
			echo '<center><b style="font-family:Georgia;color:#2F4F4F;font-size:25px"> Employees on leave on  '.$selectdate.' </b></center>';
		?>
		<table align="center" id="example" class="table table-striped table-responsive table-bordered" border="1" cellspacing="0" style="table-layout: auto;width: 100%;">
			<thead>
				<tr>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EMPID</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EMPLOYEE NAME</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DEPARTMENT</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LEAVE TYPE</th>
					 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">CLASS ADJUSTMENT</th>
				</tr>
			</thead>
			<tbody>
			
			<?php 
			$sql = "SELECT e.EmpId as emp, FirstName,LastName, e.Department as dep,l.Description as ld,l.Reason as rs, t.Description as td from tblemployees e, tblleavetype t, tblleaves l WHERE e.id=l.empid and t.LeaveType=l.LeaveType and l.status=1 and FromDate<='".$selectdate."' and ToDate>='".$selectdate."' group by l.empid order by e.Department";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':eid',$eid,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{               ?>  
						<tr>
							<td style="font: small-caps 15px/30px Georgia, serif;" align="center"> <?php echo htmlentities($cnt);?></td>
							<td style="font: small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($result->emp);?></td>
							<td style="font: small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities(strtoupper($result->FirstName." ".$result->LastName)); ?></td>
							<td style="font: small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($result->dep);?></td>
							<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->td);?></td>
							<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->ld);?></td>
						</tr>
						 <?php $cnt=$cnt+1;} }?>
					</tbody>
				</table>
			</div>
		</div>
		 
	<style>
		th {
		  font-size: 20px;
		  cursor: pointer;
		  background-color: coral;
		}
	</style>
   <!-- Footer -->
	<?php
	require_once('footer.php');
	?>
       

    </body>
</html>
<?php   ?>