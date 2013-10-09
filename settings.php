<?php
//echo ('Раздел основных настроек, для передачи в файл /config.inc');
?>
<div class="container">
	<div class="row">
	<div class="well span6 offset3">
		<legend>Настройки</legend>
			<form method="POST" action="index.php?page=settings" accept-charset="UTF-8">		
				
				<?php if (isset($save)){
				echo '<div class="alert alert-success fade in">
					<a class="close" href="#" data-dismiss="alert">X</a>Успешно сохранено
				</div>';}//если что не так вводим - сюда выкидываем мессагу и засылаем адрес в самих себя...)
				?>
				
				<p class="span3">Запрос для google.com</p><input type="text" class="span3" placeholder="Что ищем..." name="find"><br/>
				<p class="span3">Глубина запроса(до 50)</p><input type="text" class="span3" placeholder="Глубина поиска" name="depth"><br/>
				<input type="hidden" class="span3" value="ok" name="save">
				<!--<label class="chekbox">
					<input type="checkbox" value="1" name="remember"> Запомнить меня
				</label>-->
				<button type="submit" name="submit" class=" btn btn-block vtn-success">Сохранить</button>
			</form>
		</div>
	</div>
</div>
<?php

//echo $_POST['id'];
?>