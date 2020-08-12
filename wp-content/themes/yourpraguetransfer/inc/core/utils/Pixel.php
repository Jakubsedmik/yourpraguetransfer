<?php


class Pixel {


	public static function initiatePixel(){
		?>
		<!-- Facebook Pixel Code -->
		<script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window,document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '917776338700849');
            fbq('track', 'PageView');
		</script>
		<noscript>
			<img height="1" width="1"
			     src="https://www.facebook.com/tr?id=917776338700849&ev=PageView
		&noscript=1"/>
		</noscript>
		<!-- End Facebook Pixel Code -->
		<?php
	}

	public static function PixelSearch(){
		?>
        <script>fbq('track', 'Search');</script>
        <?php
	}

	public static function PixelContact(){
	    ?>
        <script>fbq('track', 'Contact');</script>
        <?php
    }


	public static function PixelRegister(){
		?>
        <script>fbq('track', 'CompleteRegistration');</script>
		<?php
	}


	public static function PixelPayment(){
		?>
        <script>fbq('track', 'InitiateCheckout');</script>
		<?php
	}

	public static function PixelBuy($waitForEvent=false, $value=0, $currency="TOKEN"){
	    if($waitForEvent){
	        ?>
            <script>
                $(window).on("PixelBuy", function (event, data) {
                    fbq('track', 'Purchase', data);
                });
            </script>
            <?php
        }else{
		    ?>
            <script>fbq('track', 'Purchase', {value: <?php echo floatval($value) ?>, currency: '<?php echo $currency; ?>'});</script>
            <?php
        }
    }

    public static function PixelCreateProduct(){
	    ?>
        <script>fbq('track', 'CustomizeProduct');</script>
	    <?php
    }

}