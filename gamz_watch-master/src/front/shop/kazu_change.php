<?php
    session_start();
    session_regenerate_id(true);
    
    require_once "../../common/Function.php";

    if(isset($_SESSION[SESSION_CON::$CART_ENTITY])){
        $cart = unserialize($_SESSION[SESSION_CON::$CART_ENTITY]);
        echo "cart exist";

        echo "<pre>";
        echo var_dump($cart);
        echo "</pre>";
    }else{
        // error
        echo "cart doesnt exist";
    }

    if(isset($_POST)){
        if(isset($_POST['calc'])){
            echo "post calc";

            $post = sanitize($_POST);
            for($i = 0; $i < count($cart->cartItemList); $i++){
                $cartItem = $cart->cartItemList[$i];
    
                if(preg_match("/\A[0-9]+\z/", $post['kazu'.$i]) == 0){
                    print '数量に誤りがあります。';
                    print '<a href="shop_cartlook.php">カートに戻る</a>';
                    exit();
                }
                if($post['kazu'.$i] < 1 || $post['kazu'.$i] > 10){
                    print '数量は1以上、10個までです。';
                    print '<a href="shop_cartlook.php">カートに戻る</a>';
                    exit();
                }
    
                $cartItem->quantity = $post['kazu' . $i];
            }
        }

        if(isset($_GET['delete'])){
            echo "get delete";

            $cartIndex = $_GET['delete'];
            echo "cart index: " . $_GET['delete'];
            $cart = unserialize($_SESSION[SESSION_CON::$CART_ENTITY]);
            array_splice($cart->cartItemList, $cartIndex, 1);
            $_SESSION[SESSION_CON::$CART_ENTITY] = serialize($cart);
        }

        if(isset($_POST['delete'])){
            echo "post delete";
        }
    }

    
    
    $_SESSION[SESSION_CON::$CART_ENTITY] = serialize($cart);

    header('Location: shop_cartlook.php');
    exit();
?>