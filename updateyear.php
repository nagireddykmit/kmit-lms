<?php
	$conn = mysqli_connect('localhost:3306', 'admin', 'kmit@3306','finalelms');
	if (!$conn){
		die('Could not connect: ' . mysql_error());
	}	
	
	date_default_timezone_set("Asia/Kolkata");
	$date=date('Y-m-d'); 
	$dateandtime=date("Y-m-d h:i:s");
	$curname=date("F", strtotime($date));
	
	//Check whether updated or not.
	$sql="select isupdated from updatemonthlyleave where monthname='".$curname."year'"; 
	$mresult = mysqli_query($conn, $sql);
	$rows=mysqli_num_rows($mresult);
	if($rows) {
		$row = $mresult->fetch_assoc();
		if($row['isupdated']==0){
			$q1=$_POST['jfm'];
			$q2=$_POST['amj'];
			$q3=$_POST['jas'];
			$q4=$_POST['ond'];
			$al=$_POST['al'];
			//Update Yearwise leaves
			$sql ="UPDATE tblavailable SET q1=".$q1.", q2= ".$q2.", q3=".$q3.", q4=".$q4.", cl=0, ccl=0, od=0, al=".$al;
			$result = mysqli_query($conn, $sql);
			//Reset January leaves
			$sql ="UPDATE january SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset February leaves
			$sql ="UPDATE february SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset March leaves
			$sql ="UPDATE march SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset April leaves
			$sql ="UPDATE april SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset May leaves
			$sql ="UPDATE may SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset June leaves
			$sql ="UPDATE june SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset July leaves
			$sql ="UPDATE july SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset August leaves
			$sql ="UPDATE august SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset September leaves
			$sql ="UPDATE september SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset October leaves
			$sql ="UPDATE october SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Reset November leaves
			$sql ="UPDATE november SET cl=0, ccl=0, od=0, al=0, avail=0, lop=0, lates=0, icl=0, iccl=0";
			$result = mysqli_query($conn, $sql);
			//Update IsUpdated Value to true (i.e, value 1) for Yearly leaves			
			$sql="update updatemonthlyleave set isupdated=1, updatedDate='".$dateandtime."' where monthname='".$curname."year'"; 
			$result = mysqli_query($conn, $sql);
			
			echo "Dear Admin, You have updated YEAR-WISE Leaves. Thank You!!!";
		
		}
		else
		{
			echo "Dear Admin, You have Already updated for YEAR-WISE leaves. Thank You!!!";
		}
	}
	mysqli_close($conn);
?>