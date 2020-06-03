<?php
    include "../includes/header.php";
?>
<?php
    $index = $_GET['index'];
    $itemList = unserialize($_SESSION[SESSION_CON::$ITEM_ENTITY_LIST]);
    $item = $itemList[$index];
?>

<div class="col-sm-12">
    <h2>Item infomation</h2>
    <?php if(isset($item->file_name) && $item->file_name != ''){ ?>
        <div class="mb-2">
            <img class="w-25 rounded" src="./gazou/<?php echo $item->file_name; ?>" alt="">
        </div>
    <?php } ?>
    <table class="table">
        <thead>
            <th>Code</th>
            <th>Name</th>
            <th>Created date</th>
            <th>Item price</th>
            <th>Profit rate</th>
            <th>Shipment fee</th>
            <th>Selling price</th>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?php print $item->code; ?>
                </td>
                <td>
                    <?php print $item->name; ?>
                </td>
                <td>
                    <?php print $item->create_date; ?>
                </td>
                <td>
                    <?php print $item->price; ?>
                </td>
                <td>
                    <?php print $item->profit_rate; ?>
                </td>
                <td>
                    <?php print $item->shipment_fee; ?>
                </td>
                <td>
                    <?php print getSalePrice($item); ?>
                </td>
            </tr>
        </tbody>
    </table>
    <form action="pro_edit_check.php" method="post">
        <div class="form-group">
            <input type="button" onclick="history.back()" value="Back" class="btn btn-secondary">
        </div>
    </form>
</div>
</body>
</html>