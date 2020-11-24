<?php
$login = $_POST["usuario"];
$senha = $_POST["senha"];

if($login == "adm" && $senha == "123"){
    session_start();
    $_SESSION["autenticado"] = true;
    $_SESSION["login"] = $login;
    header("Location:index.php?sucesso=2");
} else{
    header("Location:index.php?erro=1");
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

