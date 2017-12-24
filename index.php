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
$file = "date.csv";
$file2 = "names_sum.csv";
$arr_file_date = file($file);
foreach($arr_file_date as $val){
	preg_match_all("~([\d]{3},[а-яА-Я]+)~", $val, $match_name);
	$trimet = explode(",", $match_name[1][0]);
	$arrNames_sum[] = $trimet[1];
	$arrDig_sum[] = $trimet[0];
}
function array_combine_($keys, $values)
{
	$result = array();
	foreach($keys as $i => $k){
		$result[$k][] = $values[$i];
	}
	array_walk($result, 'array_help');
	return $result;
}
function array_help($v){
	return $v=(count($v) == 1)? array_pop($v): $v;
}
print_r($arrNames_sum);
print_r($arrDig_sum);
$arr_result =  array_combine_($arrNames_sum, $arrDig_sum);
print_r($arr_result);
foreach($arr_result as $n => $s){
	$res_str =  $n. " sum: ". array_sum($s)."\n";
	$file_content2 = file_get_contents($file2);
	$file_content2 .= $res_str;
	file_put_contents($file2,$file_content2);
}
