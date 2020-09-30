<section class="pt-3 pb-3 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">
	        <?php echo frontendError::getBackendErrors(); ?>

            <div class="section-title">
                <h1 class="title">Objednávka</h1>
                <p>Děkujeme</p>
                <p>Vaše objednávka byla zpracována. Souhrn Vaší objednávky Vám byl zaslán emailem</p>
                <ul>
                    <li><strong>Odkud pojedeme:</strong> <?php echo $this->requestData['z']; ?></li>
                    <li><strong>Kam pojedeme:</strong> <?php echo $this->requestData['do']; ?></li>
                    <li><strong>Kdy pojedeme:</strong> <?php echo $this->requestData['cas_tam']; ?></li>
                    <li><strong>Kdy pojedeme zpět:</strong> <?php echo $this->requestData['cas_zpet']; ?></li>
                    <li><strong>Počet osob:</strong> <?php echo $this->requestData['osob']; ?></li>
                    <li><strong>Cena:</strong> <?php echo $this->requestData['cena']; ?> Kč</li>
                    <li><strong>Platba:</strong> <?php echo $this->requestData['platba']; ?> Kč</li>
                </ul>
            </div>

        </div>
    </div>
</section>
