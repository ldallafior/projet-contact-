<?php

ini_set('display_errors','on');
error_reporting(E_ALL);

try {

    $spdo=new PDO ('mysql:dbname=contact;host=localhost:8889', 'root','root');
}
catch (\PDOException $e)
{
    throw new PDOException($e->getMessage());
}
