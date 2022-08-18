<?php

if(isset($_GET['token'])){
	$token = $_GET['token'];

	

	include "../php/konekcija.php";

	$upit = "SELECT * FROM korisnik WHERE token = :token";

	$priprema1 = $kon->prepare($upit);

	$priprema1->bindParam(":token", $token);

	try {
		$rezultat = $priprema1->execute();
		if($rezultat){
			$korisnik = $priprema1->fetch();
			if(empty($korisnik)){
                echo "Niste registrovani!";
                
			} else {
                $upit = "UPDATE korisnik SET aktivan = 1
                WHERE token = :token";
				$priprema = $kon->prepare($upit);

				$priprema->bindParam(":token", $token);

				$rez = $priprema->execute();

				if($rez){
                    header("Location: https://bicycles-shop.000webhostapp.com/index.php?page=validacijauspesna");
                    echo "Uspesno ste se registrovali";

				} else {
					echo "Izvinite, greska!";
				}



			}

		} else {
			echo "Upit nije ok.";
		}
	}
	catch(PDOException $ex){
		echo $ex->getMessage();
	}
}