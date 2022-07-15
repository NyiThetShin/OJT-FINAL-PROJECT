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
        .checkout_container{
            width:50%;
            height:10vh;
            margin:0 auto;
            display:flex;
            justify-content:center;
            align-items:center;
            padding:5px;
        
        }
        .checkout_card{
            width:200px;
            height:30px;
            margin-right:10px;
            padding:2px;
            border-radius:5px;
            border:1px solid black;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            box-shadow:2px 2px 2px black;
        }
        .checkout_card span{
            color:red;
        }
        .total{
            width:90%;
            margin:0 auto;
            display:flex;
            justify-content:center;
            padding:5px;
        }
        .total_sec{
            width:150px;
            padding:5px;
            border:1px solid black;
            box-shadow:2px 2px 2px black;
        }


        .form_control{
            width:90%;
            margin:0 auto;
              
        }
        h1{
            width:100%;
            text-align:center;
        }
        .main_control{
            width:60%;
            height:50vh;
            margin:0 auto;
            display:flex;
            justify-content:space-around;
              border:1px solid black;
              position: relative;
        }
        .one_form,.two_form{
            width:45%;
            padding:10px;
        }
        .one_form span,.two_form span{
            font-size:25px;
          
        }
        .one_form input ,.two_form input {
            width:350px;
            padding:5px;
            border-radius:10px;
            margin-top:10px;
        }
        .checkout_btn{
            width:150px;
            padding:5px;
            border-radius:10px;
            position:absolute;
            bottom:0px;
            left:50%;
            transform:translateX(-50%);
            margin-bottom:10px;
        }
    </style>
</head>
<body>

        <?php 
        
            if(isset($_POST['checkout'])){
                $name = $_POST['name'];
                $email = $_POST['email'];
                $city = $_POST['city'];
                $number = $_POST['number'];
                $address = $_POST['address'];
                $country = $_POST['country'];
                $placed_on = $_POST['date'];
                $cart_total= 0;
                 $cart_products[] = '';

        $select_query = mysqli_query($db,"SELECT * FROM `cart_tb` WHERE custm_id = '$user_id'") or die('query failed');
            if(mysqli_num_rows($select_query) > 0){
                while($fetch_query = mysqli_fetch_assoc($select_query)){
                     $cart_products[] = $fetch_query['cart_name'];
                    $sub_total = ($fetch_query['cart_price'] * $fetch_query['cart_qty']);
                    $cart_total += $sub_total;
                }
               
        }
         $total_products = implode(',',$cart_products);
         $order_query = mysqli_query($db,"SELECT * FROM `order_tb` WHERE custm_id = '$user_id' AND custm_name='$name' AND custm_number = '$number' AND custm_email = '$email' AND custm_address = '$address' AND total_price ='$cart_total' AND Date = '$placed_on'  ") or die('query failed');
                if($cart_total == 0){
                    echo "there haven\'t any item";
                }else{
                    if(mysqli_num_rows($order_query) > 0){
                         echo  'your order is already have!';
                     }else{
                        mysqli_query($db,"INSERT INTO `order_tb` (custm_id, custm_name, custm_number, custm_email, custm_address,order_qty, total_price, Date) VALUES ('$user_id' , '$name','$number','$email','$address','$total_products','$cart_total','$placed_on')") or die('query failed');
                        echo  "your order information is successfully !";
                        mysqli_query($db,"DELETE FROM `cart_tb` WHERE custm_id = '$user_id'");
                    }
                }
            }
        
        
        
        ?>










    <?php require_once "customer_header.php"?>
    <section>
        <div class="checkout_container">
            <?php 
                 $grand_total = 0;
                  $select_cart = mysqli_query($db,"SELECT * FROM  `cart_tb` WHERE custm_id = '$user_id'") or die('query failed');
                   if(mysqli_num_rows($select_cart) > 0){
                   while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                       $total_price = ($fetch_cart['cart_price'] * $fetch_cart['cart_qty']);
                       $grand_total += $total_price;
            ?>

            <div class="checkout_card">
                <p><?php echo $fetch_cart['cart_name']?> <span class="price_qu">($<?php echo $fetch_cart['cart_price']?> x <?php echo $fetch_cart['cart_qty']?>)</span></p>
            </div>



            <?php
                   }
                }else{
                    echo "<p>your cart is empty</p>";
                }
                
            ?>

        </div>
        <div class="total"><div class="total_sec">Grand Total : <span class="final_total">$<?php echo $grand_total ?></span></div></div>
    </section>

    <section class="checkout_form-control">
        <h1>PLACE YOUR ORDER</h1>
        <form action="checkout.php" method="post" class="main_control">
            <div class="one_form">
               <span>your name:</span> <br>
                <input type="text" name="name" placeholder="Enter your name" required><br>
                  <span>your email:</span><br>
                <input type="email" name="email" placeholder="Enter your email" required><br>
                
                  <span>your city:</span><br>
                <input type="text" name="city" placeholder="Enter your city" required><br>
                <span>date</span><br>
                <input type="date" name ="date" placeholder="date.." required>
            </div>
            <div class="two_form">
                <span>your number:</span><br>
                <input type="number" name="number" placeholder="Enter your number" required><br>
                <span>Payment method:</span><br>
                <select name="method" class="optional" >
                    <option value="cash on delivery">cash on delivery</option>
                    <option value="credit card">credit card</option>
                    <option value="paypal">paypal</option>
                    <option value="visa">visa</option>
                </select><br>
                <span>your address:</span><br>
                <input type="text" name="address" placeholder="e.g. street name"  required><br>
                <span>your country:</span><br>
                <input type="text" name="country" placeholder="e.g. myanmar"  required><br>
                
            </div> 
            <button class="checkout_btn" name="checkout">Checkout</button>
        </form>
    </section>
</body>
</html>