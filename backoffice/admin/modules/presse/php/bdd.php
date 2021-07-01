<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=project', 'root', "");
}catch(PDOException $e){
    die('Erreur connexion : '.$e->getMessage());
}