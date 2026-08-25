<?php

function component($productname, $productprice, $productimg, $productid,$productdescription, $language){
    $randomNumber = rand(2, 5);
    $element = "
    
    <div class=\"col-md-3 col-sm-6 my-3 my-md-0\">
                <form action=\"$language.php\" method=\"post\">
                    <div class=\"card shadow\">
                        <div>
                            <a href=\"product_detail_page.php?id=$productid&name=$productname&price=$productprice&img=$productimg&detail=$productdescription&language=$language\">
                            <img  src=\"spotify/${language}_album_each_page/photo/$productimg\"alt=\"Image1\" class=\"img-fluid card-img-top\">
                            </a>
                        </div>
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                            <h6>";
    for($i = 1;$i <= $randomNumber ;$i++)
    {
        $element.= "<i class=\"fas fa-star\"></i>";
    }
    for($i = 1;$i <= 5-$randomNumber ;$i++)
    {
        $element.= "<i class=\"far fa-star\"></i>";
    }
                                // <i class=\"fas fa-star\"></i>
                                // <i class=\"fas fa-star\"></i>
                                // <i class=\"fas fa-star\"></i>
                                // <i class=\"fas fa-star\"></i>
                                // <i class=\"far fa-star\"></i>
    $element .=
                            "</h6>
                            <p class=\"card-text\">";
    $element .= 
                                mb_substr($productdescription, 0, 30) ." ...
                            </p>
                            <h5>
                                <small><s class=\"text-secondary\">$519</s></small>
                                <span class=\"price\">$$productprice</span>
                            </h5>
                            <button type=\"submit\" class=\"btn btn-warning my-3\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                             <input type='hidden' name='product_id' value='$productid'>
                             <input type='hidden' name='product_language' value='$language'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}

function cartElement($productimg, $productname, $productprice, $productid, $language,$quantity){
    $price = $productprice*$quantity;
    $element = "
    
    <form action=\"./cart.php?action=remove&id=$productid&language=$language\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 pl-0\">
                                <img src=\"/group_17/spotify/${language}_album_each_page/photo/$productimg\" alt=\"Image1\" class=\"img-fluid\">
                            </div>
                            <div class=\"col-md-6\">
                                <h5 class=\"pt-2\">$productname</h5>
                                <small class=\"text-secondary\">Seller: dailytuition</small>
                                <h5 class=\"pt-2\">$price</h5>
                                <button type=\"submit\" class=\"btn btn-warning\">Save for Later</button>
                                <button type=\"submit\" class=\"btn btn-danger mx-2\" name=\"remove\">Remove</button>
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <div>
                                    <button type=\"submit\" name=\"minus\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button>
                                    <input type=\"text\" value=\"$quantity\" class=\"form-control w-25 d-inline\">
                                    <button type=\"submit\" name=\"add\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}




