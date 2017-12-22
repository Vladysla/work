<?php
header("Content-Type: text/html; charset=cp-1251");
for ($i = 0; $i<4; $i++){
    $file = "date.csv";
    $openfile = file_get_contents($file);
    $date = strtotime("+ {$i} month");
    $dateN = date("d.m.Y", $date);
    $next_month_first_monday_ts = strtotime("first monday", strtotime($dateN));
    $next_month_third_monday_ts = strtotime("third monday", strtotime($dateN));
    $third_date = date("d.m.Y", $next_month_third_monday_ts);
    $first_date = date("d.m.Y", $next_month_first_monday_ts);
    $randInt1 = rand(100, 999);
    $randInt2 = rand(100, 999);
    $arrNames = ['Иван 1','Иван 2','Олег','Дмитрий'];
    $randCount1 = rand(0, (count($arrNames)-1));
    $randCount2 = rand(0, (count($arrNames)-1));
    $randName1 = $arrNames[$randCount1];
    $randName2 = $arrNames[$randCount2];
    $str = $first_date . "," . $randInt1 . "," . $randName1 . ";\n". $third_date . "," . $randInt2 . "," . $randName2 . ";\n";
    $openfile .= $str;
    file_put_contents($file,$openfile);
}