<?php
	session_start();
	$conn = mysqli_connect('localhost:3306', 'admin', 'kmit@3306','finalelms');
	if (!$conn)
	{
		die('Could not connect: ' . mysql_error());
	}
	
	$holidays = array();
	$result = mysqli_query($conn,"SELECT hdate FROM holidaystable");
	while ($row = mysqli_fetch_assoc($result)) {
	   $holidays = array_merge($holidays,array(date("z", strtotime($row['hdate']))+1));
	}
	$leaveid = $_SESSION['lid'];
	
	echo "Leave id is".$leaveid;
	
	$sql="select te.EmpId as empid, tl.FromDate as fromdate, tl.ToDate as todate, tl.LeaveType as leavetype from tblleaves tl
		inner join 
		tblemployees te 
		on tl.empid=te.id 
		where tl.id=".$leaveid;
	
	$res = mysqli_query($conn, $sql);
	
	$values=mysqli_num_rows($res);
	
	if($values) {
		$value = mysqli_fetch_assoc($res);
		// Read form details
		$empid = $value['empid'];
		$from = $value['fromdate'];
		$to = $value['todate'];
		$leavetype = $value['leavetype'];
		echo "Empoyee ID = ".$empid."<br>From Date = ".$from."<br>TO Date = ".$to."<br>Leave Type = ".$leavetype."<br>";
		$leaves = abs(date("z", strtotime($to))-date("z", strtotime($from))) + 1;
		$daynumber = date("N", strtotime($from));
		
		// find month numbers
		$from_month = date("m", strtotime($from));
		$to_month = date("m", strtotime($to));
		
		//find leaves
		if(date("L", strtotime($to))==1)
			$monthend = array(31,60, 91, 121, 152,182, 213, 244, 274,305, 335, 366);
		else
			$monthend = array(31,59, 90, 120, 151,181, 212, 243, 273,304, 334, 365);
		
		// Temporary Variables
		$cur=0;
		$next=0;
		
		//If leaves fall in different months storing month-wise holidays
		$cur_leaves=0;
		$next_leaves=0;
		
		echo "Before: Leaves = ".$leaves."<br>Cur-Leaves = ".$cur_leaves."<br>Next-Leaves = ".$next_leaves."<br><br>";
		// Leaves falls in two months
		if($from_month!=$to_month){
			if($leaves<6){
				for ($i = date("z", strtotime($from))+1; $i <= $monthend[$from_month-1]; $i++) {
					if (in_array($i, $holidays))
						$cur = $cur + 1;
				}
				
				for ($i = $monthend[$from_month-1]+1; $i <= date("z", strtotime($to))+1; $i++) {
					if (in_array($i, $holidays))
						$next = $next + 1;
				}
			}
			$cur_leaves=$monthend[$from_month-1]-date("z", strtotime($from))-$cur;
			if(($cur_leaves+$daynumber)>7 && $leaves<6)
				$cur_leaves = $cur_leaves - 1;
			
			$next_leaves = $leaves-$cur_leaves-$next;
			if(($next_leaves+$daynumber)>7 && $leaves<6)
				$next_leaves = $next_leaves - 1;
			
			$leaves = $cur_leaves + $next_leaves;
			echo "After: Leaves = ".$leaves."<br>Cur-Leaves = ".$cur_leaves."<br>Next-Leaves = ".$next_leaves;
		}
		//Leaves falls in same month
		else{
			for ($i = date("z", strtotime($from))+1; $i <= date("z", strtotime($to))+1; $i++) {
				if (in_array($i, $holidays))
					$leaves = $leaves - 1;
			}
			//echo "leaves".$leaves;
			if(($leaves+$daynumber)>7 && $leaves<6)
				$leaves = $leaves - 1;
			
			echo "After: Leaves =".$leaves;
		}
		echo "leaves".$leaves;
		// find month names
		$fmname=date("F", strtotime($from));
		$tmname=date("F", strtotime($to));
		
		// Read employee leaves information
		$sql="select cl,ccl,al,od from ".$fmname." where empid=".$empid; 
		$sql1 = "none";
		$sql2 = "none";
		$sql3="none";
		$leaveccl=0;
		$leavecl=0;
		$result = mysqli_query($conn, $sql);
		$rows=mysqli_num_rows($result);
		if($rows) {
			echo "entered into updation";
			$row = mysqli_fetch_assoc($result);
			$cl=$row['cl'];
			$ccl=$row['ccl'];
			$al=$row['al'];
			$od=$row['od'];
			$today=date("Y-m-d");
			$fromdaynumber = date("z", strtotime($from))+1;
			$currdaynumber = date("z", strtotime($today))+1;
			
			//echo "Today date is : ".$today;
			
			// For leavetype is CL or CCL
			if($leavetype == "CL" || $leavetype == "CCL"){
				// From-date and To-date falls in Same Quarter
				
				if( $from_month==$to_month ) {
					echo "From-date and To-date falls in Same Month";
					if($ccl>=$leaves) {
						$leaveccl = $leaves;
						$sql ="UPDATE tblavailable SET ccl=ccl-".$leaves." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET ccl=ccl-".$leaves.", avail=avail+".$leaves." WHERE empid =".$empid;
						
					}
					else if($ccl>0) {
						$leaveccl = $ccl;
						$leavecl = $leaves-$ccl;
						$sql ="UPDATE tblavailable SET ccl=0, cl=".$ccl."+".$cl."-".$leaves." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET ccl=0, cl=".$ccl."+".$cl."-".$leaves.", avail=avail+".$leaves." WHERE empid =".$empid;
					}
					else{
						$leavecl = $leaves;
						$sql ="UPDATE tblavailable SET cl=".$cl."-".$leaves." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET cl=".$cl."-".$leaves.", avail=avail+".$leaves." WHERE empid =".$empid;
						//echo "<p>".$sql."</p>";
						//echo "<p>".$sql1."</p>";
					}
				}
				else if(($from_month!=$to_month )&& ($to_month=="02" ||  $to_month=="03" || $to_month=="05" ||  $to_month=="06" || $to_month=="08" || $to_month=="09" || $to_month=="11" ||  $to_month=="12")) {
					echo "From-date and To-date falls in Different Month and Same Quarter";
					
					if($ccl>=$leaves) {
						$leaveccl = $leaves;
						$sql ="UPDATE tblavailable SET ccl=".$ccl."-".$leaves." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET ccl=".$ccl."-".$leaves.", avail=avail+".$cur_leaves." WHERE empid =".$empid;
						$sql2 ="UPDATE ".$tmname." SET avail=avail+".$next_leaves." , iccl=iccl+".$next_leaves." WHERE empid =".$empid;
					}
					else if($ccl>0) {
						$leaveccl = $ccl;
						$leavecl = $leaves-$ccl;
						$sql ="UPDATE tblavailable SET ccl=0, cl=".$ccl."+".$cl."-".$leaves." WHERE empid =".$empid;
						$ccl=$ccl - $cur_leaves;
						if($ccl>=0)
						{
							$sql1 ="UPDATE ".$fmname." SET ccl=".$ccl.", avail=avail+".$cur_leaves."  WHERE empid =".$empid;
						}
						else{
							$sql1 ="UPDATE ".$fmname." SET ccl=0, cl=".$cl."-".$ccl.", avail=avail+".$cur_leaves."  WHERE empid =".$empid;
							$ccl=0;
						}
						
						$sql2 ="UPDATE ".$tmname." SET iccl=".$ccl.",  icl=".$next_leaves."-".$ccl.", avail=avail+".$next_leaves."  WHERE empid =".$empid;
					}
					else{
						$leavecl = $leaves;
						$sql ="UPDATE tblavailable SET cl=".$cl."-".$leaves." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET cl=".$cl."-".$cur_leaves.", avail=avail+".$cur_leaves."  WHERE empid =".$empid;
						$sql2 ="UPDATE ".$tmname." SET icl=".$next_leaves.", avail=avail+".$next_leaves."  WHERE empid =".$empid;
					}
					//echo "<p>".$sql."</p>";
					//echo "<p>".$sql1."</p>";
				}
				// From-date and To-date falls in Different Quarter
				else
				{
					echo "From-date and To-date falls in Different Quarter";
				
					$sql_part="";
					if($to_month=="01")
						$sql_part=" q1=q1-".$next_leaves;
					if($to_month=="04")
						$sql_part="q2=q2-".$next_leaves;
					if($to_month=="07")
						$sql_part=" q3=q3-".$next_leaves;
					if($to_month=="10")
						$sql_part=" q4=q4-".$next_leaves;
					
					if($ccl>=$leaves) {
						$leaveccl = $leaves;
						$sql = "UPDATE tblavailable SET ccl=".$ccl."-".$leaves." WHERE empid =".$empid;
						$sql1 = "UPDATE ".$fmname." SET ccl=".$ccl."-".$leaves.", avail=avail+".$cur_leaves." WHERE empid =".$empid;
						$sql2 = "UPDATE ".$tmname." SET iccl=iccl+".$next_leaves.",avail=avail+".$next_leaves." WHERE empid =".$empid;
					}
					else if($ccl>0) {
						$leaveccl = $ccl;
						$leavecl = $leaves-$ccl;
						$sql = "UPDATE tblavailable SET ccl=0, cl=".$ccl."+".$cl."-".$cur_leaves.",".$sql_part." WHERE empid =".$empid;
						$ccl=$ccl - $cur_leaves;
						if($ccl>=0){
							$sql1 = "UPDATE ".$fmname." SET ccl=".$ccl." , avail=avail+".$cur_leaves." WHERE empid =".$empid;
						}
						else	{
							$sql1 ="UPDATE ".$fmname." SET ccl=0, cl=".$cl."+".$ccl."-".$cur_leaves." , avail=avail+".$cur_leaves." WHERE empid =".$empid;
							$ccl=0;
						}
						$sql2 ="UPDATE ".$tmname." SET iccl=".$ccl.",  icl=".$next_leaves."-".$ccl.", avail=avail+".$next_leaves."  WHERE empid =".$empid;
					}
					else{
						$leavecl = $leaves;
						$sql ="UPDATE tblavailable SET cl=".$cl."-".$cur_leaves.",".$sql_part." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET cl=".$cl."-".$cur_leaves." WHERE empid =".$empid;
						$sql2 ="UPDATE ".$tmname." SET icl=icl+".$next_leaves.", avail=avail+".$next_leaves." WHERE empid =".$empid;
					}
				}
				$sql3 = "UPDATE tblleaves SET cl=".$leavecl.",ccl=".$leaveccl." WHERE id =".$leaveid;
			}
			// For leavetype is OD
			else if($leavetype == "OD"){
				$sql ="UPDATE tblavailable SET od=od+".$leaves." WHERE empid =".$empid;
				$sql1 ="UPDATE ".$fmname." SET od=od+".$leaves." WHERE empid =".$empid;
			}
			// For leavetype is AL
			else if($leavetype == "AL"){
				if($al>=$leaves){
					$sql ="UPDATE tblavailable SET al=al-".$leaves." WHERE empid =".$empid;
					$sql1 ="UPDATE ".$fmname." SET al=al-".$leaves." WHERE empid =".$empid;
				}
				/*else {
					if($ccl>=($leaves-$al)) {
						$leaveccl = $leaves-$al;
						$sql ="UPDATE tblavailable SET al=0, ccl=ccl-".($leaves-$al)." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET ccl=ccl-".$leaves.", avail=avail+".$leaves." WHERE empid =".$empid;
						
					}
					else if($ccl>0) {
						$leaveccl = $ccl;
						$leavecl = ($leaves-$al)-$ccl;
						$sql ="UPDATE tblavailable SET al=0, ccl=0, cl=".$ccl+$cl-($leaves-$al)." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET al=0, ccl=0, cl=".$ccl+$cl-($leaves-$al).", avail=avail+".($leaves-$al)." WHERE empid =".$empid;
					}
					else{
						$leavecl = $leaves-$al;
						$sql ="UPDATE tblavailable SET al=0, cl=".$cl."-".$leaves-$al." WHERE empid =".$empid;
						$sql1 ="UPDATE ".$fmname." SET al=0, cl=".$cl."-".$leaves-$al.", avail=avail+".$leaves-$al." WHERE empid =".$empid;
						//echo "<p>".$sql."</p>";
						//echo "<p>".$sql1."</p>";
					}
					$sql3 = "UPDATE tblleaves SET cl=".$leavecl.",ccl=".$leaveccl." WHERE id =".$leaveid;
					//$sql="UPDATE tblavailable SET al=0, cl=cl+al-".$leaves." WHERE empid =".$empid;
					//$sql1 ="UPDATE ".$fmname." SET al=0, cl=cl+al-".$leaves.", avail=avail+".$leaves." WHERE empid =".$empid;
				}*/
				
			}
			else if(($leavetype == "AN" || $leavetype == "FN") && $fromdaynumber == $currdaynumber ){
				
				$hl=0.5;
				if (in_array($fromdaynumber, $holidays)) $hl=0.0;
				
				if($ccl>0)
				{
					$sql1 ="UPDATE ".$fmname." SET ccl=ccl-".$hl.", avail=avail+".$hl."  WHERE empid =".$empid;	
				}
				else
				{
					$sql1 ="UPDATE ".$fmname." SET cl=cl-".$hl.", avail=avail+".$hl."  WHERE empid =".$empid;
				}
			}
		}
	}
	$result = mysqli_query($conn, $sql);
	if($sql1!="none")
		$result = mysqli_query($conn, $sql1);
	if($sql2!="none")
		$result = mysqli_query($conn, $sql2);
	if($sql3!="none")
		$result = mysqli_query($conn, $sql3);
	
	//echo "Leave type = ".$leavetype;
	echo "Updated SuccessFully";
	mysqli_close($conn);
	echo "<script type='text/javascript'> document.location = 'hod.php'; </script>";
?>