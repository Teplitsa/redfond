<!DOCTYPE html>
<!--[if lte IE 9]><html class="no-js IE9 IE" <?php language_attributes(); ?>><![endif]-->
<!--[if gt IE 9]><!--><html class="no-js" <?php language_attributes(); ?>><!--<![endif]-->
<head profile="http://gmpg.org/xfn/11">

	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="mobile-web-app-capable" content="yes">
	<meta name="theme-color" content="rgb(239,64,78)">
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!--open graph-->
	<meta property="og:url" content="https://<?php echo $_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"] ?>"/>
	<meta property="og:type" content="article" />
	<meta property="og:title" content="<?php wp_title( '|', true, 'right' ); ?>" />
	<meta property="og:description" content="Платформа для сбора помощи людям с редкими заболеваниями"/>
	<meta property="og:image" content="<?php
		if(get_post_type() == 'page') {echo (get_stylesheet_directory_uri().'/og-image.jpg');}
		elseif(is_home()) {echo (get_stylesheet_directory_uri().'/og-image.jpg');}
		else {echo the_post_thumbnail_url('full');}

	?>"/>


	<?php wp_head(); ?>
	<script type="text/javascript" src="<?php echo get_stylesheet_directory_uri(); ?>/js/emerge.js"></script>
	<meta name="yandex-verification" content="63719936bde3185b" />

</head>
	
<body id="top" <?php body_class(); ?>>
<div class="site">
	<div class="wrapper" id="wrapper">
		<div class="header">
			<a href="<?php bloginfo( 'url' ); ?>">
				<div class="logo module">
					<div class="logo-keeper emerge"></div>
					<p class="logotext emerge">Скорая помощь людям <nobr>с редкими заболеваниями</nobr></p>
				</div>
			</a>
			
			<div class="main-nav module emerge">
				<ul>
					<li><a href="/about/">О фонде</a></li>
					<li><a href="/report/">Отчеты</a></li>
					<li><a href="/contacts/">Контакты</a></li>
				</ul>
			</div>
			<div class="help-button module emerge"><div><a href="/help/">Попросить <nobr>о помощи</nobr></a></div></div>
		</div>

