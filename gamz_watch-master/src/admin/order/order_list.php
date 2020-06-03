<?php
    include "../includes/header.php"
?>
<?php
    if(isset($_GET['search'])){
        $search_type = $_GET['search_type'];
        if($search_type == 'paid'){
            $orderList = getPaidUnshippedOrderList();
        }else{
            $orderList = getAllOrderList();
        }
    }
?>
<div class="col-sm-12">
    <h2>Order List</h2>
    <div class="col-sm-12">
        <form action="order_list.php" method="get">
            <div>
                <input type="radio" name="search_type" value="paid" checked> Paid but Unshipped
            </div>
            <div>
                <input type="radio" name="search_type" value="all"> All
            </div>
            <input type="submit" name="search" value="search" class="btn">
        </form>
    </div>
    
    <?php if(isset($_GET['search'])){ ?>
        <form action="order_branch.php" method="post">
            <table class="table table-bordered table-hover">
                <thead class="<?php echo Con::$mainColorClass; ?>">
                    <th class="sticky-top bg-success">
                        Code
                    </th>
                    <th class="sticky-top bg-success">
                        Date
                    </th>
                    <th class="sticky-top bg-success">
                        Name
                    </th>
                    <th class="sticky-top bg-success">
                        Email
                    </th>
                    <th class="sticky-top bg-success">
                        order_Price
                    </th>
                    <th class="sticky-top bg-success">
                        Payment status
                    </th>
                    <th class="sticky-top bg-success">
                        Payment date
                    </th>
                    <th class="sticky-top bg-success">
                        Shipment status
                    </th>
                    <th class="sticky-top bg-success">
                        Shipment date
                    </th>
                </thead>
                <tbody>
                    <?php for($i = 0; $i < count($orderList); $i++){ ?>
                    <tr>
                        <td>
                            <input type="radio" name="ordercode" value="<?php echo $orderList[$i]->code ?>">
                            <?php echo $orderList[$i]->code; ?>
                        </td>
                        <td>
                            <?php echo $orderList[$i]->date; ?>
                        </td>
                        <td>
                            <?php echo $orderList[$i]->name; ?>
                        </td>
                        <td>
                            <?php echo $orderList[$i]->email; ?>
                        </td>
                        <td>
                            <?php echo $orderList[$i]->order_price; ?>
                        </td>
                        <td class="<?php echo strtolower($orderList[$i]->payment_status); ?>">
                            <?php echo $orderList[$i]->payment_status; ?>
                        </td>
                        <td>
                            <?php echo $orderList[$i]->payment_date; ?>
                        </td>
                        <td class="<?php echo strtolower($orderList[$i]->shipment_status); ?>">
                            <?php echo $orderList[$i]->shipment_status; ?>
                        </td>
                        <td>
                            <?php echo $orderList[$i]->shipment_date; ?>
                        </td>
                    <tr>
                    <?php } ?>
                </tbody>
            </table>
            <input type="submit" name="disp" value="detail" class="btn">
            <input type="submit" name="edit" value="edit" class="btn">
        </form>
    <?php } ?>
    <div>
        <a href="../staff_login/staff_top.php">To top</a>
    </div>
</div>
</body>
</html>