				<section class="ofer-details">
					<div class="container">
<?php
	if(empty($_GET['id']) || !is_numeric($_GET['id']))$_GET['id']=0;
		$dbc1 = $db->prepare("SELECT * FROM aukcje WHERE id = :id");
		$dbc1->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$dbc1->execute();
		$row = $dbc1->fetch();
		
		if($row[0] == 0)
			echo '<div class="alert alert-warning text-center"> Nie prawidłowy numer oferty. </div>';
		else
		if(isset($_POST['del']) && !empty($_SESSION['userid']) && $_SESSION['userid'] == $row['uid']){
			$dbc1 = $db->prepare("DELETE FROM aukcje WHERE id = :id");
			$dbc1->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
			$dbc1->execute();
			echo '<div class="alert alert-warning text-center">Ogłoszenie zostało usunięte</div>';
		}
		else
if(isset($_POST['save']) && !empty($_SESSION['userid']) && $_SESSION['userid'] == $row['uid']){
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
		$dbc1 = $db->prepare("UPDATE aukcje SET `name`=:name, `desc`=:desc, `kat1`=:kat1, `kat2`=:kat2, `reward`=:reward, 
						`price`=:price, `date2`=:date2, `place`=:place, `input1`=:input1, `input2`=:input2 WHERE id=:id");
		$dbc1->bindParam(':name', $_POST['name'], PDO::PARAM_STR, 80);
		$dbc1->bindParam(':desc', $_POST['desc'], PDO::PARAM_STR, 400);
		$dbc1->bindParam(':kat1', $_POST['kat1'], PDO::PARAM_INT, 2);
		$dbc1->bindParam(':kat2', $_POST['kat2'], PDO::PARAM_INT, 2);
		$dbc1->bindParam(':reward', $_POST['reward'], PDO::PARAM_INT, 15);
		$dbc1->bindParam(':price', $_POST['price'], PDO::PARAM_INT, 15);
		$dbc1->bindParam(':date2', $_POST['date2'], PDO::PARAM_STR, 15);
		$dbc1->bindParam(':place', $_POST['place'], PDO::PARAM_STR, 15);
		$dbc1->bindParam(':input1', $_POST['input1'], PDO::PARAM_STR, 200);
		$dbc1->bindParam(':input2', $_POST['input2'], PDO::PARAM_STR, 200);
		$dbc1->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
		$dbc1->execute();
		echo '<div class="alert alert-warning text-center">Zmiany ogłoszenia zostały zapisane</div>';
	}
$dbc1 = $db->prepare("SELECT * FROM aukcje WHERE id = :id");
$dbc1->bindParam(':id', $_GET['id'], PDO::PARAM_INT);
$dbc1->execute();
$row = $dbc1->fetch();
}
				?>

						<div class="row">
						<form method="post" style="display:inline;">
							<div id="single-car" class="col-md-8">
								<div class="up-content clearfix">
									<h2><?php
									if(isset($_POST['edit']))echo '<input type="text" class="form-control" name="name" placeholder="Nazwa oferty" value="'.$row['name'].'" maxlength="30">';
									else echo $row['name'];
									?></h2>
									<span><?php echo $row['price']; ?> .-</span>
								</div>
								<div class="tab">
									<div class="tabs">
									    <div class="tab-content">							 
									        <div id="tab2" class="tab active">
									        	<h6>Coś tam, coś tam, nie zmienny tekst, jakaś informacja.</h6>
									            <p><?php
												if(isset($_POST['edit']))echo '<textarea name="desc" style="width:360px;height:120px;">'.$row['desc'].'</textarea>';
												else echo nl2br($row['desc']); ?></p>
									        </div>
									    </div>
									    <div class="more-info">
									    	<div class="row">
									    		<div class="first-info col-md-4">
										    		<h4>Lista zakupów</h4>
										    		<ul>
														<?php
														if(isset($_POST['edit']))echo '<textarea name="input1" style="width:250px;height:120px;">'.$row['input1'].'</textarea>';
														else if($row['input1']!=''){
														$expl = explode("\n", $row['input1']);
														foreach($expl as $exple)
															echo '<li><i class="fa fa-check"></i>'.implode(' ', str_split($exple, 15)).'</li>';
														}else echo '<li><i class="fa fa-times" style="color:red;"></i>Brak informacji</li>';
														?>
										    		</ul>
										    	</div>
										    	<div class="second-info col-md-4">
										    		<h4>Oferta</h4>
										    		<ul>
														<?php
														if(isset($_POST['edit']))echo '<textarea name="input2" style="width:250px;height:120px;">'.$row['input2'].'</textarea>';
														else if($row['input2']!=''){
														$expl = explode("\n", $row['input2']);
														foreach($expl as $exple)
															echo '<li><i class="fa fa-check"></i>'.implode(' ', str_split($exple, 15)).'</li>';
														}else echo '<li><i class="fa fa-times" style="color:red;"></i>Brak informacji</li>';
														?>
										    		</ul>
										    	</div>
									    	</div>
									    </div>
									</div>
								</div>
							</div>
							<div id="left-info" class="col-md-4">
								<div class="details">
									<div class="head-side-bar">
										<h4>Szczegóły ogłoszenia</h4>
									</div>
									<div class="list-info">
										<ul>
											<li><span>Lokalizacja:</span><?php if(isset($_POST['edit'])){ ?>
											<select name="kat1" class="selected-item" style="cursor:pointer;padding:4px;width:170px;">
					<option value="0">Lokalizacja</option>
					<?php
					$i = 1;
					foreach ($kat1s as $kat){
						echo '<option value="'.$i.'"';
						if($i == $row['kat2'])echo ' selected';
						echo '>'.$kat.'</option>';
						$i++;
					} ?>
				</select>
											<?php }else
											if(!empty($row['kat1']))echo $kat1s[$row['kat1']-1];?></li>
											<li><span>Kategoria:</span><?php if(isset($_POST['edit'])){?>
											<select name="kat2" class="selected-item" style="cursor:pointer;padding:4px;width:170px;">
					<option value="0">Kategoria</option>
					<?php
					$i = 1;
					foreach ($kat2s as $kat){
						echo '<option value="'.$i.'"';
						if($i == $row['kat2'])echo ' selected';
						echo '>'.$kat.'</option>';
						$i++;
					} ?>
				</select>
											<?php }else
											if(!empty($row['kat2']))echo $kat2s[$row['kat2']-1];?></li>
											<li><span>Data dodania:</span><?php echo $row['date']; ?></li>
											<li><span>Data realizacji:</span><?php
											if(isset($_POST['edit']))echo '<input type="text" class="form-control" name="date2" placeholder="Data realizacji" value="'.$row['date2'].'" maxlength="15" style="display:inline;width:100px;">';
											else echo $row['date2']; ?></li>
										<?php
										$dbc1 = $db->prepare("SELECT * FROM users WHERE `index` = '".$row['uid']."'");
										$dbc1->execute();
										$dbr2 = $dbc1->fetch();
										?>
											<li><span>Dodał:</span><?php echo $dbr2['input1']; ?></li>
											<li><span>Kontakt (email):</span><?php echo $dbr2['email']; ?></li>
											<li><span>Kontakt (telefon):</span><?php echo $dbr2['phone']; ?></li>
											<li><span>Miejscowość:</span><?php
											if(isset($_POST['edit']))echo '<input type="text" class="form-control" name="place" placeholder="Miejscowość" value="'.$row['place'].'" maxlength="15" style="display:inline;width:100px;">';
											else echo $row['place']; ?></li>
											<li><span>Wynagrodzenie:</span><?php
											if(isset($_POST['edit']))echo '<input type="text" class="form-control" name="reward" placeholder="Wynagrodzenie" value="'.$row['reward'].'" maxlength="15" style="display:inline;width:100px;">';
											else echo $row['reward']; ?> .-</li>
											<li><span>Cena:</span><?php
											if(isset($_POST['edit']))echo '<input type="text" class="form-control" name="price" placeholder="Cena" value="'.$row['price'].'" maxlength="15" style="display:inline;width:100px;">';
											else echo $row['price']; ?> .-</li>
											<?php
											if(!empty($_SESSION['userid']) && $row['uid'] == $_SESSION['userid']){
											?>
											<li><span>Opcje ogłoszenia:</span>
											<button type="submit" name="del" class="simple-button11" style="height:20px;width:44px;line-height:20px;">Usuń</button>
											<?php
											if(!isset($_POST['edit']))
												echo '<button type="submit" name="edit" class="simple-button11" style="height:20px;width:56px;line-height:20px;">Edytuj</button>';
											else echo '<button type="submit" name="save" class="simple-button11" style="height:20px;width:56px;line-height:20px;">Zapisz</button>';
											?>
											</li>
											<?php
											}
											?>
										</ul>
									</div> 
								</div>
							</div>
							</form>
						</div>
					</div>
				</section>