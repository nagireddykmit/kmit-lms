<?php
//fetch.php
$connect = mysqli_connect('localhost:3306', 'admin', 'kmit@3306','finalelms');
$output = '';
$result='';
if(isset($_POST["query"]))
{
 $search = mysqli_real_escape_string($connect, $_POST["query"]);
 $query = "
  SELECT * FROM tblemployees 
  WHERE EmpId LIKE '%".$search."%'
  OR FirstName LIKE '%".$search."%'
  OR Department LIKE '%".$search."%'
  OR LastName LIKE '%".$search."%' 
  OR EmailId LIKE '%".$search."%' 
  OR Phonenumber LIKE '%".$search."%'
  OR Designation LIKE '%".$search."%'
 
  
 ";
 $result = mysqli_query($connect, $query);
}
else
{
	if(isset($_SESSION['dept']))
	{
		$dept=$_SESSION['dept'];
		$query1 = "SELECT * FROM tblemployees where department=".$dept." ORDER BY EmpId ";
		$result = mysqli_query($connect, $query1);
	}
	else{
		$query1 = "SELECT * FROM tblemployees ORDER BY EmpId ";
		$result = mysqli_query($connect, $query1);
	}
}
if(mysqli_num_rows($result) > 0)
{
 $output .= '
   <table class="table table-striped table-responsive table-bordered" id="Employees" cellspacing="0" style="table-layout: auto;width: 100%;" >
    <thead>
	<tr>
	<th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">EmpID</th>
     <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">User Name</th>
     <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Designation</th>
     <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">D.O.J</th>
	 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Gender</th>
     <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Department</th>
	 <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">Email ID</th>
     <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">PhoneNumber</th>
     <th class="th-sm" style="font: small-caps bold 14px/30px Georgia, serif;">JNTU-UID</th>
     
    </tr>
	</thead>
	<tbody>
 ';
 while($row = mysqli_fetch_array($result))
 {
  $output .= '
   <tr class="item">
    <td style="font: small-caps 15px/30px Georgia, serif;"><a href="hodviewemployee.php?empid='.$row["EmpId"].'">'.($row["EmpId"]).'</a></td>
    <td style="font: small-caps 15px/30px Georgia, serif;">'.($row["FirstName"]).' '.($row["LastName"]).'</td>
    <td style="font: small-caps 15px/30px Georgia, serif;">'.($row["Designation"]).'</td>
    <td style="font: small-caps 15px/30px Georgia, serif;">'.($row["doj"]).'</td>
    <td style="font: small-caps 15px/30px Georgia, serif;">'.($row["Gender"]).'</td>
    <td style="font: small-caps 15px/30px Georgia, serif;">'.($row["Department"]).'</td>
	<td style="font: small-caps 15px/30px Georgia, serif;">'.$row["EmailId"].'</td>
    <td style="font: small-caps 15px/30px Georgia, serif;" align="center">'.($row["Phonenumber"]).'</td>
    <td style="font: small-caps 15px/30px Georgia, serif;">'.($row["jntu_uid"]).'</td>
    
   </tr>
  ';
 }
 $output .="</tbody>";
 
 echo $output;
}
else
{
 echo 'Data Not Found';
}

?>