<?php
	$conn = mysqli_connect('localhost:3306', 'root', 'root','kmitelms');
	if (!$conn){
		die('Could not connect: ' . mysql_error());
	}	
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d');
	$dateandtime=date("Y-m-d h:i:s");
	$sql="";
	$month=date("m", strtotime($date));
	$prename = date("F", mktime(0, 0, 0, $month-1, 10)); 
	$curname=date("F", strtotime($date));
	$day=date("d", strtotime($date));
	
	//Check whether updated or not.
	$sql="select isupdated from updatemonthlyleave where monthname='".$curname."'"; 
	$mresult = mysqli_query($conn, $sql);
	$rows=mysqli_num_rows($mresult);
	if($rows) {
		$row = $mresult->fetch_assoc();
		if($row['isupdated']==0){
			//Update monthly leaves
			if(($month=="02" || $month=="03" || $month=="05" || $month=="06" || $month=="08" || $month=="09" || $month=="11" || $month=="12" )) {
				$sql="select * from ".$prename; 
				$result = mysqli_query($conn, $sql);
				$rows=mysqli_num_rows($result);
				if($rows) {
					while($row = $result->fetch_assoc()){
					if($row['cl']<0)
						$row['cl']=0;
					$sql1 ="UPDATE ".$curname." SET cl=".$row['cl'].", ccl= ".$row['ccl'].", od=0, al=".$row['al'].", icl=icl+".$row['cl'].", iccl= iccl+".$row['ccl']." WHERE empid=".$row['empid'];
					$result1 = mysqli_query($conn, $sql1);
					}
				}
				if($month=="12")
				{
					$sql1 ="UPDATE updatemonthlyleave SET isupdated=0 where monthname='januaryyear'";
					$result1 = mysqli_query($conn, $sql1);
				}
			}
			
			else if(($month=="04" || $month=="07" || $month=="10")) {
				$sql="select * from tblavailable"; 
				$result = mysqli_query($conn, $sql);
				$q=0;
				$rows=mysqli_num_rows($result);
				if($rows) {
					while($row = $result->fetch_assoc()){
						if($row['cl']<0)
							$row['cl']=0;
						//reading next quarter values
						if ($month=="04")		$q=$row['q2'];
						else if($month=="07")	$q=$row['q3'];
						else if($month=="10")	$q=$row['q4'];
				
						$sql1 ="UPDATE ".$curname." SET cl=".$row['cl']."+".$q.", ccl= ".$row['ccl'].", od=0, al=".$row['al']." , icl=icl+".$row['cl']."+".$q.", iccl= iccl+".$row['ccl']." WHERE empid=".$row['empid'];
						$result1 = mysqli_query($conn, $sql1);
						
						$sql2 ="UPDATE december SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
						$result2 = mysqli_query($conn, $sql2);
					}
				}
			}
			
			else if(($month=="01" )){
				$sql="select * from tblavailable"; 
				$result = mysqli_query($conn, $sql);
				$rows=mysqli_num_rows($result);
				if($rows) {
					while($row = $result->fetch_assoc()){
						$sql1="UPDATE ".$curname." SET cl=".$row['cl'].", ccl=".$row['ccl'].", od=0, al=".$row['al'].", icl=".$row['cl'].", iccl= ".$row['ccl']." where empid=".$row['empid'];
						$result1 = mysqli_query($conn, $sql1);
					}
				}
			}
			// change the isupdated to true (i.e. set to 1)
			$sql="update updatemonthlyleave set isupdated=1, updatedDate='".$dateandtime."' where monthname='".$curname."'";
			$result = mysqli_query($conn, $sql);
			
			echo "Dear Admin, ".$curname." month leaves updated. Thank You!!!";
		}
		else
		{
			echo "Dear Admin, You have Already updated ".$curname." month leaves. Thank You!!!";
		}
	}
	
	mysqli_close($conn);
?>