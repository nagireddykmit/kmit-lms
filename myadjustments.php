<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
    {   
header('location:index.php');
}
else{
	$today=date("Y-m-d");

 ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee Pending Class Adjustments</title>
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
		<script>
		function remarks()
		{
			var c=0;
			do{
				c++;
				var remark=document.getElementById("remark"+c).value;
				
			}while(remark=="");
			document.getElementById("approve"+c).href =document.getElementById("approve"+c).href +"&remark="+remark;
			document.getElementById("reject"+c).href =document.getElementById("reject"+c).href +"&remark="+remark;
			//alert(document.getElementById("reject"+c).href);
		}
		</script>
    </head>
    <body>
     <header>
<!-- #nav-menu-container -->
		<?php
		require_once('empheader.php');
		?>
     </header><!-- #header -->              
           
     <div class="container">
<h2 style="font-family:Georgia;color:#000000;" align="center">ADJUSTMENTS TO DO</h2>

                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-striped table-responsive table-bordered" id="" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
                                        <tr>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EmpID</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Adjusted Employee Name</th>
                                           
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Year</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department</th> 
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Section</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Hour</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Subject</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Class Date</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Status</th>
                                    
                                        </tr>
                                    </thead>
    
                                    <tbody>
<?php 
$status=0;
$epid=$_SESSION['empid'];
$sql = "SELECT leaveid, adjempid, empname, adjustedfrom, department, Year, Section, Subject, Timings, classdate, actionstatus from classadjustments where empid=:epid and actionstatus=1 and classdate>=:today order by leaveid asc";
$query = $dbh -> prepare($sql);
$query->bindParam(':epid',$epid,PDO::PARAM_STR);
$query->bindParam(':today',$today,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{      
      ?>  
	  <div id="defaultDialog">
			<div id="Grid"></div>
	</div>

                                        <tr>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><b><?php echo htmlentities($cnt);?></b></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->adjempid);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->adjustedfrom); ?></a></td>
                                            
                                             <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Year);?></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->department);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Section); ?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Timings);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Subject);?></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->classdate);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;">
											<?php	$stats= $result->actionstatus; 
												if($stats=='1') { ?>
                                                 <span style="color: green">Approved</span>
                                                 <?php } if($stats=='2')  { ?>
                                                <span style="color: red">Rejected</span>
                                                 <?php } if($stats=='0')  { ?>
												 <span style="color: blue">Pending</span>
												 <?php } ?>
                                             </td>
	
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