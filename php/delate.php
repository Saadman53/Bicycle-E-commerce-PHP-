<?php 
    session_start();
    if(isset($_POST['tag']))
    {   $status=404;
        $id=$_POST['id'];

        include "konekcija.php";
        $upit="DELETE FROM korisnik WHERE idKorisnik=:id";
        $rez =$kon->prepare($upit);
        $rez->bindParam(":id",$id);
        try{
            $rez->execute();
            $status=204;

        }catch(PDOException $e)
        {
            $e->getMessage();
            $status=500;
        }
    }
http_response_code($status);
echo json_encode($rez);