<?php
$result = 0;
if(isset($_POST['log'])){
	if(!isset($_POST['email']) || !isset($_POST['pass1']))$result = 1;//brak email/hasla
	else{
		$dbc1 = $db->prepare("SELECT * FROM users WHERE email = :email");
		$dbc1->bindParam(':email', $_POST['email'], PDO::PARAM_STR, 80);
		$dbc1->execute();
		if($dbc1->rowCount() != 1)$result = 1;//nie znaleziono email
		else{
			$dbc1 = $dbc1->fetch();
			if($dbc1['pass'] != md5($_POST['pass1']))$result = 1;//nie prawidlowe haslo
			else{
				session_regenerate_id();
				$_SESSION['userid'] = $dbc1['index'];
				$_SESSION['email'] = $dbc1['email'];
				session_write_close();
				$result = 4;//zalogowano
			}
		}
	} 
}
elseif(isset($_POST['reg'])){
	if(!isset($_POST['input1']) || !strrpos($_POST['input1'], " ")
		 || strlen($_POST['input1']) < 6 || strlen($_POST['input1']) > 60)$result = 5;//nie poprawne imie nazwisko
	else if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $result = 6;//nie poprawny email
	else if(!isset($_POST['phone']) || strlen($_POST['phone']) < 9 || strlen($_POST['phone']) > 12) $result = 12;//za krotki/dlugi nr tel
	else if(!isset($_POST['pass1']) || strlen($_POST['pass1']) < 6 || strlen($_POST['pass1']) > 30) $result = 7;//za krotkie/dlugie haslo
	else if(!isset($_POST['pass2']) || strcmp($_POST['pass1'], $_POST['pass2']) != 0)$result = 8;//powtorzone haslo sie nie zgadza
	else{
		$dbc1 = $db->prepare("SELECT max(data) FROM users WHERE ip = :ip");
		$dbc1->bindParam(':ip', $_SERVER["REMOTE_ADDR"], PDO::PARAM_STR, 15);
		$dbc1->execute();// HTTP_X_REAL_IP
		$dbr1 = $dbc1->fetch();
		if((time() - strtotime($dbr1[0])) < (60*2)) $result = 9;//anti flood
		else{
			$dbc1 = $db->prepare("SELECT count(*) FROM users WHERE email = :email");
			$dbc1->bindParam(':email', $_POST['email'], PDO::PARAM_STR, 80);
			$dbc1->execute();
			$dbr1 = $dbc1->fetch();
			if($dbr1[0] != 0) $result = 10;//email istnieje juz w bazie
			else{
				$dbc1 = $db->prepare("INSERT INTO users (email, pass, date, input1, ip, phone) VALUES
						(:email, '".md5($_POST['pass1'])."', '".date("Y-m-d H:i:s")."', :input1, '".$_SERVER["REMOTE_ADDR"]."', :phone)");
				$dbc1->bindParam(':email', $_POST['email'], PDO::PARAM_STR, 80);
				$dbc1->bindParam(':input1', $_POST['input1'], PDO::PARAM_STR, 60);
				$dbc1->bindParam(':phone', $_POST['phone'], PDO::PARAM_STR, 12);
				if($dbc1->execute())$result = 11;//zarejestrowano
			}
		}
	}
}
?>
<section class="plans">
	<div class="container">
<?php
switch($result){
	case 1: $echo = 'Podany email i hasło nie pasują do siebie';break;
	case 4: $echo = 'Zalogowano pomyślnie';break;
	case 5: $echo = 'Imię i nazwisko jest nie poprawne';break;
	case 6: $echo = 'Email jest nie poprawny';break;
	case 7: $echo = 'Hasło musi mieć od 6 do 30 znaków';break;
	case 8: $echo = 'Powtórzone hasło musi być takie same';break;
	case 9: $echo = 'Anti flood - 1 konto na 2 minuty';break;
	case 10:$echo = 'Email istnieje w naszej bazie';break;
	case 11:$echo = 'Konto zarejestrowane poprawnie';break;
	case 12:$echo = 'Numer telefonu jest nie poprawny';break;
}
if(isset($echo))echo '<div class="alert alert-warning text-center">'.$echo.'</div>';
?>
		<div class="row">
			<div class="col-md-12">
				<div class="heading-section-2 text-center">
					<h2>Logowanie</h2>
					<div style="width:360px;margin-left: auto;margin-right: auto;">
					<form method="post">
						<input type="text" class="form-control" name="email" placeholder="Adres E-Mail" value="" maxlength="90"></br>
						<input type="password" class="form-control" name="pass1" placeholder="Hasło" maxlength="30"></br>
						<button type="submit" name="log" class="simple-button11">Zaloguj się</button></br>
					</form>
						</br><div style="height: 1px;background-color: #aaaaaa;"></div></br></br>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="heading-section-2 text-center">
					<h2>Rejestracja</h2>
					<div style="width:360px;margin-left: auto;margin-right: auto;">
					<form method="post">
						<input type="text" class="form-control" name="input1" placeholder="Imię i Nazwisko" value="" maxlength="30"></br>
						<input type="text" class="form-control" name="email" placeholder="Adres E-Mail" value="" maxlength="90"></br>
						<input type="password" class="form-control" name="pass1" placeholder="Hasło" value="" maxlength="30"></br>
						<input type="password" class="form-control" name="pass2" placeholder="Powtórz hasło" maxlength="30"></br>
						<input type="text" class="form-control" name="phone" placeholder="Numer telefonu" value="" maxlength="12"></br>
						<button type="submit" name="reg" class="simple-button11">Zarejestruj się</button>
					</form>
					</div></br>
				</div>
			</div>
		</div>
		
		
	</div>
</section>
