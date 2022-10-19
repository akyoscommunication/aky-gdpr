<?php

//Grab all options
$options = get_option('aky-gdpr');

// Cleanup
$rgpd_title = $options['rgpd_title'];
$rgpd_mail = $options['rgpd_mail'];
$rgpd_address = $options['rgpd_address'];
//        $rgpd_color_button = $options['rgpd_color_button'];
$rgpd_contact = $options['contact'];
$rgpd_gta = $options['rgpd_gta'];
$linkpage = get_home_url().'/politique-de-conservation-de-donnees';
$linkpagecookie = get_home_url().'/utilisation-des-cookies';

if ($rgpd_title && $rgpd_mail && $rgpd_address && $rgpd_contact) {

    if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'new-page-slug'", 'ARRAY_A' ) ) {

        $current_user = wp_get_current_user();

        // create post object
        $page1 = array(
            'post_title'  => __( 'Politique de conservation de données' ),
            'post_status' => 'publish',
            'post_content'  => '
			      <p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">1. Généralités</h2>
	'.$rgpd_title.' ('.$rgpd_address.'), en sa qualité de responsable du traitement, attache une grande importance à la protection et au respect de votre vie privée. La présente politique vise à vous informer de nos pratiques concernant la collecte, l’utilisation et le partage des informations que vous êtes amenés à nous fournir par le biais de notre site internet (le « Site »). '.$rgpd_title.' sera désignée par la suite en tant que « '.$rgpd_title.' », « nous » ou « notre ».

	Cette politique (ainsi que nos Conditions générales d’utilisation et tout document auquel il y est fait référence ainsi que notre Charte sur les Cookies) présente la manière dont nous traitons les données personnelles que nous recueillons et que vous nous fournissez. Nous vous invitons à lire attentivement le présent document pour connaître et comprendre nos pratiques quant aux traitements de vos données personnelles que nous mettons en œuvre.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">2. Les informations que nous recueillons</h2>
	Nous sommes susceptibles de recueillir et de traiter les données suivantes :
	<p style="text-align: center;">&nbsp;</p>
	<h3 class="subtitle-primary">2.1. Les informations que vous nous transmettez directement</h3>
	En utilisant notre Site, vous êtes amenés à nous transmettre des informations, dont certaines sont de nature à vous identifier (« Données Personnelles »). C’est notamment le cas lorsque vous remplissez des formulaires, lorsque vous nous contactez – que ce soit par téléphone, email ou tout autre moyen de communication – ou lorsque vous nous faites part d’un problème.

	Ces informations contiennent notamment les données suivantes :

	<b>2.1.1.</b> Les données nécessaires à l’utilisation des services que nous fournissons sur notre Site ou à l’accès à tout autre service fournis par nous. Ces données sont notamment vos nom et prénom, adresse e-mail et numéro de téléphone ;

	<b>2.1.2.</b> Une adresse postale ;

	<b>2.1.3.</b> Une copie de tous les échanges intervenus entre vous et '.$rgpd_title.' ;

	<b>2.1.4.</b> Les données que nous pouvons vous demander de fournir lorsque vous nous signalez un problème relatif à nos services, comme par exemple l’objet de votre demande d’assistance ;
	<p style="text-align: center;">&nbsp;</p>
	<h3 class="subtitle-primary">2.2. Les données que nous recueillons automatiquement</h3>
	<b>2.2.1.</b> Dans le cas où vous vous connectez à nos services en utilisant les fonctionnalités de réseaux sociaux mises à votre disposition, '.$rgpd_title.' sera susceptibles de recueillir certaines de vos Données Personnelles lorsque vous interagissez avec des fonctionnalités de ces réseaux sociaux, tel que les fonctionnalités « J’aime ».

	<b>2.2.2.</b> Lors de chacune de vos visites, nous sommes susceptibles de recueillir, conformément à la législation applicable et avec votre accord, le cas échéant, des informations relatives aux appareils sur lesquels vous utilisez nos services ou aux réseaux depuis lesquels vous accédez à nos services, tels que notamment vos adresses IP, données de connexion, types et versions de navigateurs internet utilisés, types et versions des plugins de votre navigateur, systèmes et plateformes d’exploitation, données concernant votre parcours de navigation sur notre Site, notamment votre parcours sur les différentes pages URL de notre Site, le contenu auquel vous accédez ou que vous consultez, les termes de recherches utilisés, les erreurs de téléchargement, la durée de consultation de certaines pages, l’identifiant publicitaire de votre appareil, les interactions avec la page ainsi que tout numéro du téléphone utilisé pour nous contacter. Parmi les technologies utilisées pour recueillir ces informations, nous avons notamment recours aux cookies (pour en savoir plus à ce sujet, veuillez vous référer à notre <a href="'.$linkpagecookie.'">Charte sur les Cookies</a>).
	<p style="text-align: center;">&nbsp;</p>
	<h3 class="subtitle-primary">2.3. Durée de conservation de vos données</h3>
	<b>2.3.1.</b> Vos Données sont archivées à l’issue d\'une durée de 2 ans après votre dernière utilisation de notre Site.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">3. Comment utilisons-nous les données que nous recueillons ?</h2>
	Nous utilisons les données que nous recueillons afin de:

	<b>3.1.</b> exécuter les contrats conclus entre vous et nous, et vous fournir les informations et services demandés ;

	<b>3.2.</b> vous envoyer des renseignements sur nos services par e-mail ou tout autre moyen de communication ;

	<b>3.3.</b> vous envoyer, conformément aux dispositions légales applicables et avec votre accord lorsque la législation l’exige, des messages marketing, publicitaires et promotionnels et des informations relatives à l’utilisation de nos services, ou vous suggérer et vous conseiller des services susceptibles de vous intéresser. Nous sommes également susceptibles d’utiliser vos données pour vous adresser des messages publicitaires susceptibles de vous intéresser sur les plateformes de réseaux sociaux ou sites de tiers. Si vous souhaitez davantage d’informations à ce sujet, nous vous invitons à prendre connaissance des documents contractuels de ces plateformes ;

	<b>3.4.</b> afin de vous informer des modifications apportées à nos services ;

	<b>3.5.</b> améliorer et optimiser notre Site, notamment pour nous assurer de ce que l’affichage de nos contenus est adapté à votre appareil ;

	<b>3.6.</b> vous permettre d’utiliser les fonctionnalités interactives de nos services si vous le souhaitez ;
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">4. Publicité ciblée et e-mails que nous vous envoyons</h2>
	Conformément à la législation applicable et avec votre consentement lorsqu’il est requis, nous pourrons utiliser les données que vous nous fournissez sur notre Site à des fins de prospection commerciale (par exemple pour (i) vous adresser nos newsletters, (ii) vous envoyer des invitations à nos événements ou toute autre communication susceptible de vous intéresser et (iii) afficher des publicités ciblées sur les plateformes de médias sociaux ou sites tiers).

	En ce qui concerne les emails promotionnels : Vous pouvez à tout moment retirer votre consentement en (i) décochant la case afférente dans votre compte, (ii) cliquant sur le lien de désinscription fourni dans chacune de nos communications ou (iii) en nous contactant selon les modalités décrites à l’article 13 ci-dessous.

	En ce qui concerne la publicité ciblée :
	<ul>
	 	<li>Sur les plateformes de réseaux sociaux (par exemple Facebook, Twitter): vous pouvez vous opposer à tout moment à ce traitement en configurant les paramètres relatifs à la publicité de votre compte ;</li>
	 	<li>Sur des sites tiers: vous pouvez vous reporter à notre Charte sur les Cookies pour comprendre comment retirer votre consentement.</li>
	</ul>
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">5. Cookies et technologies semblables</h2>
	Pour en savoir plus, consultez notre <a href="'.$linkpagecookie.'">Charte sur les Cookies</a>.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">6. Liens vers d’autres sites internet et réseaux sociaux</h2>
	Notre Sites contient des liens vers les sites internet de nos partenaires ou de sociétés tierces. Veuillez noter que ces sites internet ont leur propre politique de confidentialité et que nous déclinons toute responsabilité quant à l’utilisation faite par ces sites des informations collectées lorsque vous cliquez sur ces liens. Nous vous invitons à prendre connaissance de politiques de confidentialité de ces sites avant de leur transmettre vos Données Personnelles.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">7. Modification de notre politique de confidentialité</h2>
	Nous pouvons être amené à modifier occasionnellement la présente politique de confidentialité. Lorsque cela est nécessaire, nous vous en informerons et/ou solliciterons votre accord. Nous vous conseillons de consulter régulièrement cette page pour prendre connaissance des éventuelles modifications ou mises à jour apportées à notre politique de confidentialité.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">8. Contact</h2>
	Pour toute question relative à la présente politique de confidentialité ou pour toute demande relative à vos données personnelles, vous pouvez nous contacter en :
	<ul>
	 	<li>adressant un email à notre délégué à la protection des données à l’adresse <a href="mailto:'.$rgpd_mail.'">'.$rgpd_mail.'</a></li>
	 	<li>en remplissant ce <a href="'.$rgpd_contact.'">formulaire en ligne</a></li>
	 	<li>ou en nous adressant un courrier à l’adresse suivante : '.$rgpd_title.' – A l’attention du Délégué à la Protection des Données – '.$rgpd_address.'</li>
	</ul>
	[/vc_column_text][/vc_column][/vc_row]',
            'post_author' => $current_user->ID,
            'post_type'   => 'page',
        );

        $page2 = array(
            'post_title'  => __( 'Utilisation des cookies' ),
            'post_status' => 'publish',
            'post_content'  => '[vc_row][vc_column][vc_column_text]'.$rgpd_title.' (« nous », « nos » ou « notre ») utilise les cookies afin de vous proposer un service web amélioré et davantage personnalisé. À travers cette Charte d’utilisation des Cookies de '.$rgpd_title.', nous vous présentons comment et pourquoi nous utilisons des cookies sur ce site, en toute transparence.
			      <p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">Qu’est-ce qu’un cookie et à quoi sert-il ?</h2>
	Un cookie est un petit fichier texte enregistré, et/ou lu par votre navigateur, sur le disque dur de votre terminal (PC, ordinateur portable ou smartphone, par exemple) et déposé par les sites internet que vous visitez. Quasiment tous les sites utilisent des cookies pour bien fonctionner et optimiser leur ergonomie et leurs fonctionnalités. Les cookies rendent également les interactions avec les sites plus sécurisées et rapides, dans la mesure où ceux-ci peuvent se souvenir de vos préférences (telles que votre identifiant et votre langue) en renvoyant les informations qu’ils contiennent au site d’origine (cookie interne) ou à un autre site auquel ils appartiennent (cookie tiers), lorsque vous visitez à nouveau le site concerné à partir du même terminal. Selon leur fonction et le but de leur utilisation, les cookies sont classés parmi les catégories décrites ci-dessous et utilisées par '.$rgpd_title.' sur ce site :

	<span class="italic bold">Les cookies absolument nécessaires</span> vous permettent de vous déplacer sur le site et d’utiliser ses fonctionnalités de base. Ils sont généralement installés uniquement en réponse à des actions de votre part pour accéder à des services, tels que la connexion à un espace sécurisé de notre site. Ces cookies sont indispensables pour l’utilisation de ce site.

	<span class="italic bold">Les cookies de fonctionnalité</span> sont utilisés pour vous reconnaître lorsque vous revenez sur notre site et nous permettent de vous proposer des fonctionnalités améliorées et davantage personnalisées, comme l’accueil nominatif et l’enregistrement de vos préférences (le choix de votre langue ou la région où vous vous trouvez par exemple). Ces cookies collectent des informations anonymes et ne peuvent pas tracer vos déplacements sur d’autres sites.

	<span class="italic bold">Les cookies d’analyse et de performance</span> nous permettent de reconnaître et de compter le nombre de visiteurs sur notre site et de collecter des informations sur la manière dont notre site est utilisé (par exemple, quels sont les pages les plus vues par les visiteurs, est-ce que les internautes ont des messages d’erreur sur certaines de nos pages, etc.). Cela nous permet d’améliorer la façon dont notre site internet fonctionne, par exemple, en nous assurant, que les utilisateurs trouvent facilement ce qu’il cherche.

	<span class="italic bold">Les cookies publicitaires ou de ciblage</span> enregistrent votre visite sur notre site, ainsi que les pages que vous avez consultées et les liens que vous avez suivis. Nous utiliserons ces informations pour afficher des publicités pertinentes en fonction de vos centres d’intérêts. Ils sont également utilisés pour limiter le nombre d’affichages d’une même publicité et pour aider à mesurer l’efficacité des campagnes publicitaires. Ainsi, il se peut également que nous partagions ces informations auprès de tiers (les annonceurs par exemple).
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">Utilisation des cookies tiers</h2>
	Veuillez noter que '.$rgpd_title.' utilise les services de tiers pour connaître votre utilisation de ce site, ceci afin d’optimiser votre expérience utilisateur et d’afficher des publicités en dehors de ce site. Ces tierces parties (comme par exemple des réseaux d’annonceurs et des prestataires de services externes, tels que les services d’analyse de trafic web) peuvent également utiliser des cookies que nous ne maîtrisons pas.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">Que faire si vous ne souhaitez pas activer les cookies ?</h2>
	Vous pouvez révoquer votre consentement à l’utilisation des cookies à tout moment, de la façon suivante :
	<p style="text-align: center;">&nbsp;</p>
	<h3 class="subtitle-primary">En paramétrant votre navigateur internet</h3>
	Si vous souhaitez supprimer les cookies enregistrés sur votre terminal et paramétrer votre navigateur pour refuser les cookies, vous pouvez le faire via les préférences de votre navigateur internet. Ces options de navigation relatives aux cookies se trouvent habituellement dans les menus « Options », « Outils » ou « Préférences » du navigateur que vous utilisez pour accéder à ce site. Cependant, selon les différents navigateurs existants, des moyens différents peuvent être utilisés pour désactiver les cookies. Pour en savoir plus vous pouvez suivre les liens référencés ci-dessous :
	<ul>
	 	<li><a href="https://support.microsoft.com/fr-fr/help/17442/windows-internet-explorer-delete-manage-cookies" target="_blank" rel="noopener">Microsoft Internet Explorer</a></li>
	 	<li><a href="https://support.google.com/accounts/answer/61416?hl=fr&amp;comuto_cmkt=FR_CR_ALL_NEWT" target="_blank" rel="noopener">Google Chrome</a></li>
	 	<li><a href="https://support.apple.com/kb/PH19214?locale=fr_FR&amp;viewlocale=fr_FR&amp;comuto_cmkt=FR_CR_ALL_NEWT" target="_blank" rel="noopener">Safari</a></li>
	 	<li><a href="https://support.mozilla.org/fr/kb/activer-desactiver-cookies-preferences?redirectlocale=fr&amp;comuto_cmkt=FR_CR_ALL_NEWT&amp;redirectslug=activer-desactiver-cookies" target="_blank" rel="noopener">Firefox</a></li>
	 	<li><a href="https://help.opera.com/en/latest/web-preferences/#cookies" target="_blank" rel="noopener">Opera</a></li>
	</ul>
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">Veuillez noter que si vous refusez, depuis votre navigateur internet, l’enregistrement de cookies sur votre terminal, vous serez toujours en mesure de naviguer sur ce site, mais certaines parties et options pourraient ne pas fonctionner correctement.</h2>
	<p style="text-align: center;">&nbsp;</p>
	<h3 class="subtitle-primary">En utilisant des plateformes en ligne de contrôle des cookies publicitaires :</h3>
	S’agissant des cookies publicitaires déposés par des tiers, vous pouvez également vous connecter au site <a href="http://www.youronlinechoices.com/fr/controler-ses-cookies/?comuto_cmkt=FR_CR_ALL_NEWT" target="_blank" rel="noopener">Youronlinechoices</a>, proposé par les professionnels de la publicité digitale regroupés au sein de l’association européenne EDAA (European Digital Advertising Alliance).

	Vous pourrez ainsi refuser ou accepter les cookies utilisés les professionnels de la publicité adhérents.
	<p style="text-align: center;">&nbsp;</p>
	<h2 class="title-primary">Des questions concernant la Charte sur les Cookies de '.$rgpd_title.' ?</h2>
	Si vous avez des questions concernant la Charte sur les Cookies de '.$rgpd_title.', n’hésitez pas à nous contacter en utilisant le <a href="'.$rgpd_contact.'">formulaire en ligne</a>.',
            'post_author' => $current_user->ID,
            'post_type'   => 'page',
        );

        // insert the post into the database
        wp_insert_post( $page1 );
        wp_insert_post( $page2 );
    }
}