<?php
    session_start();
    include "system/aes.php";
    if(isset($_COOKIE['crypt'])){
        $_SESSION['email'] = AES("decrypt",$_COOKIE['crypt']);
    }
    include "system/function.php";
    include "system/view/header.php";
    include "system/view/main.php";
    include "system/view/footer.php";
?>