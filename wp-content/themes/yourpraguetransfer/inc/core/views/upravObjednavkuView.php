<div class="container">
	<!-- Material form register -->
	<div class="card p-0 mw-100">

		<h5 class="card-header blue-gradient white-text text-center py-4">
			<strong>Editace objednávky</strong>
			<p class="mb-0 text-white">Zde můžete upravit objednávku</p>
            <a class="position-absolute admin-nav" href="<?php echo Tools::getRoute("objednavkaClass"); ?>"><i class="fas fa-bars"></i> Zpět na výpis</a>
		</h5>

		<!--Card content-->
		<div class="card-body px-lg-5 pt-0">

			<!-- Form -->
			<form class="text-center" style="color: #757575;" action="<?php Tools::getCurrentUrl(); ?>" method="POST">
				<input type="hidden" name="db_id" value="<?php echo $this->viewData['objednavka']->getId(); ?>">

                <div class="form-row">
                    <div class="col-10">
                        <!-- Cena-->
                        <?php echo Tools::simpleInput("db_cena", $this->viewData['objednavka']->dejData('db_cena'), "Cena", "number"); ?>
                    </div>
                    <div class="col-2">
                        <!-- Měna -->
                        <div class="md-form alone">
                            <?php echo Tools::getSelectBoxForDials("objednavkaClass","mena",$this->viewData['objednavka']->db_mena, 'Měna', "db_mena"); ?>
                        </div>
                    </div>


                </div>

				<!-- Připojené vozidlo-->
                <div class="form-row">
                    <div class="col-10">
	                    <?php echo Tools::getSelectBoxForEntities("vozidloClass", $this->viewData['objednavka']->db_vozidlo_id, array('db_id', 'db_nazev'),'Vozidlo','db_vozidlo_id'); ?>
                    </div>
                    <div class="col-2">
                        <a href="<?php echo Tools::getRoute("vozidloClass", "edit",$this->viewData['objednavka']->db_vozidlo_id) ?>" class="btn-sm btn-block btn-secondary btn">Detail</a>
                    </div>
                </div>


                <div class="form-row">
                    <div class="col-5">
                        <!-- Stav objednávky -->
                        <?php echo Tools::getSelectBoxForDials("objednavkaClass","stav",$this->viewData['objednavka']->db_stav, 'Stav objednávky', "db_stav"); ?>
                    </div>
                    <div class="col-5">
                        <!-- Typ platby -->
                        <?php echo Tools::getSelectBoxForDials("objednavkaClass","typ_platby",$this->viewData['objednavka']->db_typ_platby, 'Typ platby', "db_typ_platby"); ?>
                    </div>

                    <?php if($this->viewData['objednavka']->db_typ_platby == 1): ?>
                    <div class="col-2">
                        <!-- Platební odkaz -->
                        <a target="_blank" href="<?php echo Tools::getFeRoute("objednavkaClass", $this->viewData['objednavka']->getId(),"detail"); ?>" class="btn-sm btn-block btn-amber btn">Platební odkaz</a>
                    </div>
                    <?php endif; ?>
                </div>


                <div class="form-row">
                    <div class="col">
                        <!-- Odkud -->
                        <?php echo Tools::simpleInput("db_destinace_z", $this->viewData['objednavka']->dejData('db_destinace_z'), "Destinace z", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Kam -->
                        <?php echo Tools::simpleInput("db_destinace_do", $this->viewData['objednavka']->dejData('db_destinace_do'), "Destinace do", "text"); ?>
                    </div>

                    <div class="col">
                        <!-- počet osob -->
                        <?php echo Tools::simpleInput("db_pocet_osob", $this->viewData['objednavka']->dejData('db_pocet_osob'), "Počet osob", "number"); ?>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col">
                        <!-- Jmeno -->
                        <?php echo Tools::simpleInput("db_jmeno", $this->viewData['objednavka']->dejData('db_jmeno'), "Jméno", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Prijmeni -->
                        <?php echo Tools::simpleInput("db_prijmeni", $this->viewData['objednavka']->dejData('db_prijmeni'), "Příjmení", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Email -->
                        <?php echo Tools::simpleInput("db_email", $this->viewData['objednavka']->dejData('db_email'), "Email", "text"); ?>
                    </div>
                    <div class="col">
                        <!-- Telefon -->
                        <?php echo Tools::simpleInput("db_telefon", $this->viewData['objednavka']->dejData('db_telefon'), "Telefon", "text"); ?>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <?php echo Tools::timePicker($this->viewData['objednavka']->db_cas, "db_cas", "Čas vyzvednutí", "Vyberte čas vyzvednutí"); ?>
                    </div>

                    <div class="col">

                        <?php
                            if($this->viewData['objednavka']->db_cas_zpet == 0){
                                echo "<strong class='text-danger'>Klient si nepřeje zpáteční jízdu, pokud ji chcete zavést tak stačí vyplnit datum a čas</strong>";
                            }
                            echo Tools::timePicker($this->viewData['objednavka']->db_cas_zpet, "db_cas_zpet", "Čas vyzvednutí zpátky", "Vyberte čas vyzvednutí zpátky");
                            ?>
                    </div>

                </div>

                <div class="form-row">
                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Dětská sedačka", 1, 'db_detska_sedacka', $this->viewData['objednavka']->dejData('db_detska_sedacka')); ?>
                    </div>

                    <div class="col">
                        <?php echo Tools::switcher("Ano","Ne", "Velká zavazadla", 1, 'db_velka_zavazadla', $this->viewData['objednavka']->dejData('db_velka_zavazadla')); ?>
                    </div>
                </div>


                <?php echo Tools::simpleInput("db_znameni", $this->viewData['objednavka']->dejData('db_znameni'), "Znamení", "text"); ?>

                <?php echo Tools::simpleInput("db_poznamka", $this->viewData['objednavka']->dejData('db_poznamka'), "Poznámka", "text"); ?>


				<div class="form-row">
					<div class="col">
						<div class="md-form">
							<?php
							$datumUpravy =  $this->viewData['objednavka']->db_datum_upravy;
							$datumUpravy = date("d.m.Y H:i:s", $datumUpravy);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_upravy" name="db_datum_upravy" class="form-control" disabled value="<?php echo $datumUpravy; ?>">
							<label for="db_datum_upravy">Datum a čas úpravy</label>
						</div>

					</div>
					<div class="col">
						<div class="md-form">
							<?php
							    $mdbTime = Tools::getMdbNotationDate($this->viewData['objednavka']->db_datum_zalozeni);
							?>
							<input placeholder="Vyberte datum" type="text" id="db_datum_zalozeni" name="datum_zalozeni" class="form-control datepicker" data-value="<?php echo $mdbTime; ?>">
							<label for="db_datum_zalozeni">Datum vytvoření</label>
						</div>
					</div>
				</div>

				<!-- Sign up button -->
				<button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" name="ulozit" value="1" type="submit">Upravit</button>


			</form>
			<!-- Form -->

		</div>

	</div>
	<!-- Material form register -->

</div>