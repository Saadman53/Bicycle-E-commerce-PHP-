<?php
$status =404;
$data=null;

if(isset($_POST['provera']))
{   
    
    $greske = [];
    
    $aktivan = isset($_POST['aktivanIzbor'])? $_POST['aktivanIzbor']:false;
    $korisnikId=$_POST['skriveno'];
    $uloga=$_POST['ulogaIzbor'];
    $pol=$_POST['polIzbor'];

    $imePrezime = $_POST['imePrezime'];
    $adresa = $_POST['adresa'];
    $grad = $_POST['grad'];
    $postanskiBroj=$_POST['postanskiBroj'];
    $emailAdresa=$_POST['emailAdresa'];
  
    $sifra =$_POST['sifra'];
    
    $regImePrezime ="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})+$/";
    $regAdresa="/^([A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,15})*(\s[\d]{1,3})$/";
    $regGrad="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10})?(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,10})?$/";
    $regPostanskiBroj="/^[1 2 3][0-9]{4}$/";
    $regSifra="/^[A-Z][\w\d]{5,}$/";

    

    if(!preg_match($regImePrezime,$imePrezime))
    {
        array_push($greske,"Niste dobro uneli ime i prezime!");
    }
    if(!preg_match($regAdresa,$adresa))
    {
        array_push($greske,"Miste dobro uneli vasu adresu!");
    }
    if(!preg_match($regGrad,$grad))
    {
        array_push($greske,"Niste dobro uneli vas grad!");
    }
    if(!preg_match($regPostanskiBroj,$postanskiBroj))
    {
        array_push($greske,"Niste dobro uneli postanski broj!");
    }
    if(!filter_var($emailAdresa,FILTER_VALIDATE_EMAIL))
    {
        array_push($greske,"Niste u dobrom formatu uneli email!");
    }

    if(!preg_match($regSifra,$sifra))
    {
        array_push($greske,"Niste dobro uneli sifru!");
    }


    
    if(count($greske) >0)
    {   $status=422;
       
    }else
    {
        include "konekcija.php";
        $upit="INSERT INTO korisnik(imePrezime,adresa,grad,postanskiBroj,email,ulogaID,sifra,aktivan,polID)
        values(:imePrezime,:adresa,:grad,:pBroj,:email,:uloga,:sifra,:aktivan,:pol)";
        $sifra=md5($sifra);

        $rez=$kon->prepare($upit);
        $rez->bindParam(":imePrezime",$imePrezime);
        $rez->bindParam(":adresa",$adresa);
        $rez->bindParam(":grad",$grad);
        $rez->bindParam(":pBroj",$postanskiBroj);
        $rez->bindParam(":email",$emailAdresa);
        $rez->bindParam(":uloga",$uloga);
        $rez->bindParam(":aktivan",$aktivan);
        $rez->bindParam(":pol",$pol);
        $rez->bindParam(":sifra",$sifra);

        if($rez->execute())
        {
            $data="Korisnik je uspesno izmenjen";
            $status=204;
        }else
        {
            $data="Korisnik nije izmenjen dosle je do greske";
            $status=500;
        }
    }
}
header("Content-type: application/json");
http_response_code($status);
echo json_encode($data);
