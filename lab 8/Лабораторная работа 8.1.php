<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Таблица умножения</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap');

        body {
            background-color: #000;
            color: #fff;
            font-family: 'Orbitron', sans-serif;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            text-align: center;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #444;
        }

        th, td {
            padding: 10px;
        }

        th {
            background-color: #222;
        }

        tr:nth-child(even) {
            background-color: #111;
        }

        tr:nth-child(odd) {
            background-color: #1a1a1a;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>Таблица умножения</h1>
    <table>
        <thead>
            <tr>
                <th></th>
                <?php for ($i = 1; $i <= 10; $i++): ?>
                    <th><?= $i ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php for ($row = 1; $row <= 10; $row++): ?>
                <tr>
                    <th><?= $row ?></th>
                    <?php for ($col = 1; $col <= 10; $col++): ?>
                        <td><?= $row * $col ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endfor; ?>
        </tbody>
    </table>
</body>
</html>
