<?php 
session_start();
if(isset($_SESSION['username'])==0) 
	$_SESSION['username']="GUEST";
	if($_SESSION['username']=="GUEST") header("Location: index.php");
	if(isset($_GET['idordine'])==0) header("Location: index.php");
	if(is_numeric($_GET['idordine'])==0) header("Location: index.php");
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
<li><a class="active" href="index.php">Home</a></li>
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
//Script che verifica se l'ordine $_GET['idordine'] è stato effettuato da $_SESSION['username']. (privacy)
  $test="SELECT cod_cliente FROM ordine_cliente where cod_cliente='".$_SESSION['username']."' and cod_ordine='".$_GET['idordine']."'";
  $test = mysql_query($test);
  $test=mysql_num_rows($test);
  if($test==0) 
	if($_SESSION['username']!="Admin")
	  header("Location: index.php"); 
?>
<?php
print("<h2>Ordine numero #".$_GET['idordine']."</h2>");
//Data ordine
	$data="SELECT data,stato,euro FROM ordine_cliente WHERE cod_ordine=\"".$_GET['idordine']."\"";
	$data1=mysql_query($data) or die(mysql_error());
	$data2=mysql_fetch_array($data1);
	$datadefinitiva=$data2['data'];
	$anno=substr($datadefinitiva,0,4);
	$mese=substr($datadefinitiva,5,2);
	$giorno=substr($datadefinitiva,8,2);
	$datadefinitiva=$giorno. "-" .$mese. "-" .$anno;
	$stato=$data2['stato'];
	$euro=$data2['euro'];
print("<h1>Effettuato in data ".$datadefinitiva."</h1><BR>");
print("<h1>Ordine per ".$euro." &#8364</h1><BR>");
print("<h1>Stato ordine: ".$stato."</h1><BR><BR>");
print("<BR>");
//
//Numero righe ordine x 
	$sql="SELECT COUNT(cod_art) FROM ordini WHERE cod_ordine=\"".$_GET['idordine']."\"";
	$result=mysql_query($sql) or die(mysql_error());
	$raw=mysql_fetch_array($result);
	$numerorighe=$raw['COUNT(cod_art)'];
//Stampa degli articoli
//
$sql="SELECT cod_art,qt FROM ordini WHERE cod_ordine=\"".$_GET['idordine']."\"";
$query=mysql_query($sql) or die(mysql_error());
print("<table border=\"1\" width=\"350\" height=\"100\">");
for($i=0; $i<$numerorighe; $i++) 
	{
	if($i==0) 
	print("<tr><td><h1>Marca</h1></td><td><h1>Articolo</h1></td><td><h1>Quantit&agrave</h1></td></tr>");
	$row = mysql_fetch_object($query);
	print("<tr>");
	//Stampa della Marca
	$marca="SELECT marca FROM articolo WHERE cod_art=\"".$row->cod_art."\"";
	$marca=mysql_query($marca) or die(mysql_error());
	$marca=mysql_fetch_array($marca);
	$marca=$marca['marca'];
	print("<td>");
	print("<p>".$marca."</p>");
	print("</td>");
	//
	print("<td>"); 
	//Stampa di articolo.descrizione al posto di articolo.cod_art
	$articolo1="SELECT descrizione FROM articolo WHERE cod_art=\"".$row->cod_art."\"";
	$risultato=mysql_query($articolo1) or die(mysql_error());
	$risultato2=mysql_fetch_array($risultato);
	$Articolo=$risultato2['descrizione'];
	//
	print("<p>".$Articolo."</p>"); 
	print("</td>");
	print("<td>");
	print("<p>".$row->qt."</p>");
	print("</td>");
	print("</tr>");
	}
print("</table>");	
//
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