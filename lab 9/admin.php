<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    die("Доступ запрещён!");
}

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ панель</title>
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
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            width: 100%;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.6);
        }
        h1 {
            font-size: 30px;
            margin-bottom: 20px;
        }
        a {
            display: inline-block;
            text-align: center;
            color: black;
            background-color: white;
            padding: 12px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 18px;
            margin-top: 20px;
            transition: background-color 0.3s ease;
        }
        a:hover {
            background-color: #ddd;
        }
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }
        th {
            background-color: #333;
        }
        tr:nth-child(even) {
            background-color: #444;
        }
        tr:hover {
            background-color: #555;
        }
        .button {
            color: black;
            background-color: white;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
        }
        .button:hover {
            background-color: #ddd;
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
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Админ панель</h1>

    <a href="adduser.php" class="button">Добавить нового пользователя</a>

    <table>
        <thead>
            <tr>
                <th>Логин</th>
                <th>Роль</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
                <tr>
                    <td><?php echo htmlspecialchars($user['username']); ?></td>
                    <td><?php echo htmlspecialchars($user['role']); ?></td>
                    <td>
                        <a href="edit.php?id=<?php echo $user['id']; ?>" class="button">Редактировать</a>
                        <a href="delete.php?id=<?php echo $user['id']; ?>" class="button" onclick="return confirm('Вы уверены, что хотите удалить пользователя?');">Удалить</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <a href="logout.php" class="logout">Выйти</a>
</div>

</body>
</html>
