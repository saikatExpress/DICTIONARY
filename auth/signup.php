<?php
include_once '../app/models/User.php';

$user = new User();

$errors = [];
$username = $email = $mobile = $password = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $mobile = $_POST['mobile'];
    $password = $_POST['password'];

    // Server-side validation
    if (empty($username)) {
        $errors['username'] = 'Username is required.';
    }
    if (empty($email)) {
        $errors['email'] = 'Email is required.';
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = 'Invalid email format.';
    }
    if (empty($mobile)) {
        $errors['mobile'] = 'Mobile number is required.';
    } elseif (!preg_match('/^\d{11}$/', $mobile)) {
        $errors['mobile'] = 'Mobile number must be 10 digits.';
    }
    if (empty($password)) {
        $errors['password'] = 'Password is required.';
    }

    if (empty($errors)) {
        $res = $user->register($username, $password, $email, $mobile);
        if ($res === true) {
            $_SESSION['success'] = "Registration successful!";
            header("Location: ../index.php");
        } else {
            echo "Registration failed. <a href='signup.html'>Try again</a>";
        }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background: linear-gradient(to right, #6a11cb, #2575fc);
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            width: 100%;
        }
        .container h2 {
            margin-top: 0;
            color: #333;
        }
        .container form {
            display: flex;
            flex-direction: column;
        }
        .container form input {
            margin: 10px 0;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .container form button {
            padding: 10px;
            font-size: 16px;
            background-color: #6a11cb;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background 0.3s;
        }
        .container form button:hover {
            background-color: #2575fc;
        }
        .container .login-link {
            margin-top: 20px;
            text-align: center;
        }
        .container .login-link a {
            color: #6a11cb;
            text-decoration: none;
        }
        .error {
            color: red;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Sign Up</h2>
        
        <form action="signup.php" method="POST">
            <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>">
            <?php if (isset($errors['username'])): ?>
                <p class="error"><?php echo $errors['username']; ?></p>
            <?php endif; ?>

            <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>">
            <?php if (isset($errors['email'])): ?>
                <p class="error"><?php echo $errors['email']; ?></p>
            <?php endif; ?>

            <input type="text" name="mobile" placeholder="Mobile" value="<?php echo htmlspecialchars($mobile); ?>">
            <?php if (isset($errors['mobile'])): ?>
                <p class="error"><?php echo $errors['mobile']; ?></p>
            <?php endif; ?>

            <input type="password" name="password" placeholder="Password">
            <?php if (isset($errors['password'])): ?>
                <p class="error"><?php echo $errors['password']; ?></p>
            <?php endif; ?>

            <button type="submit">Sign Up</button>
        </form>
        <div class="login-link">
            <p>Do you have an account? <a href="../../index.php">Login here</a></p>
        </div>
    </div>
</body>
</html>