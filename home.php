<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['user']) ) {
  header("Location: index.php");
  exit;
}else{
  $_SESSION['login'] = True;
}
 // select logged-in users detail
 $res=mysqli_query($conn, "SELECT * FROM USERS WHERE userId=".$_SESSION['user']);
 $userRow=mysqli_fetch_array($res, MYSQLI_ASSOC);

?>
<!DOCTYPE html>
<html>
<head>
<link href="//cdn.rawgit.com/noelboss/featherlight/1.7.8/release/featherlight.min.css" type="text/css" rel="stylesheet" />
<meta charset="UTF-8">
<title>Welcome - <?php echo $userRow['firstname'] ." " . $userRow['lastname'] ?></title>
<style>
  /*
  .imgrow{
    margin-top: 5vh;
  }
  .imgrow img{
    border:2px solid #cb2356;
  }
  .container{
    background-color: rgba(226, 61, 128,0.2);
  }
  @import url('https://fonts.googleapis.com/css?family=Raleway');
    h1{
      font-family: 'Raleway', sans-serif;
      font-size:15pt;
    }
    */
    @import url('https://fonts.googleapis.com/css?family=Lato|Patua+One|Passion+One');
    button{
      font-family: 'Lato', cursive !important;
      font-size:15pt !important;
    }
    h1{
      font-size: 20pt;
      font-family: 'Lato', cursive !important;
    }
    h2{
      font-size: 18pt;
      font-family: 'Lato', cursive !important;
    }
    .itemContainer{
      margin-top: 10vh;
    }
    .product{
      color:rgb(127,127,127);
      font-family: 'Lato', cursive !important;
      font-size: 15pt;
    }
    .price{
      color:red;
    }
    .productItem{
      font-family: 'Lato', cursive !important;
      color:rgb(127,127,127);
    }
    .priceItem{
      color: red;
    }
    .detailBtn{
      color:green;
    }
    .itemRow{
      margin-top: 3vh;
    }
    #subTotal h2{
      font-size: 15pt;
      font-family: 'Lato', cursive !important;
      color:rgb(127,127,127);
    }
    .lightbox{
      display: none;
    }
    #btnElem button{
      font-family: 'Lato', cursive !important;
      color:rgb(127,127,127);
    }
    .row {
      display: -webkit-box;
      display: -webkit-flex;
      display: -ms-flexbox;
      display:         flex;
      flex-wrap: wrap;
    }
    .row > [class*='col-'] {
      display: flex;
      flex-direction: column;
    }









