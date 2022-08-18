<?php
session_start();
    
    include('konekcija.php');

    $obj =[];
    $status=404;
    if(isset($_POST['anketa']))
    {
        $idAnketa = $_POST['idAnketa'];
        
        $idOdgovor = $_POST['idOdgovor'];

        $idKorisnik = $_SESSION['korisnik']->idKorisnik;

        //da li je korisnik glasao
        $upit = "select * from anketa_korisnik where id_anketa= :id_anketa and idKorisnik= :id_korisnik";
        $rez = $kon->prepare($upit);
        $rez->bindParam(':id_anketa', $idAnketa);
        $rez->bindParam(':id_korisnik', $idKorisnik);
        try
        {
            $rez->execute();
            if($rez->rowCount() == 0)
            {
                $insert = "INSERT INTO anketa_korisnik(id_anketa,idKorisnik,id_anketa_odgovor) VALUES(:id_anketa,:id_korisnik,:id_anketa_odgovor)";
                $rez2 = $kon->prepare($insert);
                $rez2->bindParam(':id_anketa', $idAnketa);
                $rez2->bindParam(':id_korisnik', $idKorisnik);
                $rez2->bindParam(':id_anketa_odgovor', $idOdgovor);

                try
                {
                    $rez2->execute();


                    $sve = $kon->prepare("select * from anketa_odgovor ao inner join odgovor o on ao.id_odgovor = o.id_odgovor inner join anketa a on ao.id_anketa = a.id_a where ao.id_anketa = :id_a");
                
                $sve->bindParam(':id_a', $idAnketa);
                $sve->execute();
                $sve1 = $sve->fetchAll();
                array_push($obj, "Uspesno ste glasali! <br/><br/>");
                foreach($sve1 as $jedan)
                {
                    $ukupanBrojRedova = $kon->prepare('select count(*) as br from anketa_korisnik where id_anketa = :id_a');
                    $ukupanBrojRedova->bindParam('id_a', $idAnketa);
                    $ukupanBrojRedova->execute();
                    $ukupanBrojRedova = (int)$ukupanBrojRedova->fetch()->br;
                    // broj redova izabrane opcije
                    $brojRedovaOpcije = $kon->prepare('select count(*) as br from anketa_korisnik where id_anketa= :id_a and id_anketa_odgovor = :idOdgovor');
                    $idOdg = $jedan->id_odgovor;
                    $brojRedovaOpcije->bindParam(':idOdgovor', $idOdg);
                    $brojRedovaOpcije->bindParam(':id_a', $idAnketa);
                    
                    $brojRedovaOpcije->execute();
                    $brojRedovaOpcije1 = (int)$brojRedovaOpcije->fetch()->br;
                    if($brojRedovaOpcije1>0)
                    {
                        
                        $procenat = 100 / $ukupanBrojRedova * $brojRedovaOpcije1;
                    }
                    else
                    {
                        $procenat = 0;
                    }
                
                    array_push($obj, 'Za opciju: ' . $jedan->odgovor . " je glasalo " . round($procenat,3) . "%");
                }
                
                
                    
                }
                catch(PDOException $e)
                {
                    json_encode(['msg'=>'Doslo je do greske! ' . $e->getMessage()]);
                    
                }
                
            }
            else
            {
                $sve = $kon->prepare('select * from anketa_odgovor ao inner join odgovor o on ao.id_odgovor = o.id_odgovor inner join anketa a on ao.id_anketa = a.id_a where ao.id_anketa = :id_a');
                
                $sve->bindParam(':id_a', $idAnketa);
                $sve->execute();
                $sve1 = $sve->fetchAll();
                array_push($obj, "Već ste glasali! <br/><br/>");
                foreach($sve1 as $jedan)
                {
                    $ukupanBrojRedova = $kon->prepare('select count(*) as br from anketa_korisnik where id_anketa = :id_a');
                    $ukupanBrojRedova->bindParam('id_a', $idAnketa);
                    $ukupanBrojRedova->execute();
                    $ukupanBrojRedova = (int)$ukupanBrojRedova->fetch()->br;
                    // broj redova izabrane opcije
                    $brojRedovaOpcije = $kon->prepare('select count(*) as br from anketa_korisnik where id_anketa = :id_a and id_anketa_odgovor = :idOdgovor');
                    $idOdg = $jedan->id_odgovor;
                    $brojRedovaOpcije->bindParam(':idOdgovor', $idOdg);
                    $brojRedovaOpcije->bindParam(':id_a', $idAnketa);
                    
                    $brojRedovaOpcije->execute();
                    $brojRedovaOpcije1 = (int)$brojRedovaOpcije->fetch()->br;
                    if($brojRedovaOpcije1>0)
                    {
                        
                        $procenat = 100 / $ukupanBrojRedova * $brojRedovaOpcije1;
                    }
                    else
                    {
                        $procenat = 0;
                    }
                
                    array_push($obj, 'Za opciju: ' . $jedan->odgovor . " je glasalo " . round($procenat,3) . "%");
                }
               
                
              
            }

        }
        catch(PDOException $e)
        {
            json_encode(['msg'=>'Doslo je do greske! ' . $e->getMessage()]);
        }
       
        header("Content-type: aplication/json");
        http_response_code(201);
        echo json_encode($obj);
    }
    
