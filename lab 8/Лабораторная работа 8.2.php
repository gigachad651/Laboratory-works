<?php
function displayCalendar($month = null, $year = null) {
    if (!$month || !$year) {
        $month = date('n');
        $year = date('Y');
    }

    $holidays = [
        '1-1',   
        '1-7',   
        '2-23',  
        '3-8',   
        '5-1',   
        '5-9',   
        '6-12',  
        '9-1',   
        '10-4',  
        '11-4',  
        '12-25', 
        '12-31', 
        '7-4',   
        '10-31', 
        '12-31', 
    ];

    $firstDay = new DateTime("$year-$month-01");
    $daysInMonth = $firstDay->format('t');
    $firstWeekday = $firstDay->format('w');

    echo "<style>
        body { background-color: black; color: white; font-family: 'Orbitron', sans-serif; }
        table { border-collapse: collapse; margin: 20px auto; }
        th, td { border: 1px solid white; padding: 10px; text-align: center; width: 50px; height: 50px; }
        th { background-color: #333; }
        .weekend { background-color: red; color: white; }
        .holiday { background-color: green; color: white; }
    </style>";
    echo "<link href='https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&display=swap' rel='stylesheet'>";

    echo "<h1 style='text-align: center;'>Календарь: $month/$year</h1>";

    echo "<table>
        <tr>
            <th>Пн</th>
            <th>Вт</th>
            <th>Ср</th>
            <th>Чт</th>
            <th>Пт</th>
            <th class='weekend'>Сб</th>
            <th class='weekend'>Вс</th>
        </tr>";

    $day = 1;
    $isFirstRow = true;

    while ($day <= $daysInMonth) {
        echo "<tr>";

        for ($weekday = 1; $weekday <= 7; $weekday++) {
            if ($isFirstRow && $weekday < $firstWeekday) {
                echo "<td></td>";
            } elseif ($day > $daysInMonth) {
                echo "<td></td>";
            } else {
                $currentDate = "$month-$day";

                $isWeekend = ($weekday == 6 || $weekday == 7);
                $isHoliday = in_array($currentDate, $holidays);

                $class = '';
                if ($isWeekend) $class = 'weekend';
                if ($isHoliday) $class = 'holiday';

                echo "<td class='$class'>$day</td>";
                $day++;
            }
        }

        echo "</tr>";
        $isFirstRow = false;
    }

    echo "</table>";
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $month = isset($_POST['month']) && $_POST['month'] != '' ? (int)$_POST['month'] : date('n');
    $year = isset($_POST['year']) && $_POST['year'] != '' ? (int)$_POST['year'] : date('Y');
    displayCalendar($month, $year);
} else {
    $currentMonth = date('n');
    $currentYear = date('Y');
    echo "<form method='post' style='text-align: center; margin-top: 20px;'>
        <label for='month'>Месяц (1-12): </label>
        <input type='number' id='month' name='month' min='1' max='12' value='$currentMonth' required>
        <label for='year'>Год: </label>
        <input type='number' id='year' name='year' min='1900' max='2100' value='$currentYear' required>
        <button type='submit'>Показать календарь</button>
    </form>";
}
?>
