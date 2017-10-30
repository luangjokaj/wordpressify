<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript" >
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter46200687 = new Ya.Metrika({
						id:46200687,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true,
						webvisor:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-108244913-1"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-108244913-1');
	</script>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<!-- search -->
<div class="lk-search">
	<?php get_search_form(); ?>
</div>
<!-- search -->
<i class="shadow"></i>
<header id="header" class="lk-header">

	<div class="siteInfo">
		<?php if (get_theme_mod('lk-header-logo-section')) { ?>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php echo wp_get_attachment_url(get_theme_mod('lk-header-logo-section')); ?>"
				alt="Logo 🌈">
			</a>
		<?php } else { ?>
			<a href="<?php echo home_url(); ?>" class="logo">
				<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="Logo 🌈">
			</a>
		<?php } ?>

		<nav>
			<button id="menu"><span></span></button>
			<?php $args = array(
				'theme_location' => 'primary'
			); ?>
			<?php wp_nav_menu($args); ?>
		</nav>

		<button id="search"></button>
		<button id="close-search"><span></span></button>
	</div>

</header>
<!-- container -->
<div class="container">