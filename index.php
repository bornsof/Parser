<?php
require('mysql.php');
require('functions.php');
session_start();
//Admin:asshole
if (isset($_POST['login']) && (isset($_POST['passwd']))){
    $login=$_POST['login'];
    $passwd=$_POST['passwd'];   
    $query='select * from users where name="'.$login.'" and passwd=sha1("'.$passwd.'")';
    $result=$db->query($query);
    if ($result->num_rows > 0){
    //если юзер есть, регаем его
    $_SESSION['user']=$login;
    $result->num_rows;
    }
$db->close();
}
include('inc/header.php');
if  (!isset($_SESSION['user']))
    include('login.php');//если юзер не авторизован выводим форму авторизации
else{
//только для зареганных юзверей, юзаем инклуды
    if (isset($GET['page'])){
        ?>
        <div class="alert">
        <h3>Вы успешно вошли! Выберите нужный раздел...</h3>
        </div>
		<?
    }
        else
    {
		if (isset($_POST['save'])){
			$save=$_POST['save'];
		}
        $page=$_GET['page'];
        switch ($page) {
            case "settings":
                include("settings.php");
                break;
            case "list":
                include("list.php");
                break;
            case "host":
                include("host.php");
                break;
        }
    }

    
}
include('inc/footer.php');
?>
    
    
    
    
    

    
