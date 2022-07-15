<?php 
    require_once "database.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/login.css">
</head>
<?php 


if(isset($_POST['register'])){
  $name = mysqli_real_escape_string($db,$_POST['user_name']);
  $email = mysqli_real_escape_string($db,$_POST['user_email']);
  $password = mysqli_real_escape_string($db,$_POST['user_password']);
  $cpassword = mysqli_real_escape_string($db,$_POST['confirm_password']);

  

  $select_result= mysqli_query($db,"SELECT * FROM `custm_tb` WHERE custm_email='$email' AND password='$password'") or die('query failed!');

  if(mysqli_num_rows($select_result) > 0){
    echo "user already exists";
  }else {
    mysqli_query($db," INSERT INTO custm_tb (custm_name,custm_email,password) VALUES ('$name','$email','$password')" );
    echo "register is successfully ";
    header("location:customer_login.php");
  }


}


?>
<body>
     <div class="container">
        <div class="sub_container">
            <form action="customer_register.php" method="post">
                <div class="User_name">
                    <label for="user_name">UserName:</label><br>
                    <input type="text" name="user_name" placeholder="Enter your Name" id="user_name">
                </div>
                  <div class="User_email">
                    <label for="user_email">UserEmail:</label><br>
                    <input type="email" name="user_email" placeholder="Enter your Email" id="user_email">
                </div>
                  <div class="User_password">
                    <label for="user_password">UserPassword:</label><br>
                    <input type="password" name="user_password" placeholder="Enter UserName" id="user_password">
                </div>
                  <div class="Confirm_password">
                    <label for="confirm_password">Confirm Password:</label><br>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" id="confirm_password">
                </div>
               
                <div class="register_ctn">
                  <button type="submit" name="register">Register</button><span> already account?<a href="customer_login.php">Login</a></span>
                </div>
            </form>
        </div>
    </div>
</body>
</html>