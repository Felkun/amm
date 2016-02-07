<?php 
    include("connect.php");
?>
<!DOCTYPE html>
<html>
<head>
        <meta charset="UTF-8">
        <meta name="author" content="Giorgio Floris">
        <style type="text/css">/</style>
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="shortcut icon" href="favicon.ico">
        <title>Metroid Prime - Reserved Area</title>
</head>
<body>
<div id="container">
            <div id="header">
                <h1 class="logo"><a href="index.html">Metroid Prime Website</a></h1>
                <ul id="menu">
                    <li><a href="index.html"><span class="menu">Home</span></a></li>
                    <li><a href="series.php"><span class="menu">La Serie</span></a></li>
                    <li><a href="story.php"><span class="menu">La Storia</span></a></li>
                    <li><a href="gameplay.php"><span class="menu">Gameplay</span></a></li>
                    <li><a href="shop.php"><span class="menu">Shop</span></a></li>
                </ul>
            </div>
            <div id="body">
<div id="container" class="container_12">
<div id="wrapper" class="grid_7">
<div>
<?php
//Area riservata Cliente
if($_SESSION['admin'] == "false") {
//Prova
//Numero ordini (e quindi numero righe) con cod_cliente = X
	$sql="SELECT COUNT(cod_ordine) FROM ordine_cliente WHERE cod_cliente=\"".$_SESSION['username']."\"";
	$result=  mysqli_query($sql) or die(mysqli_error());
	$raw=mysql_fetch_array($result);
	$numeroordini=$raw['COUNT(cod_ordine)'];
//Stampa degli ordini
if($numeroordini==0) print("<p>Non hai ancora effettuato un ordine! Cosa pensi di fare qua?</p>");
else {
print("<table border=\"1\" width=\"500\" height=\"100\">");
$sql="SELECT cod_ordine,data,stato FROM ordine_cliente WHERE cod_cliente=\"".$_SESSION['username']."\"";
$query=mysqli_query($sql) or die(mysqli_error());
for($i=0; $i<$numeroordini; $i++) 
	{
	if($i==0) 
	print("<tr><td><h1> Codice Ordine  </h1></td><td><h1>  Effettuato in data  </h1></td><td><h1>  Stato  </h1></td></tr>");
	
	$row = mysqli_fetch_object($query);
	print("<tr>");
	print("<td>"); 
	print("<a href=\"ordini.php?idordine=".$row->cod_ordine."\"><p> #".$row->cod_ordine."</p></a>"); 
	print("</td>");
	print("<td>"); 
	$data=$row->data;
	$anno=substr($data,0,4);
	$mese=substr($data,5,2);
	$giorno=substr($data,8,2);
	$data=$giorno. "-" .$mese. "-" .$anno;
	print("<p>".$data."</p>"); 
	print("</td>");
	print("<td>");  
	print("<p>".$row->stato."</p>"); 
	print("</td>");
	print("</tr>");
	}
print("</table>");	
	}
}
	

	//Fineprova

//Area riservata Admin
if($_SESSION['username']=="Admin") {
print("<p>Area riservata all'amministrazione del sito: </p>");
//Porzione di codice che si occupa della visualizzazione di tutti gli ordini (codcliente-idordine-dataordine)
//Numero ordini (e quindi numero righe) con cod_cliente = X
	$sql="SELECT COUNT(cod_ordine) FROM ordine_cliente";
	$result=mysql_query($sql) or die(mysql_error());
	$raw=mysql_fetch_array($result);
	$numeroordini=$raw['COUNT(cod_ordine)'];
//Stampa degli ordini
print("<table border=\"1\" width=\"500\" height=\"100\">");
$sql="SELECT cod_cliente,cod_ordine,data,stato FROM ordine_cliente";
$query=mysql_query($sql) or die(mysql_error());
for($i=0; $i<=$numeroordini; $i++) 
	{
	if($i==0) 
	print("<tr><td><h1>Codice Cliente</h1></td><td><h1>Codice Ordine</h1></td><td><h1>Effettuato in data</h1></td><td><h1>Stato</h1></td></tr>");
	if($i!=0) {
	$row = mysql_fetch_object($query);
	if(!($row->cod_cliente=="0")) {
	print("<tr>");
	print("<td>"); 
	print("<p>".$row->cod_cliente."</p>"); 
	print("</td>");
	print("<td>"); 
	print("<a href=\"ordini.php?idordine=".$row->cod_ordine."\"><p> #".$row->cod_ordine."</p></a>"); 
	print("</td>");
	print("<td>"); 
	$data=$row->data;
	$anno=substr($data,0,4);
	$mese=substr($data,5,2);
	$giorno=substr($data,8,2);
	$data=$giorno. "-" .$mese. "-" .$anno;
	print("<p>".$data."</p>"); 
	print("</td>");
	print("<td>");  
	print("<p>".$row->stato."</p>"); 
	print("</td>");
	print("</tr>");
	}
	}
	}
print("</table>");	
//Fine visualizzazione ordini
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