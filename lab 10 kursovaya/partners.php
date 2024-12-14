<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Наши партнёры</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"> 
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            background-color: #1a1a1a;
            color: white;
            font-family: 'Poppins', sans-serif;
            padding: 20px;
            overflow-x: hidden;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            text-align: center;
        }
        h1 {
            color: #ff7f50;
            font-size: 36px;
            margin-bottom: 50px;
        }
        .partners-list {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
            gap: 30px;
            padding: 0 20px;
        }
        .partner {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.6);
            transition: transform 0.3s ease, background-color 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            text-align: center;
        }
        .partner:hover {
            transform: translateY(-10px);
            background-color: rgba(0, 0, 0, 0.85);
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
        }
        .partner i {
            font-size: 60px;
            color: #ff7f50;
            margin-bottom: 20px;
            transition: transform 0.3s ease;
        }
        .partner h3 {
            color: #ff7f50;
            font-size: 24px;
            font-weight: 600;
            margin-bottom: 15px;
        }
        .partner a {
            display: block;
            font-size: 16px;
            color: #ff7f50;
            text-decoration: none;
            transition: color 0.3s ease;
            margin-top: 10px;
        }
        .partner a:hover {
            color: #e06f39;
        }
        .partner::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 60%;
            height: 4px;
            background-color: #ff7f50;
            transform: translateX(-50%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .partner:hover::after {
            opacity: 1;
        }
        .back-link {
            display: block;
            margin-top: 50px;
            text-align: center;
            font-size: 18px;
            color: #ff7f50;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 8px;
            background-color: rgba(0, 0, 0, 0.8);
            transition: background-color 0.3s ease;
        }
        .back-link:hover {
            background-color: rgba(0, 0, 0, 0.6);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Наши партнёры</h1>
        <div class="partners-list">
            
            <div class="partner">
                <i class="fab fa-asus"></i>
                <h3>Asus</h3>
                <a href="https://www.asus.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fab fa-msi"></i>
                <h3>MSI</h3>
                <a href="https://www.msi.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fab fa-nvidia"></i>
                <h3>NVIDIA</h3>
                <a href="https://www.nvidia.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fab fa-corsair"></i>
                <h3>CORSAIR</h3>
                <a href="https://www.corsair.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fab fa-creative-commons"></i> 
                <h3>NZXT</h3>
                <a href="https://www.nzxt.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-microchip"></i> 
                <h3>Intel</h3>
                <a href="https://www.intel.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-cogs"></i> 
                <h3>AMD</h3>
                <a href="https://www.amd.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-hdd"></i> 
                <h3>Seagate</h3>
                <a href="https://www.seagate.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-memory"></i> 
                <h3>Kingston</h3>
                <a href="https://www.kingston.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-server"></i> 
                <h3>Western Digital</h3>
                <a href="https://www.westerndigital.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-plug"></i> 
                <h3>EVGA</h3>
                <a href="https://www.evga.com" target="_blank">Перейти на сайт</a>
            </div>
            <div class="partner">
                <i class="fas fa-wrench"></i> 
                <h3>Thermaltake</h3>
                <a href="https://www.thermaltake.com" target="_blank">Перейти на сайт</a>
            </div>
        </div>

        <a href="configurator.php" class="back-link">Вернуться в конфигуратор</a>
    </div>
</body>
</html>

