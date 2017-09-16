<?php
  include 'dbconnect.php';
 ?>
<?php
session_start();
if(isset($_SESSION['cartID'])){
  $selStatement = "INSERT INTO Checkout(cartID) VALUES (?)";
  $stmt = mysqli_prepare($conn, $selStatement);
  mysqli_stmt_bind_param($stmt, 'i', $_SESSION['cartID']);
  if(mysqli_stmt_execute($stmt)){
    unset($_SESSION['cartID']);
    echo True;
  }else{
    echo mysqli_error($connection);
  }
}
?>
