<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role = $_POST['role'];

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);

    if ($stmt->fetchColumn() > 0) {
        $error = "Логин уже существует. Выберите другой.";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role]);

        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Регистрация</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: black;
            color: white;
            font-family: 'Orbitron', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .register-form {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.6);
            width: 100%;
            max-width: 400px;
            text-align: center;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        label {
            font-size: 16px;
            margin-bottom: 8px;
            display: block;
        }
        input, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #fff;
            background-color: black;
            color: white;
            font-size: 16px;
            border-radius: 5px;
        }
        button {
            background-color: white;
            color: black;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #ddd;
        }
        .error {
            color: red;
            margin-bottom: 15px;
        }
        .login-link {
            margin-top: 20px;
            font-size: 16px;
        }
        .login-link a {
            color: white;
            text-decoration: none;
            font-weight: bold;
        }
        .login-link a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="register-form">
        <h1>Регистрация</h1>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="post">
            <label for="username">Логин:</label>
            <input type="text" name="username" id="username" placeholder="Введите логин" required>

            <label for="password">Пароль:</label>
            <input type="password" name="password" id="password" placeholder="Введите пароль" required>

            <label for="role">Роль:</label>
            <select name="role" id="role" required>
                <option value="user">Пользователь</option>
                <option value="admin">Администратор</option>
            </select>

            <button type="submit">Зарегистрироваться</button>
        </form>
        <div class="login-link">
            <p>Уже зарегистрированы? <a href="login.php">Войдите здесь</a></p>
        </div>
    </div>
</div>

</body>
</html>
