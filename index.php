<?php
//добавить провеку на отсутствие результатов поиска
$qry=$_GET['qry'];
$content= file_get_contents('https://www.google.ru/search?q='.$qry);
$f9=strripos($content,'<h3 class="r"><a href="');
while ($f0!=$f9){
    $f0=strpos($content,'<h3 class="r"><a href="',$f1);
    $f=$f0+23;
    $f1=strpos($content,'"',$f);
    $s[$i] =substr($content,$f,$f1-$f);
    echo htmlspecialchars($s[$i]);
    echo ('</br>');
    }
    
 $parser= file_get_contents('http://www.google.ru/url?q='.$s[0]);   
 
 $parser1=strpos($parser,'<a href="')+11;
 $parser2=strpos($parser,'"',$parser1);
 $a =substr($content,$parser1,$parser2-$parser1);
 
 
 
 echo ('$parser1:'.$parser1.'$parser2:'.$parser2);
 
    echo htmlspecialchars($parser);
?>