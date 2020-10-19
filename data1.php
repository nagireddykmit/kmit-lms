<?php 
	require 'DbConnect.php';
	for($i=1;<$i<=10;$i++)
	{
		if(isset($_POST['aempid'.$i])) {
			$db = new DbConnect;
			$conn = $db->connect();
			
			$stmt = $conn->prepare("SELECT FirstName, LastName FROM tblemployees WHERE  EmpId=".$EmpId);
			$stmt->execute();
			$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
			echo json_encode($employees);
		}
	}
	function loadEmpId() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT EmpId FROM tblemployees");
		$stmt->execute();
		$empids = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return $empids;
	}

 ?>
