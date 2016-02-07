<?php
session_start();
//Controlla l'indice del prodotto da aggiungere al carrello
if(isset($_POST['gnegne'])==1) {
if(isset($_SESSION['contatore'])==0) { $_SESSION['contatore']=0;
 $_SESSION['carrello'] = array(array('cod_art' => hash("sha256",$_POST['gnegne']), 'qt' => '1'));
 $_SESSION['contatore']++;
 }
else {
//Fine controllo
$_SESSION['carrello'][$_SESSION['contatore']]['cod_art']=hash("sha256",$_POST['gnegne']);
$_SESSION['carrello'][$_SESSION['contatore']]['qt']=1; 	
$_SESSION['contatore']++; }
}
?>

<html>
<head><title="gne"></title></head>
<body>
<?php
print("<FORM ACTION=\"gnegne.php\" METHOD=\"POST\">");
print("<input type=\"text\" name=\"gnegne\">");
print("<input type=\"submit\" value=\"poba\">");
print("</form>");
if(isset($_SESSION['carrello'])==1) {
for($i=0; $i<$_SESSION['contatore'];$i++) {
  print $_SESSION['carrello'][$i]['cod_art'];
  print $_SESSION['carrello'][$i]['qt'];
  }
}
?>
</body>
</html>