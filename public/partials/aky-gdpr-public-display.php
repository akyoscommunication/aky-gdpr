<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://akyos.com
 * @since      1.0.0
 *
 * @package    Aky_Gdpr
 * @subpackage Aky_Gdpr/public/partials
 */

//Grab all options
$options = get_option('aky-gdpr');

// Cleanup
$rgpd_gta = $options['rgpd_gta'];
$rgpd_youtube = $options['rgpd_youtube'];
$rgpd_pixelfb = $options['rgpd_pixelfb'];
$rgpd_front_logo = $options['rgpd_front_logo'];

$rgpd_matomo_url = $options['rgpd_matomo_url'];
$rgpd_matomo_site_id = $options['rgpd_matomo_site_id'];
$rgpd_matomo_url_tag = $options['rgpd_matomo_url_tag'];

$rgpd_service_type = $options['rgpd_service_type'];
$rgpd_front_logo_display = $options['rgpd_front_logo_display'];

$onclick = null;
if ($rgpd_service_type === Aky_Gdpr_Admin::SERVICE_TARTEAUCITRON) {
    $onclick = 'tarteaucitron.userInterface.openPanel();';
} elseif ($rgpd_service_type === Aky_Gdpr_Admin::SERVICE_SIRDATA) {
    $onclick = 'javascript:window.Sddan.cmp.displayUI();';
}

if (!$rgpd_front_logo_display) {
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="akyCookiesGestion"
     class="<?= (!$rgpd_front_logo or $rgpd_front_logo === '') ? 'aky-cookies-logo' : 'aky-cookies-text' ?>"
     onclick="<?= $onclick ?>"
>
    <?php
    if (!$rgpd_front_logo or $rgpd_front_logo === '') {
        echo '<img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADIAAAAyCAYAAAAeP4ixAAAAAXNSR0IB2cksfwAAAAlwSFlzAAAPOgAADzoBlznbwgAACM9JREFUeJzFWltwFFUaRkRRQWtRH9bywWJxq9ayVkofrNo3k8nMZKbnJiuCUhAgCUlmcoUYUe6FEWrFLdGgqySE28yEEEIkAo4reF/ZRZ+8vWmJ4rW8lHi/cPb7untIz+nTl4lYdtVXRYY+p//vnP/y/ad7woSzcOXT2uRcWrsGqM02aTngOHAS+B44beI74P18Jva/4bb47sLy1DxgOnCen2f4vW9cFwyfDuMeAt4wDRUq5IB9bXHxRGdSHL4zJWBUEV8DPS7GTwKqgRzwFlB19oxv0ibBuCrgCeAnJ+MJrL4Y6UjIxstYoVigKzG+98CyxMfSvbmzsjOYfCawE/jKlUBaE8PtcXG4K+lGQJirPEWxWF2c40n7AnwGXDtuAlihiTBwAfCBGwFiT3NMdyEPAsRpYKH8rD3N2oWY52W6osO4znGRwKRTgG1mwLqS2NsaV62iE94D/qBYtFnA9y6L8W7Z7gXjpgFHvAgQ+xEL8kNHliZFb31M5JoR6HfYDHscUD1zJ2PLI64qfhsS7Wo3GGpLiC2LouLBmqjYWq/J/79S9VzERw/nRKA7kfgFqPFLgu501A8JF1/WcRABP4zdOmB3lYiSSFq7CfOeopsq5nsWSPhyLTOwt7kZ/9jiiOieHRJba6PlxIS8W9eng4Fz5OcPtcb5/AKfY2a9U0A/cI2vXbDsxgK3wN4wJyyaqipFc7hKdGohse6WatG7JCae9EngEIzbNK9aNAQqT7RHgvuXaaE/KhZzNjPk3tbYaoyZAdgIe5GY6ZZi184KivrKCtECEjCgBP+qtcWADQMtcbE8ERSNgUrREQkWx34IzPFjHwkBIeAFoEV5E1ZhklnsHF2qIxLQiXREgzYi98+LupJgjLRVB7gTYmk0JI//AjjfjQSy4hWYpwf40pxzxGk3gl4Ve2UqKOoqKmCQnUjPQvcd2ZWO6WMRF7axJi5yIoFF/huC/zVpzuNKl4OhB70y1D/h29wRlTH9DTFXIkwK3JEl6h35ESjaQc9g5koCF5u/5UFGnvNt4LISEtA1f8p6CECivz6K+KjUjbEaclcyLB5fVppe/313SjyzupRMz8KovhDNIVuMfWJZUArSb8xndpg70sG/D5Vqt0+Bv8q70eOnZgy2xMSOpphYARfbONfIVgMtCTzAvgPPr0uJYxsMQmMZKyXuTBgJw7Irp4EdFlvutzwzbBK5Hv/+ZbSzpEh+CwTGdiMTm4yb3rQazG08vDyBXB/zlCFOIJH/biwlQuxB5lp7S0isnx3WM9362dX1IDLFQuRm4HPgR2Cq6TFUGSfQkP2EOd4E+oC6glU5s7PLGp1cycpzNY+uSZYQOWjXS444uiolXronJZ66y/PekYJUqfGsq4ESPTWQiU0baI45JgQSqZNdKJ/RxEvdSfHiPUl9d4q/l1vFfZAgfgAWOxro98oaPbYtHuhaT69KnCHCXSo+PJuJ61lKFRvjxHdAvKBWw1MBVvq5wBzgL05EXlERyZmxUvzbKg6zkOVUtH1lSBMfYPe3SOFmsmQ65kTkpJ+MNWIJdLoYs9fDi53djfHE5sht1ziWCcQyByX6fcAlFvsYLzvMBWdafsqJyA9+iBxY6i9jsYFaMyuEFFsp2k09tXlB1NYo8e/+xpi+s8Ol2ZD1YbrK1lyjNjHfEFULSC8Cuxo18cjCiO/U+8hiFD1IkUxorPpTJe9Kl/YXFJAkwQ5SIsn6YDv2wW9TgWkF44joPOBy4AagHdjuSmRLTUS0hCoh2wOiKx7SXUnRspZgtb4b0GORoK36W8dSRLIFdnBNklkPXGCSuBF4x+W5P0+Qa0gRvWiaGgIVulq1GnTf7RFHEoyHRvQq8pgitta76zEJPGV5FRgsGM2V271fOwY7u0CqVdmoe+c6E+FhA8c0VqkVbplEysEJx/S7G7GRCVbq/m41hn7tNik7yDTGtUrN1wYsgJdbOoHul0dMycLUgmOOBZFY9/dQSf/RFQ/rxdD1ocuN3mMtxjZB7nNs95yIGPV3aOfoslsWIekgRrnrint2KiVKETsbNLERK/yP2yDwkI1Uh2ZuMmSoPSG2QQGM94BCnottwGN1SvesIZE/Z11O0q2QXYMkXr7XEIi/xkgWzwPObnMGvEexs98AM5Qy3glyLXl2jSHV5QaqHOSRgnkqwxS/Zla13jKzxylD+rwOGP0+dNUWP0QoHK1u8p9ue/NkW23492BrwtG9WHcYh9YDDdYsr1i0YPOZqjmQ0WbA0J9tmQvoqzeqe/E369Y+vcKA14oz040oXGcf/F6V4gkWXx8k2GhdJUuVQzKR/iWabsS2+rHfhjyOSGXsR5bhHHta7RKHB3Ukojonoz4r3scYdIjDUbsgS2thGHrKSuTRWoOIdUco7X2+/9BBHUW5P6zQal3xoM2tinhgvkGECYXuSzeWxn9VsPbsY+4V4zFMtkSm1KHC19pjRT5gprv1YfcG1QfPjvHxKObnqWNGOl5ajaAv7iB3ggmFiUUavwOYpFTC5mnFR34Cf9T0eQo/HoMy8zBI97b5P6AgeuG2VAIks9RUANbdO7IyJV5cb0soHwDXKUlYyCzK+ng7xZcxNEKW7KtuDsOQ8qr4PhjefWsYAe4uf0xQTM53JWG62Lk5jzPgIu5OGj7eLkl2yolyiJSJXmCiJxFe+Yze8D/nRWTT7WFb1umMhcRu/zWgXAwUFG+B3cmktctyHmT66qI22b5pnr2tlUERyNhSZTIXHCkoXp76JXMpyAy5kXloQbUuLB+YH9HTrJdUH2wzxB/T+vZG3/3JwLhJnCEDNzNj5qy8nqaK5YtREvJxLnbajIny3Mnp0hOAkc08U3MZHwx4gSl2vu/ALucy68xuWQHYUrP/TzhUYMVmsXOvE7/2ogIw5cxhldCUa42Pj2qKoAAcBQIFp4r925HSZpgtAPsZ5WmMrs+aHD9zYlPEfmJzQVaxv8fF5ixvfHjGtplnADzQ4OmM9RSTRE9iR48Pt8X5uVJNwXj17PoS1O/1f30tfT03ClZuAAAAAElFTkSuQmCC
" alt="cookie">';
    } else {
        echo $rgpd_front_logo;
    }
    ?>
</div>

<?php
}

