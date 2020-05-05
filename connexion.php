<?php
$host="sqletud.u-pem.fr";
$user="vdomin01";
$pwd="xc7yo2ieJs";
$db="vdomin01_db";
try{
$con='mysql:host='.$host.';dbname='.$db;
$dbh = new PDO($con,$user,$pwd,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION));
}
catch(Exception $e){
die('Connexion impossible à la base de données !'.$e->getMessage());
}
?>