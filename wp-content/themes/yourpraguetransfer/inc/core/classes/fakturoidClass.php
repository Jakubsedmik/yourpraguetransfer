<?php


/**
 * Class fakturoidClass
 *
 * Postup práce s třídou
 * 1. konstruovat, zjistí zdali je vše v pořádku
 * 2. createInvoiceForOrder - vytvoří fakturu pro order
 * 3. getAndSaveInvoicePDFForOrder - vytvoří pdf fakturu pro order
 * 4. removeInvoice - smaže fakturu z fakturoidu
 * 5. clearUnusedPDFFiles - smaže soubory faktur na disku které již byli smazané ve fakturoidu
 * 6. generateAllInvoicesPDF - vygeneruje všem fakturám PDF
 * 7. generateAllInvoices - vygeneruje všechny faktury pro objednávky které jsou již zaplacené
 * 8. regenerateInvoiceFromOrder - regeneruje fakturu ve fakturoidu z objednávky
 * 9. regenerateInvoicePDFFromOrder - regeneruje PDF fakturu uloženou u nás z fakturoidu
 */
class fakturoidClass {

	/**
	 * @var \Fakturoid\Client
	 */
	protected $client;

	/**
	 * fakturoidClass constructor.
	 * Kontstruktor. V sestavení vyzkouší připojení na fakturoid. Pokud se nepodaří vyhodí chybu do logu a ukončí běh.
	 */
	public function __construct() {
		try {
			$this->client = new Fakturoid\Client(FAKTUROID_SLUG,FAKTUROID_MAIL,FAKTUROID_API_KEY, FAKTUROID_AGENT);
			$account = $this->client->getAccount();
		}catch (Exception $e){
			trigger_error("Během připojování k fakturační službe došlo k chybě",E_USER_ERROR);
		}
	}

	/**
	 * Vytvoří fakturu z objednávky. Pokud faktura existuje tak jí aktualizuje. Pokud neexistuje kontakt k faktuře tak ho vytvoří.
	 * @param objednavkaClass $order objednávka pro kterou chceme fakturu vytvořit
	 * @param bool $generateInvoice pokud true ihned se generuje a stahuje PDF faktura
	 * @param bool $sendmail pokud se generuje PDF faktura a pokud toto true, tak se ještě zasílá rovnou mail s PDF fakturou
	 *
	 * @return bool|string
	 */
	public function createInvoiceForOrder(objednavkaClass $order, $generateInvoice = true , $sendmail = false){

		$invoice = $this->sendInvoice($order);
		if(is_object($invoice)){
			$invoiceId = $invoice->id;
			if($generateInvoice){

				// Faktura není dostupná hned, tudíž musíme na 1 sekundu usnout a zkusit se dotázat, pokud to nevyjde tak usínáme znova dokud fakturu nezsíkáme
				$invoice_link = "";
				do{
					sleep(0.3);
					$invoice_link = $this->getAndSaveInvoicePDFForOrder($order,false, $sendmail);
				}while($invoice_link== false);

			}
		}else{
			return false;
		}
	}

	/**
	 * Stáhne a uloží fakturu v PDF pro danou objednávku.
	 * @param objednavkaClass $order objednávka pro kteoru chceme PDF fakturu vytvořit
	 * @param bool $invoice_id pokud známe invoice ID tak můžeme poskytnout Invoice ID a tím zrychlit ukládání (přeskočí krok zjišťování faktury)
	 * @param bool $sendmail má-li po získání a uložení PDF faktury odeslat rovnou eamil
	 *
	 * @return bool|string
	 */
	public function getAndSaveInvoicePDFForOrder(objednavkaClass $order, $invoice_id = false, $sendmail = false){

		if(get_class($order) == "objednavkaClass"){

			$uzivatel = $order->getSubobject("uzivatel");
			if($uzivatel !== false){

				// pokud máme invoice ID a je to číslo tak pokračujeme rovnou bez získání invoiceid z fakturoidu
				if($invoice_id && is_numeric($invoice_id)){

					// ulož dle čísla faktury PDF do souboru
					$invoice_link = $this->getAndSaveInvoicePDF($invoice_id, $sendmail, $uzivatel->db_email);
					if($invoice_link !== false) {
						$order->db_invoice_link = $invoice_link;
						return $invoice_link;
					}
				}else{
					// dej id objednávky
					$id_order = $order->getId();

					// najdi si dle custom_id ve fakturoidu fakturu
					$invoice = $this->getInvoiceBasedOnId($id_order);

					if($invoice !== false){

						// ulož dle čísla faktury PDF do souboru
						$invoice_link = $this->getAndSaveInvoicePDF($invoice, $sendmail, $uzivatel->db_email);

						// ulož link na fakturu do order
						if($invoice_link !== false){
							$order->db_invoice_link = $invoice_link;
							return $invoice_link;
						}

					}else{

						// pokud objednávku ve fakturoidu nenalezneme tak ji musíme vytvořit, faktura se dogeneruje a pošle v druhém kolem
						$this->createInvoiceForOrder($order,false, false);

					}
				}
			}else{
				trigger_error("Nepodařilo se získat uživatele ::  getAndSaveInvoicePDFForOrder");
				return false;
			}
		}else{
			trigger_error("Nesprávný parametr order :: getAndSaveInvoicePDFForOrder");
			return false;
		}
		return false;
	}