if ($rgpd_service_type === Aky_Gdpr_Admin::SERVICE_TARTEAUCITRON) {
    if($rgpd_gta) {
        ?>
        <script type="text/javascript" defer>
			tarteaucitron.user.multiplegoogletagmanagerId = ['<?= implode("','", explode('|', $rgpd_gta)) ?>'];
			(tarteaucitron.job = tarteaucitron.job || []).push('multiplegoogletagmanager');
        </script>
        <?php
    }
    if($rgpd_pixelfb) {
        ?>
        <script type="text/javascript">
		    tarteaucitron.user.facebookpixelId = '<?= $rgpd_pixelfb ?>';
			tarteaucitron.user.facebookpixelMore = function () { /* add here your optionnal facebook pixel function */ };
		    (tarteaucitron.job = tarteaucitron.job || []).push('facebookpixel');
        </script>
        <?php
    }
    if($rgpd_youtube) {
        ?>
        <script type="text/javascript" defer>
			(tarteaucitron.job = tarteaucitron.job || []).push('youtube');
        </script>
        <?php
    }
    if ($rgpd_matomo_url) {
        ?>
        <script type="text/javascript" defer>tarteaucitron.user.matomoHost = '<?= $rgpd_matomo_url ?>';</script>
        <?php
    }
    if ($rgpd_matomo_site_id) {
        ?>
        <script type="text/javascript" defer>
		    tarteaucitron.user.matomoId = <?= $rgpd_matomo_site_id ?>;
		    (tarteaucitron.job = tarteaucitron.job || []).push('matomocloud');
        </script>
        <?php
    }
    if ($rgpd_matomo_url_tag) {
        ?>
        <script type="text/javascript">
		    tarteaucitron.user.matomotmUrl = '<?= $rgpd_matomo_url_tag ?>';
		    (tarteaucitron.job = tarteaucitron.job || []).push('matomotm');
        </script>
        <?php
    }
}
?>
