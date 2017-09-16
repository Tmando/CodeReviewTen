<?php
  include 'dbconnect.php';
 ?>
<?php
session_start();
if(isset($_SESSION['cartID'])){
  $productID = $_POST['productID'];
  if(isset($_POST['productID'])){
    $sql = "UPDATE ProductInCart SET quantity = quantity-1 WHERE productID=? AND cartID=? AND quantity > 0";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, 'ii', $productID, $_SESSION['cartID']);
    if(mysqli_stmt_execute($stmt)){
      returnCart($conn);
    }else{
      echo mysqli_error($conn);
    }
  }
}

function returnCart($connection){
  if(isset($_SESSION['cartID'])){
    $selStatement = "SELECT PRODUCT.productID, PRODUCT.productname, PRODUCT.productImage,PRODUCT.ProductPrice*ProductInCart.quantity AS 'Price' ,ProductInCart.quantity FROM PRODUCT,ProductInCart,Cart WHERE PRODUCT.productID=ProductInCart.productID AND ProductInCart.cartID=? AND ProductInCart.cartID=Cart.cartID AND Cart.userID=? AND ProductInCart.quantity > 0 ORDER BY PRODUCT.productID";
    $stmt = mysqli_prepare($connection, $selStatement);
    mysqli_stmt_bind_param($stmt, 'ii', $_SESSION['cartID'],$_SESSION['user']);
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

}
?>
