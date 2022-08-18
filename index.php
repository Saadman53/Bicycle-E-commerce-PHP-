<?php 
    session_start();
    $page="";
    if(isset($_GET['page']))
    {
        $page=$_GET['page'];
    }
   
    
    include "php/validacija.php";
    include "views/head.php";
    include "views/nav.php";

    switch($page)
    { 
        case "index":
            include "views/centarIndex.php";
            include "views/scriptaIndex.php";
            break;
        case "prodavnica":
            if(isset($_SESSION['korisnik'])){
               include "views/centarProdavnica.php";
               include "views/scriptProdavnica.php"; 
               break;
            }else
            {
            include "views/centarPrijava.php";
            include "views/scriptPrijava.php";
            break;
            }  
        case "oprema":
            include "views/centarProdavnica.php";
            include "views/scriptSatovi.php";
            break;
        case "prijava":
            include "views/centarPrijava.php";
            include "views/scriptPrijava.php";
            break;
        case "registracija":
            include "views/centarRegistracija.php";
            include "views/scriptRegistracija.php";
            break;
        case "autor":
            include "views/centarAutor.php";
            include "views/scriptaIndex.php";
            break;
        case "admin":
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"){
                include "views/centarAdmin.php";
                include "views/scriptPrijava.php";
                break;
            }else
            {
                include "views/centarPrijava.php";
                include "views/scriptPrijava.php";
                break;
            }
        case "adminProizvod":
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"){
                include "views/adminProizvodi.php";
                include "views/scriptPrijava.php";
                break;
            }else
            {
                include "views/centarPrijava.php";
                include "views/scriptPrijava.php";
                break;
            }
        case "adminProizvodDodaj":
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"){
                include "views/adminNoviProizvod.php";
                include "views/scriptPrijava.php";
                break;
            }else
            {
                include "views/centarPrijava.php";
                include "views/scriptPrijava.php";
                break;
            }
        case "dodajKorisnika":
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv=="admin"){
                include "views/noviKorisnikAdmin.php";
                include "views/scriptPrijava.php";
                break;
            }else
            {
                include "views/centarPrijava.php";
                include "views/scriptPrijava.php";
                break;
            }
        case "kontakt":
            if(isset($_SESSION['korisnik'])){
                include "views/kontakt.php";
                include "views/scriptPrijava.php";
                break;
            }else
                {
                include "views/centarPrijava.php";
                include "views/scriptPrijava.php";
                break;
                 }  
        case "validacijauspesna":
            include "views/validacijauspesna.php";
            break;
        default:
            include "views/centarIndex.php";
            include "views/scriptaIndex.php";
            break;
            
    }

    
    include "views/futer.php";



?>