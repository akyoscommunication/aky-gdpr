<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">

    <h2><?php echo esc_html(get_admin_page_title()); ?></h2>

    <form method="post" name="<?= $this->plugin_name ?>-woo_tracking" id="rgpd_options" action="options.php">

        <?php
            //Grab all options
            $options = get_option("$this->plugin_name-woo_tracking");

            // Cleanup
            $woo_tracking_enabled = $options['woo_tracking_enabled'] ?? false;
            $add_to_cart_btn_class = $options['add_to_cart_btn_class'] ?? false;
            $remove_from_cart_btn_class = $options['remove_from_cart_btn_class'] ?? false;

        ?>

        <?php
            settings_fields("$this->plugin_name-woo_tracking");
            do_settings_sections("$this->plugin_name-woo_tracking");
        ?>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-woo_tracking_enabled">Activer le tracking woocommerce ?</label>
            <input type="checkbox" class="regular-text" id="<?php echo $this->plugin_name; ?>-woo_tracking_enabled" name="<?php echo $this->plugin_name; ?>-woo_tracking[woo_tracking_enabled]" value="woo_tracking_enabled" <?php if (!empty($woo_tracking_enabled)) {
                echo 'checked';
            } ?>/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-add_to_cart_btn_class">Classe du bouton "Ajout au panier"</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-add_to_cart_btn_class" name="<?php echo $this->plugin_name; ?>-woo_tracking[add_to_cart_btn_class]" value="<?php if(!empty($add_to_cart_btn_class)) echo $add_to_cart_btn_class; ?>"/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-remove_from_cart_btn_class">Classe du bouton "Suppression panier"</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-remove_from_cart_btn_class" name="<?php echo $this->plugin_name; ?>-woo_tracking[remove_from_cart_btn_class]" value="<?php if(!empty($remove_from_cart_btn_class)) echo $remove_from_cart_btn_class; ?>"/>
        </fieldset>

        <?php submit_button('Enregistrer', 'primary', 'submit', true); ?>

    </form>

</div>

