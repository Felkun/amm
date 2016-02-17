<?php
    include("connect.php");
    
    // Controllo stringhe
    if(
        (strlen($_POST['username'])==0) ||
        (strlen($_POST['password'])==0) ||
        (strlen($_POST['passwordcheck'])==0) ||
        (strlen($_POST['email'])==0) ||
        (strlen($_POST['emailcheck'])==0)
    ) {
        $stringaerrore1="Controlla il form dei dati, è presente qualche errore (manca almeno un elemento)"; 
    }
    
    //Controllo username
    if(strlen($_POST['username'])<6) {
        $stringaerrore2="Username non valido (da 6 a 20 caratteri)";
    }
        $queryusername="select * from cliente where username='".$_POST['username']."'";
        $result = mysql_query($queryusername);
        $Results=mysql_num_rows($result);
    if($Results>0) {
        $stringaerrore2="Username non valido (gia' utilizzato da altri utenti)";
    }
    
    //Controllo password
    if(strlen($_POST['password'])<6) {
        $stringaerrore3="Password non valida (da 6 a 20 caratteri)";
    }
    if($_POST['password']!=$_POST['passwordcheck']) {
        $stringaerrore4="Password non valida (il campo di conferma password è diverso dal campo password)";
    }

    //Controllo email
    $num_at = count(explode('@', $_POST['email'])) - 1;
	if($num_at != 1) {
            $stringaerrore5="E-mail non valida (Non e' presente alcuna @ nella stringa)";
	}

    if($_POST['email']!=$_POST['emailcheck']) {
        $stringaerrore6="E-mail non valida (il campo di conferma e-mail è diverso dal campo e-mail)";
    }
    
    //Controllo avanzato
    $queryemail="select * from cliente where email='".$_POST['email']."'";
    $result = mysql_query($queryemail);
    $Results=mysql_num_rows($result);
    if($Results>0) {
      $stringaerrore7="E-mail non valida (gia' utilizzata da altri utenti)";
    }

    //Fine controlli
    //Inizio check multiplo.
    if(!(
        (isset($stringaerrore1)==0) &&
        (isset($stringaerrore2)==0) &&
        (isset($stringaerrore3)==0) &&
        (isset($stringaerrore4)==0) &&
        (isset($stringaerrore5)==0) &&
        (isset($stringaerrore6)==0) &&
        (isset($stringaerrore7)==0)
    )) {
        if(isset($stringaerrore1)==1) {
            $_SESSION['e1']=$stringaerrore1;
        }
    if(isset($stringaerrore2)==1) {
        $_SESSION['e2']=$stringaerrore2;
    }
    if(isset($stringaerrore3)==1) {
        $_SESSION['e3']=$stringaerrore3;
    }
    if(isset($stringaerrore4)==1) {
        $_SESSION['e4']=$stringaerrore4;
    }
    if(isset($stringaerrore5)==1) {
        $_SESSION['e5']=$stringaerrore5;
    }
    if(isset($stringaerrore6)==1) {
        $_SESSION['e6']=$stringaerrore6;
    }
    if(isset($stringaerrore7)==1) {
        $_SESSION['e7']=$stringaerrore7;
    }
    } else {
        // Scrittura su database del nuovo utente
        $sql="INSERT INTO tbl_utenti (username, password, email, newser) VALUES"
                . "('$_POST[username]','$_POST[password]','$_POST[email]', FALSE)";
        $_SESSION['regriuscita']=1; // Controllo effettiva registrazione
        mysql_query($sql);
    }
    header("Location: registrazione.php");
    mysql_close($connessione);
?>
