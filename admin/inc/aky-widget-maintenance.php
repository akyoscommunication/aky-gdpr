<?php

wp_add_dashboard_widget('custom_help_widget', 'Support Akyos — Nous sommes disponible en cas de problème', 'custom_dashboard_help');

function custom_dashboard_help() {
    $options = get_option('aky-gdpr');
    $rgpd_id_client = $options['rgpd_id_client'];

    $json = file_get_contents('https://mon-agence-web.io/api/getMaintenance/5bc46cc7828a97000f885600/'.$rgpd_id_client.'');
    $obj = json_decode($json);

    if ($obj && property_exists((object)$obj, 'remaining_hours')) {

        $status = null;
    
        switch (true) {
            case $obj->remaining_hours >= 5:
                $status = 'success';
                break;
            case $obj->remaining_hours >= 3:
                $status = 'warning';
                break;
            case $obj->remaining_hours < 3:
                $status = 'danger';
                break;
        }
    
        ?>
        <div class="plan">
            <h3>Consommation de votre forfait de maintenance</h3>
            <?php if ($rgpd_id_client) { ?>
            <div class="progress">
                <div class="progress-bar progress-bar-<?= $status ?>" role="progressbar" aria-valuenow="100"
                     aria-valuemin="0" aria-valuemax="100" style="width:100%">
                    <?php echo $obj->remaining_hours; ?> heure(s) <?php echo $obj->remaining_minutes; ?> minute(s) restante(s)
                </div>
            </div>
            <?php } else { ?>
                <b><em>Veuillez renseigner votre identifiant client afin de recevoir vos informations de suivi.</em></b>
            <?php } ?>
        </div>
        <div class="footer">
            <p>Si vous avez un problème, besoin d'aide ou toute autres demandes vous pouvez nous contacter par mail (info@akyos.com) ou au 03 80 10 23 57.</p>
            <p>
                Cordialement, L'équipe Akyos.
            </p>
        </div>
    <?php 
    }
} 
?>
