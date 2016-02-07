<?php 
session_start();
if(isset($_SESSION['username'])==0) 
	$_SESSION['username']="GUEST";

	//Connessione MySQL
$connessione=mysqli_connect("localhost","root","davide","metroid");
  if(!$connessione)
  {
	print("<H1>connessione al server fallita</H1>");
	exit;
  }
?>