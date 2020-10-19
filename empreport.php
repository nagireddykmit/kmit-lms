<?php
// employee data from DB
$connect = mysqli_connect('localhost:3306', 'admin', 'kmit@3306','finalelms');  
 $query = "SELECT EmpId,FirstName,LastName,DepartmentShortName,Designation,doj,EmailId,Phonenumber,pancardno,adharno,jntu_uid,aicteid FROM tblemployees t, tbldepartments d where t.Department=d.DepartmentName and Status=1 order by Department,FirstName";  
 $result = mysqli_query($connect, $query); 

if(isset($_POST["ExportType"]))
{
	switch($_POST["ExportType"])
    {
        case "export-to-excel" :
            // Submission from
			$filename = $_POST["ExportType"] . ".xls";		 
            header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			ExportFile($result);
			//$_POST["ExportType"] = '';
            exit();
		case "export-to-csv" :
            // Submission from
			$filename = $_POST["ExportType"] . ".csv";		 
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Expires: 0");
			ExportCSVFile($result);
			//$_POST["ExportType"] = '';
            exit();
        default :
            die("Unknown action : ".$_POST["action"]);
            break;
    }
}

function ExportCSVFile($records) {
	// create a file pointer connected to the output stream
	$fh = fopen( 'php://output', 'w' );
	$heading = false;
		if(!empty($records))
		  foreach($records as $row) {
			if(!$heading) {
			  // output the column headings
			  fputcsv($fh, array_keys($row));
			  $heading = true;
			}
			// loop over the rows, outputting them
			 fputcsv($fh, array_values($row));
			 
		  }
		  fclose($fh);
}

function ExportFile($records) {
	$heading = false;
	if(!empty($records))
	  foreach($records as $row) {
		if(!$heading) {
		  // display field/column names as a first row
		  echo implode("\t", array_keys($row)) . "\n";
		  $heading = true;
		}
		echo implode("\t", array_values($row)) . "\n";
	  }
	exit;
}



?>
	<script src="https://code.jquery.com/jquery-3.2.1.js"></script>
 	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet" type="text/css">
	<link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet" type="text/css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>

<style type="text/css">
	.container{
		margin-top: 10px;
		
	}
			th {
	  font-size: 20px;
	  cursor: pointer;
	  background-color: coral;
	}
	table {
  border-collapse: collapse;
  border-spacing: 0;
  width: 100%;
  border: 1px solid #ddd;
}

th, td {
  text-align: left;
  padding: 8px;
}

</style>

<title>Employee Information</title>
<body>
	    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('adminheader.php');
		?>
     </header><!-- #header -->

<div class="container" style="overflow-x:auto;">
					<h2 style="line-height:35px;font-family:Georgia;" align="center">Employee Information<div class="btn-group pull-right">
						  <button type="button" class="btn btn-info">Action</button>
						  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
						    <span class="caret"></span>
						    <span class="sr-only">Toggle Dropdown</span>
						  </button>
						  <ul class="dropdown-menu" role="menu" id="export-menu">
						    <li id="export-to-excel"><a href="#">Export to excel</a></li>
							<li id="export-to-csv"><a href="#">Export to csv</a></li>
						    <li class="divider"></li>
						    <li><a href="#">Other</a></li>
						  </ul>
						</div>
					</h2>
					<form action="empreport.php" method="post" id="export-form">
						<input type="hidden" value='' id='hidden-type' name='ExportType'/>
				  	</form>
	                 
	                 <table class="table table-striped table-responsive table-bordered" id="" cellspacing="0" border="2" style="table-layout: auto;width: 100%;" >
					<tr>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">SNo</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EmpId</th>
	                        <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employee Name</th>
	                        <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department</th>
	                        <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Designation</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">D.O.J</th>
	                        <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Email</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Phonenumber</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">PAN Card No</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Aadhaar No</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">JNTU-UID</th>
							<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">AICTE-ID</th>
	                  	</tr>
		                <tbody>
		                  	<?php 
							$cnt=1;
							foreach($result as $row): ?>	
							<tr class="item">
								<td  style="font-family: Lucida Fax;" align="center"><?php echo $cnt ?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row['EmpId']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo strtoupper($row ['FirstName']."  " .$row ['LastName'])?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['DepartmentShortName']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['Designation']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['doj']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['EmailId']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['Phonenumber']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['pancardno']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['adharno']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['jntu_uid']?></td>
								<td  style="font-family: Lucida Fax;"><?php echo $row ['aicteid']?></td>
							</tr>
							
							<?php $cnt = $cnt+1; endforeach;
							?>
		                </tbody>
	              	</table>
				</div>

<script  type="text/javascript">
	$(document).ready(function() {
	
		jQuery('#export-menu li').bind("click", function() {
			var target = $(this).attr('id');
			switch(target) {
				case 'export-to-excel' :
				$('#hidden-type').val(target);
				//alert($('#hidden-type').val());
				$('#export-form').submit();
				$('#hidden-type').val('');
				break
				case 'export-to-csv' :
				$('#hidden-type').val(target);
				//alert($('#hidden-type').val());
				$('#export-form').submit();
				$('#hidden-type').val('');
				break
			}
		});
    });
</script>


 <!-- Footer -->
		<?php
		require_once('footer.php');
		?>
    </body>

 