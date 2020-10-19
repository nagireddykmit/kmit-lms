<?php
session_start();
$conn = mysqli_connect('localhost:3306', 'root', 'root','kmitelms');
if (!$conn)
  {
  die('Could not connect: ' . mysqli_error());
  }
   $name = $_SESSION['emplogin'];
$sql ="SELECT * FROM tblemployees
    WHERE EmailId ='".$name."'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
	$str='';
	while ($row = mysqli_fetch_assoc($result))
	{
	
?>


<html>
<head> 
<title>Employee Information</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-3" style="background-color:orange;">
			<img src="img/profile/<?php echo $row['EmpId'] ; $empid=$row['EmpId'];?>.jpg" class="card" onerror="this.onerror=null;this.src='img/pic.jpg';" height=300px width=200px align="centre" />
			<h3> <?php echo $row['FirstName'] . " " . $row['LastName']; ?></h3>
			<h5> Dept: <?php echo $row['Department'] ; ?></h5>
			<h5> Contact : <em><?php echo $row['Phonenumber'] ; ?></em></h5>
			<h5> Email: <em> <?php echo $row['EmailId'] ; ?></em></h5>

		</div>
	<?php
		}
	}
	$sql ="SELECT * FROM tblavailable WHERE empid ='".$empid."'";
	$result = mysqli_query($conn, $sql);

	if (mysqli_num_rows($result) > 0) {
	$str='';
	while ($row = mysqli_fetch_assoc($result))
	{
	?>
		
	
</div>
</div>
<?php
	}
}
mysqli_close($conn);
?>

</body>
</html>