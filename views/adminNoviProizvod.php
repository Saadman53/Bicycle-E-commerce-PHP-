
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
				<div class="adminPanel">
                <?php 
                    if(isset($_POST['izmenaP']))
                    {   include "php/konekcija.php";
                        include "php/funkcije.php";
                        
                        $greske = [];
                        
                        $naslov=$_POST['naslovP'];
                        $kategorijaIzbor=$_POST['ddlKategorija'];
                        $cena=$_POST['cenaProizvoda'];
                        $idProizvoda=$_POST['skivenoP'];
                        $alt=$_POST['naslovP'];

                        $slika =$_FILES['slikaP'];

                        $imeFajla =$slika['name'];
                        $tipFajla =$slika['type'];
                        $velicinaFajla = $slika['size'];
                        $tmp_putanja= $slika['tmp_name'];

                        $dozvoljeni_formati = array("image/jpg", "image/jpeg", "image/png", "image/gif");
            
                        if(!in_array($tipFajla, $dozvoljeni_formati)){
                            array_push($greske,"Tip fajla nije dobar!");
                        }
                        if($velicinaFajla>3000000){
                            array_push($greske,"Prevelika slika!");
                        }
                       
                    
                        $regNaslov="/^[\w\s]{3,30}$/";
                       
                    
                       
                        if(!preg_match($regNaslov,$naslov))
                        {
                            array_push($greske,"Niste dobro naslov!");
                        }
                       
                        if($kategorijaIzbor==0)
                        {
                            array_push($greske,"Morate izabrati kategoriju!");
                        }
                        if(empty($cena))
                        {
                            array_push($greske,"Morate uneti cenu proizvoda!");
                        }
                    
                       
                        
                        if(count($greske) >0)
                        {   
                            foreach($greske as $g)
                            {
                                echo "<h4>".$g."</h4><br/>";
                            }
                        }else
                        { 
                               
                                
                                $novoIme=time().$imeFajla;
                                $novaPutanja="images/".$novoIme;
                    
                                move_uploaded_file($tmp_putanja,$novaPutanja);
                                $malaSlika="images/mala_".$novoIme;
                    
                                malaSlika($novaPutanja,$malaSlika, 180,180);
                    
                                $upit="INSERT INTO proizvodi(naslov,src,alt,cena,idKategorija) VALUES(:naslov,:mala,:alt,:cena,:id)";
                    
                                $rez = $kon->prepare($upit);
                    
                                $rez->bindParam(":naslov",$naslov);
                                $rez->bindParam(":mala",$malaSlika);
                                $rez->bindParam(":alt",$alt);
                                $rez->bindParam(":cena",$cena);
                                $rez->bindParam(":id",$kategorijaIzbor);
                                
                    
                                try{
                                    if($rez->execute())
                                    {
                                        echo "<h4>Uspesno ste dodali proizvod</h4>";
                                    }

                                    
                                }catch(PDOException $e)
                                {
                                    $e->getMessage();
                                    
                                }
                           
                        }
                    }
                    
                ?>
                  
                </div>
                <div id="registracija">   
					<form action="<?= $_SERVER['PHP_SELF'].'?page=adminProizvodDodaj'?>" method="POST" enctype="multipart/form-data">
						<table>
							<caption><h2>DODAJ NOVI PROIZVOD</h2></caption>
                            
							<tr>
								<td>Naslov:</td>
                                <td><input type="text" id="naslovP" name="naslovP" placeholder="Maksimalno 30 karaktera"/></td>
                                <td><input type="hidden" id="skivenoP" name="skivenoP"/></td>
							</tr>
							<tr>
								<td>Kategorija proizvoda:</td>
								<td>
									<select name="ddlKategorija" id="ddlKategorija" class="liste">
                                    <option value="0">Izaberite kategoriju</option>
                                        <?php 
                                        include "php/konekcija.php";
                                        $upit="SELECT * FROM kategorije";
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
								<td>Cena:</td>
								<td><input type="text" id="cenaProizvoda" name="cenaProizvoda"placeholder="Unesite cenu prozivoda u dinarima"/></td>
							</tr>
							<tr>
                                <td>Slika prozivoda:</td>
                                <td><input type="file" id="slikaP" name="slikaP"/></td>
                            </tr>
                            
							<tr>
								<td><input type="submit" id="izmenaP" name="izmenaP" class="dugme" value="DODAJ"/></td>
								<td><input type="reset" id="dugme" class="dugme" value="PONIŠTI"/></td>
                            </tr>
                            
						</table>
					</form>
				</div>
			</div>
			<div class="cistac"></div>
		</div>
	