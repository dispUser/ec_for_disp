<?php
    use PHPUnit\Framework\TestCase;
    include_once __DIR__ . "/../../../src/common/Function.php";

    class FunctionTest extends TestCase{
        /**
         * REGULAR
         */
        public function testGuestOrderRecordCount(){
            try{
                // count up
                $count = new Countup;
                $count->countBefore();

                // setup test data
                // member : o
                // cart : o
                $test_member = getTestMember();
                $test_cart = getTestCart(1);

                // regist order
                execGuestOrder($test_member, $test_cart);

                // count up
                $count->countAfter();
                $this->assertEquals($count->memberCountBefore + 1, $count->memberCountAfter);
                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 1, $count->orderItemCountAfter);

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->memberCountBefore, $count->memberCountAfter);
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);

            }catch(Exception $e){
                echo $e;
                // delete test record
                deleteOrderForTest($test_member);
                
                // count up
                $count->countAfter();
                $this->assertEquals($count->memberCountBefore, $count->memberCountAfter);
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }
        }

        public function testMemberOrderRecordCount(){
            try{
                // count up
                $count = new Countup;
                $count->countBefore();

                // setup test data
                // member : o
                // cart   : o
                $test_member = getTestMember();
                $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($test_member);
                $test_cart = getTestCart(1);

                // regist order
                execMemberOrder($test_cart);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 1, $count->orderItemCountAfter);

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }catch(Exception $e){
                echo $e;

                // delete test record
                deleteOrderForTest($test_member);
                
                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }
        }

        public function testGuestOrderRecordCountAddTwoItem(){
            try{
                // count up
                $count = new Countup;
                $count->countBefore();

                // setup test data
                // member : o
                // cart   : o
                $test_member = getTestMember();
                $test_cart = getTestCart(2);

                // regist order
                execGuestOrder($test_member, $test_cart);

                // count up
                $count->countAfter();
                $this->assertEquals($count->memberCountBefore + 1, $count->memberCountAfter);
                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 2, $count->orderItemCountAfter);
                
                // delete test record
                deleteOrderForTest($test_member);
                
                // count up
                $count->countAfter();
                $this->assertEquals($count->memberCountBefore, $count->memberCountAfter);
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);

            }catch(Exception $e){
                echo $e;

                // delete test record
                deleteOrderForTest($test_member);
                
                // count up
                $count->countAfter();
                $this->assertEquals($count->memberCountBefore + 1, $count->memberCountAfter);
                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 2, $count->orderItemCountAfter);
            }
        }

        public function testMemberOrderRecordCountAddTwoItem(){

            try{
                // count up
                $count = new Countup;
                $count->countBefore();

                // setup data
                $test_member = getTestMember();
                $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($test_member);
                $test_cart = getTestCart(2);

                // regist order
                execMemberOrder($test_cart);

                // count up
                $count->countAfter();

                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 2, $count->orderItemCountAfter);

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();

                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }catch(Exception $e){
                echo $e;

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }
        }

        public function testGuestOrderRecordContentAddTwoItem(){
            try{
                // count up
                $count = new Countup;
                $count->countBefore();

                // setup data
                $test_member = getTestMember();
                $test_cart = getTestCart(2);

                // create order
                $order_code = execGuestOrder($test_member, $test_cart);

                // check member
                $memberList = getMemberByCode($test_member->code);
                $member_registered;
                if(count($memberList) > 0){
                    $member_registered = $memberList[0];
                }
                $this->assertEquals($member_registered->code, $test_member->code);
                $this->assertEquals($member_registered->name, $test_member->name);
                $this->assertEquals($member_registered->email, $test_member->email);
                $this->assertEquals($member_registered->postal1, $test_member->postal1);
                $this->assertEquals($member_registered->postal2, $test_member->postal2);
                $this->assertEquals($member_registered->address, $test_member->address);
                $this->assertEquals($member_registered->tel, $test_member->tel);
                $this->assertEquals($member_registered->password, encrypt($test_member->password));

                // check order content
                $orderEntity = getOrderEntity($order_code);
                $this->assertEquals($test_member->name, $orderEntity->name);
                $this->assertEquals($test_member->email, $orderEntity->email);
                $this->assertEquals($test_member->address, $orderEntity->address);
                $this->assertEquals($test_member->tel, $orderEntity->tel);
                $this->assertEquals(CON::$status_unpaid, $orderEntity->payment_status_code);
                $this->assertEquals("Unpaid", $orderEntity->payment_status);
                $this->assertFalse(isset($orderEntity->payment_date));
                $this->assertEquals(CON::$status_unshipped, $orderEntity->shipment_status_code);
                $this->assertEquals("Unshipped", $orderEntity->shipment_status);
                $this->assertFalse(isset($orderEntity->shipment_date));
                $this->assertEquals(CON::$status_uncanceled, $orderEntity->cancel_status_code);
                $this->assertEquals("", $orderEntity->cancel_status);
                $this->assertFalse(isset($orderEntity->cancel_date));
                $this->assertEquals(960, $orderEntity->order_price);

                // count
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 2, $count->orderItemCountAfter);

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }catch(Exception $e){
                echo $e;

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }
        }

        public function testMemberOrderRecordContentAddTwoItem(){
            try{
                // count up
                $count = new Countup;
                $count->countBefore();

                // setup test data
                $test_member = getTestMember();
                $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($test_member);
                $test_cart = getTestCart(2);

                // regist order
                execMemberOrder($test_cart);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore + 1, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore + 2, $count->orderItemCountAfter);

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);

            }catch(Exception $e){
                echo $e;

                // delete test record
                deleteOrderForTest($test_member);

                // count up
                $count->countAfter();
                $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
                $this->assertEquals($count->orderItemCountBefore, $count->orderItemCountAfter);
            }
        }

        /**
         * ERROR
         */
        public function testRollBackGuestOrder(){
            // count up
            $count = new Countup;
            $count->countBefore();

            // setup test data
            // member : o
            // cart   : x
            $test_member = getTestMember();
            $test_cart = new Cart;

            // create order
            execGuestOrder($test_member, $test_cart);

            // count up
            $count->countAfter();

            $this->assertEquals($count->memberCountBefore, $count->memberCountAfter);
            $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
        }

        public function testRollBackMemberOrder(){
            // count up
            $count = new Countup;
            $count->countBefore();

            // setup test data
            // member: o
            // cart  : x
            $test_member = getTestMember();
            $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($test_member);
            $test_cart = new Cart;

            // create order
            execMemberOrder($test_cart);

            // count up
            $count->countAfter();

            $this->assertEquals($count->memberCountBefore, $count->memberCountAfter);
            $this->assertEquals($count->orderCountBefore, $count->orderCountAfter);
        }
    }

    function deleteOrderForTest($member){
        try{
            // DBアクセス
            $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            // transaction start
            $dbh->beginTransaction();

            // delete member
            $sql = "DELETE FROM dat_member WHERE code = ?";
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $member->code;
            $stmt->execute($data);

            // get order code
            $sql = "SELECT code FROM dat_sales WHERE code_member = ?";
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $member->code;
            $stmt->execute($data);
            $rec = $stmt->fetch(PDO::FETCH_ASSOC);
            $order_code = $rec['code'];

            // delete order
            $sql = "DELETE FROM dat_sales WHERE code_member = ?";
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $member->code;
            $stmt->execute($data);
    
            // delete order item
            $sql = "DELETE FROM dat_sales_product WHERE code_sales = ?";
            $stmt = $dbh->prepare($sql);
            $data = array();
            $data[] = $order_code;
            $stmt->execute($data);

            $dbh->commit();

            // DB切断
            $dbh = null;

        }catch(Exception $e){
            print 'DB ERROR AAA';

            echo $e;

            $dbh->rollback();
            $dbh = null;

            exit();
        }
    }

    function getTestMember(){
        $test_member = new Member;
        $test_member->code = 999;
        $test_member->name = "test name";
        $test_member->email = "test999@gmail.com";
        $test_member->postal1 = "000";
        $test_member->postal2 = "0000";
        $test_member->address = "test address";
        $test_member->tel = "000-0000-0000";
        $test_member->password = "demo";
        return $test_member;
    }

    function getTestCart($num){
        $itemList = array();
        
        // 500円 * 10% * 50円 = 600円
        $item = new Item;
        $item->code = 900;
        $item->name = "item1";
        $item->price = 500;
        $item->profit_rate = 10;
        $item->shipment_fee = 50;
        array_push($itemList, $item);
        
        // 300円 * 10% * 30円 = 360円
        $item = new Item;
        $item->code = 910;
        $item->name = "item2";
        $item->price = 300;
        $item->profit_rate = 10;
        $item->shipment_fee = 30;
        array_push($itemList, $item);
        
        // 400円 * 10% * 50円 = 480円
        $item = new Item;
        $item->code = 920;
        $item->name = "item2";
        $item->price = 300;
        $item->profit_rate = 10;
        $item->shipment_fee = 30;
        array_push($itemList, $item);
        
        // set to cart
        $test_cart = new Cart;
        for($i = 0; $i < $num; $i++){
            $item = $itemList[$i];
            $test_cart->addItemToCart($item);
        }

        return $test_cart;
    }

    class Countup{
        public $memberCountBefore;
        public $orderCountBefore;
        public $orderItemCountBefore;
        public $memberCountAfter;
        public $orderCountAfter;
        public $orderItemCountAfter;

        public function countBefore(){
            $memberList = getAllMemberList();
            $this->memberCountBefore = count($memberList);
            $orderList = getAllOrderList();
            $this->orderCountBefore = count($orderList);
            $this->orderItemCountBefore = $this->getOrderItemCount();
        }

        public function countAfter(){
            $memberList = getAllMemberList();
            $this->memberCountAfter = count($memberList);
            $orderList = getAllOrderList();
            $this->orderCountAfter = count($orderList);
            $this->orderItemCountAfter = $this->getOrderItemCount();
        }

        function getOrderItemCount(){
            try{
                // DBアクセス
                $dbh = new PDO(Con::$dsn, Con::$user, Con::$password);
                $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
                // get order code
                $sql = "SELECT * FROM dat_sales_product";
                $stmt = $dbh->prepare($sql);
                $stmt->execute();
                
                // DB切断
                $dbh = null;
    
                $count = 0;
                while(true){
                    $rec = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($rec == false){
                        break;
                    }
                    $count += 1;
                }
    
                return $count;
                
            }catch(Exception $e){
                print 'DB ERROR';
                echo $e;
                $dbh = null;
                exit();
            }
        }
    }
?>