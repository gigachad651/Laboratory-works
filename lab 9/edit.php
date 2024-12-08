<?php
include 'db.php';
session_start();

// Проверка, что пользователь авторизован
if (!isset($_SESSION['user'])) {
    die("Доступ запрещён!");
}

// Проверка прав доступа к редактированию
if (isset($_GET['id'])) {
    $id = (int) $_GET['id'];

    // Обычные пользователи могут редактировать только свои аккаунты
    if ($_SESSION['user']['role'] !== 'admin' && $_SESSION['user']['id'] !== $id) {
        die("У вас нет прав для редактирования этого пользователя!");
    }
} else {
    // Если параметр id не передан, редактируем только свой аккаунт
    $id = $_SESSION['user']['id']; 
}

// Запрос для получения данных пользователя
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
$user = $stmt->fetch();

if (!$user) {
    die("Пользователь не найден!");
}

// Обработка формы
$passwordChanged = false;  // Переменная для отслеживания изменения пароля
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_BCRYPT) : $user['password'];

    // Получаем роль, если она передана (для админов)
    $role = isset($_POST['role']) ? $_POST['role'] : $user['role'];  // Используем текущую роль, если она не передана

    // Проверка уникальности логина, если он изменен
    if ($username !== $user['username']) {
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username AND id != :id");
        $checkStmt->execute(['username' => $username, 'id' => $id]);
        if ($checkStmt->fetchColumn() > 0) {
            $errorMessage = "Логин уже занят!";
        } else {
            $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
            $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

            // Если пароль был изменен
            if (!empty($_POST['password'])) {
                $passwordChanged = true;
            }
        }
    } else {
        // Обновление без изменения логина
        $stmt = $pdo->prepare("UPDATE users SET username = :username, password = :password, role = :role WHERE id = :id");
        $stmt->execute(['username' => $username, 'password' => $password, 'role' => $role, 'id' => $id]);

        // Если пароль был изменен
        if (!empty($_POST['password'])) {
            $passwordChanged = true;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Редактирование пользователя</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            background-color: #121212; /* Темный фон для контраста */
            color: white;
            font-family: 'Poppins', sans-serif; /* Современный шрифт */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h1 {
            font-size: 32px;
            color: #ff7f50; /* Оранжевый акцент */
            margin-bottom: 20px;
            text-align: center;
        }

        .container {
            width: 100%;
            max-width: 400px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 40px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }

        label {
            font-size: 16px;
            margin-bottom: 5px;
            display: block;
        }

        input, select, button {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border: 1px solid #fff;
            background-color: #333;
            color: white;
            font-size: 16px;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }

        input:focus, select:focus, button:focus {
            outline: none;
            background-color: #444;
        }

        button {
            background-color: #ff7f50; /* Кнопки с оранжевым фоном */
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #e67e22; /* Цвет при наведении */
            transform: translateY(-2px); /* Легкое поднятие кнопки */
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            color: #ff7f50;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .success-message {
            color: #4CAF50;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .error-message {
            color: #f44336;
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        @media (max-width: 768px) {
            .container {
                width: 90%;
                padding: 30px;
            }

            h1 {
                font-size: 28px;
            }
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Редактирование пользователя</h1>
    
    <!-- Сообщение об успешном изменении пароля -->
    <?php if ($passwordChanged): ?>
        <div class="success-message">Пароль изменён!</div>
    <?php elseif (isset($errorMessage)): ?>
        <div class="error-message"><?= $errorMessage ?></div>
    <?php endif; ?>
    
    <form method="post">
        <label for="username">Логин:</label>
        <input type="text" name="username" id="username" value="<?= htmlspecialchars($user['username']) ?>" required><br>

        <label for="password">Пароль:</label>
        <input type="password" name="password" id="password"><br>

        <!-- Роль доступна только для администраторов -->
        <?php if ($_SESSION['user']['role'] === 'admin'): ?>
            <label for="role">Роль:</label>
            <select name="role" id="role">
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
            </select><br>
        <?php endif; ?>

        <button type="submit">Сохранить изменения</button>
    </form>

    <div class="form-footer">
        <!-- Ссылка на dashboard.php -->
        <a href="dashboard.php">Вернуться на страницу пользователя</a>
    </div>
</div>

</body>
</html>
