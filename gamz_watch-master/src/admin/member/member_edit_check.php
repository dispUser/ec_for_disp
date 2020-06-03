<?php
    include "../includes/header.php";
?>
    <?php
        $member_code = $_POST['code'];
        $member_name = $_POST['name'];
        $member_email = $_POST['email'];
        $member_postal1 = $_POST['postal1'];
        $member_postal2 = $_POST['postal2'];
        $member_address = $_POST['address'];
        $member_tel = $_POST['tel'];
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];

        // 安全対策
        $member_code = htmlspecialchars($member_code, ENT_QUOTES, 'UTF-8');
        $member_name = htmlspecialchars($member_name, ENT_QUOTES, 'UTF-8');
        $member_email = htmlspecialchars($member_email, ENT_QUOTES, 'UTF-8');
        $member_postal1 = htmlspecialchars($member_postal1, ENT_QUOTES, 'UTF-8');
        $member_postal2 = htmlspecialchars($member_postal2, ENT_QUOTES, 'UTF-8');
        $member_address = htmlspecialchars($member_address, ENT_QUOTES, 'UTF-8');
        $member_tel = htmlspecialchars($member_tel, ENT_QUOTES, 'UTF-8');

        $hasError = false;

        if($member_code == ''){
            $hasError = true;
            $member_code = 'code is empty.';
        }
        
        if($member_name == ''){
            $hasError = true;
            $member_name = 'name is empty.';
        }
        
        // if email is different from current email
        $same_male = getMemberByCode($member_code)->email;
        if(!$same_male == $member_email){
            // collect format?
            if(preg_match('/\A[\w\-\.]+\@[\w\-\.]+\.([a-z]+)\z/', $member_email) == 0){
                $hasError = true;
                $member_email = 'Not valid email format';
            // already exist?
            }else{
                $member_email_check = getEmail($member_email);
                if(isset($member_email_check)){
                    $hasError = true;
                    $member_email = 'Email already exist.';
                }
            }
        }

        if($password1 != '' && $password2 != ''){
            $result = checkPassword($password1, $password2);
            $hasError = $result[0];
            $pass_check_result_text = $result[1];
        }else{
            $pass_check_result_text = '';
        }

?>
    <div class="col-sm-12">
    <?php if(!$hasError){ ?>
        <form action="member_edit_done.php" method="post">
    <?php } ?>
            <h3>Code</h3>
            <div>
                <?php echo $member_code; ?>
            </div>
            <h3>Name</h3>
            <div>
                <?php echo $member_name; ?>
            </div>
            <h3>Email</h3>
            <div>
                <?php echo $member_email; ?>
            </div>
            <h3>Postal</h3>
            <div>
                <?php echo $member_postal1; ?> - <?php echo $member_postal2; ?>
            </div>
            <h3>Address</h3>
            <div>
                <?php echo $member_address; ?>
            </div>
            <h3>Tel</h3>
            <div>
                <?php echo $member_tel; ?>
            </div>
            <h3>Password</h3>
            <div>
                <?php echo $pass_check_result_text; ?>
            </div>

            
    <?php if(!$hasError){ ?>
            <div>
                All data collect?
            </div>

            <input type="hidden" name="code" value="<?php echo $member_code ?>">
            <input type="hidden" name="name" value="<?php echo $member_name ?>">
            <input type="hidden" name="email" value="<?php echo $member_email ?>">
            <input type="hidden" name="postal1" value="<?php echo $member_postal1 ?>">
            <input type="hidden" name="postal2" value="<?php echo $member_postal2 ?>">
            <input type="hidden" name="address" value="<?php echo $member_address ?>">
            <input type="hidden" name="tel" value="<?php echo $member_tel ?>">
            <input type="hidden" name="password" value="<?php echo $password1 ?>">

            <input type="button" onclick="history.back()" value="Back" class="btn">
            <input type="submit" value="OK" class="btn">
        </form>
    <?php }else { ?>
            <input type="button" onclick="history.back()" value="Back" class="btn">
    <?php } ?>
        
    </div>
        
        

</body>
</html>