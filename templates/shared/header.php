<header id="header" role="header">

	<h1 id="logo">
		<a href="<?php echo home_url('/'); ?>">
			<?php bloginfo('name'); ?>
		</a>
	</h1>

	<nav id="navigation" role="navigation">

		<?php

		$nav = [
			'container' 		=> false,
			'container_class' => 'menu cf',
			'menu' 				=> __('Primary Menu', 'nuclear-theme'),
			'menu_class' 		=> 'nav top-nav cf',
			'theme_location' 	=> 'main-nav',
			'before' 			=> '',
			'after' 				=> '',
			'link_before' 		=> '',
			'link_after' 		=> '',
			'depth' 				=> 0,
			'fallback_cb' 		=> ''
		];

		wp_nav_menu($nav);

		?>

	</nav>
</header>

<main role="main" id="main">
