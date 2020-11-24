<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
    session_start();
    //conexão banco   
    include 'conexao.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Nova Ortografia</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <h1>NOVA ORTOGRAFIA</h1>
        <h3>Página Inicial <a href="arearestrita.php">[Modo de Edição[ADM]]</a></h3>
            <?php
                //welcome
                if(isset($_SESSION["login"])){
                    echo '<p>Bem vindo, '.$_SESSION["login"].'</p>';
                }
                //logout
                if(isset($_SESSION["autenticado"])){
                    if($_SESSION["autenticado"]==true){
                        echo '<p><a href="logoff.php">[logout]</a></p>';
                    }
                }
                 //LOGIN
            
                if(isset($_SESSION["autenticado"])){
                    if($_SESSION["autenticado"]==true){

                    }else{
                        echo '<div class="logintable"> <form action="verificalogin.php" method="post">
                        <label> Usuário: </label><br/>
                        <input type="text" name="usuario"/><br/>
                        <label> Senha: </label><br/>
                        <input type="password" name="senha"/><br/>
                        <input type="checkbox" name="lembrar" value="S"/> Lembrar senha<br/>
                        <input type="submit" value="Fazer Login"/>
                        </form>'  ;
                        echo '</div><br/>';
                    }
                } else {
                     echo '<div class="logintable">
                        <form action="verificalogin.php" method="post">
                        <label> Usuário: </label><br/>
                        <input type="text" name="usuario"/><br/>
                        <label> Senha: </label><br/>
                        <input type="password" name="senha"/><br/>
                        <input type="checkbox" name="lembrar" value="S"/> Lembrar senha<br/>
                        <input type="submit" value="Fazer Login"/>
                        </form>'  ;
                     echo '</div><br/>';
                }
                //erro de login
                if(isset($_GET["erro"])){
                    echo '<p class="erro">';
                    if($_GET["erro"]==1){
                        echo 'Login e senha inválidos';
                    }
                    if($_GET["erro"]==2){
                        echo "Efetue login para ter acesso a esta página.";
                    }
                    echo '</p>';
                }
                
                //sucesso ação
                if(isset($_GET["sucesso"])){
                    echo '<p class="sucesso">';
                    if($_GET["sucesso"]==1){
                        echo 'Palavra cadastrada com sucesso.';
                    }
                    if($_GET["sucesso"]==2){
                        echo 'Login realizado com sucesso.<br/>';
                    }
                    echo '</p>';
                }
            ?>
        
        
       
        
        <form method="GET" action="busca.php">
            <label for="consulta">Buscar palavra:</label>
            <input type="text" id="consulta" name="consulta" maxlength="255" />
            <input type="submit" value="OK" />
            </form>
            
            <?php
                
            ?>
        
        <!-- Listagem completa-->
        <p>Filtro de regras
        <form action="filtro.php" method="POST">
            <?php
                $comando="Select * from regra";
                $res = $con->query($comando, PDO::FETCH_ASSOC);
                $registros = $res->fetchAll();
                foreach ($registros as $r){
                    echo '<input type="checkbox" id="regrapalavra" name="regrapalavra[]" ';
                    echo 'value= "'.$r['idregra'].'" ';
                    if(isset($_SESSION['regras'])){
                        foreach($_SESSION['regras'] as $s){
                           if($s==$r['idregra']){
                           echo 'checked';
                           } 
                        }
                    }
                    echo '/>';
                    echo $r['nomeregra'];
                    echo '<br/>';
                }
            ?>
            <br/>
            <input type="submit" value="Filtrar"/>
        </form>
                     
        
        <br/>
        <?php
        //MOSTRAR FILTRO
        if(isset($_SESSION['regras'])){
            echo 'Lista de Palavras';
            $comando="Select * from regra where idregra = ? ";
            $comando2="Select * from palavra where idregra = ? ";
            
            //set tabela
            echo "<table>"
                   . "<tr>"
                       . "<th>Palavra antes</th>"
                       . "<th>Palavra atualmente</th>"
                       . "<th>Regra da mudança</th>"
                   . "</tr>";
            
            foreach ($_SESSION['regras'] as $r){
                $res = $con->prepare($comando);
                $res->bindParam(1,$r);
                $res->execute();
                $registroregra = $res->fetch();
                
                
                $res = $con->prepare($comando2);
                $res->bindParam(1,$r);
                $res->execute();
                $registrospalavra = $res->fetchAll();
                foreach($registrospalavra as $s){
                    echo '<tr>';
                    echo '<td>'.$s['antigapalavra']."</td>"
                        .'<td>'.$s['novapalavra']."</td>".
                        "<td>".$registroregra['nomeregra']."</td><br/>";
                    echo '</tr>';
                }
            }
            echo '</table>';
        }
        
        
            
       
        ?>
    </body>
</html>
