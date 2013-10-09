<div class="row">
    <div class="span1">
        <p class="pull-center">ID</p>
    </div>
    <div class="span2">
        <p>Host</p>
    </div>
    <div class="span3">
        <p>Title</p>
    </div>
    <div class="span3">
        <p>Keywords</p>
    </div>
    <div class="span3">
        <p>Description</p>
    </div>
</div>
<?php
if (isset($_GET['limit'])){
$limit=$_GET['limit'];
}
$query='select id from parser.parsed';

$query='select * from parser.parsed order by id desc limit '.$limit.', 10';
$result=$db->query($query);
$num_rows=$result->num_rows;

for ($i=0; $i<$num_rows; $i++){
$rows=$result->fetch_assoc();

?>


<form onkeydown="javascript:if(13==event.keyCode){return false;}">
<div class="row">
    <div class="span1">
        <p><?php echo($rows['id']); ?></p>
    </div>
    <div class="span2">
        <p><?php echo($rows['host']); ?></p>
    </div>
    <div class="span3">
        <input type="textarea" class="span3" value="<?php echo $rows['title'];?>"></textarea>
    </div>
    <div class="span3">
        <input type="textarea" class="span3" value="<?php echo $rows['keywords'];?>"></textarea>
    </div>
    <div class="span3">
        <input type="textarea" class="span3" value="<?php echo $rows['description'];?>"></textarea>
    </div>
</div>
</form>
<?

}
?>