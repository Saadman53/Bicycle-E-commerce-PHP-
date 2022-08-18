<div id="centralni">
			<div id="div-levo">
				<?php if(isset($_SESSION['greske'])): 
					
					unset($_SESSION['greske']);
				?>
				<h1>OBAVESTENJE</h1>
				<h3>Niste dobro uneli email ili lozinku</h3>

				<?php endif;?>
				
			</div> 
			<div id="div-desno">
				<div class="precice">
				<?php if(isset($_SESSION['korisnik'])):?>
				
				<?php else:?>
					<ul>
						<li class="aktivan"><a href="index.php?page=prijava">Prijava</a></li>
						<li class="aktivan"><a href="index.php?page=registracija">Registracija</a></li>
					</ul>
				<?php endif; ?>
				</div>
				
				<div id="registracija">
					<?php 
						if(isset($_SESSION['korisnik'])):
							//var_dump($_SESSION['korisnik']);
					?>
					<form>
					<table>
					<tr>
							<td>
								<h1>Dobro dosli!</h1>
								<h3><?= $_SESSION['korisnik']->imePrezime?></h3>
							</td>
					</tr>
					
					<?php 
						include "php/konekcija.php";
						$upit="SELECT * FROM anketa where aktivna=1";
						$ankete=$kon->query($upit)->fetchAll();
						foreach($ankete as $anketa):
					?>
						<tr>
							<td>
							<b><?= $anketa->pitanje?></b>
							</td>

						</tr>
						<tr>
							<td>
								<?php
									$id=$anketa->id_a;
									$upit2="SELECT * FROM odgovor o INNER JOIN anketa_odgovor ao ON o.id_odgovor=ao.id_odgovor INNER JOIN anketa a on ao.id_anketa=a.id_a WHERE a.id_a=:id";
									$rez2=$kon->prepare($upit2);
									$rez2->bindParam(":id",$id);
									$rez2->execute();
									$odgovor= $rez2->fetchall();
									
								?>
								<select id="ddl<?=$anketa->id_a?>">
								<option value="0">Izaberite odgovor</option>
									<?php foreach($odgovor as $odg):?>
										<option value="<?= $odg->id_odgovor?>"><?= $odg->odgovor;?></option>
									<?php endforeach;?>
								</select>
							</td>
						</tr>
						<tr>
							<td><input type="button" class="dugmic btnAnketa" value="Potvrdi" data-id="<?= $anketa->id_a?>"/></td>
						</tr>
					<?php endforeach; ?>

					</table>
					</form>




















					<?php 
					else: ?>		
					<form method="POST" action="php/login.php" onSubmit="return proveraForme();">
						<table>	
							<caption><h2>Prijavi se</h2></caption>
							<tr>
								<td>Email adresa:</td>
								<td><input type="text" id="emailAdresa" name="emailAdresa" placeholder="Adresa mora da bude gmail.com"/></td>
							</tr>
							<tr>
								<td>Šifra:</td>
								<td><input type="password" id="sifra" name="sifra" placeholder="Mora poceti velikim slovom"/></td>
							</tr>
							
							<tr>
								<td><input type="submit" id="dugme5"  name="logovanje" class="dugme" value="PRIJAVI SE"/></td>
								<td><input type="reset" id="dugme6" class="dugme" value="PONIŠTI"/></td>
							</tr>
						</table>
					</form>
						<?php endif;?>
				</div>
			</div>
			<div class="cistac"></div>
		</div>