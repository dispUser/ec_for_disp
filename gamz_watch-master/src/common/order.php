<?php

    class Order {
        // db
        public $code;
        public $date;
        public $name;
        public $email;
        public $address;
        public $tel;
        public $payment_status_code;
        public $payment_status;
        public $payment_date;
        public $shipment_status_code;
        public $shipment_status;
        public $shipment_date;
        public $cancel_status_code;
        public $cancel_status;
        public $cancel_date;
        // not db column, get from sql
        public $order_price;
    }

    class OrderQuery{
        static $base_order_select_query = "SELECT
                                dat_sales.code
                                ,dat_sales.date
                                ,dat_sales.name
                                ,dat_sales.email
                                ,dat_sales.postal1
                                ,dat_sales.postal2
                                ,dat_sales.address
                                ,dat_sales.tel
                                ,total.order_price AS order_price
                                ,payment_status.code AS payment_status_code
                                ,payment_status.status_name AS payment_status
                                ,dat_sales.payment_date AS payment_date
                                ,shipment_status.code AS shipment_status_code
                                ,shipment_status.status_name AS shipment_status
                                ,dat_sales.shipment_date AS shipment_date
                                ,cancel_status.code AS cancel_status_code
                                ,cancel_status.status_name AS cancel_status
                                ,dat_sales.cancel_date AS cancel_date
                            FROM
                                dat_sales
                            INNER JOIN 
                            (
                                SELECT
                                    code_sales
                                    , sum(price * quantity) AS order_price
                                FROM
                                    dat_sales_product
                                GROUP BY
                                    code_sales
                            ) AS total
                            ON 
                                dat_sales.code = total.code_sales
                            INNER JOIN
                                mst_order_status AS payment_status
                            ON 
                                dat_sales.payment_status_code = payment_status.code
                            INNER JOIN
                                mst_order_status AS shipment_status
                            ON 
                                dat_sales.shipment_status_code = shipment_status.code
                            INNER JOIN
                                mst_order_status AS cancel_status
                            ON 
                                dat_sales.cancel_status_code = cancel_status.code";
        static $orderByDefault = "ORDER BY
                                    dat_sales.date desc, dat_sales.code desc
                                 ";
        static $orderByPaidUnshipped = "ORDER BY
                                            payment_date asc
                                        ";
    }

    function execInsertOrder($dbh, $member){
        // SQL実行(prepared statement なので安全)
        $sql =  'INSERT INTO
                    dat_sales
                    (
                        code_member
                        , name
                        , email
                        , postal1
                        , postal2
                        , address
                        , tel
                        , payment_status_code
                        , shipment_status_code
                        , cancel_status_code
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
                        ,?
                        ,?
                    )';
        $stmt = $dbh->prepare($sql);
        $data = array();
        $data[] = $member->code;
        $data[] = $member->name;
        $data[] = $member->email;
        $data[] = $member->postal1;
        $data[] = $member->postal2;
        $data[] = $member->address;
        $data[] = $member->tel;
        $data[] = Con::$status_unpaid;
        $data[] = Con::$status_unshipped;
        $data[] = Con::$status_uncanceled;
        $stmt->execute($data);
        
        $sql =  'SELECT LAST_INSERT_ID()';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $last_order_code = $rec['LAST_INSERT_ID()'];

        return $last_order_code;
    }

    function setOrderEntity($stmt){
        
        $orderEntityList = array();

        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }

            $orderEntity = new Order();
            $orderEntity->code = $rec['code'];
            $orderEntity->date = $rec['date'];
            $orderEntity->name = $rec['name'];
            $orderEntity->email = $rec['email'];
            $orderEntity->address = $rec['address'];
            $orderEntity->tel = $rec['tel'];
            $orderEntity->order_price = $rec['order_price'];
            $orderEntity->payment_status_code = $rec['payment_status_code'];
            $orderEntity->payment_status = $rec['payment_status'];
            $orderEntity->payment_date = $rec['payment_date'];
            $orderEntity->shipment_status_code = $rec['shipment_status_code'];
            $orderEntity->shipment_status = $rec['shipment_status'];
            $orderEntity->shipment_date = $rec['shipment_date'];
            $orderEntity->cancel_status_code = $rec['cancel_status_code'];
            $orderEntity->cancel_status = $rec['cancel_status'];
            $orderEntity->cancel_date = $rec['cancel_date'];

            array_push($orderEntityList, $orderEntity);
        }

        return $orderEntityList;
    }

    function execSelectOrderQuery($where, $orderBy){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql =  OrderQuery::$base_order_select_query
                    . " " . $where
                    . " " . $orderBy;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // DB切断
            $dbh = null;

            $orderEntityList = setOrderEntity($stmt);

        }catch(Exception $e){
            print 'DB ERROR';
            exit();
        }
        
        return $orderEntityList;
    }

    function getAllOrderList(){
        $where = "";
        $orderBy = OrderQuery::$orderByDefault;
        $orderEntityList = execSelectOrderQuery($where, $orderBy);
        return $orderEntityList;
    }

    function getAllOrderListInMember($member_code){
        $where = "WHERE
                    code_member = "
                    . $member_code;
        $orderBy = OrderQuery::$orderByDefault;
        $orderEntityList = execSelectOrderQuery($where, $orderBy);
        return $orderEntityList;
    }

    function getPaidUnshippedOrderList(){
        // 2=支払い済み
        // 3=未出荷
        $where = "WHERE
                    payment_status.code = 2
                  AND
                    shipment_status.code = 3";
        $orderBy = OrderQuery::$orderByPaidUnshipped;
        $orderEntityList = execSelectOrderQuery($where, $orderBy);
        return $orderEntityList;
    }

    function getOrderEntity($order_code){
        $where = "WHERE
                    dat_sales.code = " . $order_code;
        $orderBy = OrderQuery::$orderByDefault;
        $orderEntity = execSelectOrderQuery($where, $orderBy)[0];
        return $orderEntity;
    }

    function execUpdateOrderStatus($set, $where){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // SQL実行(prepared statement なので安全)
            $sql = "UPDATE 
                        dat_sales"
                    . " " . $set
                    . " " . $where;
            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // DB切断
            $dbh = null;

        }catch(Exception $e){
            print 'DB ERROR';
            exit();
        }
    }

    function updateOrderShipment($order_code, $update_value){
        $set = "SET 
                    shipment_status_code = " . $update_value
                    . ", shipment_date = '" . getJapanCurrentTime() . "'";
        $where = "WHERE 
                    code = " . $order_code;
        execUpdateOrderStatus($set, $where);
    }

    function updateOrderPayment($order_code, $update_value){
        $set = "SET 
                    payment_status_code = " . $update_value
                    . ", payment_date = '" . getJapanCurrentTime() . "'";
        $where = "WHERE 
                    code = " . $order_code;
        execUpdateOrderStatus($set, $where);
    }
    
    function updateOrderCancel($order_code, $update_value){
        $set = "SET 
                    cancel_status_code = " . $update_value
                    . ", cancel_date = '" . getJapanCurrentTime() . "'";
        $where = "WHERE 
                    code = " . $order_code;
        execUpdateOrderStatus($set, $where);
    }
?>