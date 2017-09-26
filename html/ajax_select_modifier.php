<?php

include (dirname(__FILE__)."/../php/connection.php");

$id = $_GET['id'];

$sql = "SELECT * FROM utilisateurs WHERE id= :id";

$req = $spdo->prepare($sql);

$req->bindParam(":id",$id);

$req->execute();

$res = $req->fetch(PDO::FETCH_ASSOC);

echo json_encode($res);





