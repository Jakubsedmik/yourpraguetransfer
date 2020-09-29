<section class="pt-3 pb-3 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">
	        <?php echo frontendError::getBackendErrors(); ?>

            <div class="section-title">
                <h1 class="title">Objednávka</h1>
                <p>Děkujeme</p>
                <p>Vaše objednávka byla zpracována. Souhrn Vaší objednávky Vám byl zaslán emailem</p>
                <ul>
                    <li>Odkud pojedeme: <?php echo $this->requestData['z']; ?></li>
                    <li>Kam pojedeme: <?php echo $this->requestData['do']; ?></li>
                    <li>Kdy pojedeme: <?php echo $this->requestData['z']; ?></li>
                    <li>Počet osob: <?php echo $this->requestData['osob']; ?></li>
                    <li>Vzdálenost: <?php echo $this->requestData['distance']; ?> km</li>
                    <li>Cena: <?php echo $this->requestData['cena']; ?> Kč</li>
                </ul>
            </div>

        </div>
    </div>
</section>
