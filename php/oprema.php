<?php 
    $status=404;
    
    include "konekcija.php";
    $upit="SELECT * FROM proizvodi p INNER JOIN kategorije k ON p.idKategorija=k.id WHERE idKategorija=2";

    

    try{
        $rez=$kon->prepare($upit);
        $rez->execute();
        $dohvati = $rez->fetchAll();
        $status=200;

    }catch(PDOExeption $e)
    {
        $e->getMessage();
        $status=409;
    }
    header("Content-type: application/json");
    http_response_code($status);
    echo json_encode($dohvati);
