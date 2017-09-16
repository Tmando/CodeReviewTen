<?php
  include 'dbconnect.php';

 ?>
<?php
  $sql="Select * FROM PRODUCT";
  $res = mysqli_query($conn,$sql);
  $myArray = array();
  if($res){
    while($row = mysqli_fetch_assoc($res)){
      array_push($myArray,$row);
    }
    echo json_encode($myArray);
  }else{
    echo $myArray;
  }





















 ?>
