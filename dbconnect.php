<?php
 // this will avoid mysql_connect() deprecation error.
 error_reporting( ~E_DEPRECATED & ~E_NOTICE );


 define('DBHOST', 'localhost');
 define('DBUSER', 'root');
 define('DBPASS', '');
 define('DBNAME', 'mandorfer_thomas_bigshop_2');

 $conn = mysqli_connect(DBHOST,DBUSER,DBPASS,DBNAME);
 mysqli_query($conn, "SET NAMES 'utf8'");


 if ( !$conn ) {
  die("Connection failed : " . mysqli_error());
 }


 ?>
