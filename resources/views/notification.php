<?php 
    include_once '../../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>

    <div class="main-content">
        <div class="page_title1">
            <h3>Notifications</h3>
        </div>
        <div class="notification-header">
            <input type="text" id="search-input" placeholder="Search notifications...">
            <select id="filter-select">
                <option value="">All</option>
                <option value="unread">Unread</option>
                <option value="read">Read</option>
            </select>
        </div>
        <div class="notification-list" id="notification-list">
            <!-- Notifications will be dynamically inserted here -->
        </div>
    </div>
<?php include_once '../views/layout/footer.php'; ?>