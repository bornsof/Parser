<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

 </head>
 <body>
<?php
//////////////////////////////////////////////////
//      Парсер выдачи http://gogle.com/         //
//      Версия 0.0.1                            //
//                                              //
//      Дата начала проекта:03.10.2013          //
//                                              //
//      Использовано: ООП, cURL, MySQL...       //
//      Создано в Notepad++                     //
//      Лобанов Сергей                          //
//////////////////////////////////////////////////
ini_set('display_errors', 1);
error_reporting(E_ALL); //отображение ошибок для отладки
//Инклуды
require('classes.php');
require('functions.php');
require('mysql.php');
mb_internal_encoding('utf-8');
//Определяем переменные                                          (необходима замена на получение агрументов из коммандной строки и фильтрацию запросов)
// 0 -URL
// 1- количество страниц (добавить цикл постраничный)

if (isset ($_GET['query']))
	$query=$_GET['query'];
	else 
    $query='6666';
	
	$query = strtr($query, ' ', '+');
$url = ('https://www.google.ru/search?q='.$query.'&oq='.$query); //Адрес поисковика
$content = curl($url);
$str=get_url($content);

foreach ($str as $url){
$content = curl($url);
echo ('<br/>Url='.$url.'<br/>');
$host=substr($url,7,strpos($url,'/',8)-7); //выдергиваем хост;   (на регулярные переделать)
echo 'Host='.$host.'<br/>';

/*
//регулярным выражением дергаем <title>
preg_match('/<title>(.*?)<//title>/si',$content,$title);
if (mb_check_encoding ($title[1], 'UTF-8')===FALSE) 
$title[1]=mb_convert_encoding($title[1],'utf-8');
echo '<br/>Title: '.htmlspecialchars($title[1]);
*/
//if (preg_match('/\<meta\sname\=\"keywords\"\scontent=\"(.*)\"/',$content,$keywords))
if (preg_match('/<meta(?=[^>]* name *= *"?keywords"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/i',$content,$keywords))
		echo 'Keywords= '.fixcharset($keywords[1]).'<br/>';
	else
		echo 'Keywords= Нету'.'<br/>';

if (preg_match('/<meta(?=[^>]* name *= *"?description"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/i',$content,$description))
echo 'description= '.fixcharset($description[1]).'<br/>';
else
echo 'description= Нету'.'<br/>';
}
?>
 </body>
 </html>