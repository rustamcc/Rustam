<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php bloginfo('name'); wp_title(); ?></title>
	<meta name="description" content="<?php echo get_option('blogdescription'); ?>"> 
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php endif; ?>
<?php wp_head(); ?>
<script>window.jQuery || document.write('<script src="<?php echo get_bloginfo('template_url'); ?>/js/jquery-3.3.1.min.js"><\/script>')</script>
</head>
<body>
	<header>
		<div class="top-header-box pr margin-lr-auto">
			<div class="top-head">
				<a href="<?php echo get_option('siteurl'); ?>">
					<h1 class="top-head__name ta-c tt-u va-m"><?php bloginfo('name'); ?></h1>
				</a>
				<div class="top-head__hamburger df jc-c fd-c pa"><button id="menu-toggle" class="b0 hover-pointer"><i class="fas fa-bars f2em"></i></button></div>
			</div>

			<div class="top-menu1 df jc-c">
				<div class="top-menu1__search pr df jc-c ai-c">
					<a href="<?php echo get_option('siteurl'); ?>/search/"><i class="fas fa-search top-menu1__search-icon clr-6 f1-5em"></i></a>
					<?php echo usam_search_widget(); ?>	
				</div>
				<div class="top-menu1__box">
					<?php if( has_nav_menu('header_menu') ){
						wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'head-menu', 'menu_class' => 'head-menu-c ta-c tt-u', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'depth' => 6, 'item_spacing' => 'discard', 'theme_location' => 'header_menu', 'before' => '', 'fallback_cb' => '__return_empty_string' ) ); 
					} else {  ?>
						<nav class="head-menu"><ul id="menu-menu1" class="head-menu-c ta-c tt-u"><li id="menu-item-35" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-35"><a href="<?php echo get_option('siteurl'); ?>">Главная</a></li><li id="menu-item-48" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-48"><a href="#">Пример</a><ul class="sub-menu"><li id="menu-item-53" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-53"><a href="#">Уровень 2</a></li><li id="menu-item-49" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children menu-item-49"><a href="#">Уровень 2</a><ul class="sub-menu"><li id="menu-item-50" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-50"><a href="#">Уровень 3</a></li></ul></li></ul></li><li id="menu-item-51" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-51"><a href="#">Отзывы</a></li><li id="menu-item-52" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-52"><a href="#">Нет меню</a></li></ul></nav>
					<?php } ?>
				</div>
			</div>

			<div class="top-menu2 p20-0">
				<div class="user-menu-box df jc-c tt-u">
					<?php $basket_subtotal = usam_get_basket_subtotal(); if( empty($basket_subtotal) ) $basket_subtotal = 0; ?>
					<a href="<?php echo usam_get_url_system_page( 'basket' ); ?>"><i class="fas fa-shopping-basket"></i> <span>Корзина</span>
						(<div class="basket__price dib"><?php echo $basket_subtotal; ?></div>)</a>
						<a href="<?php echo usam_get_url_system_page( 'wish-list' ); ?>"><i class="far fa-heart"></i> <span>Избранное</span></a>				
						<a href="<?php echo usam_get_url_system_page( 'compare' ); ?>"><i class="far fa-clone"></i> <span>Сравнение</span></a>
						<?php usam_feedback_link( 'ask_question', '<i class="far fa-comment-alt"></i> <span>Задать вопрос</span>' ); ?>
						<?php if ( is_user_logged_in() ) { ?>
							<a href="<?php echo get_option('siteurl'); ?>/your-account/my-profile/"><i class="far fa-user"></i> <span>Мой аккаунт</span></a>
							<?php $redirect = $_SERVER['REQUEST_URI']; ?>							
							<a href="<?php echo wp_logout_url($redirect); ?>"><i class="fas fa-sign-out-alt"></i> <span>Выйти</span></a>
						<?php } else { ?>						
							<a href="<?php echo usam_get_url_system_page('login') ?>"><i class="far fa-user"></i> <span>Вход / Регистация</span></a>
						<?php } ?>
					</div>
				</div>

				<div class="top-icon-basket ta-c pa">
					<a href="<?php echo usam_get_url_system_page( 'basket' ); ?>/" class="db clr-white f1-3em p20-0">
						<i class="fas fa-shopping-basket"></i>
						<span class="basket__count"><?php echo usam_get_basket_number_items(); ?></span>
					</a>
					<div class="bot pr db cb">
					</div>
				</div>	
			</div>
		</header>