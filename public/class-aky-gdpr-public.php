<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/public
 * @author     Akyos Communication <developpement@akyos.com>
 */
class Aky_Gdpr_Public {

    /**
     * The ID of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $plugin_name    The ID of this plugin.
     */
    private $plugin_name;

    /**
     * The version of this plugin.
     *
     * @since    1.0.0
     * @access   private
     * @var      string    $version    The current version of this plugin.
     */
    private $version;

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     * @param      string    $plugin_name       The name of the plugin.
     * @param      string    $version    The version of this plugin.
     */
    public function __construct( $plugin_name, $version ) {

        $this->plugin_name = $plugin_name;
        $this->version = $version;

    }

    /**
     * Register the stylesheets for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_styles() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Aky_Gdpr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Aky_Gdpr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'resources/dist/css/main.css', array(), $this->version, 'all' );

    }

    /**
     * Register the JavaScript for the public-facing side of the site.
     *
     * @since    1.0.0
     */
    public function enqueue_scripts() {

        /**
         * This function is provided for demonstration purposes only.
         *
         * An instance of this class should be passed to the run() function
         * defined in Aky_Gdpr_Loader as all of the hooks are defined
         * in that particular class.
         *
         * The Aky_Gdpr_Loader will then create the relationship
         * between the defined hooks and the functions defined in this
         * class.
         */

        wp_enqueue_script( $this->plugin_name.'_tac', plugin_dir_url( __FILE__ ) . 'resources/vendor/tarteaucitronjs/tarteaucitron.js', array(), $this->version, false );
        wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'resources/dist/js/main.js', array(), $this->version, false );

