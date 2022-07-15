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
        .detail_ctn{
            width:80%;
            height:60vh;
            border:1px solid black;
            margin:0 auto;
            margin-top:10px;
            display:flex;
            justify-content:space-between;
            padding:10px;
        }
        .image_ctn{
            width:35%;
            height:100%;
            overflow: hidden;
        }
        .image_ctn img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .book_detail{
            width:60%;
            height:80%;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:5px;
        }
        .text{
            width:100%;
            height:60%;
            
        }
        p{
            font-size:20px;
            margin-bottom:20px;
        }
        .btn{
            width:80%;
            margin:0 auto;
            display:flex;
            justify-content:flex-end;
              margin-top:3px;
        }
        button{
            width:100px;
            padding:5px;
            border-radius:5px;
           cursor: pointer;
        }
        a{
            text-decoration:none;
            color:black;
        }
        span{
            color:red;
        }
        .button{
            margin-top:5px;
        }
        input{
            width:250px;
            padding:5px;
            border-radius:5px;
        }
        .add{
            width:150px;
            padding:5px;
            border-radius:5px;
            
        }
    </style>
</head>

        <?php 
        
            if(isset($_GET['detail'])){
               $product_id = $_GET['detail'];
              
            }
        
            if(isset($_POST['add_to_cart'])){
                $quantity = $_POST['quantity'];
                $name = $_POST['name'];
                $price = $_POST['price'];
                $id = $_POST['id'];


                $select_cart =mysqli_query($db,"SELECT * FROM `cart_tb` WHERE custm_id = '$custm_id'") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0){
                    echo "your book is already added!";
                }else{
                    mysqli_query($db,"INSERT INTO `cart_tb` (pd_id,cart_qty,cart_name,cart_price,custm_id) VALUES ('$id','$quantity','$name','$price','$custm_id') " )  or die('query failed');
                    header('location:cart.php');
                }

            }



        ?>


<body>
    <?php  require_once "customer_header.php"?>
    <?php 
    
            $select_detail = mysqli_query($db,"SELECT * FROM `product_tb` WHERE pd_id = '$product_id' ") or die('query failed');
            if(mysqli_num_rows($select_detail) > 0 ){
                while($fetch_detail = mysqli_fetch_assoc($select_detail)){


     ?>

        <form action="detail.php" method="post">
            <section class="detail_ctn">
            
                <div class="image_ctn">
                    <img src="./image/epic-fantasy-books-header-min-2.jpg" alt="">
                </div>
                <div class="book_detail">
                   <div class="text">
                    <input type="hidden" name="name" value="<?php  echo $fetch_detail['pd_name']?>" >
                     <input type="hidden"  name="price" value="<?php echo   $fetch_detail['pd_price']?>" >
                    <input type="hidden"  name="id" value="<?php echo  $fetch_detail['pd_id']?> ">
                     <p>Name:<span ><?php  echo $fetch_detail['pd_name']?></span></p>
                    <p>Writer:</p>
                    <p>Publish date:</p>
                    <p>Price:<span><?php  echo $fetch_detail['pd_price']?></span></p>
                    <p>Others:<span><?php echo $fetch_detail['pd_detail'] ?></span></p>
                   </div>
                   <div class="button">
                    <input type="number" value="<?php  echo $fetch_detail['pd_qty']?>" min="1" name="quantity">
                    <button class="add" name="add_to_cart">Add to cart</button>
                   </div>
                </div>
                    
                
            </section>
      </form>
        <div class="btn"><button><a href="customer_home.php">Back</a></button></div>




    <?php               
                }
            }
    
    ?>
    
    
</body>
</html>