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
            define("HOST", "localhost"); // E' il server a cui ti vuoi connettere.
            define("USER", "sec_user"); // E' l'utente con cui ti collegherai al DB.
            define("PASSWORD", "eKcGZr59zAa2BEWU"); // Password di accesso al DB.
            define("DATABASE", "secure_login"); // Nome del database.
            $mysqli = new mysqli(HOST, USER, PASSWORD, DATABASE);
        ?>
    </body>
</html>
