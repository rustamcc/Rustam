<?php
/*
*	Ajax
*/
add_action( 'wp_ajax_quickview',        'quickview_callback' );
add_action( 'wp_ajax_nopriv_quickview', 'quickview_callback' );
function quickview_callback(){
	if( ! empty( $_REQUEST['product_id'] ) ){
		get_template_part( 'ajax/quickview' );
		// echo( json_encode( array( 'ok' => true) ) );
	}
	else {
		echo( json_encode( array( 'ok' => false ) ) );
	}
	wp_die();
}
/*
*	Глобальные переменные JS
*/
function js_variables(){
	$variables = array (
		'ajaxurl' => admin_url('admin-ajax.php')
	);
	echo(
		'<script type="text/javascript">window.wp_data = '.
		json_encode($variables).
		';</script>'
	);
}
add_action('wp_head','js_variables');
/*
*
*/
if (function_exists('add_theme_support')) {
	add_theme_support('menus');
}
register_nav_menus( array(
	'header_menu' => 'Меню в шапке',
	'footer_menu' => 'Меню в подвале',
	'sn_menu' => 'Соц.сети в подвале'
) );


/*
*
* 	#asyncload - для асинхронной загрузки
*	wp_enqueue_script( '...', '//...min.js#asyncload' );
*
*/

add_action( 'wp_enqueue_scripts', 'magazine_scripts_styles', 1 );
function magazine_scripts_styles()
{
	wp_enqueue_style( 'main', get_stylesheet_uri(), array('usam-form', 'usam-theme', 'usam-chat', 'usam-technical') );
	wp_deregister_script( 'jquery' );

	wp_enqueue_style( 'font-RobotoCondensed', '//fonts.googleapis.com/css?family=Roboto+Condense');
	wp_enqueue_style( 'icons-font-awesome', '//use.fontawesome.com/releases/v5.0.13/css/all.css' );
	wp_enqueue_script( 'jquery', '//code.jquery.com/jquery-3.3.1.min.js', false, false );
	wp_enqueue_script( 'slick-j', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array( 'jquery' ) );
	wp_enqueue_style( 'slick-c', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css');
	wp_enqueue_script( 'main_js', get_template_directory_uri() . '/js/main.js#asyncload', array( 'jquery', 'slick-j' ) );
}


add_action( 'wp_footer', 'footer_scripts', 1 );
function footer_scripts(){

}


// Async load
function ikreativ_async_scripts($url)
{
	if ( strpos( $url, '#asyncload') === false )
		return $url;
	else if ( is_admin() )
		return str_replace( '#asyncload', '', $url );
	else
		return str_replace( '#asyncload', '', $url )."' async='async"; 
}
add_filter( 'clean_url', 'ikreativ_async_scripts', 11, 1 );


/*
*	button
*/
function button_addtocart( array $args = array() ){
	if ( empty( $args["product_has_stock"] ) ){ $args["product_has_stock"] = true; }
	if( ! $args["product_has_stock"] ) { $disabled = "disabled"; }
	else { $disabled = ''; }

	if( empty( $args["class"] ) )			{ $args["class"] = ""; }
	if( empty( $args["product_id"] ) )		{ $args["product_id"] = ""; }
	if( empty( $args["product_link"] ) )	{ $args["product_link"] = ""; }
	if( empty( $args["text"] ) ) 			{ $args["text"] = ""; }

	$r = '<a href="'.$args["product_link"].'" ';
	$r .= 'data-product_link="'.$args["product_link"].'" ';
	$r .= 'data-product_id="'.$args["product_id"].'" ';
	$r .= 'class="addtocart hover-pointer '.$args["class"].'" ';
	$r .= $disabled.'>';
	$r .= '<i class="fas fa-plus-circle"></i> '.$args["text"].'</a>';
	echo $r;
}
/*
*	customizer
*/
add_action('customize_register', function($customizer){
	$customizer->add_section(
		'example_section_one',
		array(
			'title' => 'Настройки магазина',
			'description' => 'Управление видимостью блоков на главной странице',
			'priority' => 11,
		)
	);

	$customizer->add_setting(
		'hide_block-zi1',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-zi1',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть блок "Категории"',
			'section' => 'example_section_one',
		)
	);

	$customizer->add_setting(
		'hide_block-carousel_items1',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-carousel_items1',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть карусель "Популярные товары"',
			'section' => 'example_section_one',
		)
	);

	$customizer->add_setting(
		'hide_block-carousel_items2',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-carousel_items2',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть карусель "Последние товары"',
			'section' => 'example_section_one',
		)
	);
	
	$customizer->add_setting(
		'hide_block-brands',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-brands',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть блок "Бренды"',
			'section' => 'example_section_one',
		)
	);

	$customizer->add_setting(
		'hide_block-blog',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-blog',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть блок "Блог"',
			'section' => 'example_section_one',
		)
	);

	$customizer->add_setting(
		'hide_block-reviews',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-reviews',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть блок "Отзывы"',
			'section' => 'example_section_one',
		)
	);

	$customizer->add_setting(
		'hide_block-items',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_block-items',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть блок "Товары"',
			'section' => 'example_section_one',
		)
	);

	$customizer->add_setting(
		'footer_copyricht',
		array('default' => '© 2018 WP-Universam WordPress Theme. <a href="http://wp-universam.ru">WP-Universam.ru</a>')
	);
	$customizer->add_control(
		'footer_copyricht',
		array(
			'label' => 'Копирайт (в подвале сайта)',
			'section' => 'example_section_one',
			'type' => 'text',
		)
	);

	$customizer->add_setting(
		'footer_vmc',
		array('default' => '<img alt="visa" src="'.get_template_directory_uri().'/img/visa.png"> <img alt="mastercard" src="'.get_template_directory_uri().'/img/masercard.png">')
	);
	$customizer->add_control(
		'footer_vmc',
		array(
			'label' => 'Иконки оплаты (в подвале сайта) <img src="..">',
			'section' => 'example_section_one',
			'type' => 'text',
		)
	);

	$customizer->add_setting(
		'hide_sn',
		array('default' => '')
	);
	$customizer->add_control(
		'hide_sn',
		array(
			'type' => 'checkbox',
			'label' => 'Скрыть иконки на соц.сети',
			'section' => 'example_section_one',
		)
	);

});
?>