        add_action('wp_head', function () {
            $options = get_option('aky-gdpr');

            $service_type = $options['rgpd_service_type'];
            $rgpd_front_display = $options['rgpd_front_display'];
            $pageID = get_page_by_path(!empty($options['rgpd_custom_rgpd_link']) && (!empty($options['rgpd_custom_rgpd_page'])) ? $options['rgpd_custom_rgpd_link'] : '/politique-de-conservation-de-donnees'); 
            $pagePrivacyByLang = null;
            
            if (function_exists('pll_get_post')) {
				$pagePrivacyByLang = get_permalink(pll_get_post($pageID->ID, get_locale()));
			}

			$privacy = $pagePrivacyByLang ?: (!empty($options['rgpd_custom_rgpd_link']) && (!empty($options['rgpd_custom_rgpd_page'])) ? $options['rgpd_custom_rgpd_link'] : '/politique-de-conservation-de-donnees');


            if ($rgpd_front_display) {
            ?>
            <style>
                #tarteaucitronRoot { display: none !important; }
            </style>
            <?php
            }

            if ($service_type == Aky_Gdpr_Admin::SERVICE_TARTEAUCITRON) {
            ?>
            <script type="text/javascript" class="aky-gdpr-script" defer>

                    <?php if(function_exists('pll_current_language')) { ?>
                        window.tarteaucitronForceLanguage = '<?php echo pll_current_language() ?>';
                    <?php } ?>
                
                tarteaucitron.init({
                    "privacyUrl": "<?php echo($privacy)  ?>", /* Privacy policy url */

                    "hashtag": "#tarteaucitron", /* Open the panel with this hashtag */
                    "cookieName": "tartaucitron", /* Cookie name */

                    "orientation": "top", /* Banner position (top - bottom) */
                    "showAlertSmall": false, /* Show the small banner on bottom right */
                    "cookieslist": false, /* Show the cookie list */

                    "adblocker": false, /* Show a Warning if an adblocker is detected */
                    "AcceptAllCta" : true, /* Show the accept all button when highPrivacy on */
                    "DenyAllCta" : true,
                    "highPrivacy": true, /* Disable auto consent */
                    "handleBrowserDNTRequest": false, /* If Do Not Track == 1, disallow all */

                    "removeCredit": false, /* Remove credit link */
                    "moreInfoLink": true, /* Show more info link */
                    "useExternalCss": true, /* If false, the tarteaucitron.css file will be loaded */

                    //"cookieDomain": ".my-multisite-domaine.fr", /* Shared cookie for multisite */

                    "readmoreLink": "/utilisation-des-cookies" /* Change the default readmore link */
                });
            </script>
            <?php
            } elseif ($service_type === Aky_Gdpr_Admin::SERVICE_SIRDATA) {
                $sirdata_user = $options['sirdata_user'];
                $sirdata_site = $options['sirdata_site'];

                $gtms = explode('|', $options['rgpd_gta']);
                $pixelfb = $options['rgpd_pixelfb'];
            ?>
                <script type="text/javascript" src="//cache.consentframework.com/js/pa/<?= $sirdata_user ?>/c/<?= $sirdata_site ?>/stub" referrerpolicy="unsafe-url" charset="utf-8"></script>
                <script type="text/javascript" src="//choices.consentframework.com/js/pa/<?= $sirdata_user ?>/c/<?= $sirdata_site ?>/cmp" referrerpolicy="unsafe-url" charset="utf-8" async></script>

                <?php if ($options['rgpd_gta']):
                    foreach ($gtms as $gtm):
                    ?>
                    <!-- Google Tag Manager -->
                    <script>
                        (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                                    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                        })(window,document,'script','dataLayer','<?= $gtm ?>');
                    </script>
                    <!-- End Google Tag Manager -->
                <?php
                    endforeach;
                    endif;
                ?>
                <?php if ($pixelfb):
                        ?>
                        <script> !function(f,b,e,v,n,t,s) { if(f.fbq) return; n=f.fbq=function(){ n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments); }; if(!f._fbq) f._fbq=n; n.push=n; n.loaded=!0; n.version='2.0'; n.queue=[]; t=b.createElement(e); t.async=!0; t.src=v; s=b.getElementsByTagName(e)[0]; s.parentNode.insertBefore(t,s); } (window, document,'script', 'https://connect.facebook.net/en_US/fbevents.js'); fbq('init', '<?= $pixelfb ?>'); fbq('track', 'PageView'); </script>
                    <?php
                endif;
                ?>
            <?php
            }
        }, PHP_INT_MAX);

    }

    /**
     * Render the settings page for this plugin.
     *
     * @since    1.0.0
     */
    public function display_plugin_setup_page()
    {
         include_once 'partials/aky-gdpr-public-display.php';
    }

    public function woo_tracking_add_to_cart_btn_dataset_attrs($product)
    {
        $attrs = [];

        // Récupérez les détails du produit
        $product_id = $product->get_id();

        // Récupérez les catégories à partir de la taxonomie "product_cat"
        $categories = wp_get_post_terms($product_id, 'product_cat');
        $product_categories = array();

        foreach ($categories as $key => $category) {
            $category_key = 'data-item-category' . ($key + 1);
            $product_categories[$category_key] = $category->name;
        }

        // Récupérez le nom de la variante en cours
        if ($product->is_type('variable')) {
            $variation_attributes = $product->get_variation_attributes();
            $product_variant = json_encode($variation_attributes, JSON_THROW_ON_ERROR);
        } else {
            $product_variant = ''; // Aucune variante pour les produits simples
        }

        // Ajoutez les attributs de données au tableau existant
        foreach ($product_categories as $key => $value) {
            $attrs[$key] = esc_attr($value);
        }

        $attrs['data-product-variant'] = esc_attr($product_variant);
        $attrs['data-product-name'] = esc_attr($product->get_name());
        $attrs['data-product-id'] = esc_attr($product_id);
        $attrs['data-product-price'] = esc_attr($product->get_price());

        return $attrs;
    }

    public function get_woo_tracking_dataset_attrs_inline($product)
    {
        $attrs = $this->woo_tracking_add_to_cart_btn_dataset_attrs($product);

        return array_reduce(array_keys($attrs), static function ($carry, $key) use ($attrs) {
            return $carry . ' ' . $key . '="' . $attrs[$key] . '"';
        }, '');
    }

    public function woo_tracking_remove_to_cart_btn($link, $cart_item_key)
    {
        // Récupérez l'objet de panier WooCommerce
        $cart = WC()->cart;

        // Récupérez les détails de l'article de panier
        $cart_item = $cart->get_cart_item($cart_item_key);

        // Vérifiez si l'élément de panier est valide
        if (isset($cart_item['data']) && $cart_item['data'] instanceof \WC_Product) {
            $product = $cart_item['data'];

            $attrs = $this->get_woo_tracking_dataset_attrs_inline($product);

            $link = str_replace(['<a ', 'class="'], ['<a ' . $attrs . ' ', 'class="aky-gdpr-tracking-remove-from-cart '], $link);
        }

        return $link;
    }

    public function woo_tracking_add_to_cart_btn_dataset($links, $product)
    {
        $links['attributes'] = array_merge($links['attributes'], $this->woo_tracking_add_to_cart_btn_dataset_attrs($product));

        return $links;
    }

    public function woo_tracking_product_list_dataset()
    {
        global $product;

        // Vérifiez si c'est une instance de produit WooCommerce
        if (is_a($product, 'WC_Product')) {
            $attrs = $this->get_woo_tracking_dataset_attrs_inline($product);

            echo <<<HTML
    <div class="aky-gdpr-tracking-product" $attrs></div>
HTML;
        }
    }

    public function woo_tracking_page_view()
    {
        include_once 'Woocommerce/Tracking/page_view.php';
    }

    public function woo_tracking_add_to_cart()
    {
        include_once 'Woocommerce/Tracking/add_to_cart.php';
    }

    public function woo_tracking_begin_checkout()
    {
        include_once 'Woocommerce/Tracking/begin_checkout.php';
    }

    public function woo_tracking_checkout_progress()
    {
        include_once 'Woocommerce/Tracking/checkout_progress.php';
    }

    public function woo_tracking_purchase($order_id)
    {
        include_once 'Woocommerce/Tracking/purchase.php';
    }

    public function woo_tracking_select_item()
    {
        include_once 'Woocommerce/Tracking/select_item.php';
    }

    public function woo_tracking_remove_from_cart()
    {
        include_once 'Woocommerce/Tracking/remove_from_cart.php';
    }

}
