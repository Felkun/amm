<?php
// blocco dei parametri di connessione
// host, username, password e db
$host = "localhost";
$user = "root";
$password = "davide";
$db = "metroid";

# stringa di connessione al DBMS
$connessione = new mysqli($host, $user, $password, $db);

// verifica su eventuali errori di connessione
if ($connessione->connect_errno) {
    echo "Connessione fallita: ". $connessione->connect_error . ".";
    exit();
}
?>