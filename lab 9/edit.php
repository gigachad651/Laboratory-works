<?php
include 'db.php';
session_start();

if (!isset($_SESSION['user'])) {
    die("Доступ запрещён!");
}

if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    if ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $id) {
        die("У вас нет прав для редактирования этого пользователя!");
    }
} else {
    $id = $_SESSION['user']['id']; 
}

$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    die("Пользователь не найден!");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'];
    $role = $_POST['role']; 

    if ($username !== $user['username']) {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND id != :id");
        $checkStmt->execute(['username' => $username, 'id' => $id]);
        if ($checkStmt->fetchColumn() > 0) {
            die("Логин уже занят!");
        }
    }

    $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
    $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

    echo "Данные обновлены!";
    header('Location: admin.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
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
        input, select, button {
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

<h1>Редактирование пользователя</h1>
<form method="post">
    <label for="username">Логин:</label>
    <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required><br><br>

    <label for="password">Пароль:</label>
    <input type="password" name="password" id="password"><br><br>

    <label for="role">Роль:</label>
    <select name="role" id="role">
        <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
        <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
    </select><br><br>

    <button type="submit">Сохранить изменения</button>
</form>

</body>
</html>