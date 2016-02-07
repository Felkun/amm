<?php 
session_start();
if(isset($_SESSION['username'])==0) 
	$_SESSION['username']="GUEST";

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
	
	if($_SESSION['username']!="GUEST") header("Location: index.php");
	?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
<title></title>
<link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
<?php // <link rel="stylesheet" type="text/css" href="css/menutendina.css" /> ?>
<style type="text/css">
#ricerca {
 padding: 0;
 position: relative;
}
#s {
 width: 280px;
 height: 28px;
 line-height: 18px;
 padding: 0 10px;
 background: white;
 border: 0 none;
 -moz-border-radius: 14px;
 -webkit-border-radius: 14px;
 border-radius: 14px;
 -moz-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.75) inset;
 -webkit-box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.75) inset;
 box-shadow: 1px 1px 2px rgba(0, 0, 0, 0.75) inset;
 font-size: 14px;
}
#sub {
 outline: none;
 cursor: pointer;
 width: 20px;
 height: 20px;
 padding: 0 10px;
 border: 0;
 border-left: 1px solid #faa53a;	
 background: url("img/lente.png") no-repeat center;
 text-indent: -10957px;
 position: absolute;
 top: 5px;
 right: 5px;
}
</style>
</head>
<body>
<div id="header">
<div class="container_12">
<h1 class="grid_3" id="logo"><a href="index.php">BubiShop</a></h1>

 <ul class="grid_5 prefix_4" id="menu">
<li><a class="active" href="index.php">Home</a></li>
<li><a href="prodotti.php">Prodotti</a></li>
<li><a href="riserved.php">Area Riservata</a></li>
<li><a href="carrello.php">Carrello</a></li>
<li><a href="info.php">Su Di Noi..</a></li>
</ul>

<?php /* <ul id="menutendina">
	<li class="primo-livello">
		<a href="#">Ricette</a>
		<ul>
			<li><a href="#">Primi</a></li>
			<li><a href="#">Secondi</a></li>
			<li><a href="#">Dolci</a></li>
		</ul>
	</li>
	
	<li class="primo-livello">
		<a href="#">Sport</a>
		<ul>
			<li><a href="#">Calcio</a></li>
			<li><a href="#">Basket</a></li>
			<li><a href="#">Sci</a></li>
		</ul>
	</li>
	
	<li class="primo-livello">
		<a href="#">Musica</a>
		<ul>
			<li><a href="#">Rock</a></li>
			<li><a href="#">Soul</a></li>
			<li><a href="#">Altro</a></li>
		</ul>
	</li>
</ul>	*/?>

