<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BnDictionary Dashboard</title>
    <link rel="shortcut icon" href="../public/icons/dictionary.png" type="image/x-icon">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

    <!-- CKEditor CDN -->
    <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


    <link rel="stylesheet" href="../public/assets/css/main.css">

</head>
<body>
    <header class="header">
        <div class="header-content">
            <h1>
                <a style="text-decoration: none; color:#fff;" href="../views/welcome.php">
                    BnDictionary
                </a>
            </h1>
            <div class="search-bar">
                <input type="text" placeholder="Search...">
                <button type="button"><i class="fas fa-search"></i></button>
            </div>
            <div class="profile">
                <div class="profile-icon" onclick="toggleDropdown()"></div>
                <div class="dropdown" id="dropdownMenu">
                    <a href="../views/profile.php">
                        <i class="fas fa-user"></i> 
                        Your Profile
                    </a>
                    <a href="#"><i class="fas fa-cogs"></i> Settings</a>
                    <a href="#"><i class="fas fa-info-circle"></i> About</a>
                    <a href="../views/auth/logout.php?action=logout"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
            </div>
            <div class="hamburger" onclick="toggleSidebar()">
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </header>
    
    <nav class="nav-menu">
        <ul>
            <li><a href="../views/welcome.php"><i class="fas fa-home"></i> Home</a></li>
            <li>
                <a href="../views/profile.php">
                    <i class="fas fa-user"></i> 
                    Profile
                </a>
            </li>
            <li>
                <a href="../views/dictionary.php">
                    <i class="fas fa-user"></i> 
                    Dictionary
                </a>
            </li>
            <li><a href="../views/message.php">
                <i class="fas fa-envelope"></i> 
                Messages
            </a>
            </li>
            <li>
                <a href="../views/notification.php">
                    <i class="fas fa-bell"></i> 
                    Notifications
                </a>
            </li>
        </ul>
    </nav>
    
    <div class="sidebar-menu" id="sidebarMenu">
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="#"><i class="fas fa-user"></i> Profile</a></li>
            <li><a href="#"><i class="fas fa-envelope"></i> Messages</a></li>
            <li><a href="#"><i class="fas fa-bell"></i> Notifications</a></li>
        </ul>
    </div>