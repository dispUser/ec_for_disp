<?php
    require_once("header.php");
?>
<body>
    <article id="login">
        <div class="content_width">
            <h2>Membership Login</h2>
            <form action="member_login_check.php" method="post">
                <div class="title">
                    Email
                </div>
                <input type="text" name="email">
                <div class="title">
                    Password
                </div>
                <input type="password" name="pass">
                <div>
                    <input type="submit" value="Login" class="login_button">
                </div>
            </form>
        </div>
    </article>
</body>
</html>