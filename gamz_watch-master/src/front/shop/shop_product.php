<?php
    include_once("header.php");
?>
<?php
    $pro_code = $_GET['procode'];
    $image_code = $_GET['image_code'];

    $itemList = getItemByCode($pro_code, $image_code);

    if($itemList > 0){
        $item = $itemList[0];
    }else{
        echo 'no item';
        exit();
    }

    if($item->file_name == ""){
        $disp_gazou = '';
    }else{
        $disp_gazou = '<img src="../../admin/product/gazou/'.$item->file_name.'">';
    }
?>
    <article id="item_detail">
        <div class="content_width">
            <div class="item_row">
                <div class="image_box">
                    <div class="image_container">
                        <?php print $disp_gazou; ?>
                    </div>
                </div>
                <div class="detail_box">
                    <div class="main_info">
                        <div class="product_name">
                            <?php print $item->name; ?>
                        </div>
                        <div>
                            <span class="text--price text--bold text--size-120"><?php print getSalePrice($item); ?> Pesos</span>
                        </div>
                    </div>
                    <div class="cartin-button-box">
                        <a class="button button-primary" 
                            href="shop_cartin.php?procode=<?php print $pro_code?>&image_code=<?php echo $item->image_code ?>">
                            <i class="text--primary fas fa-cart-arrow-down"></i>
                            Add to Cart
                        </a>
                    </div>
                    <!-- <a href="shop_cartin.php?procode=<?php print $pro_code?>">
                        <div class="favorite_button">
                            <i class="fas fa-heart"></i>
                            Add to Favorite
                        </div>
                    </a> -->
                    <form action="pro_edit_check.php" method="post">
                        <div class="back-button-box">
                            <input type="button" onclick="history.back()" value="Back" class="button">
                        </div>
                    </form>
                </div>
                <div class="clear"></div>
            </div>
        </div>
    </article>
<?php
    include("footer.php");
?>