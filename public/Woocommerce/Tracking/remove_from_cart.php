<?php
global $aky_gdpr_options;

$remove_from_cart_btn_class = !empty($aky_gdpr_options["$this->plugin_name-woo_tracking"]['remove_from_cart_btn_class']) ? $aky_gdpr_options["$this->plugin_name-woo_tracking"]['remove_from_cart_btn_class'] : '.aky-gdpr-tracking-remove-from-cart';
?>
<script>
	jQuery(document).ready(function($) {
		window.dataLayer = window.dataLayer || [];

		$("<?= $remove_from_cart_btn_class ?>").on('click', function() {
            const productData = $(this).data();

            // Créez un tableau d'informations sur le produit
            const productInfo = {
                'item_name': productData.productName,
                'item_id': productData.productId,
                'price': productData.productPrice,
                'quantity': 1,
                'item_variant': productData.productVariant
            };

            // Ajoutez les catégories au tableau d'informations en fonction des attributs de données
            $.each(productData, function(key, value) {
                if (key.startsWith('item-category')) {
                    productInfo[key] = value;
                }
            });

            window.dataLayer.push({
                event: 'remove_from_cart',
                ecommerce: {
                    items: [productInfo]
                }
            });
		});
	});
</script>