	/**
	 * Stáhne a uloží PDF pro danou fakturu
	 * @param \Fakturoid\Response $invoice faktura nebo číslo faktury pro kteoru se má PDF vytvořit
	 * @param bool $sendmail zdali se má s fakturou rovnou odeslat email
	 * @param bool $mail mail na který se má email odeslat
	 *
	 * @return bool|string
	 */
	protected function getAndSaveInvoicePDF($invoice, $sendmail = false, $mail = false){

		if(is_object($invoice)){
			$invoiceId = $invoice->id;
			$response = $this->client->getInvoicePdf($invoiceId);
		}elseif (is_numeric($invoice)){
			$invoiceId = $invoice;
			$response = $this->client->getInvoicePdf($invoiceId);
		}else{
			trigger_error("Parametr invoice je ve špatném formátu :: getAndSaveInvoicePDF");
			return false;
		}


		$data = $response->getBody();

		if(!is_null($data)){

			// ulož fakturu
			$storePath = Tools::getPathTillFolder("wp-content", __DIR__) . INVOICES_PATH;
			$filename = "invoice_{$invoiceId}.pdf";
			$storePath_filename = $storePath . $filename;
			file_put_contents( $storePath_filename , $data);

			// pošli mail
			if($sendmail){
				Tools::sendMail($mail, "Objednávka služby","sendInvoice",array(), '',array(
					$storePath_filename
				));
			}

			// vrať link na fakturu
			return INVOICES_URL . $filename;
		}else{
			trigger_error("Fakturu se nepodařilo stáhnout :: getAndSaveInvoicePDF");
			return false;
		}


	}


	/**
	 * Vytvoří fakturu v systému fakturoid na základě order, pokud již existuje tak jí updatuje.
	 * Pokud neexistuje kontakt tak ho založí, pokud existuje tak ho nechá být a vytváří pouze fakturu
	 * @param objednavkaClass $order objednávka pro kterou chceme založit fakturu ve fakturoidu
	 *
	 * @return bool|\Fakturoid\Response|null
	 */
	protected function sendInvoice(objednavkaClass $order){

		if(get_class($order) == "objednavkaClass"){

			$uzivatel = $order->getSubobject("uzivatel");

			if($uzivatel !== false){

				// založ kontakt
				$contact = $this->sendContact($uzivatel);

				if($contact !== false){

					// parametry faktury
					$invoice_params = array(
						"subject_id" => $contact->id,
						"lines" => array(
							"name" => "Platba za kredity",
							"quantity" => $order->db_mnozstvi,
							"unit_price" => $order->db_cena / $order->db_mnozstvi
						),
						"custom_id" => $order->getId(),
						"paid" => true
					);

					try {

						// nejdříve se pokus fakturu nalézt
						$invoice = $this->getInvoiceBasedOnId($order->getId());

						// pokud neexistuje
						if($invoice === false){

							// vytvoř fakturu
							$response = $this->client->createInvoice($invoice_params);
							$response = $response->getBody();

							if(!is_null($response)){
								$order->db_invoice_id = $response->id;
								return $response;
							}else{
								return false;
							}

						}else{
							// pokud faktura existuje

							/* Spárování řádků, máme vždy pouze jeden */
							$line_id = $invoice->lines[0]->id;
							$invoice_params['lines']['id'] = $line_id;

							// updatování faktury
							$response = $this->client->updateInvoice($invoice->id, $invoice_params);
							if(!is_null($response)){

								$order->db_invoice_id = $invoice->id;

								// zaplať fakturu
								$paid_at = $invoice->paid_at;
								if(is_null($paid_at)){
									$this->client->fireInvoice($invoice->id, "pay",array(
											"paid_at" => date("d.m.Y",time())
										)
									);
								}
								return $response->getBody();
							}else{
								return false;
							}

						}

					}catch (\Fakturoid\Exception $e){
						trigger_error("Došlo k chybám při připojování do Fakturoidu :: sendInvoice : " . $e->getMessage());
						return false;
					}
				}else{
					trigger_error("Uživatele se nepodařilo vytvořit a proto nelze vytvořit fakturu :: sendInvoice()");
					return false;
				}
			}else{
				trigger_error("Uživatele se nepodařilo získat z objednávky - nejspíše neexistuje, generování faktury přeskočeno :: sendInvoice");
				return false;
			}

		}else{
			trigger_error("Parameter order není potomkem třídy objednavkaClass :: sendInvoice");
			return false;
		}

	}

