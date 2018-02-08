				<section class="why-us">
					<div class="containerz">
						<div class="row">
							<div class="col-md-12">
								<div class="left-content">
									<div class="heading-section">
										<h2>Dlaczego my?</h2>
										<a href="./login">
											<button class="simple-button11" name="log" type="submit" style="width: 200px;margin-left:20px;float:right;height:60px;font-size:16px;">
												Zarejestruj się</button></a>
										<span>
											Łatwe i szybkie dodawanie ogłoszeń, czytelne ogłoszenia, atrakcyjne ceny
											</br>
										</span>
										<div class="line-dec"></div>
									</div>
									<div class="services">
										<div class="col-md-6">
											<div class="service-item">
												<i class="fa fa-bar-chart-o"></i>
												<div class="tittle">
													<h2>Wyniki naszych usług</h2>
												</div>
												<p>Opcja chwilowo niedostępna. Trwają prace nad modernizacją strony.</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="service-item">
												<i class="fa fa-gears"></i>
												<div class="tittle">
													<h2>Wydajność naszej strony</h2>
												</div>
												<p>Opcja chwilowo niedostępna. Trwają prace nad modernizacją strony.</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="service-item second-row">
												<i class="fa fa-pencil"></i>
												<div class="tittle">
													<h2>Usługi sprzedawców</h2>
												</div>
												<p>Opcja chwilowo niedostępna. Trwają prace nad modernizacją strony.</p>
											</div>
										</div>
										<div class="col-md-6">
											<div class="service-item second-row last-service">
												<i class="fa fa-wrench"></i>
												<div class="tittle">
													<h2>Szybkie usługi</h2>
												</div>
												<p>Opcja chwilowo niedostępna. Trwają prace nad modernizacją strony.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
				
				<section class="featured-listing">
					<div class="container-fluid">
						<div class="row">
							<div class="col-md-12">
								<div class="heading-section-2 text-center">
									<h2>Kończące się ogłoszenia</h2>
									<span>Przykladowy tekst, cos tam, cos tam, ble ble ble.</span>
								</div>
							</div>
						</div>
						<div class="row">
							<div id="featured-ofertts">
							<?php
							$dbc1 = $db->prepare("SELECT * FROM aukcje WHERE unix_timestamp(date)+604800 > '".time()."' ORDER BY date asc LIMIT 5");
							$dbc1->execute();$i = 0;
							
							while($row = $dbc1->fetch()){
							?>
								<div class="featured-item col-md-15 col-sm-6"><a href="ogloszenie&id=<?php echo $row['id']; ?>">
									<div class="down-content">
										<h2><?php echo $row['name']; ?></h2>
										<span><?php echo $row['price']; ?>.-</span>
										<div class="light-line"></div>
										<p><?php echo $row['desc']; ?></p>
										<div class="ofer-info">
											<ul>
												<li><i class="fa fa-map-marker" style="margin-left: 0;"></i><?php echo $kat1s[$row['kat1']-1]; ?></li>
												<li style="border: 0;"><i class="fa fa-info-circle"></i><?php echo $kat2s[$row['kat2']-1]; ?></li>
											</ul>
										</div>
									</div></a>
								</div>
							<?php $i++;}
							if ($i == 0) echo '<center><h2>Nie znaleziono ofert.</h2></center>';
							?>
							</div>
						</div>
					</div>
				</section>