<?php 
	require 'DbConnect.php';
	$db = new DbConnect;
	$conn = $db->connect();

	$stmt = $conn->prepare('SELECT m.empid as empid,FirstName, LastName,Department, cl,ccl,od,al,avail,icl,iccl,lop,lates from '.$_GET['month'].' m join tblemployees e on e.EmpId=m.empid where e.status=1 order by Department,FirstName');
	$stmt->execute();
	//$monthlydata = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$monthlydata = $stmt->fetchAll(PDO::FETCH_ASSOC);
	$monthresult = array();
	$cn=0;
	if($stmt->rowCount() > 0)
	{
		foreach($monthlydata as $row):
			
			//Total leaves
			$tot=$row['icl']+$row['iccl'];
			
			//remaining leaves
			$remain=($tot-$row['avail']);
			if(($remain)<0)
				$remain= 0;
			
			// Loss of pay	
			if($remain>0)
				$lossofpay=$row['lop']+intval($row['lates']/3)*0.5;
			else
				$lossofpay=abs($tot-$row['avail'])+$row['lop']+intval($row['lates']/3)*0.5;
			
				$monthresult[$cn] = array( 
					"Empid" => "".$row['empid'] ,
					"Employee Name" => "".strtoupper($row['FirstName'].' '.$row['LastName']) ,  
					"Department" => "".$row['Department'] , 
					"CL" => "".$row['cl'] , 
					"CCL" =>"".$row['ccl'] , 
					"OD" => "".$row['od'] , 
					"AL" => "".$row['al'] , 
					"Total" => "".$tot , 
					"Availed" => "".$row['avail'] , 
					"Late Coming" => "".$row['lates'] ,
					"Remaining Leaves" => "".$remain , 
					"LOP" => "".$lossofpay
				); 
				$cn=$cn+1;
		endforeach;
	}
	


							
if(isset($_POST["ExportType"]))
{
	switch($_POST["ExportType"])
    {
        case "export-to-excel" :
            // Submission from
			$filename = $_POST["ExportType"] . ".xls";		 
            header("Content-Type: application/vnd.ms-excel");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			ExportFile($monthresult);
			//$_POST["ExportType"] = '';
            exit();
		case "export-to-csv" :
            // Submission from
			$filename = $_POST["ExportType"] . ".csv";		 
			header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
			header("Content-type: text/csv");
			header("Content-Disposition: attachment; filename=\"$filename\"");
			header("Expires: 0");
			ExportCSVFile($monthresult);
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
		margin-top: 20px;
	}
		th {
	  font-size: 20px;
	  cursor: pointer;
	  background-color: coral;
	}
</style>

<script>
/*
$(document).ready(function(){
	$("#month").change(function(){
		var month = $("#month").val(); 	
		$.ajax({ url: 'monthlyleaves.php', method: 'post', data: 'month=' + month
		}).done(function(monthlydata){
			//console.log(JSON.parse(JSON.stringify(monthlydata)));
			console.log(monthlydata);
			monthly = JSON.parse(JSON.stringify(monthlydata));
			
			$('#monthdata').empty();
			Object.keys(monthly).forEach(function(mdata){
				$('#monthdata').append('<tr> <td>'+mdata.empid+'</td> <td>'+mdata.name+'</td><td>'+mdata.Department+'</td><td>'+mdata.icl+'</td><td>'+mdata.iccl+'</td><td>'+mdata.od+'</td><td>'+mdata.al+'</td><td>'+(mdata.icl+mdata.iccl)+'</td><td>'+mdata.avail+'</td><td>'+(mdata.icl+mdata.iccl-mdata.avail)+'</td><td>'+(mdata.icl+mdata.iccl-mdata.avail)+'</td></tr>')
			})
		})
	})
});
*/
function myFunction() {
  var x = document.getElementById("display_data");
  var month=document.getElementById("month").value;
  location.replace('monthvar.php?month='+month);
}

</script>
<title>Monthly Report</title>
<body>
	    <header>
<!-- #nav-menu-container -->
		<?php
		require_once('adminheader.php');
		?>
     </header><!-- #header -->

<div class="container">
		<h3 class="panel-title" style="line-height:35px;font-family:Georgia;"><b>Monthly Leaves Report </b></a>
		<select  class="custom-select" name="month" id="month" autocomplete="off" onchange="myFunction()">
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
		</h3>
		
		<h4 style="align:center;color:#625750;font-family:Georgia;"><?php echo strtoupper($_GET['month']) ?> - REPORT </h4>
		<div class="btn-group pull-right">
		 <button type="button" class="btn btn-info">Action</button>
		  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" >
			<span class="caret"></span>
			<span class="sr-only">Toggle Dropdown</span>
		  </button>
		  <ul class="dropdown-menu" role="menu" id="export-menu">
			<li id="export-to-excel"><a href="#">Export to excel</a></li>
			<li id="export-to-csv"><a href="#">Export to csv</a></li>
			<li class="divider"></li>
			<li><a href="#">Other</a></li>
		  </ul></div>
				</h4>
				<form action="monthlyreport.php?month=<?php echo $_GET['month']; ?>" method="post" id="export-form">
					<input type="hidden" value='' id='hidden-type' name='ExportType'/>
				</form>
			   <table class="table table-striped table-responsive table-bordered" id="" cellspacing="0" border="2" style="table-layout: auto;width: 100%;" >
					<tr>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Empid</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Employee Name</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">CL</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">CCL</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">OD</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">AL</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">TOTAL</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">AVAILED</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LATES</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">REMAINING</th>
						<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">LOP</th>
					</tr>
					
					<tbody id="monthdata" name="monthdata" for="monthdata">
	<?php 
						foreach($monthresult as $row): ?>	
						<tr class="item">
						<td style="font-family: Lucida Fax;"><?php echo $row['Empid'];?></td>
						<td style="font-family:Lucida Fax;"><?php echo $row['Employee Name']?></td>
						<td style="font-family:Lucida Fax;"><?php echo $row['Department'];?></td>
						<td style="font-family:Lucida Fax;"><?php echo $row['CL'];?></td>
						<!--ccl-->
						<td style="font-family:Lucida Fax;"><?php echo $row['CCL']; ?></td>
						<!--od-->
						<td style="font-family:Lucida Fax;"><?php echo $row['OD']; ?></td>
						<!--al-->
						<td style="font-family:Lucida Fax;"><?php echo $row['AL']; ?></td>
						<!--total-->
						<td style="font-family:Lucida Fax;"><?php echo $row['Total']; ?></td>
						<!--avail-->
						<td style="font-family:Lucida Fax;"><?php echo $row['Availed'];?></td>
						<!--lates-->
						<td style="font-family:Lucida Fax;"><?php echo $row['Late Coming'];?></td>
						<!--remaining-->
						<td style="font-family:Lucida Fax;"><?php echo $row['Remaining Leaves'];?></td>
						<!--lop-->
						<td style="font-family:Lucida Fax;"><?php echo $row['LOP'];?></td>
						</tr>
						<?php endforeach;
						?>
					</tbody>
				</table>
	</div>
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

 