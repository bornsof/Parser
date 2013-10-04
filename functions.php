<?php
//Файл определения функций
//из-за получения данных в рахных кодировках, меняем не утф-8 на утф-8 )))
 function fixcharset($str){ 
    if (mb_check_encoding ($str, 'UTF-8')===FALSE) 
    $str=mb_convert_encoding($str,'utf-8');
return $str;
}

//Возврат сайта как строки
function curl($url){
$headers = array    //Создаем массив с хедерами, для корректного отображения запроса.
    (
    'Accept: text/html',
    'accept-language:ru-RU,ru;q=0.8,en-US;q=0.6,en;q=0.4',
    'Accept-Encoding:deflate',
    'Accept-Charset: windows-1251,utf-8;'
    ); 
$ch = curl_init();   //инициализация cURL'a
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt($ch, CURLOPT_REFERER, 'https://www.google.ru/');
curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.1.6) Gecko/20091201 Firefox/3.5.6 (.NET CLR 3.5.30729)");
curl_setopt($ch, CURLOPT_URL,$url); // присваиваем URL
curl_setopt($ch, CURLOPT_FAILONERROR, 1);  //игнорируем ошибки 400+
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);// разрешаем редиректы  
curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); // возвращаем как переменную
curl_setopt($ch, CURLOPT_TIMEOUT, 10); // таймаут на 3 секунды 
$result = curl_exec($ch); // Отправляем запрос 
curl_close($ch);   
return $result; 
}

 function get_url($content){

$signature_start='<h3 class="r"><a href="';
$signature_stop='&amp;sa=';
$position_end=strripos($content,$signature_start);
$position_start=0;
$position_stop=0;
$asset=0;
$i=0;
if (strripos($content,'ничего не найдено') !== FALSE ) die('No results');

while (($position_start-30)!=$position_end){
    $position_start=strpos($content,$signature_start,$position_stop)+30;
    $position_stop=strpos($content,$signature_stop,$position_start); //&amp;sa= - сигнатура окончания адреса в поиске
    $asset=$position_stop-$position_start;
//игнорируем поиск картинок(если надо, отдельная проверка) картинка не содержит ссылки
    $temp = strstr(substr($content,$position_start,$asset),'http',4);  
        if ($temp!==FALSE){
        $str[$i] = substr($content,$position_start,$asset); 
        $str[$i]=urldecode($str[$i]);
        }
    $i=$i+1;

}
return $str;
}

?>