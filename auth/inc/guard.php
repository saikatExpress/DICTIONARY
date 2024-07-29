<?php
    session_start();

    // Include the VerifyController and db.php
    include_once '../../app/controllers/VerifyController.php';
    include_once '../../app/db.php';

    // Initialize VerifyController and check verification
    $verifyObj = new VerifyController();
    if (!$verifyObj->isVerified()) {
        // Unset session variable if not verified
        unset($_SESSION['verified']);
        // Redirect to the home page or login page if not verified
        header("Location: ../../index.php");
        exit();
    }
?>