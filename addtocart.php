<?php 
$connessione=mysql_connect("localhost","root","");
  if(!$connessione)
  {
	print("<H1>connessione al server MySQL fallita</H1>");
	exit;
  }
  $DB = mysql_select_DB("Bubishop");
  if(!$DB)
  {
	print("<H1>connessione al database cliente fallita</H1>");
	exit;  
  }

//Aggiunta a carrello tramite metodo $_GET['cod_art']
session_start();
//Controlla l'indice del prodotto da aggiungere al carrello
if(isset($_GET['cod_art'])==1) {
if(is_numeric($_GET['cod_art'])==1) {
if(isset($_SESSION['contatore'])==0) { $_SESSION['contatore']=0;
 $_SESSION['carrello'] = array(array('cod_art' => $_GET['cod_art'], 'qt' => '1'));
 $_SESSION['contatore']++;
 if($_SESSION['username']=="GUEST") $_SESSION['controllologin']=1; else unset($_SESSION['controllologin']); 
 $_SESSION['aggiunta_riuscita']=1; unset($_SESSION['numerr']);
 }
else {
//Fine controllo
for($i=0; $i<$_SESSION['contatore'];$i++) { 
if($_SESSION['carrello'][$i]['cod_art']==$_GET['cod_art']) { $k=1; $counter=$i;}
}
if($k==1) { 
	$query2="SELECT qt FROM articolo where cod_art='".$_GET['cod_art']."'";
	$qtart=mysql_query($query2) or die(mysql_error());
	$lol=mysql_fetch_array($qtart);
	$qtartvero=$lol['qt'];
	if($_SESSION['carrello'][$counter]['qt']<$qtartvero) { $_SESSION['carrello'][$counter]['qt']++; $_SESSION['aggiunta_riuscita']=1; unset($_SESSION['numerr']);  if($_SESSION['username']=="GUEST") $_SESSION['controllologin']=1; else unset($_SESSION['controllologin']);  }
	else $_SESSION['error_adding']=1;
 }
else {
for($i=0; $i<$_SESSION['contatore']; $i++)
if($_SESSION['carrello'][$i]['qt']==NULL) $posiznull=$i;
if(isset($posiznull)==0){
$_SESSION['carrello'][$_SESSION['contatore']]['cod_art']=$_GET['cod_art'];
$_SESSION['carrello'][$_SESSION['contatore']]['qt']=1; 
$_SESSION['contatore']++;
$_SESSION['aggiunta_riuscita']=1;
 if($_SESSION['username']=="GUEST") $_SESSION['controllologin']=1; else unset($_SESSION['controllologin']); 
unset($_SESSION['numerr']);
}
else {
$_SESSION['carrello'][$posiznull]['cod_art']=$_GET['cod_art'];
$_SESSION['carrello'][$posiznull]['qt']=1; 
$_SESSION['aggiunta_riuscita']=1;
 if($_SESSION['username']=="GUEST") $_SESSION['controllologin']=1; else unset($_SESSION['controllologin']); 
unset($_SESSION['numerr']);
}
 }
}

$a = "Location: prodotto.php?cod_art=".$_GET['cod_art']."";
header($a);
}
}
?>