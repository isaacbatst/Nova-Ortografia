<!DOCTYPE html>
<?php
//sessao iniciada
session_start();
//verificação de autenticação
if(!isset($_SESSION["autenticado"])){
    header("Location: index.php?erro=2");
}
//conexao com banco de dados
include 'conexao.php';
?>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Modo de Edição</title>
        <style> .sucesso{color: green;}</style>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <h1>NOVA ORTOGRAFIA</h1>
        <h3>Modo de Edição[ADM]     <a href="index.php">[Página Inicial]</a> </h3>
        
        <?php
        if(isset($_GET["sucesso"])){
            if($_GET["sucesso"]==1){
                echo '<p class="sucesso">Dados atualizados com sucesso.';
            }
        }
        ?>    
        <table border=1 >
          <tr>
            <th>Cadastro de Palavras</th>
            <th>Cadastro de Regras</th> 
          </tr>
          <tr>
            <td valign="top">
                <form action="cadastro.php" method="post">
                    <label> Palavra antes </label><br/>
                    <input type="text" name="antigapalavra"/><br/>
                    <label> Palavra atualizada </label><br/>
                    <input type="text" name="novapalavra"/><br/>
                    <label> Regra </label></br>
                    <select name="selectregra">
                        <?php
                            $comando = "Select * from regra";
                            $res = $con->query($comando, PDO::FETCH_ASSOC);
                            $registros = $res->fetchAll();
                            foreach ($registros as $r){
                               echo '<option name="idregra" value="';
                               echo $r['idregra'].'">'.$r['nomeregra']."</option>";
                            }
                        ?>
                    </select></br>
                    <input type="submit" value="Cadastrar" name="cadastropalavra" />
                </form>
            </td>
            <td valign="top">
                <form action="cadastro.php" method="post">
                    <label> Regra </label><br/>
                    <input type="text" name="regra"/><br/><br/><br/><br/><br/>
                    <input type="submit" value="Cadastrar" name="cadastroregra" />
                </form>            
            </td> 
          </tr>
          
        </table>
        
    
        <h3>Editar palavras</h3>
        <form action="cadastro.php" method="post">
            <p><label>Palavra: </label>
            <select name="select">
                <?php
                   $comando = "Select * from palavra";
                   $res = $con->query($comando, PDO::FETCH_ASSOC);
                   $registros = $res->fetchAll();
                   foreach ($registros as $r){
                      echo '<option name="idpalavra" value=';
                      echo $r['idpalavra'].'>'.$r['novapalavra']."</option>";
                   }
                   echo '</select><br/>';
                   
                ?>
            </p>
            <label> Palavra antes: </label>    
            <input type="text" name="antigapalavra" />
            <input type="submit" value="Editar" name="edicaoantiga"/><br/>
            <label> Palavra atualizada: </label>
            <input type="text" name="novapalavra"/>
            <input type="submit" value="Editar" name="edicaonova"/><br/>
            <label> Regra: </label>
            <select name="selectregra">
                <?php
                    $comando = "Select * from regra";
                    $res = $con->query($comando, PDO::FETCH_ASSOC);
                    $registros = $res->fetchAll();
                    foreach ($registros as $r){
                        echo '<option name="idregra" value="';
                        echo $r['idregra'].'">'.$r['nomeregra']."</option>";
                    }
                ?>
                    </select>
            <input type="submit" value="Editar" name="edicaoregra"/>
        </form> 
        
        <h3>Remover</h3>
        <form action="cadastro.php" method="post">
           <select name="selectremover">
                <?php
                   $comando = "Select * from palavra";
                   $res = $con->query($comando, PDO::FETCH_ASSOC);
                   $registros = $res->fetchAll();
                   foreach ($registros as $r){
                      echo '<option name="idpalavra" value="';
                      echo $r['idpalavra'].'">'.$r['novapalavra']."</option>";
                   }
                ?>
            </select><br/>
            <input type="submit" value="Remover" name="remover"/>
        </form>
        
        <br/>
        <a href="index.php">[voltar]</a>
        <a href="logoff.php">[logout]</a>
    </body>
</html>


