<?php

// Vérifiez si l'utilisateur est sur la page de commande de WooCommerce
if (is_checkout()) {
    global $wp;

    // Récupérez le numéro de l'étape actuelle
    $cart = WC()->cart;

    // Récupérez les produits du panier
    $cart_items = $cart->get_cart();

    // Créez un tableau d'informations sur les produits
    $products = [];

    foreach ($cart_items as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];
        $product_info = \Akyos\Gdpr\Woocommerce::getProductItemDataLayer($product);
        $products[] = $product_info;
    }

    // Créez un tableau d'événement pour le suivi du début du tunnel de commande
    $data_layer = [
        'ecommerce' => [
            'items' => $products,
        ],
    ];

    // Ajoutez l'événement au dataLayer
    ?>
    <script>
        jQuery(document).ready(function($) {
            // Envoyez l'événement au dataLayer
            window.dataLayer = window.dataLayer || [];

            const checkoutForm = $('form.checkout');
            let dataLayer = <?= json_encode($data_layer, JSON_THROW_ON_ERROR) ?>;

            if (checkoutForm.length > 0) {
                checkoutForm.on('change', 'input[name^="shipping_method"]', function() {
                    // Récupérez le mode de livraison choisi
                    const selectedShippingMethod = $('input[name^="shipping_method"]:checked').val();

                    // Envoyez le mode de livraison choisi au dataLayer
                    sendShippingMethodEvent(selectedShippingMethod);
                });

                checkoutForm.on('change', 'input[name^="payment_method"]', function() {
                    // Récupérez le mode de paiement choisi
                    const selectedPaymentMethod = $('input[name^="payment_method"]:checked').val();

                    // Envoyez le mode de paiement choisi au dataLayer
                    sendPaymentMethodEvent(selectedPaymentMethod);
                });
            }

            function sendShippingMethodEvent(shippingMethod) {
                window.dataLayer.push({
                    ...dataLayer,
                    event: 'shipping_method',
                    ecommerce: {
                        ...dataLayer.ecommerce,
                        shipping_method: shippingMethod,
                    },
                });
            }

            function sendPaymentMethodEvent(paymentMethod) {
                window.dataLayer.push({
                    ...dataLayer,
                    event: 'add_payment_info',
                    ecommerce: {
                        ...dataLayer.ecommerce,
                        payment_type: paymentMethod,
                    },
                });
            }
        });
    </script>
    <?php
}
