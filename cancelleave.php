<?php
session_start();
error_reporting(0);
$lid=$_GET['leaveid'];
$conn = mysqli_connect('localhost:3306', 'admin', 'kmit@3306','finalelms');
$sql = "DELETE FROM tblleaves WHERE id=".$lid;
if (mysqli_query($conn, $sql)) {
    echo "Record deleted successfully";
	echo "<script type='text/javascript'> document.location = 'leavehistory.php'; </script>";
} else {
    echo "Error deleting record: " . mysqli_error($conn);
}
mysqli_close($conn);
?>
