<?php
session_start();
require_once 'db_connection.php';

if (isset($_SESSION['user'])) {
    $user = $_SESSION['user'];
    $user_role = $user['role'];
} else {
    $user_role = 'user';
}

if ($user_role === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);

    if (!empty($name) && !empty($price) && !empty($description)) {
        $stmt = $conn->prepare("INSERT INTO popular_builds (name, price, description, is_active) VALUES (?, ?, ?, 1)");
        $stmt->bind_param("sds", $name, $price, $description);

        if ($stmt->execute()) {
            $message = "Сборка успешно добавлена!";
        } else {
            $message = "Ошибка при добавлении сборки: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $message = "Пожалуйста, заполните все поля.";
    }
}

if ($user_role === 'admin' && $_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'delete') {
    $build_id = intval($_POST['build_id']);

    $stmt = $conn->prepare("DELETE FROM popular_builds WHERE id = ?");
    $stmt->bind_param("i", $build_id);

    if ($stmt->execute()) {
        $message = "Сборка успешно удалена!";
    } else {
        $message = "Ошибка при удалении сборки: " . $stmt->error;
    }
    $stmt->close();
}

$sql = ($user_role === 'admin') 
    ? "SELECT * FROM popular_builds" 
    : "SELECT * FROM popular_builds WHERE is_active = 1";

$result = $conn->query($sql);
$builds = $result ? $result->fetch_all(MYSQLI_ASSOC) : [];

$conn->close();
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Готовые сборки ПК</title>
    <style>
        body {
            background-color: #1a1a1a;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
        }
        .build {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }
        h1 {
            color: #ff7f50;
        }
        h2 {
            color: #ff7f50;
        }
        .status {
            color: #f0ad4e;
        }
        .form-container {
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
        }
        input, textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            background-color: #333;
            color: white;
        }
        button {
            background-color: #ff7f50;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ff5722;
        }
        .message {
            background-color: #282828;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 20px;
            text-align: center;
        }
        .delete-button {
            background-color: #f44336;
            color: white;
            padding: 5px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .delete-button:hover {
            background-color: #d32f2f;
        }
        .order-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            display: inline-block;
            text-align: center;
            text-decoration: none;
        }
        .order-button:hover {
            background-color: #45a049;
        }
        .back-link {
            background-color: #ff5722;
            color: white;
            padding: 10px 15px;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        .back-link:hover {
            background-color: #e64a19;
        }
    </style>
</head>
<body>
    <h1>Готовые сборки ПК</h1>

    <?php if (!empty($message)): ?>
        <div class="message"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <?php if ($user_role === 'admin'): ?>
        <div class="form-container">
            <h2>Добавить новую сборку</h2>
            <form method="POST" action="">
                <input type="hidden" name="action" value="add">
                <label for="name">Название сборки</label>
                <input type="text" name="name" id="name" required>
                
                <label for="price">Цена (в рублях)</label>
                <input type="number" step="0.01" name="price" id="price" required>

                <label for="description">Описание</label>
                <textarea name="description" id="description" rows="4" required></textarea>

                <button type="submit">Добавить сборку</button>
            </form>
        </div>
    <?php endif; ?>

    <?php if (!empty($builds)): ?>
        <?php foreach ($builds as $build): ?>
            <div class="build">
                <h2><?= htmlspecialchars($build['name']) ?></h2>
                <p>Цена: <?= number_format(htmlspecialchars($build['price']), 2, ',', ' ') ?> ₽</p>
                <p>Описание: <?= nl2br(htmlspecialchars($build['description'])) ?></p>
                <p class="status">Статус: <?= $build['is_active'] ? 'Активна' : 'Неактивна' ?></p>
                
                <?php if ($user_role === 'user'): ?>
                    <a href="forma.php?id=<?= $build['id'] ?>" class="order-button">Оформить заказ</a>
                <?php endif; ?>

                <?php if ($user_role === 'admin'): ?>
                    <form method="POST" action="" style="margin-top: 10px;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="build_id" value="<?= $build['id'] ?>">
                        <button type="submit" class="delete-button">Удалить</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>Сборки не найдены.</p>
    <?php endif; ?>

    <a href="configurator.php" class="back-link">Вернуться в конфигуратор</a>
</body>
</html>
