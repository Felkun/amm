<html>
    <head>
        <title>Example</title>
        <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
        <script  type="text/javascript">
            $(document).ready(function() {
                // assegno un evento sulla pressione di uno qualsiasi dei link del menù
                $('.sidebar a').click(function(e) {
                    // prevengo il funzionamento normale del browser che mi rimanderebbe all'url del link
                    e.preventDefault();
                    // effettuo invece una richiesta in ajax grazie a quella url
                    $.get($(this).attr('href')).done(function(data) {
                        // in caso di riuscita scrivo il responso nel div main
                        $('.main').html(data);
                    });
                });
            });

        </script>
        </style>
    <body>
            <p align=center>
                <a href="#">Menu principale: </a>
            </p>
            <!-- l'attributo alt per le immagini è obbligatorio  -->
            <!-- non puoi assegnare lo stesso id a piu di un elemento nella stessa pagina  -->
            &raquo; <img src="Home.png" class="immaginimenu" alt="home"/>   
            <a href="index.php">Home</a> 
            <br/><br/>
            &raquo;   <img src="albergo.gif"  class="immaginimenu" alt="albergo">   
            <a href="story.php">Alberghi</a>
        </div>
        <div class="main">

        </div>
    </body>
<!--</html>-->