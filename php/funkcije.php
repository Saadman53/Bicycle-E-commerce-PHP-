<?php

function malaSlika($putanja_velika, $putanja_mala, $nova_sirina, $nova_visina){
    
    // primer: image/slika1.jpg

    $podaciSlika=explode('.',$putanja_velika);

    $ekstenzija = $podaciSlika[1]; // "jpg" itd

    // Provera da li je ekstenzija jpg/jpeg
    // "/i" - ne gleda da li je veliko/malo slovo - case INsensitive

	if (preg_match('/jpg|jpeg/i',$ekstenzija)){

        // "imagecreatefromjpeg" - ugradjena PHP funkcija, kreira NOVU SLIKU od originalne koja se nalazi na "putanja_velika"
        // Nova slika je za sada ista kao originalna

		$nova_slika = imagecreatefromjpeg($putanja_velika);
	}

    // Provera da li je ekstenzija png
	if (preg_match('/png/i', $ekstenzija)){
		$nova_slika = imagecreatefrompng($putanja_velika);
	}

    // Preuzimanje sirine i visine nove slike - isto kao na originalnoj

	$sirina_original = imageSX($nova_slika);
	$visina_original = imageSY($nova_slika);

    // Skaliranje slike

	if ($sirina_original > $visina_original) {

		$tmp_sirina = $nova_sirina;
		$tmp_visina = $visina_original * ($nova_visina / $visina_original); 
        // $nova_visina/$visina - vraca procentualno razliku nove i stare visine - za toliko smanjujemo sliku
	}
	if ($sirina_original < $visina_original) {
		$tmp_sirina = $sirina_original * ($nova_sirina / $sirina_original);
		$tmp_visina = $nova_visina;
	}
	if ($sirina_original == $visina_original) {
		$tmp_sirina=$nova_sirina;
		$tmp_visina=$nova_visina;
	}

	// Slika koja se dobija kao rezultat metode
	$izlazna_slika = imagecreatetruecolor($tmp_sirina, $tmp_visina);

	imagecopyresampled($izlazna_slika, $nova_slika, 
						0, 0, 0, 0, 
						$tmp_sirina, $tmp_visina, 
						$sirina_original, $visina_original);


	if (preg_match("/png/i",$ekstenzija)){
		imagepng($izlazna_slika, $putanja_mala);
    } else {
	  	imagejpeg($izlazna_slika, $putanja_mala);
	}
	imagedestroy($izlazna_slika);
	imagedestroy($nova_slika);
}