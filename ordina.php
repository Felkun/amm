<?php 
session_start();
if (isset($_POST['pagamento'])==0) header("Location: index.php");
if (is_numeric($_POST['pagamento'])==0) header("Location: index.php");
if (isset($_SESSION['contatore'])==0) header("Location: index.php");
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
<li><a href="index.php">Home</a></li>
<li><a href="showcategories.php">Prodotti</a></li>
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
<?php
	$data=date("Y-m-d");
	$stato="In Lavorazione";
	print("<h2>Il tuo ordine &egrave stato accettato!</h2>");
	print("<p>Procederemo alla consegna del tuo ordine nel pi&ugrave breve tempo possibile!</p>");
	//Stampa numero ordine
	$sql="SELECT MAX(cod_ordine) FROM ordini";
	$num_ordine=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($num_ordine);
	$row['MAX(cod_ordine)']++;
	$numordine=$row['MAX(cod_ordine)'];
	print("<p>Il tuo numero ordine &egrave il # ".$row['MAX(cod_ordine)']." !</p>");
	print("<p>Per qualsiasi dubbio non esitare a contattarci!</p>");
	$sql="SELECT MAX(idordini) FROM ordini";
	$id_ordine=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($id_ordine);
	$row['MAX(idordini)']++;	//1� ID da scrivere
	$progressivo=$row['MAX(idordini)'];
	//Aggiornamento dati nel database!
	for($i=0; $i<$_SESSION['contatore']; $i++) 
	{
	if($_SESSION['carrello'][$i]['qt']!=NULL) {
		$Sql="UPDATE articolo SET qt=qt-".$_SESSION['carrello'][$i]['qt']." WHERE cod_art='".$_SESSION['carrello'][$i]['cod_art']."'";
		mysql_query($Sql);
		$sql="INSERT INTO ordini (idordini, cod_art, qt, cod_ordine) VALUES ('".$progressivo."','".$_SESSION['carrello'][$i]['cod_art']."','".$_SESSION['carrello'][$i]['qt']."','".$numordine."')";	
		mysql_query($sql);
		$progressivo++;
		}
	}
	if($_POST['pagamento']==1) $pagamento="Contrassegno";
	if($_POST['pagamento']==2) $pagamento="Carta di Credito";
	if($_POST['pagamento']==3) $pagamento="PayPal";
	if($_POST['pagamento']==4) $pagamento="Bonifico";
	if($_POST['pagamento']==5) $pagamento="Conto Corrente";
	if((isset($_SESSION['citta'])==0) && (isset($_SESSION['provincia'])==0) && (isset($_SESSION['cap'])==0) && (isset($_SESSION['indirizzo'])==0)) {
	$sql="SELECT indirizzo,provincia,citta,cap FROM cliente WHERE username=\"".$_SESSION['username']."\"";
	$result=mysql_query($sql) or die(mysql_error());
	$row = mysql_fetch_object($result);
	$sql="INSERT INTO ordine_cliente (cod_cliente, cod_ordine, pagamento, indirizzo, citta, provincia, cap, data, stato, euro) VALUES ('".$_SESSION['username']."','".$numordine."','".$pagamento."','".$row->indirizzo."','".$row->citta."','".$row->provincia."','".$row->cap."','".$data."','".$stato."','".$_SESSION['totale']."')";	
	mysql_query($sql);
	}
	else {
	$sql="INSERT INTO ordine_cliente (cod_cliente, cod_ordine, indirizzo, citta, provincia, cap, pagamento, data, stato, euro) VALUES ('".$_SESSION['username']."','".$numordine."','".$_SESSION['indirizzo']."','".$_SESSION['citta']."','".$_SESSION['provincia']."','".$_SESSION['cap']."','".$pagamento."','".$data."','".$stato."','".$_SESSION['totale']."')";	
	mysql_query($sql);
	}
	unset($_SESSION['carrello']);
	unset($_SESSION['contatore']);
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
<h4>I Pi&ugrave venduti</h4>
<ul>
<li>item1 </li>
<li>item1</li>
<li>item1</li>
<li>item1</li>
<li>item1</li>
</ul>
<h4>Pagamenti</h4>
<ul>
<li>Contrassegno</li>
<li>Carta Di Credito</li>
<li>PayPal</li>
<li>Bonifico Bancario</li>
<li>Conto Corrente</li>
<li></li>
</ul>
<h4>Validazioni</h4>
<p>HTML5</p>
<p>CSS3</p>
</div>
</div>
<div id="footer">
<div class="container_12">
<p>BubiShop - Il primo on-LAN shop dell'ITIS - OR - 09170</p>
</div>
</div>
</body>
</html>