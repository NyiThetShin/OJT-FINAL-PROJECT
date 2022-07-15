<?php 


$db = mysqli_connect('localhost','root','','book_store');
if(!$db){
    echo "your data base is not connected!";
}


$sql = "CREATE TABLE IF NOT EXISTS admin_tb(


admin_id INT NOT NULL AUTO_INCREMENT ,
admin_name VARCHAR (225),
admin_email VARCHAR (225),
user_role VARCHAR (225),
admin_pswd VARCHAR (20),
PRIMARY KEY ( admin_id )


)";

$result1 = mysqli_query($db,$sql) or die("query failed");

if(!$result1 ) {
    echo "database is not success for create!";
}


$custm = "CREATE TABLE IF NOT EXISTS custm_tb(


custm_id INT NOT NULL AUTO_INCREMENT ,
custm_name VARCHAR (225),
custm_email VARCHAR (225),
custm_ph INT (20),
custm_address VARCHAR (225),
message VARCHAR (2000),
PRIMARY KEY ( custm_id )


)";

$result2 = mysqli_query($db,$custm) or die("query failed");

if(!$result2 ) {
    echo "database is not success for create!";
}

$product = "CREATE TABLE IF NOT EXISTS product_tb(


pd_id INT NOT NULL AUTO_INCREMENT ,
pd_name VARCHAR (225),
pd_qty VARCHAR (225),
pd_price INT (20),
pd_detail VARCHAR (225),
PRIMARY KEY ( pd_id )


)";

$result3 = mysqli_query($db,$product) or die("query failed");

if(!$result3 ) {
    echo "database is not success for create!";
}


$cart = "CREATE TABLE IF NOT EXISTS  cart_tb(


cart_id INT NOT NULL AUTO_INCREMENT ,
pd_id INT (11),
cart_qty INT (100),
cart_price INT (20),
total_price INT (225),
cart_session_id VARCHAR (225),
custm_id INT (225),
cart_date DATETIME,
PRIMARY KEY ( cart_id )


)";

$result4 = mysqli_query($db,$cart) or die("query failed");

if(!$result4 ) {
    echo "database is not success for create!";
}

$message = "CREATE TABLE IF NOT EXISTS message(
 
 id INT NOT NULL AUTO_INCREMENT,
 custm_id INT (11),
 name VARCHAR (225),
 email VARCHAR (225),
 number INT (225),
 description VARCHAR (225),
 PRIMARY KEY (id)

)";
$result6 = mysqli_query($db,$message) or die('query failed');

if(!$result6) {
    echo "database is not success for create!";
}












$order = "CREATE TABLE IF NOT EXISTS  order_tb(


order_id INT NOT NULL AUTO_INCREMENT ,
custm_id INT (11),
custm_name VARCHAR (100),
custm_num  VARCHAR(225),
custm_email VARCHAR (225),
custm_address VARCHAR (225),
total_products VARCHAR (225),
total_price VARCHAR (225),
cart_session_id VARCHAR (225),
confirm_payment VARCHAR (225),
order_date DATE,
PRIMARY KEY ( order_id )


)";

$result5 = mysqli_query($db,$order) or die("query failed");

if(!$result5 ) {
    echo "database is not success for create!";
}


?>

<?php 


$regsiter = "CREATE TABLE IF NOT EXISTS register (

    Id INT NOT NULL AUTO_INCREMENT,
    Name VARCHAR (225),
    Email VARCHAR (225),
    Password VARCHAR (225),
    PRIMARY KEY (Id)



)";
$result7 = mysqli_query($db,$regsiter) or die ('query failed');
if(!$result7) {
    echo "database is not success for create!";
}




?>