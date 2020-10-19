<?php
session_start();
error_reporting(0);
include('includes/config.php');
 ?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee CCL History</title>

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
    <body bgcolor="lightblue">
	    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('adminheader.php');
		?>
     </header><!-- #header -->
     
	 <div class="container">
                    
	<div class="card-content">
	<h2 style="font-family:Georgia;color:#000000;" align="center"> CCL  History</h2>
		<table align="center" id="example" class="table table-striped table-responsive table-bordered" border="1" cellspacing="0" style="table-layout: auto;width: 100%;">
			<thead>
				<tr>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EMPID</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EMPLOYEE NAME</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LEAVE TYPE</th>
					 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">MONTH</th>
					 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DATE</th>
					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">COUNT</th>
				</tr>
			</thead>
			<tbody>
			<?php 
			$sql = "SELECT sno,eid,leavetype,monthname,ccldate,cclcount,employees from adminaddcclleavecount order by ccldate desc";
			$query = $dbh -> prepare($sql);
			$query->bindParam(':eid',$eid,PDO::PARAM_STR);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
			foreach($results as $result)
			{               ?>   
					<tr class="item">
						<td style="font: small-caps 15px/30px Georgia, serif;"> <?php echo htmlentities($cnt); ?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->eid); ?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->employees); ?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->leavetype); ?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->monthname);?></td>
					   <td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->ccldate);?></td>
						<td style="font: small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->cclcount);?></td>
					</tr>
					  <?php $cnt=$cnt+1; } }?>
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