<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package cltheme
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e('Skip to content', 'webtintuc'); ?></a>

		<header class="header" id="header">
			<div class="container">
				<div class="header__inner">
					<a href="<?php echo home_url(); ?>" class="header__logo">
						<img src="<?php echo get_template_directory_uri() . '/assets/images/sky-news-2-logo.png'; ?>"
							alt="logo">
					</a>

					<div class="header__wrap">
						<!-- main menu -->
						<?php
						if (has_nav_menu('menu-primary')) {
							wp_nav_menu(
								array(
									'theme_location' => 'menu-primary',
									'container' => 'nav',
									'container_class' => 'header__nav',
									'depth' => 2,
								)
							);
						}
						?>

						<!-- chức năng -->
						<div class="header__func">
							<!-- btn search -->
							<button type="button" class="header__search" data-toggle="modal" data-target="#modalSearch">
								<span class="header__searchIcon"></span>
							</button>
						</div>
					</div>

					<div class="header__sp">
						<!-- btn search -->
						<button type="button" class="header__search header__search--sp" data-toggle="modal"
							data-target="#modalSearch">
							<span class="header__searchIcon"></span>
						</button>

						<!-- button toggle menu mobile -->
						<div class="header__toggle">
							<span class="header__toggleItem header__toggleItem--open"></span>
							<span class="header__toggleItem header__toggleItem--close"></span>
						</div>
					</div>

					<!-- btn book tour -->
					<?php
					// $build_your_trip = get_field('button_build_your_trip_' . LANG, 'option') ?? null;		 
					// if ($build_your_trip):
					?>
					<div class="d-none d-lg-block">
						<a class="header__btn" href="<?php echo $build_your_trip; ?>">
							<span class="header__btnIcon"></span>
							<span>
								<?php _e('LIÊN HỆ', 'wplongpv'); ?>
							</span>
						</a>
					</div>
					<?php // endif;  ?>
				</div>
			</div>
		</header>

		<!-- Modal -->
		<div class="modal modalSearch fade" id="modalSearch" tabindex="-1" role="dialog"
			aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<button type="button" class="close modalForm__btn" data-dismiss="modal" aria-label="Close">
					</button>
					<div class="modal-body">
						<form class="formGroup" method="get" action="<?php echo home_url(); ?>" role="search">
							<input type="text" aria-label="search" aria-describedby="search-addon" name="s"
								placeholder="<?php _e('Search', 'wplongpv'); ?>">
						</form>
					</div>
				</div>
			</div>
		</div>

		<!-- main body -->
		<main class="mainBody"></main>