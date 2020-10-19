<?php 
	require 'DbConnect.php';

	//$result = mysqli_query($connect, $query); 

	if(isset($_POST['month'])) 
	{
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare('SELECT m.empid as empid,cl,ccl,od,al,avail,icl,iccl,FirstName, LastName,Department from '.$_POST['month'].' m join tblemployees e on e.EmpId=m.empid');
		$stmt->execute();
		$monthlydata = $stmt->fetchAll(PDO::FETCH_ASSOC);
		
		echo json_encode($monthlydata);
	}

	function loademployees() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare('SELECT m.empid as empid,cl,ccl,od,al,avail,icl,iccl,FirstName, LastName,Department from '.$_['month'].' m join tblemployees e on e.EmpId=m.empid');
		$stmt->execute();
		$monthlydata = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $monthlydata;
	}
 ?>
