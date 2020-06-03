<?php
    include "../includes/header.php";

    $memberInfo = new Member();
    // 安全化
    $memberInfo->code = htmlspecialchars($_POST['code'], ENT_QUOTES, 'UTF-8');
    $memberInfo->name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $memberInfo->email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $memberInfo->postal1 = htmlspecialchars($_POST['postal1'], ENT_QUOTES, 'UTF-8');
    $memberInfo->postal2 = htmlspecialchars($_POST['postal2'], ENT_QUOTES, 'UTF-8');
    $memberInfo->address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');
    $memberInfo->password = htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8');

    // 暗号化
    if($memberInfo->password != ''){
        $memberInfo->password = encrypt($memberInfo->password);
    }

    execUpdateMember($memberInfo);
    
?>

<div class="col-sm-12">
    <h2>Edit done</h2>
    <p>
        Profile is updated.
    </p>
    <div>
        <a href="member_disp.php?member_code=<?php echo $memberInfo->code ?>" class="btn">Go to top</a>
    </div>
</div>

