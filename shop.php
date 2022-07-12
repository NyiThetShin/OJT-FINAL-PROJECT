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
    
        require_once "customer_header.php";
    ?>
    
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
                         <button class="detail" name="detail">Detail</button>
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
    <?php require_once "footer.php"; ?>
</body>
</html>