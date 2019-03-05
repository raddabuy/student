<?php

$user = 'root';
$password = '';
$db = 'entrance';
$host = 'localhost';

$dsn = 'mysql:host='.$host.';dbname='.$db.';charset=utf8';
$pdo = new PDO($dsn, $user, $password);

$sql = $pdo->query('TRUNCATE TABLE `list`');

$sql = $pdo->query('TRUNCATE TABLE `phys`');

$sql = $pdo->query('TRUNCATE TABLE `radio`');

$sql = $pdo->query('TRUNCATE TABLE `pmph`');

$sql = $pdo->query('TRUNCATE TABLE `nmt`');

$sql = $pdo->query('TRUNCATE TABLE `bas`');

$sql = $pdo->query('TRUNCATE TABLE `outside`');

/*$sql_gold = 'SELECT * FROM `list` ORDER BY `score` ASC';
$query_gold  = $pdo->prepare($sql_gold);
$query_gold ->execute();
$row = $query_gold->fetch(PDO::FETCH_ASSOC);

print_r ($row);*/

header('Location:show.php');
 ?>
