// crea l'oggetto per la comunicazione AJAX con il server
// compatibile con tutti i browser che supportano AJAX
function crea_http_req() {
    var req = false;
    if (typeof XMLHttpRequest !== "undefined")
        req = new XMLHttpRequest();
    if (!req && typeof ActiveXObject !== "undefined") {
        try {
            req=new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e1) {
            try {
                req=new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e2) {
                try {
                    req=new ActiveXObject("Msxml2.XMLHTTP.4.0");
                } catch (e3) {
                    req=null;
                }
            }
        }
    }

    if(!req && window.createRequest)
        req = window.createRequest();

    if (!req) alert("Il browser non supporta AJAX");

    return req;
}

// l'oggetto per comunicare con il server
var http_req = crea_http_req();

// invia i dati del form al server
function invia_dati() {
    var dati_post = "username=" +
                    encodeURIComponent( document.getElementById("username").value ) +
                    "&password=" +
                    encodeURIComponent( document.getElementById("password").value );

    http_req.onreadystatechange = gestisci_risposta;
    http_req.open('POST', 'login.php', true);
    http_req.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    http_req.setRequestHeader("Content-length", dati_post.length);
    http_req.setRequestHeader("Connection", "close");
    http_req.send(dati_post);
}

// recupero e gestisco la risposta inviata dal server
function gestisci_risposta() {
    if(http_req.readyState === 4) {
        var esito = http_req.responseText;
        switch (esito) {
            case '1':
                alert('Username non presente nel sistema');
                break;

            case '2':
                alert('Password errata');
                break;

            case '3':
                alert('Username o password non inserite');
                break;

            case '4':
                alert('Login effettuato correttamente');
                break;

            default:
                alert('Risposta del server non riconosciuta: ' + esito);
        }
    }
}