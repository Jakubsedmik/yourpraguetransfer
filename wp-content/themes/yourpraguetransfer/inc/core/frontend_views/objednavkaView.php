<section class="pt-3 pb-5 bg-light">
    <div class="s7_sw-sec mx-auto">
        <div class="wrapper">
	        <?php echo frontendError::getBackendErrors(); ?>

            <div class="section-title">
                <h1 class="title"><?php _e("Objednávka","yourpraguetransfer"); ?></h1>
                <p><?php _e("Děkujeme","yourpraguetransfer"); ?></p>
                <p><?php _e("Vaše objednávka byla zpracována. Souhrn Vaší objednávky Vám byl zaslán emailem","yourpraguetransfer"); ?></p>
                <ul>
                    <li><strong><?php _e("Odkud pojedeme:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['z']; ?></li>
                    <li><strong><?php _e("Kam pojedeme:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['do']; ?></li>
                    <li><strong><?php _e("Kdy pojedeme:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['cas_tam']; ?></li>
                    <?php if(isset($this->requestData['cas_zpet'])) : ?>
                        <li><strong><?php _e("Kdy pojedeme zpět:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['cas_zpet']; ?></li>
                    <?php endif; ?>
                    <li><strong><?php _e("Počet osob:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['osob']; ?></li>
                    <li><strong><?php _e("Cena:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['cena']; ?></li>
                    <li><strong><?php _e("Platba:","yourpraguetransfer"); ?></strong> <?php echo $this->requestData['platba']; ?></li>
                </ul>


                <?php if($this->requestData['zaplaceno'] == true) : ?>
                    <p><?php _e("Tato objednávka již byla zaplacena. O jejím zaplacení jsme Vás informovali emailem.","yourpraguetransfer"); ?></p>
                <?php else: ?>
                    <a href="<?php echo Tools::getFERoute("gopay",$this->requestData['objednavka_id'],"payment"); ?>" class="btn btn-lg border-0 rounded-0 text-white text-uppercase font-weight-bold"><?php _e("Zaplatit platební kartou","yourpraguetransfer"); ?></a>
                <?php endif; ?>

            </div>

        </div>
    </div>
</section>
