
<div id="centralni">
			<div id="div-levo">
				
			</div> 
			<div id="div-desno">
				<div class="precice">
					<ul>
						<li class="aktivan"><a href="index.php?page=admin">Korisnici</a></li>
						<li class="aktivan"><a href="index.php?page=adminProizvod">Proizvodi</a></li>
					</ul>
				</div>
				
                <div id="registracija"> 
                            
					<form action="<?= $_SERVER['PHP_SELF'].'?page=admin'?>" method="POST">
						<table>
							<caption><h2>DODAVANJE NOVOG KORISNIKA</h2></caption>
                            
							<tr>
								<td>Ime i Prezime:</td>
								<td><input type="text" id="imePrezime" name="imePrezime" placeholder="Unesite vase ime i prezime"/></td>
							</tr>
							<tr>
								<td>Pol:</td>
								<td>
									<select name="ddlPol" id="ddlPol" class="liste">
                                    <option value="0">Izaberite pol</option>
                                        <?php 
                                        include "php/konekcija.php";
                                        $upit="SELECT * FROM pol";
                                        $rez=$kon->prepare($upit);
                        
                                        try{
                                           $rez->execute();
                                           
                                        
                                        }catch(PDOException $e)
                                        {
                                            echo $e->getMessage();
                                        }
                                        foreach($rez as $red):
                                        ?>
                                        <option value="<?= $red->polID?>"><?= $red->Naziv?></option>
                                        <?php endforeach;?>
                                    </select>
								</td>
                            </tr>
                            <tr>
								<td>Uloga:</td>
								<td>
									<select name="ddlUloge" id="ddlUloge" class="liste">
                                    <option value="0">Izaberite ulogu</option>
                                        <?php 
                                        $upit="SELECT * FROM uloge";
                                        $rez=$kon->prepare($upit);
                        
                                        try{
                                           $rez->execute();
                                           
                                        
                                        }catch(PDOException $e)
                                        {
                                            echo $e->getMessage();
                                        }
                                        foreach($rez as $red):
                                        ?>
                                        <option value="<?= $red->id?>"><?= $red->naziv?></option>
                                        <?php endforeach;?>
                                    </select>
								</td>
							</tr>
							<tr>
								<td>Adresa:</td>
								<td><input type="text" id="adresa" name="Adresa" placeholder="npr. Zdravka Celara 16"/></td>
							</tr>
							<tr>
								<td>Grad:</td>
								<td><input type="text" id="grad" name="grad"placeholder="npr. Beograd"/></td>
							</tr>
							<tr>
								<td>Poštanski broj:</td>
								<td><input type="text" id="postanskiBr" name="postanskiBr"placeholder="npr. 11000"/></td>
							</tr>
							<tr>
								<td>Email adresa:</td>
								<td><input type="text" id="emailAdresa" name="emailAdresa" placeholder="Adresa mora da bude gmail.com"/></td>
							</tr>
							<tr>
								<td>Šifra:</td>
								<td><input type="password" id="sifra" name="sifra" placeholder="Mora poceti velikim slovom"/></td>
                            </tr>
                            <tr>
								<td>Aktivan korisnik da/ne:</td>
                                <td><input type="checkbox" id="aktivan" name="aktivan"/></td>
                                <td><input type="hidden" id="skiveno" name="skiveno"/></td>
                            </tr>
                            
							
							<tr>
								<td><input type="button" id="Add" name="izmena" class="dugme" value="DODAJ"/></td>
								<td><input type="reset" id="dugme" class="dugme" value="PONIŠTI"/></td>
                            </tr>
                            
						</table>
					</form>
				</div>
                
				
				<div class="cistac"></div>
			</div>
			<div class="cistac"></div>
		</div>
	