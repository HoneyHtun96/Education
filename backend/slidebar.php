<?php 


	$directoryURI = $_SERVER['REQUEST_URI'];
	$path= parse_url($directoryURI,PHP_URL_PATH);
	// /folder/backend/index.php
	$components = explode('/', $path);
	$second_part = $components[3];

?>

<nav class="sidebar col-xs-12 col-sm-4 col-lg-3 col-xl-2">
	<h1 class="site-title"><a href="index.php"><em class="fa fa-rocket"></em> Brand.name</a></h1>
										
	<a href="#menu-toggle" class="btn btn-default" id="menu-toggle"><em class="fa fa-bars"></em></a>
	<ul class="nav nav-pills flex-column sidebar-nav">
		<li class="nav-item"><a class="nav-link active" href="index.php"><em class="fa fa-dashboard"></em> Dashboard <span class="sr-only">(current)</span></a></li>
		<li class="nav-item"><a class="nav-link <?php if($second_part == 'book.php'){ echo 'active';} ?>" href="book.php"><em class="fa fa-calendar-o"></em> BOOKS</a></li>

		<li class="nav-item"><a class="nav-link <?php if($second_part == 'categories.php'){ echo 'active';} ?>" href="categories.php"><em class="fa fa-bar-chart"></em> CATEGORIES</a></li>

		<li class="nav-item"><a class="nav-link <?php if($second_part == 'authors.php'){ echo 'active';} ?>" href="authors.php"><em class="fa fa-hand-o-up"></em> AUTHORS</a></li>

		<li class="nav-item"><a class="nav-link" href="index.php"><em class="fa fa-pencil-square-o"></em> USERS</a></li>
		<li class="nav-item"><a class="nav-link" href="index.php"><em class="fa fa-clone"></em> TRAINERS</a></li>
		<li class="nav-item"><a class="nav-link" href="index.php"><em class="fa fa-clone"></em> COURSES</a></li>
		<li class="nav-item"><a class="nav-link" href="index.php"><em class="fa fa-clone"></em> ORDERS</a></li>
	</ul>
</nav>

