<?php 
	require 'DbConnect.php';

	if(isset($_POST['leid'])) {
		$db = new DbConnect;
		$conn = $db->connect();
		$stmt = $conn->prepare("SELECT FirstName, LastName FROM tblemployees WHERE EmpId = '" . $_POST['leid']."'");
		$stmt->execute();
		$employees = $stmt->fetchAll(PDO::FETCH_ASSOC);
		echo json_encode($employees);
	}
	
    if (isset($_POST['callFunc'])) {
        echo loademployees();
    }
	
	function loademployees() {
		$db = new DbConnect;
		$conn = $db->connect();

		$stmt = $conn->prepare("SELECT EmpId FROM tblemployees");
		$stmt->execute();
		$lempid = $stmt->fetchAll(PDO::FETCH_ASSOC);
		return json_encode($lempid);
	}
 ?>
