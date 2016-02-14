<!-- Connessione al database -->
<?php
    //include("connect.php");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="author" content="Giorgio Floris" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/style.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="css/slideshow.css" />
        <link rel="shortcut icon" href="favicon.ico" />
        <title>Metroid Prime - Home</title>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
        <script>
            $(function(){
                $('.fadein img:gt(0)').hide();
                setInterval(function(){$('.fadein > :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 4000);
            });
        </script>
    </head>
    <body>
        <div id="container">
            <div id="header">
                <h1 class="logo"><a href="index.php">Metroid Prime Website</a></h1>
                <ul id="menu">
                    <li><a href="index.php"><span class="menu">Home</span></a></li>
                    <li><a href="series.php"><span class="menu">La Serie</span></a></li>
                    <li><a class="active" href="story.php"><span class="menu">La Storia</span></a></li>
                    <li><a href="gameplay.php"><span class="menu">Gameplay</span></a></li>
                </ul>
            </div>
            <div id="body">
                <br /><br />
                <div id="contenuto" align="left">
                    <div id="position">
                        <center><img src="media/prime_logo.png"/></center>
                        <img src="media/orpheon.jpg" style="float:left;" id="blueborder" /><div>Durante un viaggio sulla sua navetta spaziale, Samus Aran riceve un SOS da parte di un vascello dei Pirati Spaziali.</div>
                        <div>Tracciata l'esatta posizione di una delle loro fortezze volanti, localizzandola nell'orbita del pianeta Tallon IV, Samus ci si reca per scoprire i piani dei Pirati.</div>
                        <div>All'interno della fregata spaziale Orpheon Samus scopre che una Parassita Regina, una creatura mutante modificata geneticamente, si è liberata e ha danneggiato la maggior parte della stazione, uccidendo anche i pirati all'interno.</div>
                        <div>Samus ne trova un'altra rinchiusa, viva e dal comportamento violento. La uccide, ma questa finisce nel reattore della stazione, causandone l'esplosione.</div>
                        <div>Fuggendo dalla stazione spaziale Samus incontra una copia meccanica di Ridley, la sua nemesi e capo dei Pirati Spaziali, che fugge su Tallon IV prima dell'esplosione della fregata.</div>
                        <div>Decisa di non farla passare liscia ai Pirati Samus decide di inseguire Ridley. La cacciatrice atterra sul pianeta e comincia l'esplorazione.</div>
                    </div>
                    <br />
                    <div align="center">
                        <p><h4>Screenshot</h4></p>
                        <div class="fadein">
                            <img src="media/screenshot/mprime_01.jpg" />
                            <img src="media/screenshot/mprime_02.jpg" />
                            <img src="media/screenshot/mprime_03.jpg" />
                            <img src="media/screenshot/mprime_04.jpg" />
                            <img src="media/screenshot/mprime_05.jpg" />
                        </div>
                        <br />
                    </div>
                </div>
            </div>
        </div>
            
            <div id="push"></div>
            
        </div>  
    <div id="footer">
        <center><div>Copyright &#169; 2002-2016 Nintendo</div></center>
    </div>
</html>