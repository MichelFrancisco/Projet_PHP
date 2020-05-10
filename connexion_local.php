<?php
$host="localhost";
$user="root";
$pwd="";
$db="osteopathe";
try{
$con='mysql:host='.$host.';dbname='.$db;
$dbh = new PDO($con,$user,$pwd,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
}
catch(Exception $e){
die('Connexion impossible à la base de données !'.$e->getMessage());
}
?>
