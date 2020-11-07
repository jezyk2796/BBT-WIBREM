<?php
    $current_url = basename($_SERVER['PHP_SELF']);
	$active2="class=\"active2\"";
	$active3="class=\"active3\"";
?>
<header>
	<a href="remonty-pomp-olejowych"><img src="img/bbt-wibrem.png" alt="bbt-wibrem" title="bbt-wibrem"></a>
	<div class="line"></div>
	<a id="mobileLines" href="#"><span></span></a>
	<aside>
	<nav class="menu">  
		<ul>
			<li><a <?php if(preg_match("/index.php/",$current_url)){echo $active2;}?> href="remonty-pomp-olejowych">o nas</a></li>
			<li><a <?php if(preg_match("/contact.php/",$current_url)){echo $active2;} ?> href="bbt-wibrem-kontakt">kontakt</a></li>
		</ul>
	</nav>	
	<nav id="mobileMenu">  
       <ul>
			<li><a <?php if(preg_match("/index.php/",$current_url)){echo $active3;} ?> href="remonty-pomp-olejowych">o nas</a></li>
			<li><a <?php if(preg_match("/contact.php/",$current_url)){echo $active3;} ?> href="bbt-wibrem-kontakt">kontakt</a></li>
		</ul>
	</nav>
	</aside>
</header>