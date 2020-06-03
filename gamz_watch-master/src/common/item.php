<?php
    class Item{
        public $code;
        public $name;
        public $price;
        public $profit_rate;
        public $shipment_fee;
        public $create_date;

        // FIXME:画像の管理の仕方が２つあるので、ややこしい。整理したい。
        // from image
        public $image_code;
        public $file_name;
        // 商品更新時に使用
        public $file_name_old;
        public $file_size;
        // 商品登録時に使用
        public $imageEntityList;
        public $oldImageEntityList;

        function __construct(){
            $this->imageEntityList = array();
        }
    }

    class ItemQuery {
        static $base_select_sql = 
        "SELECT 
            mst_product.code AS code
            , mst_product.name AS name
            , mst_product.price AS price
            , mst_product.profit_rate AS profit_rate
            , mst_product.shipment_fee AS shipment_fee
            , mst_product.create_date AS create_date
            , mst_image.file_name AS file_name
            , mst_image.code AS image_code
        FROM
            (
                SELECT
                    *
                    , price * (1 + profit_rate / 100) + shipment_fee AS sale_price
                FROM mst_product
            ) AS mst_product
        LEFT OUTER JOIN
            rel_product_image
        ON
            mst_product.code = rel_product_image.product_code
        LEFT OUTER JOIN
            mst_image
        ON
            mst_image.code = rel_product_image.image_code
        LEFT OUTER JOIN
            dat_ranking
        ON
            dat_ranking.pro_code = mst_product.code
        ";
    }

    function execInsertItem($dbh, $item){
        // try-catch is in call method
        // SQL実行(prepared statement なので安全)
        $sql =  'INSERT INTO mst_product(
            name
            , price
            , profit_rate
            , shipment_fee) 
        VALUES(
            ?
            ,?
            ,?
            ,?
        )';
        $stmt = $dbh->prepare($sql);
        $data[] = $item->name;
        $data[] = $item->price;
        $data[] = $item->profit_rate;
        $data[] = $item->shipment_fee;
        $stmt->execute($data);

        $sql =  'SELECT LAST_INSERT_ID() from mst_product';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();

        $rec = $stmt->fetch(PDO::FETCH_ASSOC);
        $product_code = $rec["LAST_INSERT_ID()"];

        return $product_code;
    }

    function execUpdateItem($item){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql =  'UPDATE 
                        mst_product 
                    SET 
                        name = ?
                        , price = ? 
                        , profit_rate = ?
                        , shipment_fee = ?
                    WHERE 
                        code = ?';
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $item->name;
            $data[] = $item->price;
            $data[] = $item->profit_rate;
            $data[] = $item->shipment_fee;
            $data[] = $item->code;
            $stmt->execute($data);
    
            // DB切断
            $dbh = null;
    
        }
        catch(Exception $e){
            print 'Fatal Error';
            exit();
        }
    }

    function execSelectItem($where, $orderBy){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
            // SQL実行(prepared statement なので安全)
            $sql = ItemQuery::$base_select_sql
                    . " " . $where 
                    . " " . $orderBy . ";";

            $stmt = $dbh->prepare($sql);
            $stmt->execute();

            // DB切断
            $dbh = null;
    
            $itemList = setItemEntity($stmt);

            return $itemList;
        }
        catch(Exception $e){
            print 'Fatal Error';
            exit();
        }
    }

    function setItemEntity($stmt){
        $itemList = array();

        while(true){
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            if($rec == false){
                break;
            }
            $item = new Item;
            $item->code = $rec['code'];
            $item->name = $rec['name'];
            $item->price = $rec['price'];
            $item->profit_rate = $rec['profit_rate'];
            $item->shipment_fee = $rec['shipment_fee'];
            $item->create_date = $rec['create_date'];
            $item->image_code = $rec['image_code'];
            $item->file_name = $rec['file_name'];
            array_push($itemList, $item);
        }

        return $itemList;
    }

    function getAllItemList(){
        $where = "";
        $orderBy = "";

        $itemList = execSelectItem($where, $orderBy);

        return $itemList;
    }

    function getNewItemList(){
        $where = "";
        $orderBy = "ORDER BY
                        mst_product.create_date desc 
                    LIMIT
                        4";
        $itemList = execSelectItem($where, $orderBy);
        return $itemList;
    }

    function getRankItemList(){
        $where = "";
        $orderBy = "ORDER BY 
                        dat_ranking.sell_count desc
                        , mst_product.create_date desc 
                    LIMIT
                        4";
        $itemList = execSelectItem($where, $orderBy);
        return $itemList;
    }

    function getSearchItemList($keyword, $from, $to){
        $where = "WHERE " 
                 . $from . " <= mst_product.sale_price AND mst_product.sale_price <= " . $to;
        if($keyword != ''){
            $where = $where . " AND mst_product.name like '%".$keyword."%'";
        }
        $orderBy = "ORDER BY
                    mst_product.create_date desc";

        $itemList = execSelectItem($where, $orderBy);

        return $itemList;
    }

    function getItemByCode($item_code, $image_code){
        $where = "WHERE 
                    mst_product.code = " . $item_code . " " .
                  "AND 
                    mst_image.code = " . $image_code;
        $orderBy = "";

        $itemList = execSelectItem($where, $orderBy);

        return $itemList;
    }

?>