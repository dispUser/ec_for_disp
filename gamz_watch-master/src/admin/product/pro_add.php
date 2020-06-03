<?php
    include "../includes/header.php"
?>
<div class="col-sm-12">
    <h1>Add item</h1>
    <form action="pro_add_check.php" method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Item name</label>
            <input class="form-control" type="text" name="name">
        </div>
        <div class="form-group">
            <label>Item price</label>
            <input class="form-control" type="text" name="price" id="item_price">
        </div>
        <div class="form-group">
            <label>Profit rate</label>
            <input class="form-control" type="number" name="profit_rate" id="profit_rate" value=10>
        </div>
        <div class="form-group">
            <label>Shipment fee</label>
            <input class="form-control" type="number" name="shipment_fee" id="shipment_fee" value=50>
        </div>
        <div class="form-group">
            <label>Sale price</label>
            <input class="form-control" type="number" name="sale_price" id="sale_price">
        </div>
        <div class="custom-file mb-2">
            <input class="custom-file-input" id="myfile" type="file" multiple name="upload_file[]">
            <label class="custom-file-label" for="myfile">Image</label>
        </div>
        <div class="form-group">
            <input class="btn btn-secondary" type="button" onclick="history.back()" value="Back">
            <input class="btn btn-success" type="submit" value="OK">
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