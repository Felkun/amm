<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>JQuery PowerPoint</title>
<style type="text/css">
ul.ppt {
	position: relative;
}

.ppt li {
	list-style-type: none;
	position: absolute;
}

.ppt img {
	border: 1px solid #e7e7e7;
	padding: 5px;
	background-color: #ececec;
        
}
</style>
</head>
<body>
    <center>
<ul class="ppt">
	<li><img src="media/screenshot/mprime_01.jpg" alt="Ethernet Cable"></img></li>
	<li><img src="glasses.jpg" alt="Spectacles"></img></li>
	<li><img src="pisa.jpg" alt="Leaning Tower of Pisa"></img></li>
</ul>
    </center>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
<script type="text/javascript">
$('.ppt li:gt(0)').hide();
$('.ppt li:last').addClass('last');
var cur = $('.ppt li:first');

function animate() {
	cur.fadeOut( 1000 );
	if ( cur.attr('class') == 'last' )
		cur = $('.ppt li:first');
	else
		cur = cur.next();
	cur.fadeIn( 1000 );
}

$(function() {
	setInterval( "animate()", 5000 );
} );
</script>
</body>
</html>