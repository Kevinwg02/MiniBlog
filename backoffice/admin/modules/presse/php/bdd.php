<?php

try{
    $db = new PDO('mysql:host=localhost;dbname=upload_file', 'root', "");
}catch(PDOException $e){
    die('Erreur connexion : '.$e->getMessage());
}