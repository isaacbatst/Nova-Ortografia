
 <?php
        // put your code here
        //conexão banco
        
        try{
            $con = new PDO("mysql:host=localhost;dbname=novaortografia","usuario","");
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) { 
            echo 'ERROR: '.$e->getMessage();
        }
        
        $comando = "Insert into palavra(antigapalavra,novapalavra,regrapalavra)"
                . " VALUES('Pingüim','Pinguim','Trema')";
        $s = $con->prepare($comando);
        $s->execute();
?>


