<?php
session_start(); 
$connessione=mysql_connect("localhost","root","");
  if(!$connessione)
  {
	print("<H1>connessione al server MySQL fallita</H1>");
	exit;
  }
  $DB = mysql_select_DB("Bubishop");
  if(!$DB)
  {
	print("<H1>connessione al database negozio fallita</H1>");
	exit;  
  }
  //Controlli aggiuntivi
  if((strlen($_POST['password'])>6) && (strlen($_POST['username'])>=5)) {
  //Fine controlli, perform query
  $Sql="SELECT password FROM cliente where username='".$_POST['username']."' and password='".$_POST['password']."'";
  $result = mysql_query($Sql);
  $Results=mysql_num_rows($result);
  if($Results==0) {
	 $_SESSION['accessonegato']=1; header("Location: index.php"); }
  else {
  $_SESSION['username']=$_POST['username']; unset($_SESSION['controllologin']); unset($_SESSION['numerr']);
 if((isset($_SESSION['redirect'])==1) && ($_SESSION['redirect']==2)) { unset($_SESSION['redirect']); header("Location: carrello.php"); unset($_SESSION['controllologin']); unset($_SESSION['numerr']); }
 else	header("Location: index.php");
  }
}
else {
 $_SESSION['accessonegato']=1; header("Location: index.php"); 
}
  mysql_close($connessione);
?>