<?php
global $aky_gdpr_options;

if (is_product()) {
    global $product;

    $product_data = \Akyos\Gdpr\Woocommerce::getProductItemDataLayer($product);

    // Ajoutez le tableau au dataLayer lors de l'ajout au panier
    ?>
    <script>
		jQuery(document).ready(function($) {
			window.dataLayer = window.dataLayer || [];
			const dataLayer = <?= json_encode($product_data, JSON_THROW_ON_ERROR); ?>

			$('form.cart').on('submit', function(e) {
				e.preventDefault();
				const quantity = $(this).find('input[name="quantity"]').val() || 1; // Valeur par défaut de la quantité
				window.dataLayer.push({
					...dataLayer,
					event: 'add_to_cart',
					ecommerce: {
						...dataLayer.ecommerce,
						items: [{
							...dataLayer.ecommerce.items[0],
							quantity: quantity
						}]
					}
				});

				// Ajoutez ici le code pour effectuer l'ajout au panier réel (si nécessaire)
				$(this).off('submit').submit(); // Soumettez le formulaire une fois les données du dataLayer collectées
			});
		});
    </script>
    <?php
} else {
    $add_to_cart_btn_class = !empty($aky_gdpr_options["$this->plugin_name-woo_tracking"]['add_to_cart_btn_class']) ? $aky_gdpr_options["$this->plugin_name-woo_tracking"]['add_to_cart_btn_class'] : 'a.button.add_to_cart_button';
    ?>
<script>
    jQuery(document).ready(function($) {
	    window.dataLayer = window.dataLayer || [];

        // Sélectionnez tous les boutons "Ajouter au panier" avec les attributs de données
        $('<?= $add_to_cart_btn_class ?>').on('click', function(e) {
            e.preventDefault();

            console.log('gros caca puant');

            // Récupérez les informations du produit depuis les attributs de données
	        const productData = $(this).data();

	        // Créez un tableau d'informations sur le produit
	        const productInfo = {
		        'item_name': productData.productName,
		        'item_id': productData.productId,
		        'price': productData.productPrice,
		        'quantity': productData.quantity,
		        'item_variant': productData.productVariant
	        };

	        // Ajoutez les catégories au tableau d'informations en fonction des attributs de données
            $.each(productData, function(key, value) {
                if (key.startsWith('item-category')) {
                    productInfo[key] = value;
                }
            });

            window.dataLayer.push({
                event: 'add_to_cart',
                ecommerce: {
                    items: [productInfo]
                }
            });
        });
    });
</script>
    <?php
}
