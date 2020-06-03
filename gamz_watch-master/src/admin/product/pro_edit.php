<?php
    include "../includes/header.php";
?>
<?php
    $index = $_GET['index'];
    $itemList = unserialize($_SESSION[SESSION_CON::$ITEM_ENTITY_LIST]);
    $item = $itemList[$index];
?>
    <div class="col-sm-12">
        <h2>Item edit</h2>
        <form action="pro_edit_check.php" method="post" enctype="multipart/form-data">
            <input type="hidden" name="code" value="<?php print $item->code; ?>">
            <input type="hidden" name="gazou_name_old" value="<?php print $item->file_name; ?>">
            <input type="hidden" name="image_code" value="<?php print $item->image_code; ?>">
            <table class="table">
                <thead>
                    <th>Code</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Profit rate</th>
                    <th>Shipment fee</th>
                    <th>Selling price</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php echo $item->code; ?>
                        </td>
                        <td class="form-group">
                            <input
                                class="form-control"
                                type="text" 
                                name="name" 
                                value="<?php print $item->name ?>">
                        </td>
                        <td class="form-group">
                            <input 
                                class="form-control"
                                type="text" 
                                name="price" 
                                value="<?php print $item->price ?>" 
                                id="item_price">
                        </td>
                        <td class="form-group">
                            <input 
                                class="form-control"
                                type="text" 
                                name="profit_rate" 
                                value="<?php print $item->profit_rate ?>" 
                                id="profit_rate">
                        </td>
                        <td class="form-group">
                            <input 
                                class="form-control"
                                type="text" 
                                name="shipment_fee" 
                                value="<?php print $item->shipment_fee ?>" 
                                id="shipment_fee">
                        </td>
                        <td class="form-group">
                            <input 
                                class="form-control"
                                type="text" 
                                name="sale_price" 
                                value="<?php print getSalePrice($item) ?>" 
                                id="sale_price">
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <h3>Select Image</h3>
                <?php if($item->file_name != ''){ ?>
                    <div class="mb-2">
                        <img class="w-25 img-rounded" src="gazou/<?php echo $item->file_name; ?>" alt="test">
                    </div>
                <?php } ?>
                <div class="custom-file">
                    <label for="gazou" class="custom-file-label"></label>
                    <input class="custom-file-input" type="file" name="gazou" id="gazou">
                </div>
            </div>

            <div class="form-group">
                <input 
                    type="button" 
                    onclick="history.back()" 
                    value="Go back" 
                    class="btn btn-secondary">
                <input type="submit" value="OK" class="btn btn-success">
            </div>
        </form>
    </div>
    <script>
        document.getElementById('item_price').oninput = calc;
        document.getElementById('profit_rate').oninput = calc;
        document.getElementById('shipment_fee').oninput = calc;

        function calc(){
           var price = document.getElementById('item_price').value;
           var rate = document.getElementById('profit_rate').value / 100;
           var shipmentFee = parseInt(document.getElementById('shipment_fee').value);
           var salePrice = Math.round(price * (1 + rate)) + shipmentFee;
           document.getElementById('sale_price').value = salePrice;
        }
    </script>
</body>
</html>