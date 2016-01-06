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
        <script type="text/javascript" src="sha512.js"></script>
        <script type="text/javascript" src="forms.js"></script>
        <?php
            if(isset($_GET['error'])) { 
            echo 'Errore di accesso: Controllare email e/o password';
            }
        ?>
        <form action="process_login.php" method="post" name="login_form">
            Email: <input type="text" name="email" /><br />
            Password: <input type="password" name="p" id="password"/><br />
            <input type="button" value="Login" onclick="formhash(this.form, this.form.password);" />
        </form>
    </body>
</html>
