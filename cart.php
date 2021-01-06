<?php
    //session start
    session_start();

    require_once('components/database.php');
    require_once('components/components.php');

    $databaseInstance = new createDatabase("gadgetStore", "productDatabase");
    
    
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>
    <link rel="stylesheet" href="cart-page.css">
</head>
<body>

<header>
        <h1><a href="index.php">Shopping store
            </a></h1>
        <div class="cart">
            <a href="cart.php"><span><img src="icons/3144456.svg" alt="">
            </span></a>
            <p><?php
                if(isset($_SESSION['cart']))
                {
                    $count = count($_SESSION['cart']);
                    echo "<span class=\"cart-count\">$count</span>";
                }else
                {
                    echo "<span class=\"cart-count\">0</span>";
                }
            ?></p>
        </div>
    </header>
<!-- body -->
<hr>
<div class="body">
    <div class="left">
<!--        <p>My Shopping cart</p>-->
        <?php
        
            $product_id = array_column($_SESSION['cart'], 'product_id');
            $result =   $databaseInstance   ->  getData();
            


            //display cart items from session using 'if' 'else' to declear the instance, 
            //using while to assign session variables form db to row
            // using for each to loop throung evry instance of the while statement

            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0)
            {
                while($row = mysqli_fetch_assoc($result))
                {
                    foreach($product_id as $id)
                    {
                        if($row['id'] == $id)
                        {
                            cartElement($row['product_image'], $row['product_name'], $row['product_price'], $row['id']);
                        }
                    }
                }
            }
            else
            {
                echo "<h1 class=\"elseclass\"> Your Cart Is Empty</h1>";
            }

            //manipulating session to unset session variables when remove is cliclicked in the form

            if (isset($_POST['action']) && $_POST['action'] == 'remove')
            {
                foreach ($_SESSION['cart'] as $index => $value)
                {
                    if($value["product_id"] == $_GET['id'])
                    {
                        unset($_SESSION['cart'][$index]);
                        
                        echo "<script>alert('Product Has Been Removed...')</script>";
                        echo "<script>window.open('cart.php', '_self', 'location=yes')</script>";
                    }
                }
            }

            


        ?>

    
    </div>
    
</div>
    
</body>
</html>