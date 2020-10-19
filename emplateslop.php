<?php
session_start();
error_reporting(0);
include('includes/config.php');
 ?>
 
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee Lates & LOP History</title>
 <meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta content="" name="keywords">
  <meta content="" name="description">
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
.floatLeft { width: 48%; float: left; }
.floatRight {width: 48%; float: right; }
.container { overflow: hidden; }
th {
  cursor: pointer;
  background-color: coral;
}
		</style>
    </head>
    <body>
       <!--==========================
  Header
  ============================-->
    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('empheader.php');
		?>
     </header><!-- #header -->
	  
<div class="container">
                            <div class="card-content">
                               <center> <h3 style="font-family:Georgia;"> Late's & LOP added by Admin

							   </h3></center></div>
                    <div class="floatLeft">
								<center> <h3 style="font-family:Georgia;"> Employee Lates Information </h3> <center>
                                <table id="example1" class="table table-striped table-responsive table-bordered" border="1">
                                    <thead>
                                        <tr>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
                        					<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">MONTH NAME</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DATE</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">NO OF LATES</th>
                                             <!--<th>LOP</th>-->
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 

$eid = $_SESSION['empid'];

//echo "<p> Employee ID IS ".$_SESSION['emplogin']."</p>";
$sql = "SELECT sno,empid,empname,lates,monthname,dates from addlates where empid=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_INT);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>   
                                        <tr>    
                                            <td> <?php echo htmlentities($cnt);?></td>
                                            <td><?php echo htmlentities($result->monthname);?></td>
											 <td><?php echo htmlentities($result->dates);?></td>
											 <td><?php echo htmlentities($result->lates);?></td>
                                        </tr>
                                          <?php $cnt=$cnt+1;} }?>
                                    </tbody>
                                </table>
                        </div>
                        <div class="floatRight">
						<center> <h3 style="font-family:Georgia;"> Employee LOP Information</h3> <center>
                                <table  id="example1" class="table table-striped table-responsive table-bordered" style="table-layout: auto;width: 100%;" border="1">
                                    <thead>
                                        <tr>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
                                  
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LOP</th>
                                           
                                             <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">MONTH NAME</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">DATE</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">REMARKS</th>
                                        </tr>
                                    </thead>
                                 
                                    <tbody>
<?php 
//$eid=$_SESSION['eid'];
$sql = "SELECT * from addlop where emid=".$eid;
$query = $dbh -> prepare($sql);
//$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$data=$query->fetchAll(PDO::FETCH_OBJ);
$cn=1;
if($query->rowCount() > 0)
{
foreach($data as $record)
{               ?>   
                                        <tr>    
                                            <td> <?php echo htmlentities($cn);?></td>
                                            
                                            <td><?php echo htmlentities($record->lop);?></td>
                                             <td><?php echo htmlentities($record->monthname);?></td>
                                            <td><?php echo htmlentities($record->lopdate);?></td>
											<td><?php echo htmlentities($record->remarks);?></td>
                                 
                                        </tr>
                                          <?php $cn=$cn+1;} }?>
                                    </tbody>
                                </table>
                            </div>
							
                        </div>
         
        
        <!-- Footer -->
		<?php
		require_once('footer.php');
		?>
        
    </body>
</html>