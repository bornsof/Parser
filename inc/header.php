<!DOCTYPE html>
<html lang="ru">
<head>
<title>Система настройки парсера Bornsof ver 0.0.1a</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta HTTP-EQUIV="Pragma" CONTENT="no-cache">
<!-- Bootstrap template-->
<link href="css/bootstrap.min.css" rel="stylesheet">

</head>
<body>


<div class="container">
	<header>
		<h1>Настройки парсера Bornsof</h1>
	</header>
	
	<div class="navbar navbar-static-top">
		<nav class="navbar-inner">
			<a class="brand">Версия 0.0.2а</a>
			<ul class="nav">
				<li class="divider-vertical"></li>
				<li><a href="index.php?page=settings">Основные</a></li>
					<li class="dropdown">	
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">Последние запросы<b class="caret"></b></a>
						<ul class="dropdown-menu">
							<li><a href="index.php?page=list&limit=0">1..10</a></li>
							<li><a href="index.php?page=list&limit=10">11..20</a></li>
							<li><a href="index.php?page=list&limit=20">21..30</a></li>
							<li><a href="index.php?page=list&limit=30">31..40</a></li>
							<li><a href="index.php?page=list&limit=40">41..50</a></li>
						</ul>
					</li>
				<li><a href="index.php?page=host">Выборка по хосту</a></li>
				<?php if (isset($_SESSION['user'])){echo '<li><a href="logout.php">Выход</a></li>';}
				?>
			</ul>

			
			
		</nav>
	</div>
