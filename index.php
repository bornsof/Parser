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
    //если юзер есть, регаем его сессию
    $_SESSION['user']=$login;
    $result->num_rows;
    }

}
include('inc/header.php'); //меню 
if  (!isset($_SESSION['user']))
    include('login.php');//если юзер не авторизован выводим форму авторизации
else{
//только для зареганных юзверей
    if (!isset($_GET['page']))
        header("Location: index.php?page=settings"); //если переменная не определена, кидаем в настройки
    else
        $page=$_GET['page'];
    switch ($page) 
        {
        case "settings":
            include("settings.php");
            break;
        case "list":
            include("list.php");
            break;
        case "host":
            include("host.php");
            break;
        case "parser":
            include("parser.php");
            break;
        } 
}
include('inc/footer.php');//подпись
?>
    
    
    
    
    

    
