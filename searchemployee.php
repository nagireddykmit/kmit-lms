<?php
session_start();
$conn = mysqli_connect('localhost:3306', 'root', 'root','kmitelms');
if (!$conn)
  {
  die('Could not connect: ' . mysql_error());
  }
    $name = $_POST['name'];
 
$sql ="SELECT * FROM tblemployees
    WHERE FirstName LIKE '%".$name."%' OR LastName LIKE '%".$name."%' ";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$str='';
	while ($row = mysqli_fetch_assoc($result))
	{
			$str=$str."<br />".$row['EmpId']." " . $row['FirstName'] . " " . $row['LastName'].  " "  . $row['EmailId'] ." " . $row['Phonenumber'];			
	}
	$_SESSION['RESULT123']=$str;
}
		
header('Location: hod.php#123');
mysqli_close($conn);

?>