</style>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body onload="loadItems();removeFromCart();">
  <?php
  include"navbar.php";

   ?>
   <div class="container itemContainer">
     <div class="row">
       <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" id="items">

       </div>
       <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" >
       <div class="row">
          <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="cart">
          </div>
      </div>
       <div class="row" id="subTotal">
        <div class="col-lg-12">
        <h1>Cart Totals</h1>
        <h2 id="subTotalRes"></h2>
        <p><span id="btnElem"></div></p>
       </div>
       </div>
       </div>
     </div>


   </div>
   <script>
   function parseItems(result){
     itemArray = JSON.parse(result);
     tag = "";
     for(i=0;i<itemArray.length;i++){

       if(i%4==0){
         tag+="<div class=\"row\">";
       }
       tag += createItem(itemArray[i]);
       if(((i+1)%4)==0){
         tag+="</div>";
       }
     }
     if(itemArray.length%4 != 0){
       tag += "</div>";
     }
     console.log(tag);
     $('#items').append(tag);
     addProductToCart();
   }
   function loadItems(){
     console.log('Hallo 1');
     $.ajax({
        type: "POST",
        url: "itemRequest.php",
        data: "",
        success: function(result){parseItems(result)}
    });
    }
    function updateCartSum(){
      $.ajax({
         type: "POST",
         url: "requestCartSum.php",
         data: "",
         success: function(result){parseCartSum(result)}
     });
    }
    function parseCartSum(result){
      if(result != ''){
      itemArray = JSON.parse(result);
      subtotalStr = 'Subtotal ' + "<span class=\"priceItem\">"+itemArray[0].SubTotal + '€' + "</span>";
      $('#subTotalRes').html(subtotalStr);
      btnStr = "<button onclick=\"checkout()\" class=\"btn btn-default\">"+"Proceed to checkout"+"</button>";
      $('#btnElem').html(btnStr);
      }
    }
    function checkout(){
      $.ajax({
         type: "POST",
         url: "checkout.php",
         data: "",
         success: function(result){removeCart(result);}
     });
    }
    function removeCart(res){
      boolStr = 'True ' + res
      console.log(boolStr);
      if(res == 1){
        $("#cart").html("");
        $("#btnElem").html("");
        $("#subTotalRes").html("");

      }
    }
     /*
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() {
      console.log(this.readyState);
      console.log(this.status);
      if (this.readyState == 4 && this.status == 200) {
        var itemArray = JSON.parse(this.responseText);
        console.log('Hallo 2');
        console.log(itemArray);
        for(i=0;i<itemArray.length;i++){
          tag = "";
          if(i%4==0){
            tag+="<div class=\"row\">";
          }
          tag += createItem(itemArray[i]);
          if((i%4+1)==0){
            tag+="</div>";
          }
        }
        if(itemArray.length%4 != 0){
          tag += "</div>";
        }
        console.log(tag);
        $('#items').append(tag);
      };
      xhttp.open("POST", "itemRequest.php", false);
      xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      xhttp.send();
      */


   function createItem(item){
      tag = "";
      tag += "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 productBack\">";
      tag += "<div class=\"row\">";
      tag +=  "<div class=\"col-lg-10 col-md-10 col-sm-10 col-xs-10\">";
      tag +=  "<img class=\"img-responsive\" src=" + item.productImage + ">";
      tag +=  "</div>";
     tag += "</div>";
     tag += "<div class=\"row product\">";
    tag +=   "<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12\">";
    tag +=    item.productName;
    tag +=    "</div>";
    tag += "</div>";
    tag += "<div class=\"row\">";
    tag +=    "<div class=\"col-lg-6 col-md-6 col-sm-6 col-xs-6\">";
    tag +=    "<p class=\"price\">"+ item.ProductPrice + "€" + "</p>";
    tag +=    "<p class=\"detailBtn\"><a href=\"#\"data-featherlight=\"#mylightbox\">Details</a></p>";
    tag +=    "</div>";
    tag +=    "<div class=\"col-lg-5 col-md-5 col-sm-5 col-xs-5\">";
    tag +=    "<button value=\""+item.productID+"\"class=\"btn-link productAdd\"><img class=\"img-responsive\" src=\"img/ic_add_shopping_cart_black_24dp_2x.png\"></button>";
    tag +=    "</div>";
    tag += "</div>";
    tag += "</div>";
    return tag;
   }
   function renderCart(cartArray){
     console.log('Cart Array ', cartArray);
     if(cartArray && cartArray != "" && cartArray != " "){
     itemArray = JSON.parse(cartArray);
     tag = "";
     for(i=0;i<itemArray.length;i++){
       tag += buildCartItem(itemArray[i]);
     }
     $('#cart').html(tag);
     updateCartSum();
     }
   }
   function removeFromCart(curButton){
       console.log('Button Remove');
       var productID = $(curButton).val();
       console.log(productID);
       dataString = "productID="+productID;
       $.ajax({
          type: "POST",
          url: "removeItemCart.php",
          data: dataString,
          success: function(result){renderCart(result);}
      });
      updateCartSum();
   }
   function buildCartItem(cartArray){
     tag = "";
     tag += "<div class=\"row itemRow\">";
      tag += "<div class=\"col-lg-3\">";
      tag += "<img class=\"img-responsive\" src=\"" +cartArray.productImage +"\">";
      tag += "</div>";
      tag += "<div class=\"col-lg-3 col-md-3 col-sm-3 col-xs-3 productItem\">";
      tag += cartArray.productname;
      tag += "</div>";
      tag += "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 productItem\">";
      tag += cartArray.quantity + "x";
      tag += "</div>";
      tag += "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2 productItem priceItem\">";
      tag += cartArray.Price + "€"
      tag += "</div>";
      tag += "<div class=\"col-lg-2 col-md-2 col-sm-2 col-xs-2\">";
      tag += "<button onclick=\"removeFromCart(this)\"value=\"" + cartArray.productID +"\"class=\"btn-link removeButton\"><img src=\"img/ic_delete_black_24dp_1x.png\"></button>";
      tag += "</div>";
    tag +="</div>";
    return tag;
   }
   function addProductToCart(){
     $(".productAdd").click(function(){
       console.log('Hallo1');
       productID = $(this).val();
       dataString = "productID="+productID;
       $.ajax({
          type: "POST",
          url: "addItemCart.php",
          data: dataString,
          success: function(result){renderCart(result);}
      });

    });

   }
   </script>


</body>
</html>
<?php ob_end_flush(); ?>
