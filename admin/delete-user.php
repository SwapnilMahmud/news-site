<?php
include"config.php";
$s_id=$_GET['id'];

$sql="DELETE FROM  user WHERE user_id='{$s_id}'";
if(mysqli_query($conn,$sql)){
    header("Location:{$hostname}/admin/users.php");
}else{
  echo "<p style='color:red;margin:10px 0;'>cant delete user record</p>";
}
mysqli_close($conn);

 ?>
