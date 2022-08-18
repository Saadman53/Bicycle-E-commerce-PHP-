<body>
	<div class="drzac">
		<a href="index.php?page=index" title="Početna"><img src="images/logo.png" alt="Logo"/></a>
	</div>
	<div class="drzac">
				<ul>
					<li id="meni"><a href="index.php?page=index">Početna</a></li>
					<li id="meni"><a href="index.php?page=prodavnica">Prodavnica</a></li>


					
					<?php if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"): ?>
						<li><a href="index.php?page=admin">Admin panel</a></li>
					<?php endif; ?>
					<?php if(isset($_SESSION['korisnik'])): ?>
						<li><a href="index.php?page=kontakt">Kontakt</a></li>
					<?php endif; ?>
					<?php if(isset($_SESSION['korisnik'])): ?>
						<li><a href="php/logout.php">Odjavi se</a></li>
					<?php else: ?>
						<li><a href="index.php?page=prijava">Prijavi se</a></li>
					<?php endif;?>
					<li><a href="index.php?page=autor">Autor</a></li>
				</ul>
	</div>
	<div id="slajder">
		<img  class="show" src="images/slajder1.jpg" alt="Slika 1"/>
		<img src="images/slajder2.jpg" alt="Slika 2"/>
		<img src="images/slajder3.jpg" alt="Slika 3"/>
	</div>