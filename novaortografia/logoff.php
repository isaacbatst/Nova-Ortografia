<?php
    //iniciando sessao
    session_start();
    //resetando autenticaçao
    if (isset($_SESSION["autenticado"])){
        unset($_SESSION["autenticado"]);
        unset($_SESSION["login"]);
    }
    header("Location: index.php");

