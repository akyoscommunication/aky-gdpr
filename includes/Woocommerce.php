<?php

namespace Akyos\Gdpr;

class Woocommerce
{
    public static function getProductItemDataLayer($product, $quantity = 1)
    {
        // Récupérez les détails du produit
        $product_name = $product->get_name();
        $product_id = $product->get_id();
        $product_price = $product->get_price();

        // Récupérez les catégories à partir de la taxonomie "product_cat"
        $categories = wp_get_post_terms($product_id, 'product_cat');
        $product_categories = [];

        foreach ($categories as $key => $category) {
            $category_key = 'item-category' . ($key + 1);
            $product_categories[$category_key] = $category->name;
        }

        // Récupérez le nom de la variante en cours
        if ($product->is_type('variable')) {
            $variation_attributes = $product->get_variation_attributes();
            $product_variant = json_encode($variation_attributes, JSON_THROW_ON_ERROR);
        } else {
            $product_variant = ''; // Aucune variante pour les produits simples
        }

        // Créez un tableau d'informations sur le produit
        $product_data = [
            'item_name' => $product_name,
            'item_id' => $product_id,
            'price' => $product_price,
            'quantity' => $quantity,
            'item_variant' => $product_variant // Ajoutez l'entrée item_variant
        ];

        // Ajoutez les catégories au tableau de données
        return array_merge($product_data, $product_categories);
    }
}
