<?php
session_start();
if(isset($_POST['regrapalavra'])){
    $_SESSION['regras']=$_POST['regrapalavra'];
    foreach($_SESSION['regras'] as $r){
        echo $r."<br>";
    }    
header('Location: index.php');
} else {
    unset($_SESSION['regras']);
    header("Location: index.php");
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

