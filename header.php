<?php

/**
 * Header template
 *
 * @package Abbrivio
 */

// Theme options
$theme_options = abbrivio_get_options();

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<?php if ($theme_options['abbrivio-disable-automatic-scroll-restoration']) { ?>
		<!-- Disable automatic scroll restoration -->
		<script>history.scrollRestoration = "manual"</script>
	<?php } ?>

	<?php if ($theme_options['abbrivio-site-favicon']) { ?>
		<!-- Favicon -->
		<link rel="shortcut icon" href="<?php echo $theme_options['abbrivio-site-favicon']; ?>" type="image/x-icon">
		<link rel="icon" href="<?php echo $theme_options['abbrivio-site-favicon']; ?>" type="image/x-icon">
	<?php } ?>

	<?php if ($theme_options['abbrivio-web-app-status-bar-style']) { ?>
		<!-- Enable customization for iOS -->
		<meta name="apple-mobile-web-app-capable" content="yes">
		<!-- Chrome, Firefox OS, Opera and Vivaldi -->
		<meta name="theme-color" content="<?php echo $theme_options['abbrivio-web-app-status-bar-style']; ?>">
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="<?php echo $theme_options['abbrivio-web-app-status-bar-style']; ?>">
		<!-- iOS Safari -->
		<meta name="apple-mobile-web-app-status-bar-style" content="<?php echo $theme_options['abbrivio-web-app-status-bar-style']; ?>">
	<?php } ?>

	<?php wp_head(); ?>

	<?php if ($theme_options['abbrivio-google-analytics-script']) { ?>
		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
			(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
			m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
			ga('create', '<?php echo $theme_options['abbrivio-google-analytics-script']; ?>', 'auto');
			ga('send', 'pageview');
		</script>
	<?php } ?>

	<?php if ($theme_options['abbrivio-facebook-pixel-script']) { ?>
		<!-- Facebook Pixel Code -->
		<script>
			!function(f,b,e,v,n,t,s)
			{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
			n.callMethod.apply(n,arguments):n.queue.push(arguments)};
			if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
			n.queue=[];t=b.createElement(e);t.async=!0;
			t.src=v;s=b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t,s)}(window, document,'script',
			'https://connect.facebook.net/en_US/fbevents.js');
			fbq('init', '<?php echo $theme_options['abbrivio-facebook-pixel-script']; ?>');
			fbq('track', 'PageView');
		</script>
	<?php } ?>
</head>

<body <?php body_class(); ?>>

	<?php
	if (function_exists('wp_body_open')) {
		wp_body_open();
	}
	?>

	<?php get_template_part('template-parts/menu/menu', 'desktop'); ?>

	<main id="site-content" class="site-content">