	/**
	 * Vrátí fakturu na základě Order ID
	 * @param integer $order_id order id pro kterou hledáme fakturu
	 *
	 * @return bool|mixed pokud ji nalezne tak vrátí fakturu, jinak vrací false
	 */
	protected function getInvoiceBasedOnId($order_id){
		try {
			$response = $this->client->getInvoices(array("custom_id" => $order_id));
			if(count($response->getBody()) == 0){
				return false;
			}else{
				// vrátíme nalezenou fakturu, pouze první
				$response = $response->getBody();
				$invoice = array_shift($response);
				return $invoice;
			}
		}catch (\Fakturoid\Exception $e){
			trigger_error("Došlo k chybám při připojování do Fakturoidu :: getInvoiceBasedOnId : " . $e->getMessage());
			return false;
		}
	}

	/**
	 * Pokusí se získat kontakt, pokud se ho nepodaří nalézt tak kontakt založí.
	 *
	 * @param uzivatelClass $user instance uživatele pro kterého chceme kontakt založit
	 * @return bool|\Fakturoid\Response|mixed|null vrací fakturoidResponse body a nebo false
	 */
	public function sendContact(uzivatelClass $user, $update = false){


		if(get_class($user) == "uzivatelClass"){

			// připraví údaje o kontaktu
			$user_array = array(
				'name' => $user->getFullName(),
				'email' => $user->db_email,
				'custom_id' => $user->getId()
			);

			try {

				// pokusí se nalézt kontakt dle ID v uzivatelClass
				$response = $this->client->getSubjects(array("custom_id" => $user->getId()));
				if(count($response->getBody()) == 0){

					// když kontakt neexistuje tak ho vytvoří
					$response = $this->client->createSubject($user_array);
					return $response->getBody();

				}else{


					//pokud kontakt existuje tak ho vrátí, pouze první
					if($update == false){
						$response = $response->getBody();
						$response = array_shift($response);
						return $response;
					}else{
						$response = $response->getBody();
						$response = array_shift($response);
						$response = $this->client->updateSubject($response->id, $user_array);
						return $response;
					}
				}

			}catch (\Fakturoid\Exception $e){
				trigger_error("Došlo k chybám při připojování do Fakturoidu :: sendContact " . $e->getMessage());
			}

		}else{
			trigger_error("Parameter user není potomkem třídy uzivatelClass :: sendContact");
		}
		return false;
	}

	/**
	 * Smaže fakturu z fakturoidu dle objednávky pokud existuje
	 * @param objednavkaClass $order objednávka kterou si přejeme smazat z fakturoidu
	 *
	 * @return bool true pokud byla smazána a nebo false pokud nebyla nalezenena nebo se nepodařila smazat
	 */
	public function removeInvoice(objednavkaClass $order){
		if(get_class($order) == "objednavkaClass"){

			try {

				// dej id objednávky
				$id_order = $order->getId();

				// najdi si dle custom_id ve fakturoidu fakturu
				$invoice = $this->getInvoiceBasedOnId($id_order);

				// pokud invoice existuje tak pokračujeme
				if($invoice !== false){

					// smažeme invoice a pokud se povedlo vracíme true
					$response = $this->client->deleteInvoice($invoice->id);
					if($response->getStatusCode() == 204){
						$order->db_invoice_id = -1;
						$order->db_invoice_link = "";
						return true;
					}
				}else{

					// pokud objednávku ve fakturoidu nenalezneme tak neřešíme
					trigger_error("Objednávka ke smazání nebyla ve fakturoidu nalezena :: removeInvoice");
					return false;
				}

			}catch (\Fakturoid\Exception $e){
				trigger_error("Došlo k chybám při připojování do Fakturoidu :: removeInvoice " . $e->getMessage());
			}
		}else{
			trigger_error("Parameter order není potomkem třídy objednavkaClass :: removeInvoice");
		}
		return false;
	}

