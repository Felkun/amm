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
	print("<H1>connessione al database cliente fallita</H1>");
	exit;  
  }
//Stringhe vuote oppure no? Se almeno una stringa è vuota inizializza $stringaerrore1 con l'errore
if(
(strlen($_POST['nome'])==0) || 
(strlen($_POST['cognome'])==0) ||
(strlen($_POST['giorno'])==0) ||
(strlen($_POST['mese'])==0) ||
(strlen($_POST['anno'])==0) ||
(strlen($_POST['codicefiscale'])==0) ||
(strlen($_POST['indirizzo'])==0) ||
(strlen($_POST['citta'])==0) ||
(strlen($_POST['cap'])==0) ||
(strlen($_POST['provincia'])==0) ||
(strlen($_POST['username'])==0) ||
(strlen($_POST['password'])==0) ||
(strlen($_POST['passwordcheck'])==0) ||
(strlen($_POST['email'])==0) ||
(strlen($_POST['emailcheck'])==0) ||
(strlen($_POST['telefono1'])==0)
) $stringaerrore1="Controlla il form dei dati! C'è qualche errore! (Manca almeno un elemento...)"; 
//Controllo possibili errori in data nascita prima della scrittura nel DB
if ((is_numeric($_POST['giorno'])==0) || ($_POST['giorno']<0) || ($_POST['giorno']>31)) $stringaerrore2="C'è qualche errore nella tua data di nascita! (Giorno errato)";
if ((is_numeric($_POST['mese'])==0) || ($_POST['mese']<0) || ($_POST['mese']>12)) $stringaerrore3="C'è qualche errore nella tua data di nascita! (Mese errato)";
if ((is_numeric($_POST['anno'])==0) || ($_POST['anno']<1930) || ($_POST['anno']>1994)) $stringaerrore4="C'è qualche errore nella tua data di nascita! (Anno errato)";
$data = $_POST['anno']. "-" .$_POST['mese']. "-" .$_POST['giorno'];
//Controllo possibili errori nel campo COD. FISCALE!
if(strlen($_POST['codicefiscale'])!=16) $stringaerrore5="C'è qualche errore nel tuo codice fiscale!";
//Controllo possibili errori nel campo CAP!
if((is_numeric($_POST['cap'])==0) && (strlen($_POST['cap'])!=5)) $stringaerrore6="C'è qualche errore nel tuo CAP!";
//Controllo errori nel campo provincia!
if((is_numeric($_POST['provincia'])==1) && (strlen($_POST['provincia'])!=2)) $stringaerrore7="C'è qualche errore nella tua provincia!";
//Controllo username
if(strlen($_POST['username'])<6) $stringaerrore8="Username non valido! (Da 6 a 20 caratteri!!)";
$queryusername="select * from cliente where username='".$_POST['username']."'";
  $result = mysql_query($queryusername);
  $Results=mysql_num_rows($result);
  if($Results>0)
$stringaerrore8="Username non valido! (già utilizzato da altri utenti!)";
//Controllo password
if(strlen($_POST['password'])<6) $stringaerrore9="Password non valida! (Da 6 a 20 caratteri!!)";
if($_POST['password']!=$_POST['passwordcheck']) $stringaerrore10="Password non valida! (Il campo di conferma password è diverso dal campo password)";
//Controllo email
$contatore = 0; //Contatore per il ciclo
$flagmail = 0; //Flag per indicare se la @ è stata trovata nella stringa, inizializzata a 0 poichè non trovata!
for ($contatore=0; $contatore <(strlen($_POST['email'])); $contatore++) { 
	$testmail=substr($_POST['email'],$contatore,1);
		if($testmail="@") $flagmail=1;
		}
		if($flagmail==0) $stringaerrore11="E-mail non valida! (Non è presente alcuna @ nella stringa!)";

