<?php  
$target_path = "C:\xampp\htdocs\elms-test\oduploads\";  
$target_path = $target_path.basename( $_FILES['odupload']['name']);   
  
if(move_uploaded_file($_FILES['odupload']['tmp_name'], $target_path)) {  
    echo "od uploaded successfully!";  
}
 else{  
    echo "Sorry, od not uploaded, please try again!";  
}  
?>  