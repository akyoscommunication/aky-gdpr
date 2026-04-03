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

    <div class="notice notice-info" style="padding: 12px 16px;">
        <h3 style="margin-top: 8px;">📋 Checklist mise en conformité RGPD</h3>
        <ol style="margin-left: 20px; line-height: 1.8;">
            <li>
                <strong>Bannière de cookies</strong> — À activer systématiquement, même sans outil de suivi.
                Nos bannières permettent déjà aux utilisateurs de refuser les cookies tout en accédant librement au site.
            </li>
            <li>
                <strong>3 pages obligatoires à créer</strong> (générées automatiquement via ce plugin) :
                <ul style="margin-left: 20px; list-style: disc;">
                    <li>Politique de confidentialité</li>
                    <li>Utilisation des cookies</li>
                    <li>Mentions légales</li>
                </ul>
                Les informations de la société sont disponibles sur <a href="https://www.societe.com/" target="_blank" rel="noopener">societe.com</a>.
                Les modèles de textes légaux sont disponibles sur
                <a href="https://drive.google.com/drive/folders/1IJIUgbtvtkacqGc8FtotCpcSOrVgtGZ9?usp=sharing" target="_blank" rel="noopener">Google Drive – TEXTES LEGAUX</a>.
            </li>
            <li>
                <strong>Formulaires de contact</strong> — Chaque formulaire doit comporter une case à cocher RGPD avec le texte suivant :<br>
                <em style="display: inline-block; margin-top: 4px; padding: 6px 10px; background: #f0f0f0; border-left: 3px solid #007cba;">
                    « J'accepte que mes données personnelles soient réutilisées par <strong>[Nom de la société]</strong> à des fins d'information. »
                </em>
            </li>
        </ol>
    </div>

    <div class="notice notice-warning" style="padding: 12px 16px;">
        <p>
            <strong>⚠️ Site e-commerce ?</strong>
            Une page <strong>Conditions générales de vente (CGV)</strong> est également obligatoire.
            Son contenu est propre à chaque entreprise et doit être fourni par le client — aucun modèle disponible.
        </p>
    </div>

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
            $rgpd_legal_company_name = $options['rgpd_legal_company_name'] ?? false;
            $rgpd_legal_legal_form = $options['rgpd_legal_legal_form'] ?? false;
            $rgpd_legal_capital = $options['rgpd_legal_capital'] ?? false;
            $rgpd_legal_rcs = $options['rgpd_legal_rcs'] ?? false;
            $rgpd_legal_siret = $options['rgpd_legal_siret'] ?? false;
            $rgpd_legal_tva = $options['rgpd_legal_tva'] ?? false;
            $rgpd_legal_publication_director = $options['rgpd_legal_publication_director'] ?? false;
            $rgpd_legal_host_name = $options['rgpd_legal_host_name'] ?? false;
            $rgpd_legal_host_address = $options['rgpd_legal_host_address'] ?? false;
            $rgpd_legal_host_phone = $options['rgpd_legal_host_phone'] ?? false;

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
            <h3>Mentions légales (génération automatique)</h3>
            <em class="aky-gdpr-field-info">Ces champs alimentent la page "Mentions légales" générée automatiquement.</em>
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-company-name">Raison sociale</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-company-name" name="<?php echo $this->plugin_name; ?>[rgpd_legal_company_name]" value="<?php if(!empty($rgpd_legal_company_name)) echo $rgpd_legal_company_name; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-form">Forme juridique</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-form" name="<?php echo $this->plugin_name; ?>[rgpd_legal_legal_form]" value="<?php if(!empty($rgpd_legal_legal_form)) echo $rgpd_legal_legal_form; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-capital">Capital social</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-capital" name="<?php echo $this->plugin_name; ?>[rgpd_legal_capital]" value="<?php if(!empty($rgpd_legal_capital)) echo $rgpd_legal_capital; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-rcs">RCS</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-rcs" name="<?php echo $this->plugin_name; ?>[rgpd_legal_rcs]" value="<?php if(!empty($rgpd_legal_rcs)) echo $rgpd_legal_rcs; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-siret">SIRET</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-siret" name="<?php echo $this->plugin_name; ?>[rgpd_legal_siret]" value="<?php if(!empty($rgpd_legal_siret)) echo $rgpd_legal_siret; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-tva">TVA intracommunautaire</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-tva" name="<?php echo $this->plugin_name; ?>[rgpd_legal_tva]" value="<?php if(!empty($rgpd_legal_tva)) echo $rgpd_legal_tva; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-publication-director">Directeur de la publication</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-publication-director" name="<?php echo $this->plugin_name; ?>[rgpd_legal_publication_director]" value="<?php if(!empty($rgpd_legal_publication_director)) echo $rgpd_legal_publication_director; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-host-name">Hébergeur - Nom</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-host-name" name="<?php echo $this->plugin_name; ?>[rgpd_legal_host_name]" value="<?php if(!empty($rgpd_legal_host_name)) echo $rgpd_legal_host_name; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-host-address">Hébergeur - Adresse</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-host-address" name="<?php echo $this->plugin_name; ?>[rgpd_legal_host_address]" value="<?php if(!empty($rgpd_legal_host_address)) echo $rgpd_legal_host_address; ?>" />
        </fieldset>

        <fieldset class="aky-gdpr-field">
            <label for="<?php echo $this->plugin_name; ?>-legal-host-phone">Hébergeur - Téléphone</label>
            <input type="text" class="regular-text" id="<?php echo $this->plugin_name; ?>-legal-host-phone" name="<?php echo $this->plugin_name; ?>[rgpd_legal_host_phone]" value="<?php if(!empty($rgpd_legal_host_phone)) echo $rgpd_legal_host_phone; ?>" />
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

