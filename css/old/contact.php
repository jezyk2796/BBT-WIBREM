	<?php
	session_start();
	$siteKey = '6LdapC8UAAAAAHBtovAqc2SGZG-sJboVNHWSFOEM';

	//Jeśli nastąpiło wysłanie formularza (można to sprawdzić tym, że jest ustawiona zmienna mail)
	if(isset($_POST['email']))
    {
         //Udana walidacja
		 $all_OK=true;

		 //Sprawdzenie poprawności imienia i nazwiska
		 $name = $_POST['name'];
		 $name=htmlentities($name,ENT_QUOTES,"UTF-8");

		 if((strlen($name)<3)||(strlen($name)>50))
		 {
			$all_OK=false;
			$_SESSION['error_name']="Pole powinno zawierać od 3 do 50 znaków!";
		 }

		 //Sprawdzenie poprawności adresu e-mail
		 $email=$_POST['email'];
		 $email_sanitize=filter_var($email,FILTER_SANITIZE_EMAIL);

		if((filter_var($email_sanitize,FILTER_SANITIZE_EMAIL)==false)||($email!=$email_sanitize))
		{
			$all_OK=false;
			$_SESSION['error_email']="Podaj poprawny adres e-mail!";
		}

		 //Sprawdzenie poprawności numeru telefonu
		 $tel=$_POST['tel'];
		 $tel_sanitize=filter_var($tel,FILTER_SANITIZE_NUMBER_INT);

		 if(strlen($tel)>0)
		 {
			if((filter_var($tel_sanitize,FILTER_SANITIZE_NUMBER_INT)==false)||($tel!=$tel_sanitize)||(strlen($tel_sanitize)<9))
			{
				$all_OK=false;
				$_SESSION['error_tel']="Numer telefonu powinien zawierć min. 9 cyfr!";
			}
		 }

		 //Sprawdzenie poprawności pola tekstowego

		 $text_message = $_POST['pole'];
		 $text_message=htmlentities($text_message,ENT_QUOTES,"UTF-8");


		 if(strlen($text_message)<1)
		 {
			$all_OK=false;
			$_SESSION['error_text_message']="To pole nie może pozostać puste!";
		 }

		 //Sprawdzenie RECAPTCHA
			$secret = '6LdapC8UAAAAAN0eNlVKXTfkNfgX4QR_bFW9e36d';
			$check = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secret.'&response='.$_POST['g-recaptcha-response']);
			$response=json_decode($check);

			if($response->success==false)
			{
				$all_OK=false;
				$_SESSION['error_boot']="Potwierdź, że nie jesteś bootem!";

			}

		//Zapamiętywanie wprowadzonych danych
		$_SESSION['remember_name']=$name;
		$_SESSION['remember_tel']=$tel;
		$_SESSION['remember_email']=$email;
		$_SESSION['remember_message']=$text_message;



		 //Ostateczne sprawdzenie
		 if($all_OK==true)
		 {
			$_SESSION['send']="Twoja wiadomość została wysłana!";
			$odkogo = "wojciech.blochowiak@bbt-wibrem.pl";
			$dokogo = "wojciech.blochowiak@bbt-wibrem.pl";
			$tytul = "Formularz kontaktowy";
			$wiadomosc = "";
			$wiadomosc .= "Imię i nazwisko: ". $name . "\n";
			$wiadomosc .= "Tel.: " . $tel . "\n";
			$wiadomosc .= "E-mail: " . $email . "\n";
			$wiadomosc .= "Wiadomość: " . $text_message . "\n";
			$success = mail($dokogo, $tytul, $wiadomosc, $odkogo);

			unset($_SESSION['remember_name']);
			unset($_SESSION['remember_tel']);
			unset($_SESSION['remember_email']);
			unset($_SESSION['remember_message']);
		 }
    }
