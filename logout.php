<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
            include 'functions.php';
            sec_session_start();
            // Elimina tutti i valori della sessione.
            $_SESSION = array();
            // Recupera i parametri di sessione.
            $params = session_get_cookie_params();
            // Cancella i cookie attuali.
            setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
            // Cancella la sessione.
            session_destroy();
            header('Location: ./');
            // Recupero la password criptata dal form di inserimento.
            $password = $_POST['p']; 
            // Crea una chiave casuale
            $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
            // Crea una password usando la chiave appena creata.
            $password = hash('sha512', $password.$random_salt);
            // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
            // Assicurati di usare statement SQL 'prepared'.
            if ($insert_stmt = $mysqli->prepare("INSERT INTO members (username, email, password, salt) VALUES (?, ?, ?, ?)")) {    
                $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt); 
                // Esegui la query ottenuta.
                $insert_stmt->execute();
            }
        ?>
    </body>
</html>