if($_POST['email']!=$_POST['emailcheck']) $stringaerrore12="E-mail non valida! (Il campo di conferma e-mail è diverso dal campo e-mail!)";
//Controllo avanzato
$queryemail="select * from cliente where email='".$_POST['email']."'";
  $result = mysql_query($queryemail);
  $Results=mysql_num_rows($result);
  if($Results>0)
$stringaerrore12="E-mail non valida! (già utilizzata da altri utenti!)";
//Controllo telefoni
$flagtelefono2=0;
if(is_numeric($_POST['telefono1'])==0) $stringaerrore13="Telefono non valido!";
if(strlen($_POST['telefono2'])>0) {
if(is_numeric($_POST['telefono2'])==0) $stringaerrore14="Telefono alternativo non valido!"; 
else $flagtelefono2=1; }
//Fine controlli
//Inizio check multiplo.
if(!(
(isset($stringaerrore1)==0) &&
(isset($stringaerrore2)==0) &&
(isset($stringaerrore3)==0) &&
(isset($stringaerrore4)==0) &&
(isset($stringaerrore5)==0) &&
(isset($stringaerrore6)==0) &&
(isset($stringaerrore7)==0) &&
(isset($stringaerrore8)==0) &&
(isset($stringaerrore9)==0) &&
(isset($stringaerrore10)==0) &&
(isset($stringaerrore11)==0) &&
(isset($stringaerrore12)==0) &&
(isset($stringaerrore13)==0) &&
(isset($stringaerrore14)==0)
)) {
if(isset($stringaerrore1)==1) $_SESSION['e1']=$stringaerrore1;
if(isset($stringaerrore2)==1) $_SESSION['e2']=$stringaerrore2;
if(isset($stringaerrore3)==1) $_SESSION['e3']=$stringaerrore3;
if(isset($stringaerrore4)==1) $_SESSION['e4']=$stringaerrore4;
if(isset($stringaerrore5)==1) $_SESSION['e5']=$stringaerrore5;
if(isset($stringaerrore6)==1) $_SESSION['e6']=$stringaerrore6;
if(isset($stringaerrore7)==1) $_SESSION['e7']=$stringaerrore7;
if(isset($stringaerrore8)==1) $_SESSION['e8']=$stringaerrore8;
if(isset($stringaerrore9)==1) $_SESSION['e9']=$stringaerrore9;
if(isset($stringaerrore10)==1) $_SESSION['e10']=$stringaerrore10;
if(isset($stringaerrore11)==1) $_SESSION['e11']=$stringaerrore11;
if(isset($stringaerrore12)==1) $_SESSION['e12']=$stringaerrore12;
if(isset($stringaerrore13)==1) $_SESSION['e13']=$stringaerrore13;
if(isset($stringaerrore14)==1) $_SESSION['e14']=$stringaerrore14;
} else { 
if ($flagtelefono2==0) //se telefono 2 non esiste performa una query, altrimenti un'altra (con telefono2)
$sql="INSERT INTO cliente (username, password, email, nome, cognome, codicefiscale, datanascita, indirizzo, provincia, citta, cap, telefono1)
VALUES
('$_POST[username]','$_POST[password]','$_POST[email]','$_POST[nome]','$_POST[cognome]','$_POST[codicefiscale]','$data','$_POST[indirizzo]','$_POST[provincia]','$_POST[citta]','$_POST[cap]','$_POST[telefono1]')";
else
$sql="INSERT INTO cliente (username, password, email, nome, cognome, codicefiscale, datanascita, indirizzo, provincia, citta, cap, telefono1, telefono2)
VALUES
('$_POST[username]','$_POST[password]','$_POST[email]','$_POST[nome]','$_POST[cognome]','$_POST[codicefiscale]','$data','$_POST[indirizzo]','$_POST[provincia]','$_POST[citta]','$_POST[cap]','$_POST[telefono1]','$_POST[telefono2]')";
$_SESSION['regriuscita']=1; //Ci indica se la registrazione è riuscita oppure no.
mysql_query($sql);
}
header("Location: registrazioneprivato.php");
mysql_close($connessione);
?>
