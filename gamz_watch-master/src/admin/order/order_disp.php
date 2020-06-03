<?php
    include "../includes/header.php"
?>
<?php
    $order_code = $_GET['ordercode'];
    $orderEntity = getOrderEntity($order_code);
    $itemEntityList = getItemEntityListInOrder($order_code);
?>
    <div class="col-sm-12">
        <h2>Order Detail</h2>
        <table class="table table-bordered table-hover">
            <thead class="<?php echo Con::$mainColorClass; ?>">
                <th>
                    Order Code
                </th>
                <th>
                    Customer Name
                </th>
                <th>
                    Order price
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php print $orderEntity->code; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->name; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->order_price; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table table-bordered table-hover">
            <thead class="<?php echo Con::$mainColorClass; ?>">
                <th>
                    Payment status
                </th>
                <th>
                    Payment date
                </th>
                <th>
                    Shipment status
                </th>
                <th>
                    Shipment date
                </th>
                <th>
                    Cancel status
                </th>
                <th>
                    Cancel date
                </th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <?php print $orderEntity->payment_status; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->payment_date; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->shipment_status; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->shipment_date; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->cancel_status; ?>
                    </td>
                    <td>
                        <?php print $orderEntity->cancel_date; ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <h2>Order Items</h2>
        <table class="table table-bordered table-hover">
        <?php for($i = 0; $i < count($itemEntityList); $i++){ ?>
            <thead class="<?php echo Con::$mainColorClass; ?>">
                <th>Image</th>
                <th>Code</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <div class="col-sm-2">
                            <img
                                src="../../admin/product/gazou/<?php print $itemEntityList[$i]->filename; ?>" alt="<?php print $itemEntityList[$i]->filename; ?>"
                                class="img-thumbnail img-rounded"
                            >
                        </div>
                    </td>
                    <td>
                        <?php echo $itemEntityList[$i]->code ;?>
                    </td>
                    <td>
                        <?php echo $itemEntityList[$i]->name ;?>
                    </td>
                    <td>
                        <?php echo $itemEntityList[$i]->price ;?>
                    </td>
                    <td>
                        <?php echo $itemEntityList[$i]->quantity ;?>
                    </td>
                    <td>
                        <?php 
                            $total = $itemEntityList[$i]->price * $itemEntityList[$i]->quantity;
                            echo $total;
                        ?>
                    </td>
                </tr>
            </tbody>
        <?php } ?>
        </table>
        <form action="order_branch.php" method="post">
            <div>
                <input type="submit" value="edit" name="edit" class="btn">
                <input type="hidden" name="ordercode" value="<?php echo $orderEntity->code; ?>">
            </div>
            <div>
                <input type="button" onclick="history.back()" value="Back to list" class="btn">
            </div>
        </form>
    </div>
</body>
</html>