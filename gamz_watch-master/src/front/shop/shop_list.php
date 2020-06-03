<?php
    include("header.php");
?>
<?php
    $newItemList = getNewItemList();
    $rankItemList = getRankItemList();
?>
    <article id='jumbotron'>
        <div class="jumbotron">
            <h2 class="jumbotron__text">Watch that engraves memories</h2>
        </div>
    </article>
    <article id='new'>
        <div class="content-width">
            <h2 class="heading--center">New Items</h2>
            <div class="card-unit">
                <?php for($i = 0; $i < count($newItemList); $i++){ ?>
                    <div class="item-card card-unit__item">
                        <a  class="item-card__link" 
                            href="shop_product.php?procode=<?php print $newItemList[$i]->code ?>&image_code=<?php echo $newItemList[$i]->image_code ?>">
                            <div class="item-card__image-box">
                                <img class="item-card__img" 
                                     src="../../admin/product/gazou/<?php print $newItemList[$i]->file_name; ?>">
                            </div>
                            <p class="item-card__text"><?php print $newItemList[$i]->name ?></p>
                            <p class="item-card__text text--price"><?php print getSalePrice($newItemList[$i]); ?> Pesos</p>
                        </a>
                    </div>
                <?php } ?>
                <div class="clear"></div>
            </div>
        </div>
    </article>
    <article id='popular'>
    <div class="content-width">
        <h2 class="heading--center">Popular Items</h2>
        <div class="card-unit">
            <?php for($i = 0; $i < count($rankItemList); $i++){ ?>
                <div class="item-card">
                    <a class="item-card__link" href="shop_product.php?procode=<?php print $rankItemList[$i]->code ?>&image_code=<?php echo $rankItemList[$i]->image_code ?>">
                        <div class="item-card__image-box">
                            <img class="item-card__img" 
                                 src="../../admin/product/gazou/<?php print $rankItemList[$i]->file_name; ?>">
                        </div>
                        <p class="item-card__text"><?php print $rankItemList[$i]->name ?></p>
                        <p class="item-card__text text--price"><?php print getSalePrice($rankItemList[$i]); ?> Pesos</p>
                    </a>
                </div>
            <?php } ?>
            <div class="clear"></div>
        </div>
    </div>
</article>
    <?php        
        include("footer.php");
    ?>
</body>
</html>