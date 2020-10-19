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
        <title>HOD | Employee Pedning leaves </title>
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
		require_once('hodheader.php');
		?>
     </header><!-- #header -->              
           
     <div class="container">
<h2 style="font-family:Georgia;color:#000000;" align="center">Pending Leave History</h2>
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-striped table-responsive table-bordered" id="" cellspacing="0" style="table-layout: auto;width: 100%;" >
			<thead>
                                        <tr>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNO</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EmpID</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employe Name</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LEAVE TYPE</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">POSTING DATE</th> 
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LEAVE DATE</th>
                                      
											 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">REASON</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">CLASS ADJ</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Status</th>
											<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Remark</th>
                                            <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">ACTION</th>
                                        </tr>
                                    </thead>
    
                                    <tbody>
<?php 
$status=0;
$dept=$_SESSION['dept'];
$sql = "SELECT tblleaves.id as lid,tblemployees.FirstName,tblemployees.LastName,tblemployees.EmpId,tblemployees.id,tblleaves.LeaveType,tblleaves.Description,tblleaves.Reason,tblleaves.FromDate,tblleaves.ToDate,tblleaves.PostingDate,tblleaves.Status from tblleaves join tblemployees on tblleaves.empid=tblemployees.id where tblleaves.Status=:status and tblemployees.department=:dept order by lid desc";
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
	  <div id="defaultDialog">
			<div id="Grid"></div>
	</div>

                                        <tr>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><b><?php echo htmlentities($cnt);?></b></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->EmpId);?></td>
                                              <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><a href="hodviewemployee.php?empid=<?php echo htmlentities($result->EmpId);?>" target="_blank"><?php echo htmlentities($result->FirstName." ".$result->LastName);?></a></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->LeaveType);?></td>
                                            <td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->PostingDate);?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;width:120px"><?php echo 'From<br>'.$result->FromDate.'<br>To<br>'.$result->ToDate;?></td>
											<td class="th-sm" style="font:small-caps 15px/30px Georgia, serif;"><?php echo htmlentities($result->Reason);?></td>
											<td>
													<?php if($result->Description=="no")
																echo "<p class='waves-effect waves-light btn blue m-b-xs'>NO</p>";
															else 
																echo "<a href='somepage.php?leaveid=$result->lid' class='waves-effect waves-light btn blue m-b-xs'>YES</button>"; ?>
											</td>
											
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
<td><textarea type="text" placeholder="Enter your remarks" name="remark<?php echo $cnt; ?>" id="remark<?php echo $cnt; ?>" onchange="remarks()"></textarea></td>
		    <td>
 
<pre><a href="action.php?leaveid=<?php echo htmlentities($result->lid);?>&status=1;&cnt=1" class="waves-effect waves-light btn blue m-b-xs" id="approve<?php echo $cnt; ?>" >Approve</a><br><br><a href="action.php?leaveid=<?php echo htmlentities($result->lid)?>&status=2;" class="waves-effect waves-light btn blue m-b-xs" id="reject<?php echo $cnt; ?>">Reject</a></pre>

<!--<input type="button" name="approve" id="approve" class="modal-trigger waves-effect waves-light btn" value="Approve" onclick=""></a>
<input type="button" name="reject" id="reject" class="modal-trigger waves-effect waves-light btn" value="Reject">-->

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