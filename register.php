<?php
 ob_start();
 session_start(); // start a new session or continues the previous
 if( isset($_SESSION['user'])!="" || isset($_SESSION['login'])){
  header("Location: home.php"); // redirects to home.php
 }
 include_once 'dbconnect.php';
 $error = false;
 if ( isset($_POST['btn-signup']) ) {

  // sanitize user input to prevent sql injection
  $firstname = trim($_POST['firstname']);
  $firstname = strip_tags($firstname);
  $firstname = htmlspecialchars($firstname);

  $lastname = trim($_POST['lastname']);
  $lastname = strip_tags($lastname);
  $lastname = htmlspecialchars($lastname);

  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);

  $pass = trim($_POST['pass']);  // remove whitespace
  $pass = strip_tags($pass); // remove html and php tags
  $pass = htmlspecialchars($pass); // special characters to html code

  // basic firstname validation
  if (empty($firstname)) {
   $error = true;
   $firstNameError = "Please enter your full name.";
  } else if (strlen($firstname) < 3) {
   $error = true;
   $firstNameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$firstname)) {
   $error = true;
   $firstNameError = "Name must contain alphabets and space.";
  }

  // basic lastname validation
  if (empty($lastname)) {
   $error = true;
   $lastNameError = "Please enter your full name.";
  } else if (strlen($lastname) < 3) {
   $error = true;
   $lastNameError = "Name must have atleat 3 characters.";
  } else if (!preg_match("/^[a-zA-Z ]+$/",$lastname)) {
   $error = true;
   $lastNameError = "Name must contain alphabets and space.";
  }

  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
  } else {
   // check whether the email exist or not
   $query = "SELECT email FROM USERS WHERE email='$email'";
   $result = mysqli_query($conn, $query);
   $count = mysqli_num_rows($result);
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }


  // password encrypt using SHA256();
  $password = hash('sha256', $pass);

  // if there's no error, continue to signup
  if( !$error ) {

   $query = "INSERT INTO USERS(firstname,lastname,email,userPass) VALUES('$firstname','$lastname','$email','$password')";
   $res = mysqli_query($conn, $query);

   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($firstname);
    unset($lastname);
    unset($email);
    unset($pass);
   } else {
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later...";
   }

  }


 }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Login & Registration System</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
    <style>
    button{
      width:10% !important;
    }


    </style>
    <div class="container">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">


             <h2>Sign Up.</h2>
             <hr />

            <?php

   //old code error

   if(isset($errMSG)){
     echo "<div class=\"alert\">";
     echo $errMSG;
     echo "</div>";
   }
   ?>



            <div class="form-group">
             <input type="text" name="firstname" class="form-control" placeholder="Enter Firstname" maxlength="100" value="<?php echo $name ?>" />

                <span class="text-danger"><?php echo $firstNameError; ?></span>
            </div>
            <div class="form-group">
            <input type="text" name="lastname" class="form-control" placeholder="Enter Lastname" maxlength="100" value="<?php echo $name ?>" />

                   <span class="text-danger"><?php echo $lastNameError; ?></span>
            </div>


            <div class="form-group">
             <input type="email" name="email" class="form-control" placeholder="Enter Your Email" maxlength="40" value="<?php echo $email ?>" />

                <span class="text-danger"><?php echo $emailError; ?></span>
            </div>



            <div class="form-group">
             <input type="password" name="pass" class="form-control" placeholder="Enter Password" maxlength="15" />

                <span class="text-danger"><?php echo $passError; ?></span>
             <hr />
             </div>


             <button type="submit" class="btn btn-block btn-primary" name="btn-signup">Sign Up</button>
             <hr />
             <a href="index.php">Sign in Here...</a>


    </form>
  </div>
</body>
</html>
<?php ob_end_flush(); ?>
