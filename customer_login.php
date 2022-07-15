<?php 

    require_once "database.php";
    session_start();


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


        if(isset($_POST['login'])){

        $email = mysqli_real_escape_string($db,$_POST['user_email']);
        $password = mysqli_real_escape_string($db,$_POST['user_password']);

        

        $select_result= mysqli_query($db,"SELECT * FROM `custm_tb` WHERE custm_email='$email' AND password='$password'") or die('query failed!');
        if(mysqli_num_rows($select_result) > 0) {
            $item = mysqli_fetch_assoc($select_result);

            
                $_SESSION['user_email'] = $item['custm_email'];
                $_SESSION['user_name'] = $item['custm_name'];
                $_SESSION['user_id'] = $item['custm_id'];
                header("location:customer_home.php");
           
          
        }else {
            echo "Incorrect email or password";
        }
        
        



        }


?>
<body>

 

    



    
    <div class="container">
        <div class="sub_container">
            <form action="customer_login.php" method="post">
              
                  <div class="User_email">
                    <label for="user_email">UserEmail:</label><br>
                    <input type="email" name="user_email" placeholder="Enter your Email" id="user_email">
                </div>
                  <div class="User_password">
                    <label for="user_password">UserPassword:</label><br>
                    <input type="password" name="user_password" placeholder="Enter UserName" id="user_password">
                </div>
               
             
                <div class="register_ctn">
                  <button type="submit" name="login">Login</button><span> have you not been account?<a href="customer_register.php">Register</a></span>
                </div>
            </form>
        </div>
    </div>












</body>
</html>