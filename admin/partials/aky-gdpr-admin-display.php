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
            $rgpd_custom_rgpd_page = $options['rgpd_custom_rgpd_page'];
            $rgpd_custom_rgpd_link = $options['rgpd_custom_rgpd_link'];

            $rgpd_title = $options['rgpd_title'];
            $rgpd_mail = $options['rgpd_mail'];
            $rgpd_address = $options['rgpd_address'];
            $rgpd_contact = $options['rgpd_contact'];
            $rgpd_gta = $options['rgpd_gta'];
            $rgpd_youtube = $options['rgpd_youtube'];
            $rgpd_id_client = $options['rgpd_id_client'];
            $rgpd_front_logo = $options['rgpd_front_logo'];

            $rgpd_service_type = $options['rgpd_service_type'];
            $sirdata_user = $options['sirdata_user'];
            $sirdata_site = $options['sirdata_site'];

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

        <?php submit_button('Enregistrer', 'primary','submit', TRUE); ?>

    </form>

</div>

