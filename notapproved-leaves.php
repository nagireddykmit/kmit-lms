<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['alogin'])==0)
    {   
header('location:index.php');
}
else{



 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <!-- Title -->
        <title>HOD | Approved Leaves </title>
                       <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
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
    </head>
    <body>
<header>
<!-- #nav-menu-container -->
		<?php
		require_once('hodheader.php');
		?>
     </header><!-- #header -->              

                    <div class="container">
					<h2 style="font-family:Georgia;color:#000000;" align="center">NOT APPROVED LEAVE HISTORY </h2>

                                <span class="card-title"></span>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-striped table-responsive table-bordered" id="example" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
                                        <tr>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EmpID</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employe Name</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LEAVE TYPE</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">POSTING DATE</th> 
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LEAVE DATE</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">REASON</th>
                                    
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
<?php 
$status=2;
$dept=$_SESSION['dept'];
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.Description,tblleaves.Reason,tblleaves.FromDate,tblleaves.ToDate,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.Status=:status and tblemployees.department=:dept order by lid desc";
//$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.Status=:status and tblemployees.department=:dept order by lid desc";
$query = $dbh -> prepare($sql);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':dept',$dept,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"> <b><?php echo htmlentities($cnt);?></b></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->EmpId);?></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->LeaveType);?></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->PostingDate);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;">From <?php echo htmlentities($result->FromDate);?> to <?php echo htmlentities($result->ToDate);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;">Reason:<?php echo htmlentities($result->Reason);?></td>
											
											
                                        <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php $stats=$result->Status;
if($stats==1){
                                             ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Not Approved</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">waiting for approval</span>
 <?php } ?>


                                             </td>

          
           <!--<td><a href="leave-details.php?leaveid=<?php echo htmlentities($result->lid);?>" class="waves-effect waves-light btn blue m-b-xs"> View Details</a></td>-->
                                    </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
         
        <style>
	th {
	  font-size: 20px;
	  cursor: pointer;
	  background-color: coral;
	}
.icon-update {
    color: #0000FF;
}
.icon-valid {
    color: #008000;
}
.icon-invalid {
    color: #FF0000;
}
</style>
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>

    </body>
</html>
<?php } ?>