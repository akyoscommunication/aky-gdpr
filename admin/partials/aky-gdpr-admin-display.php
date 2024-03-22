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

    <form method="post" name="rgpd_options" id="rgpd_options" action="options.php">

		<?php
	        //Grab all options
	        $options = get_option($this->plugin_name);

	        // Cleanup
            $rgpd_custom_rgpd_page = $options['rgpd_custom_rgpd_page'] ?? false;
            $rgpd_custom_rgpd_link = $options['rgpd_custom_rgpd_link'] ?? false;

            $rgpd_title = $options['rgpd_title'] ?? false;
            $rgpd_mail = $options['rgpd_mail'] ?? false;
            $rgpd_address = $options['rgpd_address'] ?? false;
            $rgpd_contact = $options['rgpd_contact'] ?? false;
            $rgpd_gta = $options['rgpd_gta'] ?? false;
            $rgpd_youtube = $options['rgpd_youtube'] ?? false;
            $rgpd_pixelfb = $options['rgpd_pixelfb'] ?? false;
            $rgpd_id_client = $options['rgpd_id_client'] ?? false;
            $rgpd_front_logo = $options['rgpd_front_logo'] ?? false;
            $rgpd_front_logo_display = $options['rgpd_front_logo_display'] ?? false;
            $rgpd_front_display = $options['rgpd_front_display'] ?? false;

            $rgpd_matomo_url = $options['rgpd_matomo_url'] ?? false;
            $rgpd_matomo_site_id = $options['rgpd_matomo_site_id'] ?? false;
            $rgpd_matomo_js_path = $options['rgpd_matomo_js_path'] ?? false;
            $rgpd_matomo_url_tag = $options['rgpd_matomo_url_tag'] ?? false;

            $rgpd_service_type = $options['rgpd_service_type'] ?? false;
            $sirdata_user = $options['sirdata_user'] ?? false;
            $sirdata_site = $options['sirdata_site'] ?? false;

        ?>

	    <?php
            settings_fields($this->plugin_name);
            do_settings_sections($this->plugin_name);
	    ?>

        <fieldset class="aky-gdpr-field">
            <label for="<?= $this->plugin_name; ?>-service_type">Type de service</label>
            <select name="<?= $this->plugin_name; ?>[rgpd_service_type]" id="<?= $this->plugin_name; ?>-rgpd_service_type" required>
                <option value="" disabled <?php if(empty($rgpd_service_type)) echo 'selected'; ?>>Selectionner votre service</option>
                <option value="<?= Aky_Gdpr_Admin::SERVICE_TARTEAUCITRON ?>" <?php if($rgpd_service_type === Aky_Gdpr_Admin::SERVICE_TARTEAUCITRON) echo 'selected'; ?>>TarteauCitron</option>
                <option value="<?= Aky_Gdpr_Admin::SERVICE_SIRDATA ?>" <?php if($rgpd_service_type === Aky_Gdpr_Admin::SERVICE_SIRDATA) echo 'selected'; ?>>SirData</option>
                <option value="<?= Aky_Gdpr_Admin::SERVICE_MATOMO_NO_COOKIE ?>" <?php if($rgpd_service_type === Aky_Gdpr_Admin::SERVICE_MATOMO_NO_COOKIE) echo 'selected'; ?>>Matomo no consent mode</option>
            </select>

            <div class="aky-gdpr-field-sub" id="<?= $this->plugin_name; ?>-service_sirdata">
                <div class="aky-gdpr-field">
                    <label for="<?= $this->plugin_name; ?>-sirdata_user">Identifiant SirData (utilisateur)</label>
                    <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-sirdata_user" name="<?php echo $this->plugin_name; ?>[sirdata_user]" value="<?php if(!empty($sirdata_user)) echo $sirdata_user; ?>"/>
                </div>
                <div class="aky-gdpr-field">
                    <label for="<?= $this->plugin_name; ?>-sirdata_site">Identifiant SirData (site)</label>
                    <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-sirdata_site" name="<?php echo $this->plugin_name; ?>[sirdata_site]" value="<?php if(!empty($sirdata_site)) echo $sirdata_site; ?>"/>
                </div>
            </div>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-custom-rgpd-page">Activer la gestion des pages de politiques de confidentialité manuelle</label>
            <em class="aky-gdpr-field-info">( Ceci désactive la génération automatique des pages, et l'écrasement des données à chaque enregistrement )</em>
            <input type="checkbox" class="regular-text" id="<?php echo $this->plugin_name; ?>-custom-rgpd-page" name="<?php echo $this->plugin_name; ?>[rgpd_custom_rgpd_page]" value="deactivate_page" <?php if(!empty($rgpd_custom_rgpd_page)) echo 'checked'; ?>/>

            <div class="<?php echo $this->plugin_name; ?>-custom-rgpd-page_link">
                <label for="<?php echo $this->plugin_name; ?>-custom-rgpd-page_link">Lien de la page de confidentialité customisée</label>
                <em class="aky-gdpr-field-info">( /ma-page )</em>
                <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-custom-rgpd-page_link" name="<?php echo $this->plugin_name; ?>[rgpd_custom_rgpd_link]" value="<?php if(!empty($rgpd_custom_rgpd_link)) echo $rgpd_custom_rgpd_link; ?>"/>
            </div>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-title">Nom du site</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-title" name="<?php echo $this->plugin_name; ?>[rgpd_title]" value="<?php if(!empty($rgpd_title)) echo $rgpd_title; ?>" required/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-mail">Mail de destination</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-mail" name="<?php echo $this->plugin_name; ?>[rgpd_mail]" value="<?php if(!empty($rgpd_mail)) echo $rgpd_mail; ?>" required/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-address">Adresse de la personne</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-address" name="<?php echo $this->plugin_name; ?>[rgpd_address]" value="<?php if(!empty($rgpd_address)) echo $rgpd_address; ?>" required/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-contact">Lien de la page contact</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-contact" name="<?php echo $this->plugin_name; ?>[rgpd_contact]" value="<?php if(!empty($rgpd_contact)) echo $rgpd_contact; ?>" required/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-gta">Code GTM TagManager</label>
            <em class="aky-gdpr-field-info">Pour en mettre plusieurs, mettre les codes GTM séparés par des pipes (|)</em>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-gta" name="<?php echo $this->plugin_name; ?>[rgpd_gta]" value="<?php if(!empty($rgpd_gta)) echo $rgpd_gta; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-pixelfb">ID du Pixel Facebook</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-pixelfb" name="<?php echo $this->plugin_name; ?>[rgpd_pixelfb]" value="<?php if(!empty($rgpd_pixelfb)) echo $rgpd_pixelfb; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-matomo_url">URL MATOMO</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-matomo_url" name="<?php echo $this->plugin_name; ?>[rgpd_matomo_url]" value="<?php if(!empty($rgpd_matomo_url)) echo $rgpd_matomo_url; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-matomo_url">JS PATH MATOMO</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-matomo_js_path" name="<?php echo $this->plugin_name; ?>[rgpd_matomo_js_path]" value="<?php if(!empty($rgpd_matomo_js_path)) echo $rgpd_matomo_js_path; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-matomo_site_id">ID site MATOMO</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-matomo_site_id" name="<?php echo $this->plugin_name; ?>[rgpd_matomo_site_id]" value="<?php if(!empty($rgpd_matomo_site_id)) echo $rgpd_matomo_site_id; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-matomo_url_tag">Url Tag MATOMO</label>
            <em>( url dans g.src= du script donné par Matomo pour le tag manager )</em>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-matomo_tag" name="<?php echo $this->plugin_name; ?>[rgpd_matomo_url_tag]" value="<?php if(!empty($rgpd_matomo_url_tag)) echo $rgpd_matomo_url_tag; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-youtube">Youtube ?</label>
            <em class="aky-gdpr-field-info"><?php echo htmlentities('<div class="youtube_player" videoID="video_id" width="width" height="height" theme="theme (dark | light)" rel="rel (1 | 0)" controls="controls (1 | 0)" showinfo="showinfo (1 | 0)" autoplay="autoplay (0 | 1)"></div>') ?></em>
            <input type="checkbox" class="regular-text" id="<?php echo $this->plugin_name; ?>-youtube" name="<?php echo $this->plugin_name; ?>[rgpd_youtube]" value="activate_youtube" <?php if(!empty($rgpd_youtube)) echo 'checked'; ?>/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-id">Identifiant client</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-id" name="<?php echo $this->plugin_name; ?>[rgpd_id_client]" value="<?php if(!empty($rgpd_id_client)) echo $rgpd_id_client; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-front-logo">Affichage sur le site</label>
            <em>Laisser vide pour le logo.</em>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-front-logo" name="<?php echo $this->plugin_name; ?>[rgpd_front_logo]" value="<?php if(!empty($rgpd_front_logo)) echo $rgpd_front_logo; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-rgpd_front_display">Cacher la banniere ?</label>
            <em class="aky-gdpr-field-info">Attention cela peut-être illégal si vous devez proposer l'acceptation de cookies à vos clients.</em>
            <input type="checkbox" class="regular-text" id="<?php echo $this->plugin_name; ?>-rgpd_front_display" name="<?php echo $this->plugin_name; ?>[rgpd_front_display]" value="rgpd_front_display" <?php if(!empty($rgpd_front_display)) echo 'checked'; ?>/>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-rgpd_front_logo_display">Cacher le logo ?</label>
            <em class="aky-gdpr-field-info">Attention cela peut-être illégal si vous devez proposer l'acceptation de cookies à vos clients.</em>
            <input type="checkbox" class="regular-text" id="<?php echo $this->plugin_name; ?>-rgpd_front_logo_display" name="<?php echo $this->plugin_name; ?>[rgpd_front_logo_display]" value="rgpd_front_logo_display" <?php if(!empty($rgpd_front_logo_display)) echo 'checked'; ?>/>
        </fieldset>

        <?php submit_button('Enregistrer', 'primary','submit', TRUE); ?>

    </form>

</div>