?>
	<!--=====HEAD=====-->
	<?php
		include("php.components/head.php");
	?>
	<!--================-->
	<title>BBT - WIBREM kontakt</title>
	<meta name="DC.Title" content="BBT - WIBREM kontakt">
	<script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
	<!--=====HEADER=====-->
	<?php
		include("php.components/header.php");
	?>
	<!--================-->
	<div id="map"></div>
	<div  class="container">
		<main class="mainContact">
			<h1>Kontakt z BBT - WIBREM Sp. z o.o.</h1>
			<address>
				<p>Adres:</p>
				<p><strong>ul. Piękna 66</strong><br />
					50-506 Wrocław<br />
					NIP: 8992795402<br />
					REGON: 365093668</p>
				<p>Telefon:</p>
				<p>+48 600 801 784</p>
				<p>E-mail:</p>
				<p> wojciech.blochowiak&#64;bbt-wibrem.pl</p>	
			</address>	
			<form class="form" method="post">
				<label for="name">Imię i Nazwisko</label>
				<div class="place-for-error">
				<?php
					if(isset($_SESSION['error_name']))
					{
						echo '<div class="error">'.$_SESSION['error_name'].'</div>';
						unset($_SESSION['error_name']);
					}
				?>
				</div>
				<input name="name" type="text" autofocus value="<?php if(isset($_SESSION['remember_name']))
				{
					echo $_SESSION['remember_name'];
					unset($_SESSION['remember_name']);	
				}
				?>">
				<label for="tel">Nr telefonu</label>
				<span class="place-for-error">
				<?php if(isset($_SESSION['error_tel']))
					{
						echo '<div class="error">'.$_SESSION['error_tel'].'</div>';
						unset($_SESSION['error_tel']);
					}
				?>
				</span>
				<input name="tel" type="tel" value="<?php if(isset($_SESSION['remember_tel']))
				{
					echo $_SESSION['remember_tel'];
					unset($_SESSION['remember_tel']);

				}?>">	
				<label for="email">Adres e-mail<em>*</em></label>
				<div class="place-for-error">
				<?php if(isset($_SESSION['error_email']))
				{
					echo '<div class="error">'.$_SESSION['error_email'].'</div>';
					unset($_SESSION['error_email']);
				}
				?>
				</div>
				<input name="email" type="email" value="<?php if(isset($_SESSION['remember_email']))
				{
					echo $_SESSION['remember_email'];
					unset($_SESSION['remember_email']);
				}?>">		
				<label for="message">Treść wiadomości<em>*</em></label>
				<div class="place-for-error"><?php if(isset($_SESSION['error_text_message']))
				{
					echo '<div class="error">'.$_SESSION['error_text_message'].'</div>';
					unset($_SESSION['error_text_message']);
				}?>
				</div>
				<textarea name="pole" type="text"><?php if(isset($_SESSION['remember_message']))
				{
					echo $_SESSION['remember_message'];
					unset($_SESSION['remember_message']);
				}?></textarea>	
				<input class="button" type="submit" value="wyślij">
				<div class="g-recaptcha" data-sitekey="6LdapC8UAAAAAHBtovAqc2SGZG-sJboVNHWSFOEM"></div><br />
				<?php if(isset($_SESSION['error_boot']))
				{
					echo '<div class="error">'.$_SESSION['error_boot'].'</div>';
					unset($_SESSION['error_boot']);
				}
				?>
				<?php if(isset($_SESSION['send']))
				{
					echo '<div class="send">'.$_SESSION['send'].'</div>';
					unset($_SESSION['send']);
				}
				?>
			</form>	
			<div style="clear:both"></div>	
		</main>
	</div>
<!--=====FOOTER=====-->
<?php
	include("php.components/footer.php");
?>
<!--================-->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="js/tools.js"></script>
<script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCGVsLhlM29B4THUcscE7Og5n_9aqZm1lI&callback=initMap"
  type="text/javascript"></script>
</body>
</html>

