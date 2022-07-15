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
        section{
            width:80%;
            margin:0 auto;
           
        }
        h1{
            width:100%;
             text-align: center;
        }
        .order_container{
            width:100%;
            display:flex;
            flex-wrap:wrap;
            padding:5px;
        }
        .card{
            width:300px;
            heigth:300px;
            border:1px solid black;
            box-shadow:2px 2px 2px black;
            border-radius:10px;
            padding:5px;
            margin-right:10px;
        }
        p{
            width:100%;
            margin-bottom:10px;
        }
    </style>
</head>
<body>
        
    <?php  require_once "customer_header.php"?>

        <section>

            <h1>Place Orders</h1>
            <div class="order_container">
                <?php 
             
             $select_order = mysqli_query($db,"SELECT * FROM `order_tb` WHERE custm_id = '$user_id'") or die('query failed ');
             if(mysqli_num_rows($select_order) > 0){
                 while($fetch_order = mysqli_fetch_assoc($select_order)){
             ?>
                <div class="card">
                 <p>Placed On : <span><?php echo $fetch_order['Date'] ?></span></p>
                 <p>name : <span><?php echo $fetch_order['custm_name'] ?></span></p>
                 <p>number : <span><?php echo $fetch_order['custm_number'] ?></span></p>
                 <p>email : <span><?php echo $fetch_order['custm_email'] ?></span></p>
                 <p>address : <span><?php echo $fetch_order['custm_address'] ?></span></p>
                 <p>total_products : <span><?php echo $fetch_order['order_qty'] ?></span></p>
                 <p>total_price : <span><?php echo $fetch_order['total_price'] ?></span></p>
                </div>
            </div>
            <?php 
                     }
             }else {
                        echo '<p>no orders placed yet !</p>';
                    }
            
            ?>
        </section>

</body>
</html>