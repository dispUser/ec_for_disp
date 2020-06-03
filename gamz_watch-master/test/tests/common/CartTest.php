<?php
    use PHPUnit\Framework\TestCase;
    include_once __DIR__ . "/../../../src/common/Function.php";

    class CartTest extends TestCase{
        public function testAddItemCountIncrease(){
            $cart = new Cart;
            $this->assertEquals(0, count($cart->cartItemList));
            
            $item = new Item;
            $item->code = 10;
            $cart->addItemToCart($item);
            $this->assertEquals(1, count($cart->cartItemList));
            
            $item = new Item;
            $item->code = 11;
            $cart->addItemToCart($item);
            $this->assertEquals(2, count($cart->cartItemList));
            
            $item = new Item;
            $item->code = 12;
            $cart->addItemToCart($item);
            $this->assertEquals(3, count($cart->cartItemList));
            
            $item = new Item;
            $item->code = 13;
            $cart->addItemToCart($item);
            $this->assertEquals(4, count($cart->cartItemList));
        }

        public function testCountItemInCart(){
            $cart = new Cart;
            $this->assertEquals(0, $cart->getItemCount());
            
            $item = new Item;
            $item->code = 10;
            $cart->addItemToCart($item);
            $this->assertEquals(1, $cart->getItemCount());
            
            $item = new Item;
            $item->code = 11;
            $cart->addItemToCart($item);
            $this->assertEquals(2, $cart->getItemCount());
            
            $item = new Item;
            $item->code = 12;
            $cart->addItemToCart($item);
            $this->assertEquals(3, $cart->getItemCount());
            
            $item = new Item;
            $item->code = 13;
            // set quantity
            $cart->addItemToCart($item);
            // change quantity
            $cartItem = $cart->cartItemList[3];
            $cartItem->quantity = 2;
            $this->assertEquals(5, $cart->getItemCount());

            $item = new Item;
            $item->code = 14;
            // set quantity
            $cart->addItemToCart($item);
            // change quantity
            $cartItem = $cart->cartItemList[4];
            $cartItem->quantity = 5;
            $this->assertEquals(10, $cart->getItemCount());
        }

        public function testAddItemCountNotChange(){
            $cart = new Cart;
            $this->assertEquals(0, count($cart->cartItemList));

            $item = new Item;
            $item->code = 10;
            $cart->addItemToCart($item);
            $this->assertEquals(1, count($cart->cartItemList));

            $item = new Item;
            $item->code = 10;
            $cart->addItemToCart($item);
            $this->assertEquals(1, count($cart->cartItemList));

            $item = new Item;
            $item->code = 10;
            $cart->addItemToCart($item);
            $this->assertEquals(1, count($cart->cartItemList));
        }
        
        public function testAddItemContent(){
            $cart = new Cart;
            
            $item = new Item;
            $item->code = 10;
            $item->name = 'name';
            $item->price = 20;
            $item->profit_rate = 30;
            $item->shipment_fee = 40;
            $item->image_code = 50;
            $item->file_name = 'test.png';
            $cart->addItemToCart($item);

            $cartItem = $cart->cartItemList[0];
            $this->assertEquals(10, $cartItem->code);
            $this->assertEquals('name', $cartItem->name);
            $this->assertEquals(20, $cartItem->price);
            $this->assertEquals(30, $cartItem->profit_rate);
            $this->assertEquals(40, $cartItem->shipment_fee);
            $this->assertEquals(50, $cartItem->image_code);
            $this->assertEquals('test.png', $cartItem->file_name);
            $this->assertEquals(1, $cartItem->quantity);

            $item = new Item;
            $item->code = 11;
            $item->name = 'name';
            $item->price = 20;
            $item->profit_rate = 30;
            $item->shipment_fee = 40;
            $item->image_code = 50;
            $item->file_name = 'test.png';
            $cart->addItemToCart($item);

            $cartItem = $cart->cartItemList[1];
            $this->assertEquals(11, $cartItem->code);
            $this->assertEquals('name', $cartItem->name);
            $this->assertEquals(20, $cartItem->price);
            $this->assertEquals(30, $cartItem->profit_rate);
            $this->assertEquals(40, $cartItem->shipment_fee);
            $this->assertEquals(50, $cartItem->image_code);
            $this->assertEquals('test.png', $cartItem->file_name);
            $this->assertEquals(1, $cartItem->quantity);
        }

        public function testOrderPriceInCart(){
            $cart = new Cart;

            $item = new Item;
            $item->code = 1;
            $item->price = 100;
            $item->profit_rate = 10;
            $item->shipment_fee = 20;
            $cart->addItemToCart($item);

            // 100円 * 利益率10% + 送料20円 * 1個 = 130円
            $this->assertEquals(130, $cart->getTotalPrice());

            $item = new Item;
            $item->code = 2;
            $item->price = 500;
            $item->profit_rate = 50;
            $item->shipment_fee = 50;
            $cart->addItemToCart($item);
            // 130円
            // 500円 * 利益率50% + 送料50円 * 1個 = 800
            // 合計: 930円
            $this->assertEquals(930, $cart->getTotalPrice());

            $item = new Item;
            $item->code = 3;
            $item->price = 300;
            $item->profit_rate = 30;
            $item->shipment_fee = 30;
            $cart->addItemToCart($item);
            // 930円
            // 300円 * 利益率30% + 送料30円 * 1個 = 420円
            // 合計: 1350円
            $this->assertEquals(1350, $cart->getTotalPrice());

            $item = new Item;
            $item->code = 4;
            $item->price = 300;
            $item->profit_rate = 30;
            $item->shipment_fee = 30;
            $cart->addItemToCart($item);
            // change quantity to 3
            $cart->cartItemList[3]->quantity = 3;
            
            // 1350円
            // 300円 * 利益率30% + 送料30円 * 3個 = 1260円
            // 合計: 2610円
            $this->assertEquals(2610, $cart->getTotalPrice());

        }
    }
?>