	public function removeAllInvoices(){
		// dej všechny objednávky kde se jejich invoice_id nerovná null nebo -1
		$all_active_orders = assetsFactory::getAllEntity(
			"objednavkaClass",
			array(
				new filterClass("invoice_id","IS NOT","NULL"),
				new filterClass("invoice_id", "!=", -1)
			)
		);

		foreach ($all_active_orders as $key => $val){
			$this->removeInvoice($val);
		}
		$this->clearUnusedPDFFiles();
	}

	/**
	 * Metoda promaže adresář invoices na základě toho jaké objednávky máme v databázi.
	 * Pokud existuje v souborovém systému faktura v PDF, která nekoreluje se záznamem v databázi invoice_id / invoice_link
	 * tak je smazána. Jedná se pouze o objednávky, které mají invoice_id vyplněné
	 */
	public function clearUnusedPDFFiles(){

		// dej všechny objednávky kde se jejich invoice_id nerovná null nebo -1
		$all_active_orders = assetsFactory::getAllEntity(
			"objednavkaClass",
			array(
				new filterClass("invoice_id","IS NOT","NULL"),
				new filterClass("invoice_id", "!=", -1)
			)
		);

		// dej systémovou cestu k invoices
		$invoices_path = Tools::getPathTillFolder("wp-content", __DIR__) . INVOICES_PATH;

		// pole všech PDF faktur
		$files = glob($invoices_path . "/*.pdf", GLOB_BRACE);

		// transformuj pole na pole idéček + cesty
		$files = array_map(function($value){
			$re = '/invoice_(\d+)\.pdf/m';
			$matches = "";
			preg_match_all($re, $value, $matches, PREG_SET_ORDER, 0);
			return array(
				"invoice_id" => $matches[0][1],
				"filename" => $value
			);
		}, $files);

		// hledej id faktury v databázové struktuře, pokud nenalezneš tak ho odstraň
		$found = false;
		foreach ($files as $file_k => $file_v){

			foreach ($all_active_orders as $key => $value){
				if($file_v['invoice_id'] == $value->db_invoice_id){
					$found = true;
				}
			}

			// nanalezen tak odstraňujeme
			if(!$found){
				unlink($file_v['filename']);
			}

			$found = false;
		}

	}


	/**
	 * Všechny faktury které neměli doposud generované PDF tak se pokusí si PDF dogenerovat.
	 * @param bool $sendmail máli se rovnou zasílat s fakturou email
	 */
	public function generateAllInvoicesPDF($sendmail = false){
		$orders = assetsFactory::getAllEntity("objednavkaClass",
			array(
				new filterClass( "invoice_id","IS NOT","NULL")
			)
		);


		foreach ($orders as $key => $value){
			// tady musíme vyloučit také ty s db_invoice_id -1 protože to jsou ty u kterých jsme smazali ve fakturoidu záznam
			if($value->db_invoice_id != -1 && ($value->db_invoice_link == NULL || strlen($value->db_invoice_link) == 0)){
				$this->getAndSaveInvoicePDFForOrder($value,false, $sendmail);
			}
		}
	}


	/**
	 * Metoda sloužící pro znovu vytvoření všech faktur v systému fakturoid (ne PDF, pouze záznamy)
	 * @param bool $sendmail máli metoda rovnou všem zasílat PDF
	 * @param bool $makepdf máli metoda rovnou také vytvářet PDF
	 */
	public function generateAllInvoices($sendmail = false, $makepdf = false){
		$orders = assetsFactory::getAllEntity("objednavkaClass",
			array(
				new filterClass( "stav","=","1")
			)
		);


		foreach ($orders as $key => $value){
			if($value->db_invoice_id == NULL || $value->db_invoice_id == -1){
				$this->createInvoiceForOrder($value, $makepdf, $sendmail );
			}
		}
	}


	/**
	 * Zregenruje stav faktury ve fakturoidu dle objednávky.
	 * @param objednavkaClass $order objednávka pro kterou chceme regenerovat stav faktury
	 *
	 * @return bool|\Fakturoid\Response|null
	 */
	public function regenerateInvoiceFromOrder(objednavkaClass $order){
		return $this->createInvoiceForOrder($order, true, false);
	}

	/**
	 * Zeregenruje PDF fakturu u nás dle fakturoidu
	 * @param $order objednávka pro kteoru cheme regenerovat
	 * @param bool $sendmail zdali má být zaslaný email rovnou s PDF
	 *
	 * @return bool|string
	 */
	public function regenerateInvoicePDFFromOrder($order,$sendmail = false){
		return $this->getAndSaveInvoicePDFForOrder($order,false, $sendmail);
	}


}