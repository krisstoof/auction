<section class="plans">
	<div class="container">
		<div class="row">
<?php
if(!isset($_SESSION['userid']))
	echo '<div class="alert alert-warning"> Aby dodać ofertę musisz się zalogować </div>';
else{
if(isset($_POST['add'])){
	if(strlen($_POST['name']) < 6 || strlen($_POST['name']) > 80)
		echo '<div class="alert alert-warning">Długość nazwy ogłoszenia to od 6 do 80 znaków</div>';
	else if(!is_numeric($_POST['kat1']) || $_POST['kat1'] == 0)
		echo '<div class="alert alert-warning">Kategoria jest nie poprawna</div>';
	else if(!is_numeric($_POST['kat2']) || $_POST['kat2'] == 0)
		echo '<div class="alert alert-warning">Lokalizacja jest nie poprawna</div>';
	else if(strlen($_POST['desc']) < 8 || strlen($_POST['desc']) > 400)
		echo '<div class="alert alert-warning">Długość opisu ogłoszenia to od 8 do 400 znaków</div>';
	else if(!is_numeric($_POST['reward']) || strlen($_POST['reward']) > 15)
		echo '<div class="alert alert-warning">Wynagrodzenie może zawierać tylko 15 cyfr</div>';
	else if(!is_numeric($_POST['price']) || strlen($_POST['price']) > 15)
		echo '<div class="alert alert-warning">Cena może zawierać tylko 15 cyfr</div>';
	else if(strlen($_POST['date2']) < 4 || strlen($_POST['date2']) > 22)
		echo '<div class="alert alert-warning">Długość daty realizacji to od 4 do 22 znaków</div>';
	else if(strlen($_POST['place']) < 4 || strlen($_POST['place']) > 32)
		echo '<div class="alert alert-warning">Miejscowość musi zawierać od 4 do 32 znaków</div>';
	else if(strlen($_POST['input1']) > 200)
		echo '<div class="alert alert-warning">Maksymalna długość wymagań ogłoszenia to 200 znaków</div>';
	else if(strlen($_POST['input2']) > 200)
		echo '<div class="alert alert-warning">Maksymalna długość oferty ogłoszenia to 200 znaków</div>';
	else{
		$dbc1 = $db->prepare("INSERT INTO aukcje (`date`, `name`, `desc`, `uid`, `kat1`, `kat2`, `reward`, `price`, `date2`, `place`, `input1`, `input2`) 
			VALUES('".date("Y-m-d H:i:s")."', :name, :desc, '".$_SESSION['userid']."', :kat1, :kat2, :reward, :price, :date2, :place, :input1, :input2)");
		$dbc1->bindParam(':name', $_POST['name'], PDO::PARAM_STR, 80);
		$dbc1->bindParam(':desc', $_POST['desc'], PDO::PARAM_STR, 400);
		$dbc1->bindParam(':kat1', $_POST['kat1'], PDO::PARAM_INT, 2);
		$dbc1->bindParam(':kat2', $_POST['kat2'], PDO::PARAM_INT, 2);
		$dbc1->bindParam(':reward', $_POST['reward'], PDO::PARAM_INT, 15);
		$dbc1->bindParam(':price', $_POST['price'], PDO::PARAM_INT, 15);
		$dbc1->bindParam(':date2', $_POST['date2'], PDO::PARAM_STR, 22);
		$dbc1->bindParam(':place', $_POST['place'], PDO::PARAM_STR, 32);
		$dbc1->bindParam(':input1', $_POST['input1'], PDO::PARAM_STR, 200);
		$dbc1->bindParam(':input2', $_POST['input2'], PDO::PARAM_STR, 200);
		$dbc1->execute();
		echo '<div class="alert alert-warning">Ogłoszenie zostało dodane</div>';
	}
}
?>
			<div class="col-md-12">
				<div class="heading-section-2 text-center">
					<h2>Nowe ogłoszenie</h2>
					<div style="width:360px;margin-left: auto;margin-right: auto;">
					<form method="post">
						<input type="text" class="form-control" name="name" placeholder="Nazwa oferty" value="" maxlength="30"></br>
				<select name="kat1" class="selected-item" style="cursor:pointer;padding:4px;width:170px;">
					<option value="0">Lokalizacja</option>
					<?php
					$i = 1;
					foreach ($kat1s as $kat){
						echo '<option value="'.$i.'">'.$kat.'</option>';
						$i++;
					} ?>
				</select>&nbsp;&nbsp;&nbsp;
				<select name="kat2" class="selected-item" style="cursor:pointer;padding:4px;width:170px;">
					<option value="0">Kategoria</option>
					<?php
					$i = 1;
					foreach ($kat2s as $kat){
						echo '<option value="'.$i.'">'.$kat.'</option>';
						$i++;
					} ?>
				</select></br></br>
					<input type="text" class="form-control" name="reward" placeholder="Wynagrodzenie" value="" maxlength="15"></br>
					<input type="text" class="form-control" name="price" placeholder="Cena" value="" maxlength="15"></br>
					<input type="text" class="form-control" name="date2" placeholder="Data realizacji" value="" maxlength="22"></br>
					<input type="text" class="form-control" name="place" placeholder="Miejscowość" value="" maxlength="32"></br>
						Opis ogłoszenia:</br>
						<textarea name="desc" style="width:360px;height:120px;"></textarea></br></br>
						Lista zakupów(kolejne w nowej linii):</br>
						<textarea name="input1" style="width:360px;height:120px;"></textarea></br></br>
						Oferta(kolejne w nowej linii):</br>
						<textarea name="input2" style="width:360px;height:120px;"></textarea></br></br>
						Ogłoszenia automatycznie wygasają po 7 dniach</br>
						<button type="submit" name="add" class="simple-button11">Dodaj ofertę</button>
					</form>
					</div></br>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>