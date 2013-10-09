<?php
//////////////////////////////////////////////////
//      Парсер выдачи http://gogle.com/         //
//      Версия 0.1                              //
//                                              //
//      Дата начала проекта:03.10.2013          //
//                                              //
//      Использовано: ООП, cURL, MySQL...       //
//      Создано в Notepad++                     //
//      Лобанов Сергей                          //
//////////////////////////////////////////////////

//Добавить получение настроек из базы.
//Текущие возможные настройки -
//Адрес сервера для получения парсинга
//глубина страниц проникновения гугла


//Инклуды
//mb_internal_encoding('utf-8'); //включаем кодировку по умолчанию
require_once('classes.php');
require_once('functions.php');
require_once('mysql.php');

$query='select * from parser.settings';
$result=$db->query($query);
$num_rows=$result->num_rows;
if ($num_rows=0) die('Ошибка');
$row=$result->fetch_assoc();


// 1 -URL
// 2- глубина страниц (добавить цикл постраничный)
/*
if ($argc != 2) 
    die(PHP_EOL . 'Use: php index.php query_to_google.com.' . PHP_EOL);

$find=$argv[1];
$depth=$argv[2];
*/
$find=$row['find'];
$depth=$row['depth']-1;
$find = strtr($find, ' ', '+');//пробелы в +, иначе курл не скушает
for ($i=0; $i<=$depth; $i++){
$url = ('https://www.google.ru/search?q='.$find.'&oq='.$find.'&start='.$i*10); //итоговый запрос сюда
$str=get_url(curl($url));
////////////////////////////
//основная функция парсера//парсит и добавляет в базу ответ от гугла ей передаем результат функции get_url
////////////////////////////
foreach ($str[1] as $url)  
{ 
$content_url = fixcharset(curl($url));
//echo ('<br/>Url='.$url.'<br/>');
$host=substr($url,7,strpos($url,'/',8)-7); //выдергиваем хост;   (на регулярные переделать) (криво жрет https) (((

//регулярными выражением дергаем <title>, keywords и description
if (!preg_match("/<title>(.*?)<\/title>/usi",$content_url,$title))
    $title[1]='Нету';
    
if (!preg_match('/<meta(?=[^>]* name *= *"?keywords"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/usi',$content_url,$keywords))
    $keywords[1]='Нету';

if (!preg_match('/<meta(?=[^>]* name *= *"?description"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/usi',$content_url,$description))
    $description[1]='Нету';

$query= "insert into parser.parsed (`url`,`host`,`title`,`keywords`,`description`) values (\"".$url."\",\"".$host."\",\"".htmlspecialchars(fixcharset($title[1]))."\",\"".fixcharset($keywords[1])."\",\"".fixcharset($description[1])."\")";
$result=$db->query($query);
}
/////////////////////////////
//основная функция парсера^//
///////////////////////////// 
}
echo "Done.\n";
?>