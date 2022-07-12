<?php 
 require_once "database.php";
 $custm_id = 1;
 
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

        .cart_show_product{
            width:90%;
            margin:0 auto;
            border:1px solid black;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            padding:10px;
        }
        .cart_show_product h1{
            width:100%;
            text-align:center;
        }
        .book_container{
            width:100%;
            display:flex;
            padding:10px;
        }
        .book_card{
            width:300px;
            height:300px;
            border:1px solid black;
            border-radius:10px;
            box-shadow:2px 2px 2px black;
            display:flex;
            flex-direction:column;
            justify-content:center;
            align-items:center;
            position: relative;
        }
        .cart_img_ctn{
            width:200px;
            height:200px;
        }
        .cart_img_ctn img{
            width:100%;
            height:100%;
            object-fit:cover;
        }
        .update{
            margin-top:5px;
        }
        .cross{
            position: absolute;
            top:5px;
            right:5px;
            font-size:20px;
            cursor:pointer;
        }
     .all_delete{
        width:100px;
        padding:5px;
        border:1px solid black;
        text-align:center;
        margin-bottom:5px;
     }
     .all_delete a{
        text-decoration:none;
        color:black;
     }
     .total_amount{
        width:100%;
        border:1px solid black;
        padding:5px;
        text-align:center;
     }
     span{
        color:red;
     }
     .c_s,.checkout{
        padding:5px;
     }
     .c_s a ,.checkout a {
        text-decoration:none;
        color:black;
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

<?php 

     if(isset($_POST['update'])){
        $qty = $_POST['quantity'];
        $updated_id =$_POST['id'];
        mysqli_query($db,"UPDATE  `cart_tb` SET cart_qty = '$qty' WHERE pd_id = '$updated_id'") or die('query failed');
        echo "your book quantity updated!";
     }


?>
<?php 

     if(isset($_GET['delete'])){
        $del_id = $_GET['delete'];
        mysqli_query($db,"DELETE FROM `cart_tb` WHERE pd_id = '$del_id'");
     }


?>
<?php 

     if(isset($_GET['delete_all'])){
        mysqli_query($db,"DELETE FROM `cart_tb` WHERE custm_id='$custm_id'");
     }

?>
    
    <?php  require_once "customer_header.php"?>
    <section class="cart_show_product">
        <h1>Book in your cart</h1>
        <div class="book_container">
            <?php 
                $grand_total = 0;
                $select_cart = mysqli_query($db,"SELECT * FROM `cart_tb`") or die('query failed');
                if(mysqli_num_rows($select_cart) > 0) {
                    while($fetch_cart = mysqli_fetch_assoc($select_cart)){
            ?>



            <div class="book_card">
              <a href="cart.php?delete=<?php echo $fetch_cart['pd_id']?>" style="text-decoration:none;color:black;" onclick="return confirm('Are you sure you want to delete!')"> <i class="fa-solid fa-xmark cross"></i></a>
                <div class="cart_img_ctn">
                    <img src="./image/epic-fantasy-books-header-min-2.jpg" alt="">
                </div>
                <h3><?php echo $fetch_cart['cart_name']?></h3>
                <p><?php echo $fetch_cart['cart_price']?></p>
                <form action="cart.php" method="post">
                        <input type="hidden" value="<?php echo $fetch_cart['pd_id']?>" name="id">
                        <input type="number" value="<?php  echo $fetch_cart['cart_qty']?>" name='quantity' min='1'>
                        <input type="submit" value="Update" name="update" class="update">
                </form>
                
                <div>Total Price:<span style="color:red"><?php echo $sub_total = $fetch_cart['cart_qty'] * $fetch_cart['cart_price']?></span></div>
            </div>
            
            
            <?php 
                $grand_total +=$sub_total;
                            }
                }else{
                    echo "<p>Sorry,There is no any product!</p>";
                }
            
            ?>
            
        </div>
        <div class="all_delete">
            <a href="cart.php?delete_all" class="del_al <?php echo ($grand_total > 1)? '' : 'disabled' ;?>" onclick="return confirm('Do you want to delte all item?')" >Delete All</a>
        </div>
    <div class="total_amount">
            <p>Grand Total : <span class="g_t"> <?php echo $grand_total?> </span> </p>
            <button class="c_s"><a href="shop.php">Continue Shopping</a></button>
            <button class="checkout"><a href="checkout.php" style="color:black">CheckOut</a></button>
    </div>
    </section>

<?php  require_once "footer.php"?>

</body>
</html>