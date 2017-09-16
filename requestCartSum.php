<?php
  include 'dbconnect.php';
 ?>
<?php
session_start();
if(isset($_SESSION['cartID'])){
  $selStatement = "SELECT sum(PRODUCT.ProductPrice*ProductInCart.quantity) AS 'SubTotal' FROM PRODUCT,ProductInCart WHERE PRODUCT.productID=ProductInCart.productID AND ProductInCart.cartID=? AND ProductInCart.quantity > 0";
  $stmt = mysqli_prepare($conn, $selStatement);
  mysqli_stmt_bind_param($stmt, 'i', $_SESSION['cartID']);
  if(mysqli_stmt_execute($stmt)){
    $res = mysqli_stmt_get_result($stmt);
    $resArray = array();
    while($row = mysqli_fetch_assoc($res)){
      array_push($resArray,$row);
    }
    echo json_encode($resArray);
  }else{
    echo mysqli_error($connection);
  }
}
?>
