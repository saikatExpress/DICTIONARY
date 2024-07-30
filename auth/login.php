<?php session_start(); ?>
<?php include_once '../app/models/User.php'; ?>
<?php include_once  '../auth/session.php';?>

<?php

$user = new User();

$errors = [];
$email = $password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    }

    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    $res = $user->login($email, $password);

    if ($res === true) {
        Session::set("user_login", true);
        Session::set("msg", "Invalid Code");
        Session::set("id", $user->id);
        Session::set("name", $user->username);
        Session::set("email", $user->email);
        header("Location: ../resources/views/welcome.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="assets/logos/fav.png" type="image/x-icon">
    <title>Login</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        
        <form action="login.php" method="POST">
            <input type="text" name="email" placeholder="Email">
            <?php if (isset($errors['email'])): ?>
                <p style="color: red;"><?php echo $errors['email']; ?></p>
            <?php endif; ?>
            <input type="password" name="password" placeholder="Password">
            <?php if (isset($errors['password'])): ?>
                <p style="color: red;"><?php echo $errors['password']; ?></p>
            <?php endif; ?>
            <button type="submit">Login</button>
        </form>
        <div class="links">
            <p>Do you have no account? <a href="views/auth/register.html">Sign up here</a></p>
            <p>
                <a href="views/auth/forgot.html">
                    Forgot password?
                </a>
            </p>
        </div>
    </div>




    <script>
        setTimeout(function() {
            var successMsg = document.getElementById('successMsg');
            successMsg.style.opacity = 0;
            setTimeout(function() {
                successMsg.style.display = 'none';
            }, 600); // Delay to allow fade out transition
        }, 3000); // 3 seconds
    </script>
</body>
</html>
