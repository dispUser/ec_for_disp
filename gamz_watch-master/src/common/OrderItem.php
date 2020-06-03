<?php

    /**
     * Order Item
     */
    class OrderItemEntity extends Item {
    }

    class OrderItemQuery {
        static $base_query = "SELECT 
                                dat_sales_product.code as code
                                , dat_sales_product.code_product as code_product
                                , mst_product.name as name
                                , dat_sales_product.price as price
                                , dat_sales_product.profit_rate as profit_rate
                                , dat_sales_product.shipment_fee as shipment_fee
                                , dat_sales_product.quantity as quantity
                                , mst_image.file_name as file_name
                                , mst_image.code as image_code
                            FROM
                                dat_sales_product
                            INNER JOIN
                                mst_product
                            ON
                                dat_sales_product.code_product = mst_product.code
                            LEFT OUTER JOIN
                                rel_product_image
                            ON
                                dat_sales_product.code_product = rel_product_image.product_code
                            AND
                                dat_sales_product.code_image = rel_product_image.image_code
                            LEFT OUTER JOIN
                                mst_image
                            ON
                                mst_image.code = rel_product_image.image_code ";
        static $defaultOrderBy = "ORDER BY mst_product.code desc";
    }

    function execInsertOrderItem($dbh, $cartItem, $last_order_code){
            $sql =  'INSERT INTO 
                        dat_sales_product 
                        (
                            name
                            , code_sales
                            , code_product
                            , code_image
                            , price
                            , profit_rate
                            , shipment_fee
                            , quantity
                        ) 
                    VALUES 
                        (
                            ?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                            ,?
                        )';
            $stmt = $dbh->prepare($sql);
                        
            $data = array();
            $data[] = $cartItem->name;
            $data[] = $last_order_code;
            $data[] = $cartItem->code;
            $data[] = $cartItem->image_code;
            $data[] = $cartItem->price;
            $data[] = $cartItem->profit_rate;
            $data[] = $cartItem->shipment_fee;
            $data[] = $cartItem->quantity;
            $stmt->execute($data);
    }

    function execSelectOrderItem($where, $orderBy){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  OrderItemQuery::$base_query
                    . " " . $where
                    . " " . $orderBy;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // DB切断
            $dbh = null;

            $orderItemEntityList = setOrderItemEntity($stmt);

            return $orderItemEntityList;
    
        }catch(Exception $e){
            print 'DB ERROR';
            
            exit();
        }
    }

    function setOrderItemEntity($stmt){
        $orderItemEntityList = array();
        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }
                $order_item = new OrderItemEntity();
                $order_item->code = $rec['code'];
                $order_item->name = $rec['name'];
                $order_item->price = $rec['price'];
                $order_item->profit_rate = $rec['profit_rate'];
                $order_item->shipment_fee = $rec['shipment_fee'];
                $order_item->image_code = $rec['image_code'];
                $order_item->code_product = $rec['code_product'];
                $order_item->quantity = $rec['quantity'];
                $order_item->filename = $rec['file_name'];
                array_push($orderItemEntityList, $order_item);
        }
        return $orderItemEntityList;
    }

    function getItemEntityListInOrder($order_code){
        $where = "WHERE
                    dat_sales_product.code_sales = " . $order_code;
        $orderBy = OrderItemQuery::$defaultOrderBy;
        $orderItemEntityList = execSelectOrderItem($where, $orderBy);
        return $orderItemEntityList;
    }
?>