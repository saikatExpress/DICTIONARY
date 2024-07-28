<?php
include_once '../auth/session.php'; 
Session::checkSession();

include_once '../app/models/Post.php';

$postObj = new Post();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $content = $_POST['content'];
    $userId = $_SESSION["id"];

    $res = $postObj->create($content,$userId);

    if ($res === true) {
        $_SESSION['message'] = 'Post created successfully.';
    } else {
        $_SESSION['message'] = 'Failed to create post.';
    }
    header("Location: ../views/dashboard.php"); // Redirect to the dashboard or wherever you want
    exit();
}
?>
