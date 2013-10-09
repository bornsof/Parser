<?php
//////////////////////////////////////////////////
//      Парсер выдачи http://gogle.com/         //
//      Версия 0.0.3                            //
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
require('classes.php');
require('functions.php');
require('mysql.php');
// 1 -URL
// 2- глубина страниц (добавить цикл постраничный)
if ($argc != 2) {
    die(PHP_EOL . 'Use: php index.php query_to_google.com.' . PHP_EOL);
}
$find=$argv[1];
//$page=$argv[2];

//if (isset ($_GET['find']))
//    $find=$_GET['find'];
//    else 
//    $find='Parser'; //дефолтный запрос для отладки
$find = strtr($find, ' ', '+');//пробелы в +, иначе курл не скушает
$url = ('https://www.google.ru/search?q='.$find.'&oq='.$find); //итоговый запрос сюда
$content = curl($url);
$str=get_url($content);

foreach ($str[1] as $url){ //основной цикл поехал
$content_url = fixcharset(curl($url));
//echo ('<br/>Url='.$url.'<br/>');
$host=substr($url,7,strpos($url,'/',8)-7); //выдергиваем хост;   (на регулярные переделать)

//регулярными выражением дергаем <title>, keywords и description
if (!preg_match("/<title>(.*?)<\/title>/usi",$content_url,$title))
	$title[1]='Нету';
	
if (!preg_match('/<meta(?=[^>]* name *= *"?keywords"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/usi',$content_url,$keywords))
	$keywords[1]='Нету';

if (!preg_match('/<meta(?=[^>]* name *= *"?description"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/usi',$content_url,$description))
	$description[1]='Нету';

$query= "insert into parser.parsed (`url`,`host`,`title`,`keywords`,`description`) values (\"".$url."\",\"".$host."\",\"".htmlspecialchars(fixcharset($title[1]))."\",\"".fixcharset($keywords[1])."\",\"".fixcharset($description[1])."\")";
$result=$db->query($query);
//echo $query;
}
$db->close();
unset($url);
echo "Done.\n";
?>