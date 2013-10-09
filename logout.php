<?php
session_start();
include('inc/header.php');
if (!empty($_SESSION['user'])){
unset($_SESSION['user']);
session_destroy();
echo ('<h2>Вы успешно вышли!<br/> <small>Вы вернетесь на главную страницу через 5 секунд</small></h2><br/>');
}else{
echo ('<h2 class="">Вы не входили или что-то пошло не так. <br/><small>Вы вернетесь на главную страницу через 5 секунд</small></h2><br/>');
}
?>

<script type="text/JavaScript">

    function doRedirect() {
        atTime = "5000";
        toUrl = "index.php";
        setTimeout("location.href = toUrl;", atTime);
    }
</script>
<body onload="doRedirect();">
</body>

<?php include('inc/footer.php'); ?>