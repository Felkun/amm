<?php
session_start();
if(isset($_POST['Scelta'])==1) { 
	if($_POST['Scelta']=="Solito") {
		if(($_POST['indirizzo']==NULL) && ($_POST['citta']==NULL) && ($_POST['provincia']==NULL) && ($_POST['cap']==NULL)) {
	header("Location: pagamento.php"); $_SESSION['payment']=1; }
	
	else { $_SESSION['errore_conferma_indirizzo_1']="Se hai specificato il solito indirizzo NON aggiungere campi nell'indirizzo alternativo! :) "; header("Location: confirmorder.php"); }
	}
	if($_POST['Scelta']=="Altro") {
	if(($_POST['indirizzo']!=NULL) && ($_POST['citta']!=NULL) && ($_POST['provincia']!=NULL) && ($_POST['cap']!=NULL)) {
	if((strlen($_POST['provincia'])==2) && (is_numeric($_POST['provincia'])==0) && (strlen($_POST['cap'])==5) && (is_numeric($_POST['cap'])==1)) {
	//Tutto corretto, inseriamo nella sessione i valori di indirizzo città provincia e cap per il nostro ordine!
	$_SESSION['indirizzo']=$_POST['indirizzo'];
	$_SESSION['cap']=$_POST['cap'];
	$_SESSION['provincia']=$_POST['provincia'];
	$_SESSION['citta']=$_POST['citta'];
	$_SESSION['payment']=1;
	header("Location: pagamento.php");
	}
	else { $_SESSION['errore_conferma_indirizzo_2']="Almeno uno dei campi che hai inserito nell'indirizzo dell'ordine NON è valido. Riprova!"; header("Location: confirmorder.php"); }
	}
	else { $_SESSION['errore_conferma_indirizzo_3']="Non hai inserito almeno uno dei campi richiesti. Riprova!"; header("Location: confirmorder.php"); }
 }
 }
 else { $_SESSION['errore_conferma_indirizzo_4']="Errore! (Controlla di aver selezionato una delle due possibilita' !)"; header("Location: confirmorder.php"); }

?>