<?php
    include "../includes/header.php"
?>
    <?php
        $category_name=$_POST['name'];

        // 安全対策
        $category_name = htmlspecialchars($category_name, ENT_QUOTES, 'UTF-8');

        $hasError = false;

        if($category_name == ''){
            $hasError = true;
            print 'Category Name is empty.';
            print '<br>';
        }else{
            print 'Category Name:';
            print $category_name;
            print '<br>';
        }

        if($hasError){
            print '<form>';
            print '<input type="button" onclick="history.back()" value="Back">';
            print '</form>';
        }else{
            print 'Add category above.<br>';
            print '<form action="category_add_done.php" method="post">';
            print '<input type="hidden" name="name" value="'.$category_name.'">';
            print '<input type="button" onclick="history.back()" value="Back">';
            print '<input type="submit" value="OK">';
            print '</form>';
        }

    ?>

</body>
</html>