
<div id="centralni">
			<div id="div-levo">
				<h1>Selekcija</h1>
					<ul id="selekcija">
						<?php 
							$upitGlavni ="SELECT * FROM meni WHERE roditelj=0";
							include "php/konekcija.php";
							$rezGlavni = $kon->query($upitGlavni);

							foreach($rezGlavni as $red)
							{
								echo "<li>".$red->naziv;
								
								$upit="SELECT * FROM meni WHERE roditelj=$red->idMeni";
								$rezPod=$kon->query($upit);
								if($rezPod->rowCount()>0){
									echo "<ul>";
								foreach($rezPod as $red)
								{
									echo "<li><a id='".$red->putanja."'href='#div-desno'>".$red->naziv."</a>";
									
									echo "</li>";
								}
								
									echo "</ul>";
								}

								echo "</li>";
							}

						?>
					</ul>
					
				
			</div> 
			<div id="div-desno">
				<div class="precice">
					<ul>
						<li class="aktivan"><a href="index.php?page=prodavnica">Bicikli</a></li>
						<li class="aktivan"><a href="index.php?page=oprema">Oprema</a></li>
					</ul>
				</div>
				<div class="pera"></div>
				
				<div class="cistac"></div>
			</div>
			<div class="cistac"></div>
		</div>
	