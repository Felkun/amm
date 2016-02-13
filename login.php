<?php 
session_start();
if(isset($_SESSION['username'])==0) 
	$_SESSION['username']="GUEST";

	//Connessione al database
  $connessione=mysql_connect("localhost","root","davide");
  if(!$connessione)
  {
	print("<H1>connessione al server fallita</H1>");
	exit;
  }
  $DB = mysql_select_DB("metroid");
  if(!$DB)
  {
	print("<H1>Connessione al database fallita</H1>");
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