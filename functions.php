<?php
//Файл определения функций
//из-за получения данных в рахных кодировках, меняем не утф-8 на утф-8 )))
 
 


 function fixcharset($str){ 
    if (mb_check_encoding ($str, 'UTF8')===FALSE) 
    $str=iconv("windows-1251","UTF-8",$str);
return $str;
}

//Возврат сайта как строки
function curl($url){
$headers = array    //Создаем массив с хедерами, для корректного отображения запроса.
    (
    'Accept: text/html',
    'Accept-language:ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
    'Accept-Charset: windows-1251, utf-8;'
    ); 
$ch = curl_init();   //инициализация cURL'a
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_ENCODING, '');
curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.ru/');
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/30.0.1599.69 Safari/537.36");
curl_setopt($ch, CURLOPT_URL,$url); // присваиваем URL
curl_setopt($ch, CURLOPT_FAILONERROR, 0);  //игнорируем ошибки 400+
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);// разрешаем редиректы  
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // возвращаем как переменную
curl_setopt($ch, CURLOPT_TIMEOUT, 45); // таймаут на 10 секунд 
$result = curl_exec($ch); // Отправляем запрос 
curl_close($ch);   
return $result; 
}

 function get_url($content){ //можно на регулярное выражение переделать
if (preg_match_all("/<h3 class=\"r\"><a href=\"(.*?)\" onmouse/iu",$content,$str))
	return $str;
	else 
		return "Not found";
}

?>