</div>
</div>
<div id="container" class="container_12">
<div id="wrapper" class="grid_7">
<div class="post">
	<?php if($_SESSION['username']=="GUEST") { if(isset($_SESSION['regriuscita'])==0) {
	print("<p>Se hai sbagliato, Per tornare indietro clicka <a href=\"registrazione.php\">QUI</a>");
	print("<BR>Procediamo alla creazione del tuo utente AZIENDALE!</p><BR>");
	if(isset($_SESSION['e1'])==1) { print($_SESSION['e1']); print("<BR>"); $e1=$_SESSION['e1']; unset($_SESSION['e1']); }
	if(isset($_SESSION['e2'])==1) { print($_SESSION['e2']); print("<BR>"); $e2=$_SESSION['e2']; unset($_SESSION['e2']); }
	if(isset($_SESSION['e3'])==1) { print($_SESSION['e3']); print("<BR>"); $e3=$_SESSION['e3']; unset($_SESSION['e3']); }
	if(isset($_SESSION['e4'])==1) { print($_SESSION['e4']); print("<BR>"); $e4=$_SESSION['e4']; unset($_SESSION['e4']); }
	if(isset($_SESSION['e5'])==1) { print($_SESSION['e5']); print("<BR>"); $e5=$_SESSION['e5']; unset($_SESSION['e5']); }
	if(isset($_SESSION['e6'])==1) { print($_SESSION['e6']); print("<BR>"); $e6=$_SESSION['e6']; unset($_SESSION['e6']); }
	if(isset($_SESSION['e7'])==1) { print($_SESSION['e7']); print("<BR>"); $e7=$_SESSION['e7']; unset($_SESSION['e7']); }
	if(isset($_SESSION['e8'])==1) { print($_SESSION['e8']); print("<BR>"); $e8=$_SESSION['e8']; unset($_SESSION['e8']); }
	if(isset($_SESSION['e9'])==1) { print($_SESSION['e9']); print("<BR>"); $e9=$_SESSION['e9']; unset($_SESSION['e9']); }
	if(isset($_SESSION['e10'])==1) { print($_SESSION['e10']); print("<BR>"); $e10=$_SESSION['e10']; unset($_SESSION['e10']); }
	if(isset($_SESSION['e11'])==1) { print($_SESSION['e11']); print("<BR>"); $e11=$_SESSION['e11']; unset($_SESSION['e11']); }
	if(isset($_SESSION['e12'])==1) { print($_SESSION['e12']); print("<BR>"); $e12=$_SESSION['e12']; unset($_SESSION['e12']); }
	if(isset($_SESSION['e13'])==1) { print($_SESSION['e13']); print("<BR>"); $e13=$_SESSION['e13']; unset($_SESSION['e13']); }
	if(isset($_SESSION['e14'])==1) { print($_SESSION['e14']); print("<BR>"); $e14=$_SESSION['e14']; unset($_SESSION['e14']); }
	if(isset($_SESSION['e15'])==1) { print($_SESSION['e15']); print("<BR>"); $e15=$_SESSION['e15']; unset($_SESSION['e15']); }
	if(isset($_SESSION['e16'])==1) { print($_SESSION['e16']); print("<BR>"); $e16=$_SESSION['e16']; unset($_SESSION['e16']); }
	print("<FORM ACTION=\"registerazienda.php\" METHOD=\"POST\">");
	print("<ul id=\"registrazione\">");
	print("<pre>");
	print("<li>Nome&#9&#9&#9&#9");
	print("<INPUT TYPE=text name=\"nome\" maxlength=\"45\" /></li><BR>");
    print("<li>Cognome&#9&#9&#9");
    print("<INPUT TYPE=text name=\"cognome\" maxlength=\"45\" /></li><BR>");
    print("<li>Data di nascita<BR><BR>");
	print("<li>Giorno&#9&#9&#9&#9");
    print("<INPUT TYPE=text name=\"giorno\" maxlength=\"2\" /></li><span id=\"little\">(Formato giorno: GG)</span><BR><BR>");
	print("<li>Mese&#9&#9&#9&#9");
    print("<INPUT TYPE=text name=\"mese\" maxlength=\"2\" /></li><span id=\"little\">(Formato mese: MM)</span><BR><BR>");
	print("<li>Anno&#9&#9&#9&#9");
    print("<INPUT TYPE=text name=\"anno\" maxlength=\"4\" /></li><span id=\"little\">(Formato anno: AAAA)</span><BR>");
    print("<li>Codice Fiscale&#9&#9");
    print("<INPUT TYPE=text name=\"codicefiscale\" maxlength=\"16\" /></li><BR>");
    print("<li>Indirizzo&#9&#9&#9&#9");
    print("<INPUT TYPE=text name=\"indirizzo\" maxlength=\"45\" /></li><BR>");
    print("<li>Citt&agrave&#9&#9&#9&#9");
    print("<INPUT TYPE=text name=\"citta\" maxlength=\"45\" /></li><BR>");
    print("<li>CAP&#9&#9&#9&#9");
    print("<INPUT TYPE=text name=\"cap\" maxlength=\"5\" /></li><BR>");
    print("<li>Provincia&#9&#9&#9");
    print("<INPUT TYPE=text name=\"provincia\" maxlength=\"2\" /></li><BR>");
    print("<li>Username&#9&#9&#9");
    print("<INPUT TYPE=text name=\"username\" maxlength=\"20\" /></li><BR>");
    print("<li>Password&#9&#9&#9");
    print("<INPUT TYPE=password name=\"password\" maxlength=\"20\" /></li><span id=\"little\">(Min 6 Max 20 Caratteri)</span><BR>");
    print("<li>Conferma Password&#9");
    print("<INPUT TYPE=password name=\"passwordcheck\" maxlength=\"20\" /></li><BR>");
    print("<li>Indirizzo e-mail&#9&#9");
    print("<INPUT TYPE=text name=\"email\" maxlength=\"45\" /></li><BR>");
    print("<li>Conferma e-mail&#9&#9");
    print("<INPUT TYPE=text name=\"emailcheck\" maxlength=\"45\" /></li><BR>");
    print("<li>Numero Telefono&#9&#9");
    print("<INPUT TYPE=text name=\"telefono1\" maxlength=\"10\" /></li><span id=\"little\">(Campo Obbligatorio)</span><BR>");
    print("<li>Numero Cellulare&#9");
    print("<INPUT TYPE=text name=\"telefono2\" maxlength=\"10\" /></li><BR>");
    print("<li>Partita IVA&#9&#9&#9");
    print("<INPUT TYPE=text name=\"partitaiva\" maxlength=\"11\" /></li><BR>");
    print("<li>Ragione Sociale&#9&#9");
    print("<INPUT TYPE=text name=\"ragionesociale\" maxlength=\"45\" /></li><BR>");
	print("<INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Registrati!\">");
	print("</pre>");
	print("</ul>");
	print("</FORM>");
	}
	else print("Registrazione riuscita! Immetti i tuoi campi user e pass e usufruirai di tutti i nostri servizi!");
	}
	?>
