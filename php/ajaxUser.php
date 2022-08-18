<?php 
    session_start();
    if(isset($_POST['tag']))
    {   $status=404;
        $data=null;
        $id=$_POST['id'];

        include "konekcija.php";
        $upit="SELECT * FROM korisnik WHERE idKorisnik=:id";
        $rez =$kon->prepare($upit);
        $rez->bindParam(":id",$id);
        try{
            $rez->execute();
            $korisnici = $rez->fetch();
            if($korisnici)
            {
                $data=$korisnici;
                $status=201;
            }else
            {
                $status=500;
            }

            

        }catch(PDOException $e)
        {
            $e->getMessage();
            $status=500;
        }
    }
header("Content-type: application/json");
http_response_code($status);
echo json_encode($data);