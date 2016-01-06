
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
            include 'db_connect.php';
            include 'functions.php';
            sec_session_start(); // usiamo la nostra funzione per avviare una sessione php sicura
            if(isset($_POST['email'], $_POST['p'])) { 
                $email = $_POST['email'];
                $password = $_POST['p']; // Recupero la password criptata.
                if(login($email, $password, $mysqli) == true) {
                    // Login eseguito
                    echo 'Successo: Hai completato la fase di log-in!';
                } else {
                    // Login fallito
                    header('Location: ./login.php?error=1');
                }
            } else { 
                // Le variabili corrette non sono state inviate a questa pagina dal metodo POST.
                echo 'Invalid Request';
            }
        ?>
    </body>
</html>

