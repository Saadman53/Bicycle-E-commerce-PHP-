<?php 
    session_start();
    if(isset($_POST['logovanje']))
    { 
        $email =$_POST['emailAdresa'];
        $lozinka = $_POST['sifra'];
        $greske=[];

        $regLozinka="/^[A-Z][\w\d]{5,}$/";

        if(!filter_var($email,FILTER_VALIDATE_EMAIL))
        {
            array_push($greske,"Niste dobro uneli email!");
        }

        if(!preg_match($regLozinka,$lozinka))
        {
            array_push($greske,"Niste dobro uneli lozinku");

        }

        if(count($greske))
        {   $_SESSION['greske']=$greske;
            header("Location: ../index.php?page=prijava");
        }else
        {
            $lozinka=md5($lozinka);
            include "konekcija.php";
            $upit="SELECT k.idKorisnik,k.imePrezime,k.email,u.naziv FROM korisnik k INNER JOIN uloge u ON k.ulogaID=u.id WHERE aktivan=1 AND email=:email AND sifra=:lozinka";

            $rez=$kon->prepare($upit);
            $rez->bindParam(":email",$email);
            $rez->bindParam(":lozinka",$lozinka);

            try{
                $rez->execute();
                $korisnik=$rez->fetch();
                if($korisnik)
                {   header("Location: ../index.php?page=prijava");
                    $_SESSION['korisnik']=$korisnik;
                    
                }else
                {   header("Location: ../index.php?page=prijava");
                    $_SESSION['greske']="Pogresno ste uneli email ili lozinku";
                    
                }
            }catch(PDOExeption $e)
            {
                $e->getMessage();
            }

        }
    }
    header("Location: ../index.php?page=prijava");