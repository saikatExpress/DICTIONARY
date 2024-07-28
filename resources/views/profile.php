<?php 
    include_once '../auth/session.php'; 
    Session::checkSession();
?>
<?php include_once '../views/layout/header.php'; ?>

    <div class="main-content">
        <div class="user-info">
            <h3>User Profile</h3>
            <img id="user-image" src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS2rQqSyR1xF2AJYlijHJvqb-vhe4EyWSc5ZA&s" alt="User Image">
            <div class="details">
                <label><strong>Name:</strong> <span id="user-name"><?= $_SESSION['name'] ?></span></label> <br>
                <label><strong>Email:</strong> <span id="user-email"><?= $_SESSION['email'] ?></span></label> <br>
                <label><strong>Bio:</strong> <span id="user-bio">I am Saikat Talukder and i am a professional Web Developer</span></label>
            </div>
            <div class="bio">
                <strong>Bio:</strong>
                <p id="user-bio">I am Saikat Talukder and i am a professional Web Developer</p>
            </div>
            <ul class="activities" id="user-activities">
                <li>
                    Create a profile a page
                </li>
            </ul>
        </div>

        <div class="profile-section">
            <h3>Update Information</h3>
            <form id="update-info-form">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                
                <button type="button" onclick="updateInfo()">Update Info</button>
                <div class="message" id="info-message"></div>
            </form>
        </div>

        <div class="profile-section">
            <h3>Update Password</h3>
            <form id="update-password-form">
                <label for="current-password">Current Password:</label>
                <input type="password" id="current-password" name="current_password" required>
                
                <label for="new-password">New Password:</label>
                <input type="password" id="new-password" name="new_password" required>
                
                <label for="confirm-password">Confirm New Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required>
                
                <button type="button" onclick="updatePassword()">Update Password</button>
                <div class="message" id="password-message"></div>
            </form>
        </div>

        <div class="profile-section">
            <h3>Update Email</h3>
            <form id="update-email-form">
                <label for="new-email">New Email:</label>
                <input type="email" id="new-email" name="new_email" required>
                
                <button type="button" onclick="updateEmail()">Update Email</button>
                <div class="message" id="email-message"></div>
            </form>
        </div>
    </div>
<?php include_once '../views/layout/footer.php'; ?>
