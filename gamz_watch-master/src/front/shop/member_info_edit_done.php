<?php
    require_once("header.php");

    $memberInfo = new Member();

    // 安全化
    $member = unserialize($_SESSION[SESSION_CON::$MEMBER_ENTITY]);
    $memberInfo->code = $member->code;
    $memberInfo->name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    $memberInfo->email = htmlspecialchars($_POST['email'], ENT_QUOTES, 'UTF-8');
    $memberInfo->postal1 = htmlspecialchars($_POST['postal1'], ENT_QUOTES, 'UTF-8');
    $memberInfo->postal2 = htmlspecialchars($_POST['postal2'], ENT_QUOTES, 'UTF-8');
    $memberInfo->address = htmlspecialchars($_POST['address'], ENT_QUOTES, 'UTF-8');

    execUpdateMember($memberInfo);
    $_SESSION[SESSION_CON::$MEMBER_ENTITY] = serialize($memberInfo);
?>

<article id="member_info_edit_done">
    <h2>Edit done</h2>
    <div>
        Profile is updated.
    </div>
    <div>
        <a href="member_info.php" class="back_button fix_button">To Member Info</a>
        <a href="shop_list.php" class="back_button fix_button">Go to top</a>
    </div>
</article>

