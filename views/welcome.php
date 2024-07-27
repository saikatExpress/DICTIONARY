<?php 
    include_once '../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>
    <div class="main-content">
        <h2>Welcome to Your Dashboard</h2>
        
        <!-- Post Form -->
        <div class="post-form">
            <textarea rows="4" placeholder="What's on your mind?"></textarea>
            <button type="button">Post</button>
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
<?php include_once '../views/layout/footer.php'; ?>

