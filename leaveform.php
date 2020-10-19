<?php
session_start();
error_reporting(0);
include('includes/config.php');
if(strlen($_SESSION['emplogin'])==0)
{   
header('location:index.php');
}
else{
if(isset($_POST['apply']))
{
$empid=$_SESSION['eid'];
$emname=$_SESSION['emname'];
$leavetype=$_POST['leavetype'];
$fromdate=$_POST['fromdate'];  
$todate=$_POST['todate'];
//$noofdays=$_POST['noofdays'];
$description=$_POST['gender']; 
$Reason=$_POST['Reason']; 
//$odupload=$_POST['odupload'];  
$status=0;
$isread=0;
if($fromdate > $todate){
	echo '<script>';
    echo 'alert(" ToDate should be greater than FromDate ");';
	echo '</script>';
}
else{
$sql="INSERT INTO tblleaves(LeaveType,ToDate,FromDate,Description,Reason,Status,IsRead,empid) VALUES(:leavetype,:todate,:fromdate,:description,:Reason,:status,:isread,:empid)";
$query = $dbh->prepare($sql);
$query->bindParam(':leavetype',$leavetype,PDO::PARAM_STR);
$query->bindParam(':fromdate',$fromdate,PDO::PARAM_STR);
$query->bindParam(':todate',$todate,PDO::PARAM_STR);
//$query->bindParam(':noofdays',$noofdays,PDO::PARAM_STR);
$query->bindParam(':description',$description,PDO::PARAM_STR);
$query->bindParam(':Reason',$Reason,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':isread',$isread,PDO::PARAM_STR);
$query->bindParam(':empid',$empid,PDO::PARAM_STR);
//$query->bindParam(':odupload',$odupload,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();

    for ($i=0; $i<=9; $i++) 
    {
        if ( ! isset($_POST['sel_empid'.$i]) ) continue;
        if ( ! isset($_POST['sel_name'.$i]) ) continue;
        if ( ! isset($_POST['sel_year'.$i]) ) continue;
        if ( ! isset($_POST['sel_dept'.$i]) ) continue;
        if ( ! isset($_POST['sel_section'.$i]) ) continue;
        if ( ! isset($_POST['sel_class'.$i]) ) continue;
        if ( ! isset($_POST['adjsub'.$i]) ) continue;
        if ( ! isset($_POST['adjdate'.$i]) ) continue;

        $aempid = htmlentities($_POST['sel_empid'.$i]);
        $aempname = htmlentities($_POST['sel_name'.$i]);
        $ayear = htmlentities($_POST['sel_year'.$i]);
        $adept = htmlentities($_POST['sel_dept'.$i]);
        $asection = htmlentities($_POST['sel_section'.$i]);
        $aclass = htmlentities($_POST['sel_class'.$i]);
        $asubject = htmlentities($_POST['adjsub'.$i]);
        $adate = htmlentities($_POST['adjdate'.$i]);
		$sql1="INSERT INTO classadjustments (leaveid, adjempid, empname, adjustedfrom, department, Year, Section, Subject, Timings, classdate) VALUES (:lastInsertId, :aempid, :aempname, :emname, :adept, :ayear, :asection, :asubject, :aclass, :adate)";
        $atmt = $dbh->prepare($sql1);
		$atmt->bindParam(':lastInsertId',$lastInsertId,PDO::PARAM_STR);
		$atmt->bindParam(':aempid',$aempid,PDO::PARAM_STR);
		$atmt->bindParam(':aempname',$aempname,PDO::PARAM_STR);
		$atmt->bindParam(':emname',$emname,PDO::PARAM_STR);
		$atmt->bindParam(':adept',$adept,PDO::PARAM_STR);
		$atmt->bindParam(':ayear',$ayear,PDO::PARAM_STR);
		$atmt->bindParam(':asection',$asection,PDO::PARAM_STR);
		$atmt->bindParam(':asubject',$asubject,PDO::PARAM_STR);
		$atmt->bindParam(':aclass',$aclass,PDO::PARAM_STR);
		$atmt->bindParam(':adate',$adate,PDO::PARAM_STR);
        $atmt->execute();
    }
/*	
$sql ="SELECT Status FROM tblleaves WHERE empid=:empid";
$query= $dbh -> prepare($sql);
$query-> execute();
$results = $query -> fetchAll(PDO::FETCH_OBJ);
if($results->Status==0)
{
	echo '<script type="text/javascript">'; 
	echo 'alert(Your previous leave application status is still pending);';
	echo 'window.location.href = "emp-changepassword.php";';
	echo '</script>';
}*/
if($lastInsertId)
{
echo '<script type="text/javascript">'; 
echo 'alert("Leave applied successfully");'; 
echo 'window.location.href = "emp-changepassword.php";';
echo '</script>';

//$msg="Leave applied successfully";
}
else 
{
echo '<script type="text/javascript">'; 
echo 'alert("Something went wrong. Please try again");'; 
echo 'window.location.href = "emp-changepassword.php";';
echo '</script>';
//$error="Something went wrong. Please try again";
}

}
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Employee | Apply Leave</title>
        
       <title>KMIT ELMS</title>
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

		</style>

 <script>
 
	function showtext() {
	 var lt = document.getElementById("leavetype");
	 var value = leavetype.options[lt.selectedIndex].value;
	if(lt.options[lt.selectedIndex].text=="On Duty")
	{
		document.getElementById("odmodal").style.display="block";
	}
    };
</script>

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
	 <style>
		.card-container.card {
		padding: 15px 15px;
		}
	 </style>
	<div class="container">
		   <div class="card card-container">
				<h3 style="font-family:Georgia ;font-size:25px;color:#2F4F4F;" align="center">APPLY LEAVE</h3>
                 <form class="form-signin" id="example-form" method="post" name="addemp">
                                        
			<br><select  class="form-control" name="leavetype" id="leavetype" onchange= "showtext();" autocomplete="off">
			
			<option value="">Select leave type...</option>
			<?php $sql = "SELECT  LeaveType, Description from tblleavetype";
			$query = $dbh -> prepare($sql);
			$query->execute();
			$results=$query->fetchAll(PDO::FETCH_OBJ);
			$cnt=1;
			if($query->rowCount() > 0)
			{
				foreach($results as $result)
				{   ?>                                            
				<option value="<?php echo htmlentities($result->LeaveType);?>"><?php echo htmlentities($result->Description);?></option>
			<?php }} ?>
		</select>


		<div id="odmodal" style="display:none">
          <input type="file" class="form-control" id="odupload" name="odupload" onchange="readURL(this);">
        </div>
			<br>
			<label for="fromdate">From  Date:</label>
			<input required class="form-control" type="date" name="fromdate" id="fromdate" title="Choose your desired date" min="<?php echo date('Y-m-d');?>"/>
		<br>
		<label for="todate">To Date</label>
		<input class="form-control" id="todate" name="todate" type="date" min="<?php echo date('Y-m-d');?>" required>
		
		<br> 
		<input id="textarea1" placeholder="Enter Reason" class="form-control" name="Reason" class="materialize-textarea" length="1000" required>
		<br>
		<div>
			<label >Class Adjustments</label>
			<input type="radio" id="yes" name="gender" value="yes" onchange="toggleadd();>
			  <label for="yes">YES</label>
			  <input type="radio" id="no" name="gender" value="no">
			  <label for="no">NO</label><br>
		</div>
		<div id="adjustdiv" style="display:none;"><button id="adjustments" class="btn btn-default" class="waves-effect waves-light btn indigo m-b-xs" style="float:left;width:50px;" >Add</button></div>
		<div id="adjust_fields"></div>
		<br>
		<button type="submit" name="apply" class="waves-effect waves-light btn indigo m-b-xs" style="margin:auto;width:120px;">APPLY</button>                                             
		</form>
	</div>                     
</div>                         
<script>
            var countAdj = 0;
            // http://stackoverflow.com/questions/17650776/add-remove-html-inside-div-using-javascript
            $(document).ready(function(){
			    $('input[type="radio"]').click(function(){
					var inputValue = $(this).attr("value");
					if(inputValue=="yes")
						document.getElementById("adjustdiv").style.display='block';
					else
						document.getElementById("adjustdiv").style.display='none';
				});
                window.console && console.log('Document ready called');

                $('#adjustments').click(function(event){
                    // http://api.jquery.com/event.preventdefault/
					
					event.preventDefault();
                    if ( countAdj >=10 ) {
                        alert("Maximum of ten adjustments possible exceeded");
                        return;
                    }
                    countAdj++;
                    window.console && console.log("Adding position "+countAdj);	

                    $('#adjust_fields').append('<div id="position'+countAdj+'"> \
						           <div><button class="btn btn-basic" class="waves-effect waves-light btn indigo m-b-xs" style="float:right;width:75px;"\
                                        onclick="$(\'#position'+countAdj+'\').remove();return false;" \
                                    > Remove</button> </div>\
								<input type="text" placeholder="Enter Employee ID" class="form-control" name="sel_empid'+countAdj+'">\
								<input type="text" placeholder="Enter Name" class="form-control" name="sel_name'+countAdj+'">\
								<select name="sel_year'+countAdj+'">\
									<option value="">-Year-</option>\
									<option value="1">I</option>\
									<option value="2">II</option>\
									<option value="3">III</option>\
									<option value="4">IV</option>\
								</select>\
								<select name="sel_dept'+countAdj+'">\
									<option value="">-Department-</option>\
									<option value="CSE">CSE</option>\
									<option value="IT">IT</option>\
									<option value="EIE">EIE</option>\
									<option value="ECE">ECE</option>\
								</select>\
								<select name="sel_section'+countAdj+'">\
									<option value="">-Section-</option>\
									<option value="A">A</option>\
									<option value="B">B</option>\
									<option value="C">C</option>\
									<option value="D">D</option>\
									<option value="E">E</option>\
									<option value="F">F</option>\
									<option value="G1">G1</option>\
									<option value="G2">G2</option>\
								</select>\
								<select name="sel_class'+countAdj+'">\
								<option value="">-Hour-</option>\
									<option value="1">1st</option>\
									<option value="2">2nd</option>\
									<option value="3">3rd</option>\
									<option value="4">4th</option>\
									<option value="5">5th</option>\
									<option value="6">6th</option>\
									<option value="7">7th</option>\
								</select><br><br>\
                                <input type="text" placeholder="Enter Subject" class="form-control" name="adjsub'+countAdj+'">\
								<input type="date" placeholder="Select Date" class="form-control" name="adjdate'+countAdj+'"><br>\
                        </div>'
						
                    );
                });
            });
        </script>                 
<!-- Footer -->
		<?php
		require_once('footer.php');
		?>    
</body>
</html>
<?php } ?> 