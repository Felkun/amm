<?php
// prelevo username e password dal POST,
// eliminando eventuali spazi alle estremità delle stringhe
$username = trim($_POST['username']);
$password = trim($_POST['password']);

// elimino eventuali backslash inseriti automaticamente da PHP
if(get_magic_quotes_gpc())
{
	$username = stripslashes($username);
	$password = stripslashes($password);
}

// Converto in ISO-8859-1 i caratteri provenienti
// dal client, codificati di default in UTF8
$username = utf8_decode($username);
$password = utf8_decode($password);

// provo ad effettuare il login con i dati recuperati dal form
$esito = login($_POST['username'],$_POST['password']);

// converto in UTF8 la risposta restituita dalla funzione login()
$esito = utf8_encode($esito);

// invio la risposta al client
echo $esito;

// funzione per la verifica dei dati di login
function login($username, $password)
{
    $username_corretto = "ivan";
    $password_corretta = "segreto";

    if(!$username || !$password) {
        return 3;
    }

    if($username != $username_corretto) {
        return 1;
    }

    if($username == $username_corretto && $password != $password_corretta) {
        return 2;
    }

    if($username == $username_corretto && $password == $password_corretta) {
        return 4;
    }
}
?>