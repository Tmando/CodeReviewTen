<?php
 ob_start();
 session_start();
 require_once 'dbconnect.php';

 // it will never let you open index(login) page if session is set
 if ( isset($_SESSION['user'])!="" ) {
  header("Location: home.php");
  exit;
 }

 $error = false;

 if( isset($_POST['btn-login']) ) {

  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs

  if(empty($email)){
   $error = true;
   $emailError = "Please enter your email address.";
  } else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  }

  if(empty($pass)){
   $error = true;
   $passError = "Please enter your password.";
  }

  // if there's no error, continue to login
  if (!$error) {

   $password = hash('sha256', $pass); // password hashing using SHA256

   $res=mysqli_query($conn, "SELECT userId, firstname, lastname,email,userPass FROM USERS WHERE email='$email'");
   $row=mysqli_fetch_array($res, MYSQLI_ASSOC);
   $count = mysqli_num_rows($res); // if uname/pass correct it returns must be 1 row

   if( $count == 1 && $row['userPass']==$password ) {
    $_SESSION['user'] = $row['userId'];
    header("Location: home.php");
   } else {
    $errMSG = "Incorrect Credentials, Try again...";
   }

  }

 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login & Registration System</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
@import url('https://fonts.googleapis.com/css?family=Lato|Patua+One');
h2{
  font-size: 18pt;
  font-family: 'Patua One', cursive !important;
}
button{
  width:10% !important;
}
</style>
</head>
<body>
    <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">

             <h2>Big Shop</h2>
             <hr />

            <?php
   if ( isset($errMSG) ) {
echo $errMSG; ?>

                <?php
   }
   ?>



             <div class="form-group"><input type="email" name="email" class="form-control" placeholder="Your Email" value="<?php echo $email; ?>" maxlength="40" />

             <span class="text-danger"><?php echo $emailError; ?></span>
             </div>



             <div class="form-group"><input type="password" name="pass" class="form-control" placeholder="Your Password" maxlength="15" />

            <span class="text-danger"><?php echo $passError; ?></span>
            </div>
             <hr />
             <div class="form-group"><button class="btn btn-block btn-primary" type="submit" name="btn-login">Sign In</button></div>


             <hr />

             <a href="register.php">Sign Up Here...</a>


    </form>
    </div>

</body>
</html>
<?php ob_end_flush(); ?>
