<?php 
    require_once "database.php";
    session_start();
        $user_id = $_SESSION['user_id'];
if(!isset($user_id)){
    header('location:customer_login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/user_home.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <style>
        .contact_form{
            width:80%;
            height:60vh;
            margin:0 auto;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        .contact_ctn{
            width:600px;
            height:300px;
            border:1px solid black;
            border-radius:10px;
            box-shadow:2px 2px 2px black;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
        }
        h1{
           text-align:center;
        }
        input{
            width:400px;
            padding:5px;
            border-radius:5px;
            margin-top:10px;
        }
        textarea{
            width:400px;
            margin-top:10px;
        }
        button{
            width:100px;
            padding:5px;
            cursor:pointer;
        }
                 .footer{
            width: 90%;
            margin: 0 auto;
            height: 20vh;
            border: 1px solid black;
            display:flex;
            flex-direction: column;
            jsutify-content:center;
            align-items: center;
    }
    
    .icon_container{
        width: 100%;
        display: flex;
        justify-content: center;
        margin-top:20px
    }
    .icon_container i{
        font-size: 25px;
        margin-right: 20px;
    }
    .copy_right{
    width: 100%;
    text-align: center;
    margin-top:10px;
    font-size:20px;
}
    </style>
</head>
<body>
    <?php require_once "customer_header.php";?>

<?php 

if(isset($_POST['submit'])){
    $name = $_POST['user_name'];
    $email = $_POST['user_email'];
    $number = $_POST['user_number'];
    $des = $_POST['user_des'];

    if($name="" AND  $email = "" AND $number = "" AND $des = "" ){
        header('location:contact.php');
    }else{
        $select_message = mysqli_query($db,"SELECT * FROM `message` WHERE name='$name' AND email='$email' AND description ='$des'") or die('query failed');
        if(mysqli_num_rows($select_message) > 0){
            echo "your message is already send!";
        }else{
            $send_message = mysqli_query($db,"INSERT INTO `message` (custm_id,name,email,number,description) VALUES('$custm_id','$name','$email','$number','$des')") or die('query failed');
        }
    }


}




?>
    <section class="contact_form">
        <form action="contact.php" method="post">
            <div class="contact_ctn">
                <h1>Say Something!</h1>
                <div><input type="text" placeholder="Enter your name" name="user_name"></div>
                <div><input type="email" placeholder="Enter your email" name="user_email"></div>
                <div><input type="text" placeholder="Enter your number" name="user_number"></div>
                <div><textarea cols="30" rows="3" name="user_des"></textarea></div>
                <button name="submit">Submit</button>
            </div>
        </form>
    </section>



<?php  require_once "footer.php"?>
</body>
</html>