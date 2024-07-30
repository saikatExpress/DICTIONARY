<?php 
    include_once '../../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>

    <div class="main-content">
        <div class="chat-header">
            Chat with Support
        </div>
        <div class="chat-body" id="chat-body">
            <!-- Chat messages will be dynamically inserted here -->
        </div>
        <div class="chat-input">
            <input type="text" id="message-input" placeholder="Type a message...">
            <button type="button" id="send-button">Send</button>
        </div>
    </div>
<?php include_once '../views/layout/footer.php'; ?>