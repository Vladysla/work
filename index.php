<?php
// Устанавливаем кодировку cp-1251
header("Content-Type: text/html; charset=cp-1251");
// Создаем цикл для сегодняшнего и на 3 месяца вперед 
for ($i = 0; $i<4; $i++){
    $file = "date.csv";
    // Достаем контент из файла "date.csv"
    $file_content = file_get_contents($file);
    // Устанавливаем дату на 1 месяц вперед
    $date = strtotime("+ {$i} month");
    // Задаем формат даты
    $dateN = date("d.m.Y", $date);
    // Достаем первый и третий понедельник месяца
    $next_month_first_monday_ts = strtotime("first monday", strtotime($dateN));
    $next_month_third_monday_ts = strtotime("third monday", strtotime($dateN));
    // Задаем формат даты
    $third_date = date("d.m.Y", $next_month_third_monday_ts);
    $first_date = date("d.m.Y", $next_month_first_monday_ts);
    // Генеерируем 2 случайных числа от 100 до 999
    $randInt1 = rand(100, 999);
    $randInt2 = rand(100, 999);
    // Массив с именами $arrNames
    $arrNames = ['Иван 1','Иван 2','Олег','Дмитрий'];
    // Генеерируем 2 случайных чисел
    $randCount1 = rand(0, (count($arrNames)-1));
    $randCount2 = rand(0, (count($arrNames)-1));
    // Достаем имена по индексу $randCount1 и $randCount2
    $randName1 = $arrNames[$randCount1];
    $randName2 = $arrNames[$randCount2];
    // Обьединяем все нужные значения в идну строку разделяя их ","
    $str = $first_date . "," . $randInt1 . "," . $randName1 . ";\n". $third_date . "," . $randInt2 . "," . $randName2 . ";\n";
    $file_content .= $str;
    file_put_contents($file,$file_content);
}