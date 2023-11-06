<?php

if (!$order_id) {
    return;
}

// Récupérez l'objet de la commande WooCommerce
$order = wc_get_order($order_id);

// Vérifiez si la commande est valide
if (!$order) {
    return;
}

// Récupérez les détails de la commande
$order_data = $order->get_data();
$order_total = $order->get_total();
$order_currency = $order->get_currency();

// Récupérez les frais de port, la taxe et l'affiliation (coupon) de la commande
$order_shipping = $order->get_shipping_total();
$order_tax = $order->get_total_tax();
$order_affiliation = $order->get_coupon_codes(); // Vous pouvez personnaliser la récupération de l'affiliation

// Récupérez la liste des produits de la commande
$products = [];

foreach ($order->get_items() as $item_id => $item) {
    $product = $item->get_product();
    $product_info = \Akyos\Gdpr\Woocommerce::getProductItemDataLayer($product, $item->get_quantity());
    $product_info['item_coupon'] = $product->get_sku();
    $products[] = $product_info;
}

// Créez un tableau d'événement pour le suivi d'achat
$purchase_event = [
    'event' => 'purchase',
    'ecommerce' => [
        'currency' => $order_currency,
        'value' => $order_total,
        'tax' => $order_tax,
        'shipping' => $order_shipping,
        'affiliation' => $order_affiliation,
        'transaction_id' => $order_id,
        'coupon' => implode(', ', $order_affiliation), // Vous pouvez personnaliser cette valeur
        'items' => $products,
    ],
];

// Ajoutez l'événement au dataLayer
?>
<script>
    window.dataLayer = window.dataLayer || [];
    window.dataLayer.push(<?= json_encode($purchase_event, JSON_THROW_ON_ERROR); ?>);
</script>
