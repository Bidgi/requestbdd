<?php
$server = "psqlserver-girardin.postgres.database.azure.com";
$username = $_ENV['user'];
$password = $_ENV['password'];
$db = "postgresql-database-girardin";
$conn = pg_connect("host=$server dbname=$db user=$username password=$password");
$method = $_SERVER["REQUEST_METHOD"];

if ($method === 'GET') {
  $result = pg_query($conn, "SELECT * FROM personnes");
  $response = [];
  while ($row = pg_fetch_row($result)) {
    $response[] = ["Id" => $row[0], "Nom" => $row[1], "Prenom" => $row[2]];
  }
  header("Access-Control-Allow-Origin: *");
  header("Access-Control-Allow-Headers: *");
  header("Content-Type: application/json");
  echo json_encode($response, JSON_PRETTY_PRINT);
} else {
  header("HTTP/1.0 405 Method Not Allowed");
}
?>
