
<div class="container">
    <div class="row">
    <div class="well span4 offset4">
        <legend>Авторизация</legend>
            <form method="POST" action="index.php?page=settings" accept-charset="UTF-8">        
                
                <?php if (isset($login)){
                echo    '<div class="alert alert-error fade in">
                        <a class="close" href="#" data-dismiss="alert">X</a>Введены неверные данные
                        </div>';}?>
                <input type="text" class="span4" placeholder="Введите логин" name="login">
                <input type="password" class="span4" placeholder="Введите пароль" name="passwd">
                <!--<label class="chekbox">
                    <input type="checkbox" value="1" name="remember"> Запомнить меня
                </label>-->
                <button type="submit" name="submit" class=" btn btn-block vtn-success">Войти</button>
            </form>
        </div>
    </div>
</div>