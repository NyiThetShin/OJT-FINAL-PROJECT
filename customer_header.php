<section class="user_header_ctn">
    <div class="logo">
        Logo
    </div>
    <div class="nav_icon_ctn">
        <a href="customer_home.php" style="text-decoration:none;color:black;"><i class="fa-solid fa-house"></i></a>
        <a href="shop.php" style="text-decoration:none;color:black;"><i class="fa-solid fa-shop"></i></a>
        <a href="about_us.php" style="text-decoration:none;color:black;"><i class="fa-solid fa-id-card"></i></a>
        <a href="contact.php" style="text-decoration:none;color:black;"><i class="fa-solid fa-phone"></i></a>
        <a href="order.php" style="text-decoration:none;color:black;"><i class="fa-solid fa-box-archive"></i></a>
    </div>
    <div class="search_item">
        <input type="search" placeholder="Search book..">
    </div>
    <div class="profile">
        <i class="fa-solid fa-user"></i>
    </div>
    <?php 
        
        $cart_quantity = mysqli_query($db,"SELECT * FROM `cart_tb` WHERE custm_id='$user_id'") or die('query failed');
        $number_qty = mysqli_num_rows($cart_quantity);
    ?>
    <div class="cart" >
        <a href="cart.php" style="text-decoration:none;color:black;"><i class="fa-solid fa-cart-arrow-down"></i></a>
        <span>(<?php  echo $number_qty?>)</span>
    </div>
    <div class="toggle_bar">
       <i class="fa-solid fa-bars-staggered"></i>
    </div>
</section>