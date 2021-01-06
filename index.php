<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    //session start
    session_start();

    require_once('components/database.php');
    require_once('components/components.php');
    
    $databaseInstance = new createDatabase("gadgetStore", "productDatabase");
    //declare statement to manipulate click event from session
    if(isset($_POST['add'])){
        //print_r($_POST['product_id']);

        if(isset($_SESSION['cart'])){

           $item_array_id = array_column($_SESSION['cart'], "product_id");

        //     print_r($item_array_id);

           if(in_array($_POST['product_id'], $item_array_id)){
                echo"<script>alert('product already in cart')</script>";
                echo" <script> window.location = index.php</script> ";
           }else{
               $count = count($_SESSION['cart']);
               $item_array = array(
                'product_id' => $_POST['product_id']
            );

            $_SESSION['cart'][$count] = $item_array;
            // print_r($_SESSION['cart']);
           }
        }else{
            $item_array = array(
                'product_id' => $_POST['product_id']
            );

            //create new session variable
            $_SESSION['cart'][0] = $item_array;
            //print_r($_SESSION['cart']);
        }
    }
?>
<header>
        <h1>Shopping store</h1>
        <div class="cart">
            <a href="cart.php"><span><img src="icons/3144456.svg" alt="">
            </span></a>
            <p><?php

                if(isset($_SESSION['cart'])){
                    $count = count($_SESSION['cart']);
                    echo "<span class=\"cart-count\">$count</span>";
                }else{
                    echo "<span class=\"cart-count\">0</span>";
                }

            ?></p>
        </div>
    </header>
    <!--container-->
    <div class="container">
        <div class="contents">
            <?php 
                $products = $databaseInstance->getData();
                if($products !== null)
                {
                    while($rows = mysqli_fetch_assoc($products)){
                        product($rows['product_name'], $rows['product_price'], $rows['product_image'], $rows['id']);
                    }
                }else{
                    echo "<h1 class=\"elseclass\"> You Have No Products in Your Store</h1>";
                }
            ?>
        </div>
    </div>
</body>
</html>