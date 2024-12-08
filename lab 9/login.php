<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include 'db.php';
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: dashboard.php');
        exit;
    } else {
        echo "Неверный логин или пароль!";
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Вход</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Orbitron', sans-serif;
        }
        form {
            width: 300px;
            margin: 0 auto;
        }
        input, button {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #fff;
            background-color: black;
            color: white;
        }
        button {
            background-color: white;
            color: black;
            border: none;
        }
        button:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<h1>Вход</h1>
<form method="post">
    <input type="text" name="username" placeholder="Логин" required><br><br>
    <input type="password" name="password" placeholder="Пароль" required><br><br>
    <button type="submit">Войти</button>
</form>

</body>
</html>