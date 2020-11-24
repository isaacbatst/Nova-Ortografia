<?php
//sessao iniciada
session_start();
//verificação de autenticação
if(!isset($_SESSION["autenticado"])){
    header("Location: index.php?erro=2");
}
//conexao
include 'conexao.php';

//APLICAR AS ATUALIZAÇÕES NO BANCO E REDIRECIONAR
if(isset($_POST["cadastroregra"])){
    $comando = "INSERT into regra(nomeregra) "
            . "VALUES(?)";
    $s = $con->prepare($comando);
    $s -> bindparam(1, $regra);
    $regra= $_POST["regra"];
    $s->execute();
    header("Location: arearestrita.php?sucesso=1");
}
if(isset($_POST["cadastropalavra"])){
    echo "AEEEEE";
    $comando = "INSERT into palavra(antigapalavra,novapalavra,idregra)
                VALUES(?,?,?)";
    $s = $con->prepare($comando);
    $s->bindParam(1, $antigapalavra);
    $s->bindParam(2, $novapalavra);
    $s->bindParam(3, $idregra);
    $antigapalavra = $_POST["antigapalavra"];
    $novapalavra = $_POST["novapalavra"];
    $idregra = $_POST["selectregra"];
    $s->execute();
    header("Location: arearestrita.php?sucesso=1");
    
} 
if (isset ($_POST["remover"])) {
    echo "lululu";
    $comando = "DELETE from palavra "
            . "WHERE idpalavra = ? ";
    $s = $con->prepare($comando);
    $s->bindParam(1,$_POST["selectremover"]);
    $s->execute();
    header("Location: arearestrita.php?sucesso=1");
} else{
if (isset($_POST["edicaoantiga"])){
    $comando = "UPDATE palavra "
            . "SET antigapalavra = ? "
            . "WHERE idpalavra = ? ";
    $s = $con->prepare($comando);
    $s->bindParam(1,$_POST["antigapalavra"]);
    $s->bindParam(2,$_POST["select"]);
    $s->execute();
}
if (isset($_POST["edicaonova"])){
    $comando = "UPDATE palavra "
            . "SET novapalavra = ? "
            . "WHERE idpalavra = ?";
    $s = $con->prepare($comando);
    $s->bindParam(1,$_POST["novapalavra"]);
    $s->bindParam(2,$_POST["select"]);
    $s->execute();
}
if (isset($_POST["edicaoregra"])){
    $comando = "UPDATE palavra "
            . "SET idregra = ? "
            . "WHERE idpalavra = ?";
    $s = $con->prepare($comando);
    $s->bindParam(1,$_POST["idregra"]);
    $s->bindParam(2,$_POST["selectregra"]);
    $s->execute();
}
header("Location: arearestrita.php?sucesso=1");
}
?>


