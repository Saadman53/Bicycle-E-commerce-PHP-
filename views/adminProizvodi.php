
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
                        include "php/konekcija.php";
 
                        $upit="SELECT * FROM proizvodi";
                        $priprema=$kon->prepare($upit);
                    
                        try{
                            $rezultat=$priprema->execute();
                            //var_dump($priprema->rowCount());
                           
                        }catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                        $brojPoStrani=5;
                        $brojStrana=ceil($priprema->rowCount()/$brojPoStrani);
                       
                        $strana=isset($_GET['type'])? $_GET['type']:1;
                        $odKogKrece =($strana-1)*$brojPoStrani;
                        $upit="SELECT * FROM proizvodi p INNER JOIN kategorije k ON p.idKategorija=k.id LIMIT $odKogKrece,$brojPoStrani";
                        $proizvodi=$kon->query($upit)->fetchAll();
                        
                       foreach($proizvodi as $red):
                    ?>
                    <div class="artikli">
					    <a id="single_image" class="lightbox" href="<?= $red->src ?>" data-fancybox="group" data-caption="<?= $red->naslov ?>"><img src="<?= $red->src ?>" alt="<?= $red->alt ?>"/></a>
					    <h2 class="cena"><?= $red->cena ?></h2>
					    <p class="naziv"><?= $red->naslov ?></p>
                        <p class="naziv">Kategorija: <?= $red->naziv ?></p>
                        <td><input type="button" value="Obrisi" class="brisanjeP dugmic" data-id="<?= $red->idProizvod ?>"/></td>
                        <td><input type="button" value="Update" class="updateP dugmic"  data-id="<?= $red->idProizvod ?>"/></td>
					</div>
                    <?php  endforeach;?>
                    
                </div>
                <div class="cistac"></div>
                <div class="paginacija">
                <ul>
                    <?php for($i=1;$i<$brojStrana+1;$i++): ?>
                        <li><a href="index.php?page=adminProizvod&type=<?= $i?>"><?=$i?></a></li>
                    <?php endfor;?>
                </ul>
                </div>
                <div id="registracija"> 
                <?php 
                    if(isset($_POST['izmenaP']))
                    {   

                        include "php/funkcije.php";
                        
                        $greske = [];
                        
                        $naslov=$_POST['naslovP'];
                        $kategorijaIzbor=$_POST['ddlKategorija'];
                        $cena=$_POST['cenaProizvoda'];
                        $idProizvoda=$_POST['skivenoP'];
                        $alt=$_POST['naslovP'];

                        $slika =$_FILES['slikaP'];
                        
                       
                    
                        $regNaslov="/^[\w\s]{3,30}$/";
                       
                    
                       
                        if(!preg_match($regNaslov,$naslov))
                        {
                            array_push($greske,"Niste dobro naslov!");
                        }
                       
                        if($kategorijaIzbor==0)
                        {
                            array_push($greske,"Morate izabrati kategoriju!");
                        }
                       
                        
                        if(count($greske) >0)
                        {   
                            echo "Niste dobro uneli Cenu ili naslov";
                        }else
                        { 
                            if($slika['size'] != 0)
                            {
                                $imeFajla =$slika['name'];
                                var_dump($imeFajla);
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
                                
                                $novoIme=time().$imeFajla;
                                $novaPutanja="images/".$novoIme;
                    
                                move_uploaded_file($tmp_putanja,$novaPutanja);
                                $malaSlika="images/mala_".$novoIme;
                    
                                malaSlika($novaPutanja,$malaSlika, 180,180);
                    
                                $upit="UPDATE proizvodi SET naslov=:naslov,src=:mala,alt=:alt,cena=:cena,idKategorija=:id WHERE idProizvod=:idPro";
                    
                                $rez = $kon->prepare($upit);
                    
                                $rez->bindParam(":naslov",$naslov);
                                $rez->bindParam(":mala",$malaSlika);
                                $rez->bindParam(":alt",$alt);
                                $rez->bindParam(":cena",$cena);
                                $rez->bindParam(":id",$kategorijaIzbor);
                                $rez->bindParam(":idPro",$idProizvoda);
                    
                                try{
                                    $rez->execute();
                                    
                                }catch(PDOException $e)
                                {
                                    $e->getMessage();
                                    
                                }
                    
                            }else{

                                $upit="UPDATE proizvodi SET naslov=:naslov,alt=:alt,cena=:cena,idKategorija=:id WHERE idProizvod=:idPro";
                    
                                $rez = $kon->prepare($upit);
                    
                                $rez->bindParam(":naslov",$naslov);
                                $rez->bindParam(":alt",$alt);
                                $rez->bindParam(":cena",$cena);
                                $rez->bindParam(":id",$kategorijaIzbor);
                                $rez->bindParam(":idPro",$idProizvoda);
                    
                                try{
                                    $rez->execute();
                                    
                                }catch(PDOException $e)
                                {
                                    $e->getMessage();
                                    
                                }
                            }  
                            
                           
                        }
                    }
                    
                ?>
                            
					<form action="<?= $_SERVER['PHP_SELF'].'?page=adminProizvod'?>" method="POST" enctype="multipart/form-data">
						<table>
							<caption><h2>IZMENA PROIZVODA</h2></caption>
                            <tr><td colspan="2"><a href="index.php?page=adminProizvodDodaj" id="korisnikDodat" title="Forma za dodavanje proizvoda">KLIKOM OVDE MOZETE DODATI NOVI PROIZVOD</a></td></tr>
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
								<td>Alt se uzima od naslova:</td>
								<td><input type="text" id="altP" name="altP"placeholder="Alt se uzima od naslova proizvoda" disabled/></td>
							</tr>
							<tr>
								<td><input type="submit" id="izmenaP" name="izmenaP" class="dugme" value="IZMENA"/></td>
								<td><input type="reset" id="dugme" class="dugme" value="PONIŠTI"/></td>
                            </tr>
                            
						</table>
					</form>
				</div>
				
				
			</div>
			<div class="cistac"></div>
		</div>
	