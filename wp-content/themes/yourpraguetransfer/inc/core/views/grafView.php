<div class="border p-5 mr-3">
	<div class="container-fluid">
		<h1>
			<i class="fas fa-chart-area"></i> Grafy a reporty
		</h1>
		<p class="lead">
			Kompletní analýza současných prodejů a nových inzerátů
		</p>
	</div>
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-4">
				<div class="p-2 bg-secondary">
					<h4 class="text-white text-center">Hodnota objednávek za posledních 30 dní</h4>
				</div>
				<?php
					echo $this->getGraph("zisk_obj", "Hodnota objednávek", "objednavkaClass", time() - 24 * 60 * 60 * 30, time(),"d.m.Y",'db_cena', 'line', 'rgba(170, 102, 204, 0.5)', '#aa66cc', 2);
				?>

			</div>
			<div class="col-sm-4">
				<div class="p-2 bg-primary">
					<h4 class="text-white text-center">Počet objednávek za posledních 30 dní</h4>
				</div>
				<?php
				echo $this->getGraph("pocet_obj", "Počet objednávek", "objednavkaClass", time() - 24 * 60 * 60 * 30, time(),"d.m.Y", false,'line', 'rgba(66, 133, 244, 0.5)', '#4285f4', 2 );
				?>

			</div>
			<div class="col-sm-4">
				<div class="p-2 bg-info">
					<h4 class="text-white text-center">Hodnota transakcí za posledních 30 dní</h4>
				</div>
				<?php
				echo $this->getGraph("hodnota_transakc", "Hodnota  transakcí", "transakceClass", time() - 24 * 60 * 60 * 30, time(),"d.m.Y", "db_mnozstvi",'line', 'rgba(51, 181, 229, 0.5)', '#4285f4', 2 );
				?>

			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-sm-6">
				<div class="p-2 bg-success">
					<h4 class="text-white text-center">Vytvořených inzerátů za posledních 30 dní</h4>
				</div>
				<?php
				echo $this->getGraph("pocet_inzr", "Počet inzerátů", "inzeratClass", time() - 24 * 60 * 60 * 30, time(),"d.m.Y", false,'line', 'rgba(0, 200, 81, 0.5)', '#00c851', 2);
				?>

			</div>

			<div class="col-sm-6">
				<div class="p-2 bg-warning">
					<h4 class="text-white text-center">Vytvořených uživatelů za posledních 30 dní</h4>
				</div>
				<?php
					echo $this->getGraph("pocet_uziv", "Počet uživatelů", "uzivatelClass", time() - 24 * 60 * 60 * 30, time(),"d.m.Y", false, 'line', 'rgba(255, 187, 51, 0.5)', '#ffbb33', 2);
				?>

			</div>

		</div>
		<hr>

	</div>
	<div class="container-fluid">
		<a href="<?php echo ADMIN_BASE_URL;?>" class="btn btn-amber mt-3"><i class="fas fa-chevron-left mr-1"></i> Zpět na rozcestník</a>
	</div>
</div>

