<?php
	session_start();
	include_once "assets/config.php";//config
	try{$db = new PDO("mysql:host=".$dbip.";dbname=".$dbn1, $dbus, $dbps);}
	catch(PDOException $e){die('Błąd łączenia bazy danych');}
	
	$kat1s = array('dolnośląskie', 'kujawsko-pomorskie', 'lubelskie', 'lubuskie', 'łódzkie', 
		'małopolskie', 'mazowieckie', 'opolskie', 'podkarpackie', 'podlaskie', 'pomorskie', 'śląskie', 
		'świętokrzyskie', 'warmińsko-mazurskie', 'wielkopolskie', 'zachodniopomorskie');
		
	$kat2s = array('do 30m', 'do 1h', 'do 2h', 'do 6h', 'do 12h', 
		'do 16', 'do 24h', 'do 48h', 'do 96h', 'do tygodnia');

	if(empty($_GET['sort']) || !is_numeric($_GET['sort']))$_GET['sort']=0;
	if(empty($_GET['kat1']) || !is_numeric($_GET['kat1']))$_GET['kat1']=0;
	if(empty($_GET['kat2']) || !is_numeric($_GET['kat2']))$_GET['kat2']=0;
	if(empty($_GET['s']) || !ctype_alnum(str_replace(' ','',$_GET['s'])))$_GET['s']='';
	if(isset($_POST['logout'])){
		$_SESSION = array();
		session_destroy();
	}
	if(!isset($_GET['page'])) $_GET['page']='index';
	if(empty($_GET['p']))$_GET['p'] = 1;
?>
<!doctype html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <title>uslugi.us - Aukcje z usługami</title>
    <meta name="description" content="uslugi.us - Aukcje z usługami" />
    <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
    <meta name="robots" content="index,follow,all" />

    <link href='https://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link href='https://fonts.googleapis.com/css?family=Roboto:400,300,500,700' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="assets/css/bootstrap.css">
	<link rel="stylesheet" href="assets/css/font-awesome.css">
	<link rel="stylesheet" href="assets/css/auction.css">
</head>
<body>
	<div class="sidebar-menu-container" id="sidebar-menu-container">
		<div class="sidebar-menu-push">
			<div class="sidebar-menu-overlay"></div>
			<div class="sidebar-menu-inner">

				<header class="site-header">
						<div class="containerz">
							<nav class="main-navigation text-left">
								<ul>
									<li><a href="./"><img src="assets/images/logo.png" alt=""></a></li>
									<li><a href="./">Główna</a></li>
									<li><a href="./aukcje">Aukcje</a></li>
									<li><a href="./onas">O nas</a></li>
									<li><a href="./login">Konto</a></li>
									<li>
									<?php
									if(isset($_SESSION['email'])){
										$dbc1 = $db->prepare("SELECT * FROM users WHERE email = '".$_SESSION['email']."'");
										$dbc1->execute();
										$dbr1 = $dbc1->fetch();
										?>
										<div style="margin-left:50px;">
											Witaj, <?php echo $dbr1['input1']; ?>
											<form method="post" style="display: inline;">
											<button class="simple-button11" name="logout" type="submit" style="height: 26px;line-height: 25px;width: 75px;">Wyloguj</button>
											</form>
										</div>
									<?php
									}elseif(isset($_POST['logout'])) echo '<div style="margin-left:50px;">Wylogowano pomyślnie</div>';
									elseif($_GET['page'] == 'login');
									else{ ?>
										<div id="example11" class="more">
											<form action="./login" method="post">
												<input type="text" name="email" placeholder="Email" value="">
												<input type="password" name="pass1" placeholder="Hasło" value="">
												<button type="submit" name="log" style="background-color:#f1f7fb;border:0;" value="">
													<i class="fa fa-sign-in"></i></button>
											</form>
										</div>
									<?php } ?>
									</li>
									<li>
										<div id="example" class="more">
											<form action="./" method="get">
												<input type="hidden" name="page" value="aukcje">
												<input type="hidden" name="kat1" value="<?php echo $_GET['kat1'];?>">
												<input type="hidden" name="kat2" value="<?php echo $_GET['kat2'];?>">
												<input type="text" name="s" placeholder="Wyszukiwarka" value="">
												<button class="hideLink" type="submit" style="width: 40px;background-color:transparent;border: 0 none;right: 5px;" value="">
												<i class="fa fa-search"></i>
												</button>
											</form>
										</div>
									</li>
								</ul>
							</nav>
						</div>
				</header>
	<?php
	$inc = "page/".basename($_GET['page']).".php";
	if(file_exists($inc))include $inc;
		else echo '<section class="plans"><div class="container"><div class="alert alert-warning text-center"><h2>Błąd 404 - Strona nie istnieje</h2></section></div>';
	?>
				<div id="sub-footer">
					<div class="container">
						<div class="row">
							<div class="col-md-6 col-sm-12">
								<p>Copyrights &copy;2016 <em>PARAGON</em>. <small>Strona wykorzystuje pliki Cookies.</small></p>
							</div>
							<div class="col-md-6 col-sm-12">
								<ul>
									<li><a href="./">Główna</a></li>
									<li><a href="./aukcje">Aukcje</a></li>
									<li><a href="./onas">O nas</a></li>
									<li><a href="./login">Rejestracja</a></li>
									<li><a href="./konto">Konto</a></li>
									<li><a href="./noweogloszenie">Dodaj ofertę</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
    </body>
</html>