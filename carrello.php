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
        <title>Metroid Prime - Shop</title>
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
                    <li><a class="active" href="shop.php"><span class="menu">Shop</span></a></li>
                </ul>
            </div>

    <div id="body">
                <?php
//Gestione carrello:
if(isset($_SESSION['contatore'])==0) print("<p>Il tuo carrello &egrave vuoto! Aggiungici dei prodotti!</p>");
else
$totale=0;
print("<BR>");
$j=1;
{
if(isset($_SESSION['contatore'])==1) {
for($i=0; $i<$_SESSION['contatore']; $i++) 
	{
	if($_SESSION['carrello'][$i]['qt']!=NULL) { $almenounelemento=1;
	if(isset($j)==1) { unset($j); print("<table border=\"1\" width=\"600\" height=\"70\">"); $f=1; }
	print("<tr>");
	print("<td>"); 
	print("<BR><img src=\"".$_SESSION['carrello'][$i]['cod_art'].".jpg\" width=80 height=80 />"); 
	print("</td>");
	print("<td>"); 
	$sql="SELECT descrizione,prezzo FROM articolo WHERE cod_art=\"".$_SESSION['carrello'][$i]['cod_art']."\"";
	$query=mysql_query($sql) or die(mysql_error());
	$row=mysql_fetch_array($query);
	$descrizione=$row['descrizione'];
	$prezzo=$row['prezzo'];
	print("<BR><BR><BR><p>".$descrizione."</p>");
	print("</td>");
	print("<td>");
	$totale=$totale+($prezzo*$_SESSION['carrello'][$i]['qt']);
	print("<BR><BR><BR><p>".($prezzo*$_SESSION['carrello'][$i]['qt'])." &#8364</p>");
	print("</td>");
	print("<td>");  
	//
	//print("<a href=\"qt.php?operation=sum&cod_art=".$_SESSION['carrello'][$i]['cod_art']."\"><p>+</p></a>");
	//print("<a href=\"qt.php?operation=minus&cod_art=".$_SESSION['carrello'][$i]['cod_art']."\"><p>-</p></a>");
	//test
	print("<form action=\"qt.php\" method=\"GET\">");
	print("<input type=\"hidden\" name=\"operation\" value=\"sum\">");
	print("<input type=\"hidden\" name=\"cod_art\" value=\"".$_SESSION['carrello'][$i]['cod_art']."\">");
	print("<BR><BR><input id=\"pulsantecarrello\"  name=\"".$_SESSION['carrello'][$i]['cod_art']."\" type=\"submit\" value=\"+\">");
	print("</form>");
	print("</td>");
	print("<td>");
	print("<form action=\"qt.php\" method=\"GET\">");
	print("<input type=\"hidden\" name=\"operation\" value=\"minus\">");
	print("<input type=\"hidden\" name=\"cod_art\" value=\"".$_SESSION['carrello'][$i]['cod_art']."\">");
	print("<BR><BR><input id=\"pulsantecarrello\"  name=\"".$_SESSION['carrello'][$i]['cod_art']."\" type=\"submit\" value=\"-\">");
	print("</form>");
	//test
	print("</td>");
	print("<td>");
	print("<BR><BR><BR><p>Quantit&agrave =".$_SESSION['carrello'][$i]['qt']."</p>");
	print("</td>");
	print("<td>");
	//print("<a href=\"qt.php?remove=".$_SESSION['carrello'][$i]['cod_art']."\"><p>RIMUOVI</p></a>"); <- ALTERNATIVO
	//
	print("<form action=\"qt.php\" method=\"GET\">");
	print("<input type=\"hidden\" name=\"remove\" value=\"".$_SESSION['carrello'][$i]['cod_art']."\">");
	print("<BR><BR><input id=\"pulsantecarrello\"  name=\"".$_SESSION['carrello'][$i]['cod_art']."\" type=\"submit\" value=\"RIMUOVI!\">");
	print("</form>");
	//
	print("</td>");
	print("</tr>");
	}
	}
	$_SESSION['totale']=$totale;
	if(isset($f)==1) { print("</table>"); unset($f); print("<BR><BR><BR><h1 align=\"right\">Totale: ".$totale." &#8364</h1>"); }
	
	}
	}
?>
<?php
//Visualizzazione del totale nel carrello
//Fine visualizzazione del totale nel carrello

//Dedicata alla visualizzazione del "CONFERMA ORDINE"
		if(isset($_SESSION['contatore'])==1) {
		if(isset($_SESSION['controllologin'])==0) {
		print("<FORM ACTION=\"confirmorder.php\" METHOD=\"POST\">");		
		print("<BR><BR><BR><BR><INPUT id=\"pulsante\" TYPE=Submit VALUE=\"CONFERMA ORDINE\">");
		print("</FORM>");
		}
		if(isset($_SESSION['controllologin'])==1) {
		if(isset($_SESSION['numerr'])==1) print("Non ci sono elementi nel tuo carrello! Come fai a ordinare?");
		else {
		if($_SESSION['username']=="GUEST") {
		print("<BR><BR><BR><h2>Devi loggarti prima di poter confermare un ordine!</h2>");
		print("<p>Guarda il menu alla tua destra e inserisci i dati di accesso!!</p>");
		print("<p>NON sei registrato? REGISTRATI <a href=\"registrazione.php\">QUI!!</a></p>"); }
		}
		$_SESSION['redirect']=2;
}
}
?>
</div>

            
            <div id="push"></div>
            
        </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
</body>
</html>