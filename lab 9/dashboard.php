<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Панель управления</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: black;
            color: white;
            font-family: 'Orbitron', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            text-align: center;
            padding: 20px;
        }
        .container {
            width: 100%;
            max-width: 600px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            text-align: center;
            color: black;
            background-color: white;
            padding: 15px 25px;
            border-radius: 5px;
            margin-top: 20px;
            text-decoration: none;
            font-size: 18px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #ddd;
            color: black;
        }
        .button {
            display: inline-block;
            margin-top: 20px;
            text-decoration: none;
        }
        .logout {
            background-color: red;
            color: white;
            padding: 12px 20px;
            border-radius: 5px;
            margin-top: 30px;
        }
        .logout:hover {
            background-color: #e74c3c;
        }
        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 20px;
            }
            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Панель управления</h1>

    <p>Добро пожаловать, <?php echo $_SESSION['user']['username']; ?>!</p>

    <?php if ($_SESSION['user']['role'] === 'admin'): ?>
        <a href="admin.php" class="button">Админ панель</a>
    <?php else: ?>
        <a href="edit.php" class="button">Редактировать профиль</a>
    <?php endif; ?>

    <a href="logout.php" class="logout">Выйти</a>
</div>

</body>
</html>
