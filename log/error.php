<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            text-align: center;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            width: 100%;
            text-align: center;
        }
        .error-container {
            background-color: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            max-width: 400px;
            width: 90%;
            margin: 20px 0;
        }
        .error-container h1 {
            font-size: 48px;
            margin: 0;
            color: #4CAF50;
        }
        .error-container p {
            margin: 10px 0;
            font-size: 16px;
        }
        .error-container button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 20px;
        }
        .error-container button:hover {
            background-color: #45a049;
        }
        footer {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 10px 0;
            width: 100%;
            position: fixed;
            bottom: 0;
        }
    </style>
</head>
<body>

<header>
    <h1>BnDictionary</h1>
</header>

<div class="error-container">
    <h1>404</h1>
    <p>Oops! The page you are looking for does not exist.</p>
    <p>It might have been moved or deleted.</p>
    <button onclick="goHome()">Go to Home</button>
</div>

<footer>
    <p>&copy; 2024 BnDictionary. All rights reserved.</p>
</footer>

<script>
    function goHome() {
        window.location.href = '/';
    }
</script>

</body>
</html>
