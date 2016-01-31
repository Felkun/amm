<head>
    <title>Slideshow</title>
    <meta charset="UTF-8">
    <meta name="author" content="Giorgio Floris">
    <style type="text/css">/</style>
    <link rel="stylesheet" type="text/css" media="screen" href="css/slideshow.css" />
    <link rel="shortcut icon" href="favicon.ico">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
    <script>
        $(function(){
            $('.fadein img:gt(0)').hide();
            setInterval(function(){$('.fadein :first-child').fadeOut().next('img').fadeIn().end().appendTo('.fadein');}, 3000);
        });
    </script>
</head>

<!-- Codice di esempio per generare gli slideshow -->
<!-- <body>
<?php
    //include("slideshow.php");
?>
<div class="fadein">
<img src="http://chictraveler.wpengine.netdna-cdn.com/wp-content/uploads/2010/09/Picture-91-500x332.png">
<img src="http://sevillespain.info/wp-content/uploads/2012/02/Casa-De-Carmona-Hotel-Seville-casa_de_carmona_galeria_mr_1200-500x332.jpg">
<img src="http://hereelsewhere.com/wp-content/uploads/2012/06/Chambre22-500x332.jpeg">
<img src="http://www.worlddesignhotels.com/wp-content/uploads/407/X%20Ordinary%20Room-500x332.jpg">
<img src="http://armywife101.com/wp-content/uploads/2012/09/DoubleTree-Suites-by-Hilton-exterior-photo-Downtown-Disney-Resort-Area-Hotels-500x332.jpg">
</div>
</body> -->