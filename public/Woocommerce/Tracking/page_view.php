<?php

if (is_product()) {
    global $product;

    $product_data = \Akyos\Gdpr\Woocommerce::getProductItemDataLayer($product);

    // Ajoutez le tableau au dataLayer
    ?>
    <script>
		window.dataLayer = window.dataLayer || [];
		window.dataLayer.push({
			event: 'view_item',
			ecommerce: {
				items: [<?php echo json_encode($product_data); ?>]
			}
		});
    </script>
    <?php
}
