<div class="container">
    <form method="POST" action="index.php?page=host" accept-charset="UTF-8">        
        <div class="pull-right">
<div class="input-append">
  <input class="span2" id="appendedInputButtons" size="16" type="text" name="host" placeholder="Host..."><button class="btn">Найти</button>
</div>

  </div>
</form>
</div>
<?php
if (isset($_POST['host'])){
    $host=$_POST['host'];

    $query='select * from parser.parsed where host=\''.$host.'\'';
    $result=$db->query($query);
    $num_rows=$result->num_rows;
if ($num_rows>0){
    ?>
     <div class="alert success">
        <h3>Найдено <?php echo $num_rows;?>.</h3>
     </div>

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
}   
else
{
    ?>
        <div class="alert">
        <h3>Ничего не найдено...</h3>
        </div>
    <?php
}
    
    
    for($i=0; $i<$num_rows; $i++){
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
    <?php
        
    }
}
else{
    ?>
        <div class="alert">
        <h3>Введите host для поиска в базе...<small> Например "www.youtube.com"</small></h3>
        </div>
    <?php
}
?>