<nav class="navbar fixed-top navbar-expand-lg navbar-dark text-white " id='nav'>
	<a class="navbar-brand hvr-float-shadow logo link" href="index.php?page=accueil">
		<span>Loopi</span>
	</a>
	<button class="navbar-toggler toggle" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse w-100 order-1 order-lg-0" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto ">
			<li class="nav-item text-center">
				<a class="nav-link" href="index.php?page=informations"> Informations <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item text-center">
				<a class="nav-link" href="index.php?page=moderation">Moderation</a>
			</li>
			<li class="nav-item text-center">
				<?php if ($_SESSION['connected'] == true) echo '<a class="nav-link" href="index.php?page=overview">Serveurs</a>'
				?>
			</li>
		</ul>
	</div>
	<?php
	if ($_SESSION['connected'] == false) echo ('<div class="login-button nav-link"><a href="?action=login" id="test" class="link link-button">Login</a></div>');
	if ($_SESSION['connected'] == true) echo ('<div class="login-button nav-link"><a href="?action=logout" class="link link-button">Logout</a></div>');
	?>
</nav>