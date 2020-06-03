<?php 
    include "../includes/header.php";
?>
<?php
    $itemList = getAllItemList();
    $_SESSION[SESSION_CON::$ITEM_ENTITY_LIST] = serialize($itemList);
?>

    <div class="col-sm-12">
        <h2>Goods list</h2>
        <form action="pro_branch.php" method="post">
            <table class="table table-bordered table-hover">
                <thead class="bg-secondary">
                    <th class="sticky-top bg-secondary">Index</th>
                    <th class="sticky-top bg-secondary">Code</th>
                    <th class="sticky-top bg-secondary">Image</th>
                    <th class="sticky-top bg-secondary">Name</th>
                    <th class="sticky-top bg-secondary">Price</th>
                    <th class="sticky-top bg-secondary">Profit Rate</th>
                    <th class="sticky-top bg-secondary">Shipment Fee</th>
                    <th class="sticky-top bg-secondary">Sale Price</th>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($itemList); $i++){ ?>
                    <?php $item = $itemList[$i]; ?>
                        <tr>
                            <td>
                                <input type="radio" name="index" value="<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </td>
                            <td>
                                <?php echo $item->code; ?>
                            </td>
                            <td class="w-25">
                                <div>
                                    <img 
                                        class="w-75" 
                                        src="<?php echo Con::$image_path . $item->file_name; ?>" 
                                        alt="">
                                </div>
                            </td>
                            <td><?php echo $item->name; ?></td>
                            <td><?php echo $item->price; ?></td>
                            <td><?php echo $item->profit_rate; ?></td>
                            <td><?php echo $item->shipment_fee; ?></td>
                            <td><?php echo getSalePrice($item); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div>
                <input type="submit" name="disp" value="Detail" class="btn btn-primary">
                <input type="submit" name="edit" value="Edit" class="btn btn-primary">
                <input type="submit" name="add_image" value="Add Image" class="btn btn-primary">
            </div>
            <div class="mt-2">
                <input type="submit" name="add_item" value="Add Item" class="btn btn-primary">
            </div>    
        </form>
        <div class="form-group mt-2">
            <a href="../staff_login/staff_top.php" class="btn btn-secondary">To top</a>
        </div>
    </div>
</body>
</html>