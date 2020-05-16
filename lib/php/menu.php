<ul class="nav-list">
		<li class="nav-item"><a href="index.php?page=information.php" class="lien hvr-underline-from-left">Information</a></li>
		<li class="nav-item"><a href="" class="lien hvr-underline-from-left">Commands</a></li>
		<?php if($_SESSION['connected'] == true) echo '<li class="nav-item"><a href="index.php?page=overview.php" class="lien hvr-underline-from-left">Overview</a></li>' ?>
</ul>