<?php

try{
    $bdd=new PDO("mysql:host=localhost;dbname=devme","root","root");
 }
 catch(PDOException $e){
    echo $e->getMessage();
 }
 
?>