<?php

#header component
function headerSection($count){
    
    $header = "
    
    ";
    echo $header;
}

#count function to number of items on session and display as cart item count
function cartcount()
{
    if(isset($_SESSION['cart'])){
        $count = count($_SESSION['cart']);
        echo "<span class=\"cart-count\">$count</span>";
    }else{
        echo "<span class=\"cart-count\">0</span>";
    }

}


//products components making calls to contents from database

function product($name, $price_main, $image,$productId)
{
    //static discount 
    $price_discount = $price_main + 120;
    $products ="
    
    <form action=\"index.php\" method=\"post\">
    <div class=\"products\">
        <div class=\"image\">
            <img src=\"$image\" alt=\"\">
        </div>
        <div class=\"name\">
            <h1>$name</h1>
            <h2><s>$$price_discount</s></h2>
            <h2>$$price_main</h2>
        </div>
        <button type='submit' name='add' class='add-to-cart'><p>Add To Cart  <img src='icons/3144456.svg' alt=\"\" width='10px'></p></button>
        <input type='hidden' class='add-to-cart'  name='product_id' value='$productId'>
    </div>
    </form>

    ";
echo $products;
}

//cart page form to make calls for dynamic details from session to display on cart page!!

function cartElement($image, $name, $price,$productid)
{
    $cart = "
    
        <form class=\"cart-section\" method=\"post\" action=\"cart.php?id=$productid\">
            <img src=$image alt=\"\">
            <div class=\"details\">
                <h2>$name</h2>
                <h5>Seller Name</h5>
                <h2>$$price</h2>
                <div class=\"button\">
                    <button type=\"submit\" value=\"\">Save For Later</button>
                    <button type=\"submit\" name=\"action\" value=\"remove\">Remove</button>
                </div>
            </div>
            
        </form>
    
    ";
    echo $cart;
}