</div>
</div>
<div id="sidebar" class="grid_4 prefix_1">
<div id="ricerca">
<label for="s" class="hide">Cerca sul sito</label>
<FORM ACTION="ricerca.php" METHOD="POST">
<input type="search" id="s" name="s" placeholder="Cerca sul sito">
<input type="submit" id="sub" name="sub" value="Cerca">
</FORM>
</div>
<h4>LOGIN</h4>
<p class="about">
<?php 		
		if($_SESSION['username']=="GUEST") {				
		print("<FORM ACTION=\"login.php\" METHOD=\"POST\">");		
		print("<ul>");
		print("<li>Username</li>");
		print("<li><INPUT TYPE=\"Text\" NAME=\"username\"></li>");
		print("<li>Password</li>");
		print("<li><INPUT TYPE=\"Password\" NAME=\"password\"></li>");
		print("<BR>");
		print("<li><INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Log In\"></li>");
		print("<li>Non sei registrato? <a href=\"registrazione.php\">Registrati!</a></li>");
		if(isset($_SESSION['accessonegato'])==1) { print("<li><h1>Non hai inserito dati di accesso corretti!</h1></li>"); unset($_SESSION['accessonegato']); }
		print("</ul>");
		print("</FORM>");
		}
		if($_SESSION['username']!="GUEST") {
		print("<span>Benvenuto ".$_SESSION['username']." !</span>");
		print("<a href=\"riserved.php\"><p>Entra nella tua area riservata!</p></a>");
		print("<FORM ACTION=\"logout.php\" METHOD=\"POST\">");
		print("<ul>");
		print("<li><INPUT id=\"pulsante\" TYPE=Submit VALUE=\"Log Out\"></li>");
		print("</ul>");
		print("</FORM>");
		}
?>	
</p>
<h4>Pagamenti</h4>
<ul>
<li>Contrassegno</li>
<li>Carta Di Credito</li>
<li>PayPal</li>
<li>Bonifico Bancario</li>
<li>Conto Corrente</li>
<li></li>
</ul>
</div>
</div>
<div id="footer">
<div class="container_12">
<p>BubiShop - Il primo on-LAN shop dell'ITIS - OR - 09170</p>
</div>
</div>
</body>
</html>