<?php 
    include_once 'vendor/version.php'; 
    VersionCheck();
?>
<?php
    ob_start();

    session_start();

    include_once 'app/controllers/VerifyController.php';
    include_once 'app/db.php';

    $verifyObj = new VerifyController();

    $res = $verifyObj->getVerify();

    if ($res === true) {
        $_SESSION['verified'] = true;
        header("Location: resources/views/greetings.php");
        exit();
    } elseif (is_string($res)) {
        echo $res;
    }else{
        header("Location: config/purchase.php");
        exit();
    }

    ob_end_flush();
?>


