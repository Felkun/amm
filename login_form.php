<?php
    include("connect.php");
    $username=$_POST['username'];
    $password=$_POST['password'];
    
    //Controllo lunghezza username e password
    if((strlen($password)>5) && (strlen($username)>=5)) {
        //Query
        $Sql="SELECT password, newser FROM tbl_utenti where username='".$username."' and password='".$password."'";
        $result = mysql_query($Sql);
        $Results=mysql_num_rows($result);
        
        // Controllo esistenza utente
        if($Results==0) {
            $_SESSION['accessonegato']=1;
            header("Location: login.php");
        } else {
            $_SESSION['username']=$username;
            unset($_SESSION['controllologin']);
            unset($_SESSION['numerr']);
            if((isset($_SESSION['redirect'])==1) && ($_SESSION['redirect']==2)) {
                unset($_SESSION['redirect']);
                header("Location: index.php");
                unset($_SESSION['controllologin']);
                unset($_SESSION['numerr']);
            }
        }
    } else {
        $_SESSION['accessonegato']=1;
        header("Location: login.php");
    }
    
    // Controllo log-in effettuato
    if ($_SESSION['accessonegato']==0) {
        header("Location: index.php");
        $_SESSION['newser']=mysql_result($result,0,"newser");
    }
    mysql_close($connessione);
?>