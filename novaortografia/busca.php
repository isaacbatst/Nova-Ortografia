<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Resultado da busca</title>
        <link rel="stylesheet" type="text/css" href="style.css" />
    </head>
    <body>
        <h1>NOVA ORTOGRAFIA</h1>
        <h3>Resultados da Busca      <a href="index.php">[Página Inicial]</a> </h3>
        <?php
        // Verifica se foi feita alguma busca
        // Caso contrario, redireciona o visitante pra home
        if (!isset($_GET['consulta'])) {
          header("Location: index.php");
          exit;
        }

        include 'conexao.php';
        // Conecte-se ao MySQL antes desse ponto

        // Salva o que foi buscado em uma variável
        $busca = "%".$_GET['consulta']."%";
        // ============================================
        // Monta outra consulta MySQL para a busca 1=Palavra;2=Regra
        $comando = "SELECT * FROM palavra WHERE "
                . "novapalavra LIKE ? OR antigapalavra LIKE ?";
        $comando2 = "SELECT * FROM regra WHERE "
                . "idregra = ?";
        $res = $con->prepare($comando);
        $res->bindParam(1,$busca);
        $res->bindParam(2,$busca);

        // Executa a consulta das palavras
        $res->execute();
        
       
        // Começa a exibição dos resultados ou erro
        
        $registrospalavra = $res->fetchAll();
        if(count($registrospalavra)>0){
            echo "<table>"
            . "<tr>"
                . "<th>Palavra antes</th>"
                . "<th>Palavra atualmente</th>"
                . "<th>Regra da mudança</th>"
             . "</tr>";
            foreach ($registrospalavra as $r){
                //Consulta as regras
                $res = $con->prepare($comando2);
                $res->bindParam(1,$r['idregra']);
                $res->execute();
                $registroregra= $res->fetch();
                echo '<tr>';
                    echo "<td>".$r['antigapalavra']."</td><td>".$r['novapalavra']."</td><td>".$registroregra['nomeregra']."</td><br/>";
                echo '</tr>';
            }
            echo '</table>';
            echo '</p>';
        } else {
            echo '<p class="erro">Nenhum resultado encontrado.</p>';
        }
                
        ?>
        <a href="index.php">[voltar]</a>
    </body>
</html>


