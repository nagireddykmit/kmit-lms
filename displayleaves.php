<?php 
$eid=$_SESSION['eid'];
$sql = "SELECT LeaveType,COUNT(*) from tblleaves GROUP BY LeaveType HAVING COUNT(*)>1 where empid=:eid";
$query = $dbh -> prepare($sql);
$query->bindParam(':eid',$eid,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{               ?>  
                                        <tr>
                                           
                                           <td><?php echo htmlentities($result->LeaveType);?></td>
                                            <td><?php echo htmlentities($result->noofdays);?></td>
                            <?
                                            {
echo htmlentities('success');
                                            } else
{

 echo htmlentities('error in query');
}
?></td>


<?php 
$eid=$_SESSION['eid'];
$sql1 = "SELECT LeaveType,COUNT(*) from tblleaves GROUP BY LeaveType HAVING COUNT(*) > 1 where empid=:eid";
$q = mysqli_query($conn,$sql1);
if (mysqli_num_rows($q) > 0) 
{
	$res='';
	while ($r = mysqli_fetch_assoc($q))
	{    
?>
                                         
										   
                                           <td><?php echo $r['LeaveType'];?></td>
                                            <td><?php echo $r['noofdays'];?></td>
                            <?
                                            {
echo htmlentities('success');
                                            } else
{

 echo htmlentities('error in query');
}
	}
}
?></td>