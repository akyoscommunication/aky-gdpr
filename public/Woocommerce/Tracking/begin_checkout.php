<?php

// Récupérez le panier WooCommerce
$cart = WC()->cart;

// Récupérez les produits du panier
$cart_items = $cart->get_cart();

// Vérifiez si le panier est vide
if (empty($cart_items)) {
    return;
}

// Créez un tableau d'informations sur les produits
$products = [];

foreach ($cart_items as $cart_item_key => $cart_item) {
    $product = $cart_item['data'];
    $product_info = \Akyos\Gdpr\Woocommerce::getProductItemDataLayer($product);
    $products[] = $product_info;
}

// Créez un tableau d'événement pour le suivi du début du tunnel de commande
$begin_checkout_event = [
    'event' => 'begin_checkout',
    'ecommerce' => [
        'items' => $products,
    ],
];

// Ajoutez l'événement au dataLayer
?>
<script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(<?= json_encode($begin_checkout_event, JSON_THROW_ON_ERROR) ?>);
</script>
