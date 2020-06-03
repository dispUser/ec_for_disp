<?php
    include_once "Order.php";
    include_once "Item.php";
    include_once "Staff.php";
    include_once "Member.php";
    include_once "Cart.php";
    include_once "CartItem.php";
    include_once "OrderItem.php";
    include_once "Ranking.php";
    include_once "Image.php";
    include_once "ItemImageRelation.php";

    class Con {
        // DB access info
        static $dsn = 'mysql:dbname=dummy;host=localhost;charset=utf8';
        static $user = 'dummy';
        // local
        static $password = 'dummy';
        // admin
        // static $password = 'dummy';

        static $image_path = 'gazou/';

        static $mainColorClass = "bg-success";

        static $status_unpaid = 1;
        static $status_paid = 2;
        static $status_unshipped = 3;
        static $status_shipped = 4;
        static $status_canceled = 5;
        static $status_uncanceled = 6;
    }

    class SESSION_CON{
        // all session in use is below
        static $ADMIN_LOGIN = "admin_login_gamz_watch";
        static $FRONT_LOGIN = "front_login_gamz_watch";
        static $MEMBER_ENTITY = "member_entity_gamz_watch";
        static $CART_ENTITY = "cart_entity_gamz_watch";
        static $STAFF_ENTITY = "staff_entity_gamz_watch";
        static $ITEM_ENTITY = "item_entity_gamz_watch";
        static $ITEM_ENTITY_LIST = "item_entity_list_gamz_watch";
    }

    function sanitize($postedItems){
        foreach($postedItems as $key => $value){
            $postedItems[$key] = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        }
        return $postedItems;
    }

    function getJapanCurrentTime(){
        date_default_timezone_set('Asia/Tokyo');
        
        $current_date = date('Y/m/d H:i:s');
        return $current_date;
    }

    // udemy updated crypt function
    // stronger than md5
    function encrypt($text){
        $hashFormat = "$2y$10$";
        $salt = "thisisencryptsaltstring";
        $hashF_and_salt = $hashFormat . $salt;
        return crypt($text, $hashF_and_salt);
    }

    function getSalePrice($item){
        $item_price = $item->price;
        $profit_rate = $item->profit_rate;
        $shipment_fee = $item->shipment_fee;
        $sale_price = round(($item_price * (1 + $profit_rate / 100)) + $shipment_fee);
        return $sale_price;
    }

    /**
     * tran start
     * 1. insert member
     * 2. insert order
     * 3. insert order item
     * 
     * @return $last_order_code
     */
    function execGuestOrder($member, $cart){
        // from php official transaction sample code
        try {
            // success db access
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
        } catch (Exception $e) {
            die("NO DB connection: " . $e->getMessage());
        }

        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $lastmembercode = execInsertMember($dbh, $member);
            $member->code = $lastmembercode;

            $last_order_code = execInsertOrder($dbh, $member);
            createOrderProductRec($dbh, $cart, $last_order_code);

            $dbh->commit();
            // connection end
            $dbh = null;

            return $last_order_code;

        }catch(Exception $e){
            $dbh->rollBack();
            $dbh = null;
        }
    }

    /**
     * tran begin
     * 1. item
     * 2. item image
     * 3. ranking
     * tran end
     * 4. rename image file name
     */
    function execAddItem($item){
        try {
            // success db access
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
        } catch (Exception $e) {
            die("NO DB connection: " . $e->getMessage());
        }

        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();
            
            // 商品をINSERT
            $item->code = execInsertItem($dbh, $item);

            // 商品画像ListをINSERT
            addImageList($dbh, $item);

            // 商品と画像の紐づきをINSERT
            addImageRelationList($dbh, $item);

            // 商品のランキングレコードをINSERT
            execInsertRanking($dbh, $item);
            
            $dbh->commit();
            
            // connection end
            $dbh = null;

            // to rename image
            return $item;

        }catch(Exception $e){
            echo $e;
            $dbh->rollBack();
            $dbh = null;
        }
    }

    /**
     * tran start
     * 1. insert order
     * 2. insert order item
     * tran end
     * 
     * @return $last_order_code
     */
    function execMemberOrder($cart){
        // from php official transaction sample code
        try {
            // success db access
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
        } catch (Exception $e) {
            die("NO DB connection: " . $e->getMessage());
        }

        try{
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $dbh->beginTransaction();

            $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);

            $last_order_code = execInsertOrder($dbh, $member);
            createOrderProductRec($dbh, $cart, $last_order_code);

            $dbh->commit();
            // connection end
            $dbh = null;

            return $last_order_code;

        }catch(Exception $e){
            $dbh->rollBack();
            $dbh = null;
        }
    }

    function createOrderProductRec($dbh, $cart, $last_order_code){
        // get item from cart
        $cartItemList = $cart->cartItemList;

        if(count($cartItemList) == 0){
            throw new Exception;
        }

        for($i = 0; $i < count($cartItemList); $i++){
            $cartItem = $cartItemList[$i];
            execInsertOrderItem($dbh, $cartItem, $last_order_code);
            execUpdateRanking($dbh, $cartItem);
        }
    }

    function createMail($something){
        $honbun = '';
        $honbun .= $onamae."様 \n\n このたびはご注文ありがとうございました。\n";
        $honbun .= "\n";
        $honbun .= "Items in Order\n";
        $honbun .= "---------------\n";

        $honbun.=$name.' ';
        $honbun.=$sale_price.'円 x ';
        $honbun.=$suryo.'個 = ';
        $honbun.=$shokei."円\n";

        $honbun .= "送料は無料です。\n";
        $honbun .= "---------------------\n";
        $honbun .= "\n";
        $honbun .= "代金は以下の口座番号にお振込みください。\n";
        $honbun .= "ろくまる銀行　やさい支店　普通口座　1234567\n";
        $honbun .= "入金確認が取れ次第、梱包、発送させていただきます。\n";
        $honbun .= "\n";
        $honbun .= "〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇\n";
        $honbun .= "～　安心野菜のろくまる農園　～\n";
        $honbun .= "\n";
        $honbun .= "〇〇県六丸群六丸村 123-4\n";
        $honbun .= "電話 090-6060-xxxx\n";
        $honbun .= "メール info@rokumarunouen.co.jp\n";
        $honbun .= "〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇〇\n";

        print '<br>';
        print nl2br($honbun);

        $title = 'ご注文ありががとうございます。';
        $header = 'From: info@rokumarunouen.co.jp';
        $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail($email, $title, $honbun, $header);

        $title = 'お客様からご注文がありました。';
        $header = 'From: '.$email;
        $honbun = html_entity_decode($honbun, ENT_QUOTES, 'UTF-8');
        mb_language('Japanese');
        mb_internal_encoding('UTF-8');
        mb_send_mail('info@rokumarunouen.co.jp', $title, $honbun, $header);
    }

    // download csv
    function pulldown_year(){
        print '<select name="year">';
        print '<option value="2017">2017</option>';
        print '<option value="2018">2018</option>';
        print '<option value="2019">2019</option>';
        print '<option value="2020">2020</option>';
        print '</select>';
        print '年';
    }

    // download csv
    function pulldown_month(){
        print '<select name="month">';
        print '<option value="01">01</option>';
        print '<option value="02">02</option>';
        print '<option value="03">03</option>';
        print '<option value="04">04</option>';
        print '<option value="05">05</option>';
        print '<option value="06">06</option>';
        print '<option value="07">07</option>';
        print '<option value="08">08</option>';
        print '<option value="09">09</option>';
        print '<option value="10">10</option>';
        print '<option value="11">11</option>';
        print '<option value="12">12</option>';
        print '</select>';
        print '月';
    }

    // download csv
    function pulldown_day(){
        print '<select name="day">';
        print '<option value="01">01</option>';
        print '<option value="02">02</option>';
        print '<option value="03">03</option>';
        print '<option value="04">04</option>';
        print '<option value="05">05</option>';
        print '<option value="06">06</option>';
        print '<option value="07">07</option>';
        print '<option value="08">08</option>';
        print '<option value="09">09</option>';
        print '<option value="10">10</option>';
        print '<option value="11">11</option>';
        print '<option value="12">12</option>';
        print '<option value="13">13</option>';
        print '<option value="14">14</option>';
        print '<option value="15">15</option>';
        print '<option value="16">16</option>';
        print '<option value="17">17</option>';
        print '<option value="18">18</option>';
        print '<option value="19">19</option>';
        print '<option value="20">20</option>';
        print '<option value="21">21</option>';
        print '<option value="22">22</option>';
        print '<option value="23">23</option>';
        print '<option value="24">24</option>';
        print '<option value="25">25</option>';
        print '<option value="26">26</option>';
        print '<option value="27">27</option>';
        print '<option value="28">28</option>';
        print '<option value="29">29</option>';
        print '<option value="30">30</option>';
        print '<option value="31">31</option>';
        print '</select>';
        print '日';
    }
    
?>