<?php
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $phone = htmlspecialchars($_POST['phone']);
        $address = htmlspecialchars($_POST['address']);
        $payment_method = $_POST['payment_method'];
        $delivery_method = $_POST['delivery_method'];
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Оформление заказа</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            background-color: #1a1a1a;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 40px;
            display: flex;
            flex-direction: column;
            gap: 20px;
            align-items: center;
        }
        h1 {
            text-align: center;
            color: #ff7f50;
            font-size: 32px;
            margin-bottom: 40px;
        }
        .form-container {
            width: 100%;
            max-width: 800px;
            background-color: rgba(30, 30, 30, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            font-size: 16px;
            color: #ff7f50;
            margin-bottom: 10px;
        }
        .form-group input, .form-group select, .form-group textarea {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.1);
            color: white;
        }
        .form-group select {
            background-color: rgba(255, 255, 255, 0.2);
        }
        .form-group input:focus, .form-group select:focus {
            outline: none;
            background-color: rgba(255, 255, 255, 0.3);
        }
        .form-group textarea {
            resize: vertical;
            height: 100px;
        }
        .form-group button {
            background-color: #ff7f50;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            border: none;
            font-size: 18px;
            cursor: pointer;
            width: 100%;
            text-align: center;
        }
        .form-group button:hover {
            background-color: #e06f39;
        }
        /* Анимация сообщения */
        .order-success {
            display: none;
            padding: 20px;
            background-color: #28a745;
            color: white;
            font-size: 18px;
            border-radius: 10px;
            margin-top: 20px;
            animation: fadeIn 2s ease-in-out;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .back-link {
            display: block;
            margin-top: 20px;
            color: #ff7f50;
            font-size: 18px;
            text-decoration: none;
            text-align: center;
        }
        .back-link:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<h1>Оформление заказа</h1>

<div class="form-container">
    <form id="order-form" action="forma.php" method="POST">
        <!-- Информация о клиенте -->
        <div class="form-group">
            <label for="name">Ваше имя</label>
            <input type="text" id="name" name="name" required placeholder="Введите ваше имя">
        </div>

        <div class="form-group">
            <label for="email">Электронная почта</label>
            <input type="email" id="email" name="email" required placeholder="Введите ваш email">
        </div>

        <div class="form-group">
            <label for="phone">Телефон</label>
            <input type="tel" id="phone" name="phone" required placeholder="Введите ваш номер телефона">
        </div>

        <div class="form-group">
            <label for="address">Адрес доставки</label>
            <textarea id="address" name="address" required placeholder="Введите ваш адрес"></textarea>
        </div>

        
        <div class="form-group">
            <label for="delivery_method">Способ доставки</label>
            <select id="delivery_method" name="delivery_method" required>
                <option value="курьер">Курьером</option>
                <option value="пункт самовывоза">Пункт самовывоза</option>
                <option value="почта">Почта</option>
            </select>
        </div>

        
        <div class="form-group">
            <label for="payment_method">Способ оплаты</label>
            <select id="payment_method" name="payment_method" required>
                <option value="наличными">Наличными при получении</option>
                <option value="картой">Картой при доставке</option>
                <option value="онлайн">Онлайн оплата</option>
            </select>
        </div>

        
        <div class="form-group">
            <button type="submit">Оформить заказ</button>
        </div>
    </form>

    
    <div id="success-message" class="order-success">
        Заказ оформлен!
    </div>

    
    <a href="configurator.php" class="back-link">Вернуться в конфигуратор</a>
</div>

<script>
    
    const form = document.getElementById('order-form');
    const successMessage = document.getElementById('success-message');

    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); 

        
        successMessage.style.display = 'block';

        
        setTimeout(function() {
            successMessage.style.display = 'none';
        }, 4000);

        
    });
</script>

</body>
</html>

