<?php
//conexão banco
        
        try{
            $con = new PDO("mysql:host=localhost;dbname=novaortografia","usuario","");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { 
            echo 'ERROR: '.$e->getMessage();
        }
?>


