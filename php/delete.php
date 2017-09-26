<?php
include ('connection.php');

$sql = "DELETE FROM utilisateurs WHERE id = :id";
$stmt = $spdo->prepare($sql);
$stmt->bindParam(':id', $_GET['id'], PDO::PARAM_INT);

$stmt->execute();

header('location: http://localhost:8888/phpcontact/index.php');







