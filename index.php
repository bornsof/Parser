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
//Инклуды
require('classes.php');
require('functions.php');
require('mysql.php');

mb_internal_encoding('utf-8'); //включаем кодировку по умолчанию
// Необходима замена на получение агрументов из коммандной строки и фильтрацию запросов)
// 0 -URL
// 1- количество страниц (добавить цикл постраничный)

if (isset ($_GET['query']))
    $query=$_GET['query'];
    else 
    $query='Parser'; //дефолтный запрос для отладки
    $query = strtr($query, ' ', '+');//пробелы в +, иначе курл не скушает
$url = ('https://www.google.ru/search?q='.$query.'&oq='.$query); //итоговый запрос сюда
$content = curl($url);
$str=get_url($content);



foreach ($str as $url){ //основной цикл поехал(можно курл в многопоточность для скорости определить =) )
$content = curl($url);
echo ('<br/>Url='.$url.'<br/>');
$host=substr($url,7,strpos($url,'/',8)-7); //выдергиваем хост;   (на регулярные переделать)
echo 'Host='.$host.'<br/>';

//регулярным выражением дергаем <title>
if (preg_match('/<title>(.*?)<\/title>/si',$content,$title))
    echo 'title= '.htmlspecialchars(fixcharset($title[1])).'<br/>';
    else {
    echo 'title= Нету'.'<br/>';
	echo 'Нет результата плять:'.htmlspecialchars($content).'<br/>';}
if (preg_match('/<meta(?=[^>]* name *= *"?keywords"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/i',$content,$keywords))
    echo 'Keywords= '.fixcharset($keywords[1]).'<br/>';
    else
    echo 'Keywords= Нету'.'<br/>';
if (preg_match('/<meta(?=[^>]* name *= *"?description"?) [^>]*?(?<= )content *= *"([^"]*)"[^>]*>/i',$content,$description))
    echo 'description= '.fixcharset($description[1]).'<br/>';
    else
    echo 'description= Нету'.'<br/>';
	
}

unset($url);
?>
 </body>
 </html>