<script>
	jQuery(document).ready(function($) {
		window.dataLayer = window.dataLayer || [];

		$('.woocommerce-LoopProduct-link, .woocommerce-loop-product__link').on('click', function(e) {
			e.preventDefault();
            const href = $(this).attr('href');

			const productData = $(this).find('.aky-gdpr-tracking-product').data();

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
				event: 'select_item',
				ecommerce: {
					items: [productInfo]
				}
			});

			// continue to product page
            window.location = href;
		});
	});
</script>
