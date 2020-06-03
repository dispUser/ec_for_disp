<?php
    include "../includes/header.php";
    $order_code = $_GET['ordercode'];
    $orderEntity = getOrderEntity($order_code);
    $itemEntityList = getItemEntityListInOrder($order_code);
?>

<div class="col-sm-12">
    <form action="order_edit_check.php" method="post">
        <h2>Order Edit</h2>
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
                        <input type="text" value="<?php print $orderEntity->name; ?>" name="cust_name">
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
                        <?php print $orderEntity->code; ?>
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
                            <?php echo $itemEntityList[$i]->code; ?>
                        </td>
                        <td>
                            <?php echo $itemEntityList[$i]->name; ?>
                        </td>
                        <td>
                            <?php echo $itemEntityList[$i]->price; ?>
                        </td>
                        <td>
                            <input type="number" value="<?php echo $itemEntityList[$i]->quantity; ?>" name="quantity<?php echo $i?>">
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
        <div>
            <input type="submit" value="check" name="check" class="btn">
            <a class="btn" href="order_edit_payment_check.php?ordercode=<?php echo $orderEntity->code; ?>">Payment</a>
            <a class="btn" href="order_edit_shipment_check.php?ordercode=<?php echo $orderEntity->code; ?>">Shipment</a>
            <a class="btn" href="order_edit_cancel_check.php?ordercode=<?php echo $orderEntity->code; ?>">Cancel</a>
            <input type="hidden" name="ordercode" value="<?php echo $orderEntity->code; ?>">
        </div>
        <div>
            <input type="button" onclick="history.back()" value="戻る" class="btn">
        </div>
    </form>
</div>

</body>
</html>