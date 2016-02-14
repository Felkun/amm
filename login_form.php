<?php
    include("connect.php");
    //Controlli aggiuntivi
    if((strlen($_POST['password'])>5) && (strlen($_POST['username'])>=5)) {
    //Fine controlli, perform query
    $Sql="SELECT password FROM tbl_utenti where username='".$_POST['username']."' and password='".$_POST['password']."'";
    $result = mysql_query($Sql);
    $Results=mysql_num_rows($result);
        if($Results==0) {
            $_SESSION['accessonegato']=1; header("Location: login.php");
        } else {
            $_SESSION['username']=$_POST['username']; unset($_SESSION['controllologin']); unset($_SESSION['numerr']);
            if((isset($_SESSION['redirect'])==1) && ($_SESSION['redirect']==2)) { unset($_SESSION['redirect']); header("Location: index.php"); unset($_SESSION['controllologin']); unset($_SESSION['numerr']);
            }
        }
    } else {
        $_SESSION['accessonegato']=1;
        header("Location: login.php");
    }
    header("Location: index.php");
    mysql_close($connessione);
?>