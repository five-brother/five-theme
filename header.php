<!DOCTYPE html>
<html>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">


	<?php wp_head(); ?>

</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<!-- 头部logo -->
		<div class="bg-zise">
			<div class="container">
				<?php
				// the_custom_logo(); 
				?>
			</div>
		</div>

		<header class="navbar navbar-expand-md navbar-dark bd-navbar">
			<nav class="container-xxl flex-wrap flex-md-nowrap">

				<?php
				if (is_front_page() && is_home()) :
				?>
					<h1 class="site-title navbar-brand"><a class="text-white" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
				<?php
				else :
				?>
					<p class="site-title navbar-brand"><a class="text-white" href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></p>
				<?php
				endif;
				?>


				<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#bdNavbar" aria-controls="bdNavbar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>

				<div class="offcanvas offcanvas-end bd-navbar" tabindex="-1" id="bdNavbar" aria-labelledby="bdNavbarOffcanvasLabel">
					<div class="offcanvas-header pb-0">
						<h5 class="offcanvas-title text-white" id="bdNavbarOffcanvasLabel">品牌名称</h5>
						<button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
					</div>
					<?php
					wp_nav_menu(array(
						'theme_location'       => 'top',
						'container'            => 'div',
						'container_class'      => 'offcanvas-body pt-0',
						'fallback_cb'          => 'wp_page_menu',
						'items_wrap'           => '<ul class="navbar-nav flex-row flex-wrap">%3$s</ul>'
					)); ?>

				</div>
			</nav>
		</header>

		<!-- 主体部分开始 -->


		<div class="wrap mt-2">

			<div class="container-xxl ">
				<div class="row">