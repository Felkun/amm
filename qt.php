<?php
session_start();

	//Connessione MySQL
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
if((isset($_SESSION['contatore'])==1) && (isset($_SESSION['carrello'])==1)) {
	$sql="SELECT COUNT(cod_art) FROM articolo";
	$numart=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($numart);
	$numarticoli=$row['COUNT(cod_art)'];
  if((isset($_GET['operation'])==1) && ($_GET['operation']=="sum") &&(isset($_GET['cod_art'])==1) && (is_numeric($_GET['cod_art'])==1)) //Operazione di incremento
{ 
	$sql="SELECT cod_art FROM articolo";
	$query=mysql_query($sql) or die(mysql_error());
	for($i=0; $i<$numarticoli; $i++) { 
		$row=mysql_fetch_array($query);
		if($row['cod_art']==$_GET['cod_art']) $k=1; //Flag per indicare che cod_art è valido (Non inserito il where in query per evitare sql injection)
			}

//INCREMENTO
if(isset($k)==1) { 
unset($k);
for($i=0; $i<$_SESSION['contatore']; $i++) { 
	if($_SESSION['carrello'][$i]['cod_art']==$_GET['cod_art']) { 
	$query2="SELECT qt FROM articolo where cod_art='".$_GET['cod_art']."'";
	$qtart=mysql_query($query2) or die(mysql_error());
	$lol=mysql_fetch_array($qtart);
	$qtartvero=$lol['qt'];
	if($_SESSION['carrello'][$i]['qt']<$qtartvero)
	$_SESSION['carrello'][$i]['qt']++; 
	header("Location: carrello.php");
	}
}
}
}
if((isset($_GET['operation'])==1) && ($_GET['operation']=="minus") &&(isset($_GET['cod_art'])==1) && (is_numeric($_GET['cod_art'])==1)) //Operazione di incremento
{ 
	$sql="SELECT cod_art FROM articolo";
	$query=mysql_query($sql) or die(mysql_error());
	for($i=0; $i<$numarticoli; $i++) { 
		$row=mysql_fetch_array($query);
		if($row['cod_art']==$_GET['cod_art']) $k=1; //Flag per indicare che cod_art è valido (Non inserito il where in query per evitare sql injection)
			}

//DECREMENTO
if(isset($k)==1) {
unset($k); 
for($i=0; $i<$_SESSION['contatore']; $i++) { 
	if($_SESSION['carrello'][$i]['cod_art']==$_GET['cod_art']) { 
	if($_SESSION['carrello'][$i]['qt']>1)
	$_SESSION['carrello'][$i]['qt']--;  header("Location: carrello.php"); }
}
}
}

if((isset($_GET['remove'])==1) && (is_numeric($_GET['remove'])==1) && (isset($_GET['cod_art'])==0) && (isset($_GET['operation'])==0)) {
$sql="SELECT cod_art FROM articolo";
	$query=mysql_query($sql) or die(mysql_error());
	for($i=0; $i<$numarticoli; $i++) { 
		$row=mysql_fetch_array($query);
		if($row['cod_art']==$_GET['remove']) $k=1; //Flag per indicare che cod_art è valido (Non inserito il where in query per evitare sql injection)
			}
//header("Location: carrello.php");
if(isset($k)==1) {
unset($k); 
$stillnull=0;
for($i=0; $i<$_SESSION['contatore']; $i++) { 
	if($_SESSION['carrello'][$i]['cod_art']==$_GET['remove']) { $_SESSION['carrello'][$i]['qt']=NULL; }
	if($_SESSION['carrello'][$i]['qt']==NULL) $stillnull++;
	//header("Location: carrello.php"); 
}
if($stillnull==$_SESSION['contatore']) { unset($_SESSION['carrello']); unset($_SESSION['contatore']); }
header("Location: carrello.php");
}
}
}
?>