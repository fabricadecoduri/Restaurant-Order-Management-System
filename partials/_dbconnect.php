<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "db_name";
// Înlocuiește "db_name" cu numele bazei tale de date
// Înlocuiește "root" și "" cu utilizatorul și parola tale de MySQL dacă este necesar
// Conectare la baza de date

$conn = mysqli_connect($server, $username, $password, $database);
if (!$conn){
    die("Error". mysqli_connect_error());
}

?>
