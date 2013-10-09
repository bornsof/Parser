<?php
//Файл подключения и работы с БД
require('config.inc');
@ $db = new mysqli($dbhost, $dbuser, $dbpassword, $dbname);
$db->set_charset('utf8');
if ($db->connect_errno) {
	die ('Ошибка при подключении к базе данных. Ошибка номер: '.$db->connect_errno);
	}
//Создание базы
//$query="create table parsed (id int unsigned not null auto_increment primary key, url char(100) not null, host char(70) not null, title text, keywords text, description text)";
//Добавление записей
//$query= "insert into parser.parsed (`url`,`host`,`title`,`keywords`,`description`) values ('1','2','3','221неуту','123нуету')";
//$result=$db->query($query);
//$query='select * from parser.parsed ';
//$result=$db->query($query);

/*$num_results = $result->num_rows;
for ($i=0; $i < $num_results; $i++) {
 $row = $result->fetch_object();
 echo ($row->description);
}*/
?>
