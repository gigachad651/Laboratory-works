<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Конфигуратор ПК</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"> <!-- Шрифт Poppins -->
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
            padding: 20px;
            display: flex;
            flex-direction: column;
            gap: 40px;
            align-items: center;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            width: 100%;
            max-width: 1200px;
        }
        .category {
            width: 300px;
            background-color: rgba(0, 0, 0, 0.85);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease;
            text-align: center;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .category:hover {
            transform: scale(1.05);
        }
        .icon {
            font-size: 40px;
            margin-bottom: 15px;
        }
        .category select {
            width: 100%;
            padding: 10px;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            transition: background-color 0.3s;
        }
        .category select:focus {
            outline: none; 
            background-color: #333; 
            color: white; 
        }
        option {
            background-color: black; 
            color: white; 
        }
        option:checked {
            background-color: #444; 
        }
        option:hover {
            background-color: #555; 
        }
        h1 {
            text-align: center;
            color: #ff7f50;
            margin-bottom: 20px;
            font-size: 32px;
        }
        .popular-builds-link {
            font-size: 18px;
            color: #ff7f50;
            text-decoration: none;
            font-weight: 600;
            margin-top: 10px;
        }
        .popular-builds-link:hover {
            color: #e06f39;
        }
        .summary {
            width: 100%;
            max-width: 400px;
            background-color: rgba(30, 30, 30, 0.95);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .summary h2 {
            font-size: 24px;
            color: #ff7f50;
            margin-bottom: 20px;
            text-align: center;
        }
        .summary .total {
            font-size: 20px;
            margin-top: 20px;
            text-align: center;
        }
        .summary .selected-items {
            font-size: 16px;
            line-height: 1.5;
            background-color: rgba(50, 50, 50, 0.8); 
            padding: 10px;
            border-radius: 8px;
            max-height: 200px;
            overflow-y: auto;
            color: #f0f0f0;
        }
        .order-link {
            display: block;
            margin-top: 20px;
            text-align: center;
            background-color: #ff7f50;
            color: white;
            padding: 10px 20px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
        }
        .order-link:hover {
            background-color: #e06f39;
        }

        
        .account-link {
            position: absolute;
            top: 20px;
            right: 20px;
            font-size: 18px;
            font-weight: 600;
            color: #ff7f50;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.7);
            transition: background-color 0.3s;
        }
        .account-link:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }

        
        .partners-link {
            position: fixed;
            bottom: 20px;
            right: 20px;
            font-size: 18px;
            font-weight: 600;
            color: #ff7f50;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.7);
            transition: background-color 0.3s;
        }
        .partners-link:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }
    </style>
</head>
<body>
    
    <a href="dashboard.php" class="account-link">Аккаунт</a>

    
    <a href="partners.php" class="partners-link">Наши партнёры</a>

    <h1>Конфигуратор ПК</h1>
    
    <a href="popularpc.php" class="popular-builds-link">Популярные сборки</a>

    <div class="container">
        
        <div class="category">
            <div class="icon">🔲</div>
            <h3>Процессор</h3>
            <select onchange="updateTotal(this, 'Процессор')">
                <option value="0">Не выбрано</option>
                <option value="10000">Intel Core i3 - 10,000 ₽</option>
                <option value="15000">Intel Core i5 - 15,000 ₽</option>
                <option value="25000">Intel Core i7 - 25,000 ₽</option>
                <option value="12000">AMD Ryzen 5 - 12,000 ₽</option>
                <option value="22000">AMD Ryzen 7 - 22,000 ₽</option>
                <option value="32000">AMD Ryzen 9 - 32,000 ₽</option>
            </select>
        </div>

        <div class="category">
            <div class="icon">💾</div>
            <h3>Оперативная память</h3>
            <select onchange="updateTotal(this, 'Оперативная память')">
                <option value="0">Не выбрано</option>
                <option value="4000">Kingston Fury 16GB - 4,000 ₽</option>
                <option value="8000">Corsair Vengeance 32GB - 8,000 ₽</option>
                <option value="16000">G.Skill Trident Z 64GB - 16,000 ₽</option>
            </select>
        </div>

        <div class="category">
            <div class="icon">🎮</div>
            <h3>Видеокарта</h3>
            <select onchange="updateTotal(this, 'Видеокарта')">
                <option value="0">Не выбрано</option>
                <option value="20000">NVIDIA GTX 1660 - 20,000 ₽</option>
                <option value="40000">NVIDIA RTX 3060 - 40,000 ₽</option>
                <option value="60000">NVIDIA RTX 3080 - 60,000 ₽</option>
                <option value="50000">AMD RX 6700 XT - 50,000 ₽</option>
                <option value="70000">AMD RX 6900 XT - 70,000 ₽</option>
            </select>
        </div>

        <div class="category">
            <div class="icon">🖧</div>
            <h3>Материнская плата</h3>
            <select onchange="updateTotal(this, 'Материнская плата')">
                <option value="0">Не выбрано</option>
                <option value="5000">MSI B450 - 5,000 ₽</option>
                <option value="10000">ASUS TUF B550 - 10,000 ₽</option>
                <option value="15000">Gigabyte AORUS X570 - 15,000 ₽</option>
            </select>
        </div>

        <div class="category">
            <div class="icon">📀</div>
            <h3>Накопитель</h3>
            <select onchange="updateTotal(this, 'Накопитель')">
                <option value="0">Не выбрано</option>
                <option value="3000">HDD 1TB - 3,000 ₽</option>
                <option value="5000">SSD 512GB - 5,000 ₽</option>
                <option value="8000">SSD 1TB - 8,000 ₽</option>
            </select>
        </div>

        <div class="category">
            <div class="icon">🔌</div>
            <h3>Блок питания</h3>
            <select onchange="updateTotal(this, 'Блок питания')">
                <option value="0">Не выбрано</option>
                <option value="3000">450W - 3,000 ₽</option>
                <option value="5000">650W - 5,000 ₽</option>
                <option value="7000">850W - 7,000 ₽</option>
            </select>
        </div>

        <div class="category">
            <div class="icon">📦</div>
            <h3>Корпус</h3>
            <select onchange="updateTotal(this, 'Корпус')">
                <option value="0">Не выбрано</option>
                <option value="2000">Simple Case - 2,000 ₽</option>
                <option value="5000">Gaming Case - 5,000 ₽</option>
                <option value="8000">Premium Case - 8,000 ₽</option>
            </select>
        </div>
    </div>

    <div class="summary">
        <h2>Общая стоимость</h2>
        <div id="total" class="total">0 ₽</div>
        <div class="selected-items" id="selectedItems">Выбранные компоненты отсутствуют</div>
        <a href="forma.php" class="order-link">Оформить заказ</a> 
    </div>

    <script>
        const selectedComponents = {}; 

        function updateTotal(selectElement, category) {
            const price = parseInt(selectElement.value);
            const componentName = selectElement.parentElement.querySelector('h3').innerText;
            
            if (price > 0) {
                selectedComponents[componentName] = {
                    price: price
                };
            } else {
                delete selectedComponents[componentName];
            }

            
            let total = 0;
            Object.values(selectedComponents).forEach(component => {
                total += component.price;
            });

            
            document.getElementById('total').innerText = total + ' ₽';


            const selectedItems = Object.keys(selectedComponents).map(key => `${key} - ${selectedComponents[key].price} ₽`).join('<br>');
            document.getElementById('selectedItems').innerHTML = selectedItems || 'Выбранные компоненты отсутствуют';
        }
    </script>
</body>
</html>
