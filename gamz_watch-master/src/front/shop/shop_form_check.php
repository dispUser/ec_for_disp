<?php
    include("header.php");
    
    $post = sanitize($_POST);
    
    $onamae = $post['onamae'];
    $email = $post['email'];
    $postal1 = $post['postal1'];
    $postal2 = $post['postal2'];
    $address = $post['address'];
    $tel = $post['tel'];
    $pass = $post['pass'];
    $pass2 = $post['pass2'];
    
    $okFlag = true;
    
    if($onamae == ''){
        $okFlag = false;
        $onamae = 'Your name is empty.';
    }
    
    if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $email) == 0){
        $okFlag = false;
        $email = 'Not valid email. format';
    }else{
        // email 存在チェック
        $memberList = getEmail($email);
        if(count($memberList) > 0){
            $okFlag = false;
            $email = 'Email already exist.';
        }
    }
    
    $postalOk = true;
    $postal = '';
    if(preg_match('/\A[0-9]+\z/', $postal1) == 0){
        $okFlag = false;
        $postalOk = false;
        $postal = 'postal1';
    }
    
    if(preg_match('/\A[0-9]+\z/', $postal2) == 0){
        $okFlag = false;
        $postalOk = false;
        $postal = $postal." postal2";
    }
    
    if($postalOk){
        $postal = $postal1." - ".$postal2;
    }else{
        $postal = $postal." is not valid.";
    }
    
    if($address == ''){
        $okFlag = false;
        $address = 'Your address is empty.';
    }
    
    if(preg_match('/\A\d{2,5}-?\d{2,5}-?\d{4,5}\z/', $tel) == 0){
        $okFlag = false;
        $tel =  'Your phone number is not valid.';
    }

    $pass_text = "valid password.";
    if($pass == ''){
        $okFlag = false;
        $hasError = true;
        $pass_text = 'Password is empty.';
    }else{
        if($pass != $pass2){
            $okFlag = false;
            $pass_text = "Password doesn't match.";
        }
    }

?>
    <article id="shop_form_check">
        <div class="content_width">
            <div class="box first">
                <div class="title">
                    Your Name
                </div>
                <div>
                    <?php
                        print $onamae;
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Email
                </div>
                <div>
                    <?php
                        print $email;
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Postal code
                </div>
                <div>
                    <?php
                        print $postal;
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Address
                </div>
                <div>
                    <?php
                        print $address;
                    ?>
                </div>
            </div>
            <div class="box">
                <div class="title">
                    Tel
                </div>
                <div>
                    <?php
                        print $tel;
                    ?>
                </div>
            </div>
            <?php
                print '<div class="box">';
                    print '<div class="title">';
                        print 'Password';
                    print '</div>';
                    print '<div>';
                        print $pass_text;
                    print '</div>';
                print '</div>';
            ?>
            <form action="shop_form_done.php" method="post">
                <input type="hidden" name="onamae" value="<?php print $onamae; ?>">
                <input type="hidden" name="email" value="<?php print $email; ?>">
                <input type="hidden" name="postal1" value="<?php print $postal1; ?>">
                <input type="hidden" name="postal2" value="<?php print $postal2; ?>">
                <input type="hidden" name="address" value="<?php print $address; ?>">
                <input type="hidden" name="tel" value="<?php print $tel; ?>">
                <input type="hidden" name="chumon" value="<?php print $chumon; ?>">
                <input type="hidden" name="pass" value="<?php print $pass; ?>">
                <div>
                    <?php
                        if($okFlag){
                            print '<div>';
                            print '<input type="submit" value="OK" class="back_button fix_button">';
                            print '</div>';
                        }
                    ?>
                    <div>
                        <input type="button" onclick="history.back()" value="Back" class="back_button fix_button">
                    </div>
                </div>
            </form>
        </div>
    </article>
<?php
    require_once("footer.php");
?>