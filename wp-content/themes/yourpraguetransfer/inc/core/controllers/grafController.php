<?php


class grafController extends controller {

	public function action() {
		//globalUtils::writeDebug($this->getStructuredDataReadable("objednavkaClass", time()-24*60*60*30, time(), "d.m.Y"));
		$this->performView();
	}

	public function getStructuredData( $class, $start, $end, $step = 24 * 60 * 60, $cumulative ) {
		$entities        = assetsFactory::getAllEntity( $class );
		$structured_data = array();

		for ( $i = $start; $i <= $end; $i += $step ) {
			$structured_data[ $i ] = $this->giveCountForDay( $i, $entities, $cumulative );
		}

		return $structured_data;
	}

	private function giveCountForDay( $day, $entities, $cumulative ) {
		$result = array_filter( $entities, function ( $obj, $index ) use ( $day ) {
			$parsed_day       = date( "d_m_Y", $day );
			$order_parsed_day = date( "d_m_Y", $obj->db_datum_zalozeni );
			if ( $parsed_day == $order_parsed_day ) {
				return true;
			}
		}, ARRAY_FILTER_USE_BOTH );
		if ( is_array( $result ) ) {
		    if($cumulative !== false){
		        $total = 0;
		        foreach ($result as $key => $value){
		            $total += $value->$cumulative;
                }
		        return $total;
            }
			return count( $result );
		} else {
			return 0;
		}
	}

	public function getStructuredDataReadable( $class, $start, $end, $format, $cumulative, $step = 24 * 60 * 60) {
		$structured_data          = $this->getStructuredData( $class, $start, $end, $step, $cumulative );
		$structured_data_readable = array();

		foreach ( $structured_data as $key => $value ) {
			$formated_day                              = date( $format, $key );
			$structured_data_readable[ $formated_day ] = $value;
		}

		return $structured_data_readable;
	}

	public function getJSLabels( $structured_data ) {
		$keys = array_keys( $structured_data );

		return json_encode( $keys );
	}

	public function getJSData( $structured_data ) {
		$data = array_values( $structured_data );

		return json_encode( $data );
	}

	public function getGraph(
	        $id,
            $name,
            $class,
            $start,
            $end,
            $format,
            $cumulative = false,
            $type = 'line',
            $bgColor = 'rgba(105, 0, 132, .2)',
            $borderColor = 'rgba(200, 99, 132, .7)',
            $borderWidth = 2) {
		$structured_data = $this->getStructuredDataReadable( $class, $start, $end, $format, $cumulative);
		if ( true ) : ?>
            <canvas id="<?php echo $id; ?>"></canvas>
            <script>
                $(document).ready(function () {
                    var realLabels = <?php echo $this->getJSLabels( $structured_data ); ?>;
                    var realData = <?php echo $this->getJSData( $structured_data ); ?>;

                    //line
                    var ctxL = document.getElementById("<?php echo $id; ?>").getContext('2d');
                    var myLineChart = new Chart(ctxL, {
                        type: '<?php echo $type; ?>',
                        data: {
                            labels: realLabels,
                            datasets: [{
                                label: "<?php echo $name; ?>",
                                data: realData,
                                backgroundColor: [
                                    '<?php echo $bgColor; ?>',
                                ],
                                borderColor: [
                                    '<?php echo $borderColor; ?>',
                                ],
                                borderWidth: <?php echo $borderWidth; ?>
                            }]
                        },
                        options: {
                            responsive: true
                        }
                    });
                });
            </script>
		<?php endif;
	}
}