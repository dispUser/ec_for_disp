<?php
    class Cart{
        public $cartItemList;

        function __construct(){
            $this->cartItemList = array();
        }

        public function addItemToCart($item){
            $pro_code = $item->code;
            $item_exist_flag = $this->checkItemExist($pro_code);
            // add the item to the cart if not exist
            if(!$item_exist_flag){
                $cartItem = $this->setCartItem($item);
                array_push($this->cartItemList, $cartItem);
            }

            return $item_exist_flag;
        }

        public function setCartItem($item){
            $cartItem = new CartItem;
            $cartItem->code = $item->code;
            $cartItem->name = $item->name;
            $cartItem->price = $item->price;
            $cartItem->profit_rate = $item->profit_rate;
            $cartItem->shipment_fee = $item->shipment_fee;
            $cartItem->image_code = $item->image_code;
            $cartItem->file_name = $item->file_name;
            $cartItem->quantity = 1;
            return $cartItem;
        }

        public function checkItemExist($pro_code){
            $item_exist_flag = false;
            for($i = 0; $i < count($this->cartItemList); $i++){
                $cart_item_code = $this->cartItemList[$i]->code;
                if($pro_code == $cart_item_code){
                    $item_exist_flag = true;
                }
            }
            return $item_exist_flag;
        }

        public function getTotalPrice(){
            $total_price = 0;
            for($i = 0; $i < count($this->cartItemList); $i++){
                $cartItem = $this->cartItemList[$i];
                $total_price += getSalePrice($cartItem) * $cartItem->quantity;
            }
            return $total_price;
        }

        public function getItemCount(){
            $count = 0;
            for($i = 0; $i < count($this->cartItemList); $i++){
                $cartItem = $this->cartItemList[$i];
                $count += $cartItem->quantity;
            }
            return $count;
        }
    }

?>