<?php 
    include_once '../../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>
    <div class="main-content">
        <h2>Welcome to Your Dashboard</h2>
        <?php
        
        if (isset($_SESSION['message'])) {
            echo '<div class="alert">' . $_SESSION['message'] . '</div>';
            // Unset the message after displaying it
            unset($_SESSION['message']);
        }
        
        ?>
        <!-- Post Form -->
        <div class="post-form">
            <form method="post" action="../auth/submit_post.php">
                <textarea name="content" id="editor"></textarea>
                <button style="margin-top: 10px;" type="submit">Post</button>
            </form>
        </div>
        
        <!-- Example Posts -->
        <div class="post">
            <div class="author">John Doe</div>
            <div class="content">This is an example post. It includes some text to demonstrate the layout.</div>
        </div>
        
        <div class="post">
            <div class="author">Jane Smith</div>
            <div class="content">Here is another example post. Feel free to customize the content and style as needed.</div>
        </div>
    </div>

    <script>
    CKEDITOR.replace('editor');
</script>
<?php include_once '../views/layout/footer.php'; ?>

