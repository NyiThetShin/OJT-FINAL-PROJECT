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
          
.form_control{
    width: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}
 .add_cart,.detail{
        margin-top: 5px;
        display: inline-block;

      
    }
   /* about us start */
        .about_us{
            width: 90%;
            margin: 0 auto;
            height: 40vh;
            border: 1px solid red;
            display:flex;
        }
        .about_img_ctn{
            width:50%;
            height:100%;
        }
        .about_img_ctn img{
            width:100%;
            height:100%;
            object-fit: cover;
        }
        .about_text{
            width:50%;
            height:100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
     /* about us end */

     /* contact us start  */
     .contact_us{
            width:90%;
            height: 40vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align:center;
            margin:0 auto;
            border:1px solid black;
    }
     /* contact us end  */
    /* footer start  */
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
     /* footer end  */


    </style>
</head>
<body>
<!-- header section start  -->
<?php  require_once "customer_header.php"?>
<!-- header section end  -->

<!-- discover start  -->
    <section class="discover"><a href="">Discover More</a></section>
<!-- discover end  -->






<?php 

if(isset($_POST['add'])){
    $custom_id = 1;
    $id = $_POST['id'];
    $name= $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $select_book = mysqli_query($db,"SELECT * FROM `cart_tb` WHERE custm_id='$user_id'  ") or die('query failed');
    if(mysqli_num_rows($select_book) > 0){
        echo "your book is already added!";
    }else{
        mysqli_query($db,"INSERT INTO `cart_tb` (pd_id,cart_qty,cart_name,cart_price,custm_id) VALUES ('$id','$quantity','$name','$price','$custom_id')");
        echo "book is successfully added!";
    }
}







?>












<!-- show product start  -->

    <section class="show_product_ctn">
        <h1>latest books</h1>
        <div class="book_product_ctn">

        <?php 
        
            $select_product = mysqli_query($db,"SELECT * FROM `product_tb` LIMIT 8") or die("query failed");
            if(mysqli_num_rows($select_product) > 0) {
                while($fetch_product = mysqli_fetch_assoc($select_product)){

                
        ?>
           
                <div class="card">
                    <form action="" method="post" class="form_control">
                        <input type="hidden" name="id" value="<?php echo $fetch_product['pd_id']?>">
                        <input type="hidden" name="name" value="<?php echo $fetch_product['pd_name'] ?>">
                        <input type="hidden" name="price" value="<?php echo $fetch_product['pd_price'] ?>">
                      
                        <div class="img_ctn">
                            <img src="./image/epic-fantasy-books-header-min-2.jpg" alt="">
                        </div>
                        <p><?php echo $fetch_product['pd_name']?></p>
                        <p><?php echo $fetch_product['pd_price']?></p>
                       
                        <input type="number" value="1" min="1" class="num_input" name="quantity">
                         <button class="detail" name="detail"><a href="detail.php?detail=<?php  echo $fetch_product['pd_id']?>" style="text-decoration:none;color:black;">Detail</a></button>
                        <button class="add_cart" name="add">Add Cart</button>
                       
                    </form>
                </div>
          
          <?php
        
        }
    }else{
        echo "<p>No Product!</p>";
    }
        
        ?>
        </div>
    </section>


<!-- show product end  -->

<!-- about us start  -->

<section class="about_us">

    <div class="about_img_ctn">
        <img src="./image/Bluestocking-ft-scaled.jpg" alt="">
    </div>
    <div class="about_text">
       <h1 style="font-size:30px;font-weight:800">About us</h1>
       <p> Lorem ipsum dolor sit amet consectetur adipisicing elit. Neque, quibusdam.</p>
       <button style="cursor:pointer;padding:5px;border-radius:5px"><a href="collection.php" style="text-decoration:none;color:black">Read More</a></button>
    </div>
</section>

<!-- about us end  -->
<!-- contact us start  -->

    <section class="contact_us">
        <h1 style="font-size:30px;font-weight:800">HAVE ANY QUESTIONS?</h1>
        <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magni, impedit.</p>
        <button style="cursor:pointer;padding:5px;border-radius:5px"><a href="contact_us.php" style="text-decoration:none;color:black">Contact Us</a></button>
    </section>



<!-- contact us end  -->

<!-- footer start  -->
      <?php  require_once "footer.php";?>
<!-- footer end  -->

</body>
</html>