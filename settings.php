<?php
$query='select * from parser.settings where id=1';
$result=$db->query($query);
$num_rows=$result->num_rows;
if ($num_rows=0) die('Отсутствуют настройки в базе MySQL');
$row=$result->fetch_assoc();
?>
<div class="container">
    <div class="row">
    <div class="well span6 offset3">
        <legend>Настройки</legend>
            <form method="POST" action="index.php?page=settings" accept-charset="UTF-8">
                <p class="span3">Запрос для google.com</p><input type="text" class="span3" value="<?php echo $row['find'];?>" name="find"><br/>
                <p class="span3">Глубина запроса(до 99 страниц)</p><input type="text" maxlength="2" class="span3" value="<?php echo $row['depth'];?>" name="depth"><br/>
                <input type="hidden" value="ok" name="save">
                <button type="submit" name="submit" class=" btn btn-block vtn-success">Сохранить</button>
            </form>
        </div>
    </div>
</div>
<?php
if (isset($_POST['save']))
    $save=$_POST['save'];
    else
$save=false;

if (($save=="ok") and (isset($_POST['find'])) and (isset($_POST['depth'])))
{
$query='UPDATE `parser`.`settings` SET `find` =  \''.$_POST['find'].'\' , `depth`=\''.$_POST['depth'].'\' WHERE `settings`.`id` =1';
$db->query($query);
header("Location: index.php");
}

?>