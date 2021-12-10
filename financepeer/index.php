<?php
session_start();
$_SESSION['user_name']= "";
$_SESSION['var']= "";
$errors = array();
if(isset($_POST["login"]))
{
    include ("includes/dbConnection.php");
    $uname = strip_tags($_POST["user_name"]);
    $uname = str_replace(' ','',$uname);
    $uname = ucfirst($uname);
    $email = strip_tags($_POST["user_email"]);
    $email = str_replace(' ','',$email);
    $pass = $_POST["password"];
    if(empty($uname)){
    array_push($errors,"User name is required !");
    }
    if(empty($email)){
    array_push($errors,"Email is required !");
    }
    if(filter_var($email,FILTER_VALIDATE_EMAIL)){ // Email validity
    $email = filter_var($email,FILTER_VALIDATE_EMAIL);
    }
    else{
    array_push($errors,"Invalid email !");
    }
    if(empty($pass)){
    array_push($errors,"Password is required !");
    }
    if(count($errors) == 0){
    $password = md5($pass);
    $fetch_query = "SELECT * FROM `users` WHERE `u_name` = '$uname' AND `u_email` = '$email 'AND `u_password` = '$password' LIMIT 1";
    $login_result = mysqli_query($sqlcon,$fetch_query);
    $user_validity = mysqli_num_rows($login_result);
    if($user_validity > 0)
    {
    $_SESSION['user_nam'] = $login_result->fetch_assoc();
    header("Location: panel.php");
    }
   else
   {
   $_SESSION['var'] = "Wrong user name or Password";
   }
 }
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <title>Financepeer</title>
</head>

<body>
    <div class="container">
        <div class="main-div" style="margin-top: 150px;">
            <form action="index.php" method="post" class="form-group">
                <h1 class="text-center" style="color: #a9a9a9; font-size: 30px; font-family: sans-serif;">Login</h1>
                <div style="margin-top: 20px;">
                    <input type="text" id="uname" name="user_name" class="form-control" placeholder="Enter User name">
                    <?php if(in_array("User name is required !", $errors)){echo "<span class='error'>User name is required !</span>";}?>
                </div>
                <div style="margin-top: 20px;">
                    <input type="email" id="email" name="user_email" class="form-control" placeholder="Email">
                    <?php if(in_array("Email is required !", $errors)){echo "<span class='error'>Email is required !</span>";}?>
                    <?php if(in_array("Invalid email !", $errors)){echo "<span class='error'>Invalid email !</span>";}?>
                </div>
                <div style="margin-top: 20px;">
                    <input type="password" id="password" name="password" class="form-control" placeholder="Password">
                    <?php if(in_array("Password is required !", $errors)){echo "<span class='error'>Password is required !</span>";}?>
                </div>
                    <a class="nav-link d-block small text-center" href="register.php">Don't have account, Register for new Account</a>
                <div class="form-group">
                    <button type="submit" name="login" class="form-control btn btn-primary" style="margin-top: 15px;">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>