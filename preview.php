<?php
    function preview($testo, $lunghezza, $finale) {
        // Taglio news per creazione preview nella home
        return (count($parole = explode(' ', $testo)) > $lunghezza) ? implode(' ', array_slice($parole, 0, $lunghezza)) . $finale : $testo;
    }
?>