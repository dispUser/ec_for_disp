<?php
    include_once('header.php');

    if(isset($_GET['search'])){
        $search = true;
    }else{
        $search = false;
    }

    $dispFrom = '';
    $dispTo = '';
    $dispKeyword = '';

    if($search){

        $from = 0;
        $to = 99999;
        $keyword = '';
        
        if(isset($_GET['from'])  && $_GET['from'] != ''){
            $from = $_GET['from'];
            $dispFrom = $from;
        }
        if(isset($_GET['to']) && $_GET['to'] != ''){
            $to = $_GET['to'];
            $dispTo = $to;
        }
        if(isset($_GET['keyword']) && $_GET['keyword'] != ''){
            $keyword = $_GET['keyword'];
            $dispKeyword = $keyword;
            $keyword = str_replace(' ', '%', $keyword);
        }

        $itemList = getSearchItemList($keyword, $from, $to);
    }
?>
<article id="search">
    <div class="content_width">
        <div class="search-box">
            <form action="search.php" method="get">
                <div class="search-box__condition_box">
                    <div class="search-box__group_box">
                        <div class="search-box__group-item">
                            <label for="keyword">Keyword</label>
                            <input type="text" name="keyword" id="keyword" value="<?php print $dispKeyword?>">
                        </div>
                    </div>
                    <div class="search-box__group_box">
                        <div class="search-box__group-item">
                            <label for="">Price</label>
                        </div>
                        <div class="search-box__group-item">
                            <label for="from-price">From</label>
                            <input type="number" name="from" id="from-price" value=<?php print $dispFrom ?>>
                        </div>
                        <div class="search-box__group-item">
                            <label for="to-price">To</label>
                            <input type="number" name="to" id="to-price" value=<?php print $dispTo ?>>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Search" class="search-box__button" name="search">
            </form>
        </div>
    </div>
</article>
<article id="result">
    <div class="content_width">
        <div class="result_box">
            <?php if($search){ ?>
                    <h2 class="heading--center--min-hight">Result</h2>
                    <p class="text--search-result-count">
                        <span><?php echo count($itemList); ?> items found</span>
                    </p>
                    <div class="card-unit">
                    <?php for($i = 0; $i < count($itemList); $i++){ ?>
                        <?php $item = $itemList[$i]; ?>
                            <div class="item-card">
                                <a class="item-card__link" 
                                   href="shop_product.php?procode=<?php echo $item->code; ?>
                                        &image_code=<?php echo $item->image_code; ?>">
                                    <div class="item-card__image-box">
                                        <img 
                                            src="/gamz_watch/src/admin/product/gazou/<?php echo $item->file_name;?>" 
                                            alt="test"
                                            class="item-card__img">
                                    </div>
                                    <h3 class="item-card__text">
                                        <?php echo $item->name; ?>
                                    </h3>
                                    <div class="item-card__text text--price">
                                        <?php echo getSalePrice($item)?> Pesos
                                    </div>
                                </a>
                            </div>
                    <?php } ?>
                    <div class="clear"></div>
                    </div>
            <?php } ?>
        </div>
    </div>
</article>

<?php
    include "footer.php";
?>
