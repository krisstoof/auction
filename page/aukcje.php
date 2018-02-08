				<section class="listing-page">
					<div class="container">
						<div class="row">
							<div id="sidebar" class="col-md-3">
								<div class="sidebar-content">
									<div class="head-side-bar">
										<h4>Szczegóły</h4>
									</div>
									<div class="search-form">
									<form action="./" method="get">
										<input type="hidden" name="page" value="aukcje">
										<input type="hidden" name="s" value="<?php echo $_GET['s'];?>">
										<div class="select">
		                                    <select name="kat1" id="make">
		                                        <option value="0">Wybierz lokalizacje</option>
												<?php
												$i = 1;
												foreach ($kat1s as $kat){
													echo '<option value="'.$i.'"';
													if($_GET['kat1'] == $i) echo ' selected';
													echo '>'.$kat.'</option>';
													$i++;
												} ?>
		                                    </select>
		                                </div>
		                                <div class="select">
		                                    <select name="kat2" id="model">
		                                        <option value="0">Wybierz kategorię</option>
												<?php
												$i = 1;
												foreach ($kat2s as $kat){
													echo '<option value="'.$i.'"';
													if($_GET['kat2'] == $i) echo ' selected';
													echo '>'.$kat.'</option>';
													$i++;
												} ?>
		                                    </select>
		                                </div>
										<button style="border:0;background-color:#f4c23d;width:100%;">
		                                <div class="advanced-button">
											<a>Szukaj<i class="fa fa-search"></i></a>
										</div>
										</button>
									</form>
									</div>
								</div>
							</div>
							<div id="listing-ofertts" class="col-md-9">
								<div class="pre-featured">
									<div class="right-content">
										<div class="input-select">
											<select style="cursor: pointer;" 
													onchange="window.location.href='./?page=<?php echo $_GET['page'];?>&s=<?php echo $_GET['s'];?>&sort='+this.value+'&kat1=<?php echo $_GET['kat1']; ?>&kat2=<?php echo $_GET['kat2'];?>'">
												<option value="1"<?php if($_GET['sort']==1)echo " selected";?>>Data: najnowsze</option>
												<option value="2"<?php if($_GET['sort']==2)echo " selected";?>>Data: najstarsze</option>
												<option value="3"<?php if($_GET['sort']==3)echo " selected";?>>Nazwa: A-Z</option>
												<option value="4"<?php if($_GET['sort']==4)echo " selected";?>>Nazwa: Z-A</option>
												<option value="5"<?php if($_GET['sort']==5)echo " selected";?>>Cena: najtańsze</option>
												<option value="6"<?php if($_GET['sort']==6)echo " selected";?>>Cena: najdroższe</option>
											</select>
										</div>
										<div class="input-select">
										<a href="./noweogloszenie">
											<button class="simple-button11" name="log" type="submit" style="width: 140px;margin-left:20px;">
												Dodaj ogłoszenie</button></a>
										</div>
				<?php //$wher = "";
				$wher = "WHERE unix_timestamp(date)+604800 > '".time()."' ";
				if($_GET['kat1'] != 0 || $_GET['kat2'] != 0 || $_GET['s'] != ''){
					$wher .= "and ";
					if($_GET['kat1'] != 0)$wher .= "`kat1`=".$_GET['kat1'];
					if($_GET['kat1'] != 0 && $_GET['kat2'] != 0)$wher .= " and ";
					if($_GET['kat2'] != 0)$wher .= "`kat2`=".$_GET['kat2'];
					
					if($_GET['s'] != ''){
						if($_GET['kat1'] != 0 || $_GET['kat2'] != 0)$wher .= " and ";
						$expl = explode(" ", $_GET['s']);
						$f=1;
						foreach($expl as $exple){
							if($f > 1)$wher.=" and ";$f++;
							$wher.="(`desc` LIKE '%".$exple."%' OR `name` LIKE '%".$exple."%')";
						}
					}
				}
				$dbc1 = $db->prepare("SELECT count(*) FROM aukcje ".$wher);
				$dbc1->execute();$row = $dbc1->fetch();$rows = ceil($row[0] / 10);
				$gett = '?page='.$_GET['page'].'&s='.$_GET['s'].'&sort='.$_GET['sort'].'&kat1='.$_GET['kat1'].'&kat2='.$_GET['kat2'].'&p=';
				?>
		                                <div class="grid-list">
					<a href="./<?php echo $gett.($_GET['p'] - 1);?>" title="Poprzednia strona"<?php if($_GET['p'] <= 1) echo ' class="inactivep"';?>><i class="fa fa-arrow-left"></i></a>
					<span><input name="p" type="text" onkeypress="if (event.keyCode==13) window.location.href='./<?php echo $gett;?>'+this.value" value="<?php echo $_GET['p'];?>" style="width: 22px;height: 22px" /> z <span><?php echo $rows;?></span></span>
					<a href="./<?php echo $gett.($_GET['p'] + 1);?>" title="Następna strona"<?php if($_GET['p'] >= $rows) echo ' class="inactivep"';?>><i class="fa fa-arrow-right"></i></a>
		                                </div>
									</div>
								</div>
				<?php
				switch($_GET['sort']){
					default:
					case 1:$dba1="date DESC";break;
					case 2:$dba1="date ASC";break;
					case 3:$dba1="name ASC";break;
					case 4:$dba1="name DESC";break;
					case 5:$dba1="price ASC";break;
					case 6:$dba1="price DESC";break;
				}
				
				if(is_numeric($_GET['p'])) $pag = $_GET['p'] * 10 - 10;
				$dbc1 = $db->prepare("SELECT * FROM aukcje ".$wher." ORDER BY ".$dba1." LIMIT ".$pag.",10");
				$dbc1->execute();$i = 0;
				
				while($row = $dbc1->fetch()){
				?>
								<div class="featured-item"><a href="ogloszenie&id=<?php echo $row['id']; ?>">
									<div class="right-content">
										<h2><?php echo $row['name']; ?></h2>
										<span><?php echo $row['price']; ?>.-</span>
										<div class="light-line"></div>
										<p><?php echo $row['desc']; ?></p>
										<div class="ofer-info">
											<ul>
												<li><i class="fa fa-map-marker" style="margin-left: 0;"></i><?php echo $kat1s[$row['kat1']-1]; ?></li>
												<li style="border: 0;"><i class="fa fa-info-circle"></i><?php echo $kat2s[$row['kat2']-1]; ?></li>
												<li style="float: right;"><i class="fa fa-clock-o"></i><?php echo $row['date']; ?></li>
											</ul>
										</div>
									</div></a>
								</div>
				<?php $i++;}
				if ($i == 0) echo 'Nie znaleziono ofert.';
				?>

								<div class="pagination">
									<div class="prev">
										<a href="./<?php echo $gett.($_GET['p'] - 1);?>"<?php if($_GET['p'] <= 1) echo ' class="inactivep"';?>><i class="fa fa-arrow-left"></i>Prev</a>
									</div>
									<div class="page-numbers">
										<ul>
											<?php
										if($rows > 0){
											if($_GET['p'] != 1) echo '<li><a href="./'.$gett.'1">1</a></li>';
											if($_GET['p'] != 1 && $_GET['p'] != 2 && $_GET['p'] != 3) echo '<li>...</li>';
											if($_GET['p'] != 1 && $_GET['p'] != 2){
												echo'<li><a href="./'.$gett.($_GET['p'] - 1).'">'.($_GET['p'] - 1).'</a></li>';}
											echo '<li class="active"><a href="./'.$gett.$_GET['p'].'">'.$_GET['p'].'</a></li>';
											if($_GET['p'] != $rows && $_GET['p'] != $rows - 1 && ($_GET['p'] != $rows - 2 || $_GET['p'] == 1)){
												echo '<li><a href="./aukcje'.$gett.($_GET['p'] + 1).'">'.($_GET['p'] + 1).'</a></li>';
											}
											if($_GET['p'] != $rows && $_GET['p'] != $rows - 1 && $_GET['p'] + 1 != $rows - 1) echo '<li>...</li>';
											if($_GET['p'] != $rows) echo '<li><a href="./'.$gett.$rows.'">'.$rows.'</a></li>';
										}else
										echo '<li><a href="./'.$gett.'1">1</a></li>';
											?>
										</ul>
									</div>
									<div class="next">
										<a href="./<?php echo $gett.($_GET['p'] + 1);?>"<?php if($_GET['p'] >= $rows) echo ' class="inactivep"';?>>Next<i class="fa fa-arrow-right"></i></a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>