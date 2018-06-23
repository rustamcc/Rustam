<?php
// Описание: Страница корзины, оформления заказа и т. д.

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
} 
get_header( 'shop' );
?>
<div>
	<div id="content" class="margin-lr-auto">
		
		<?php get_template_part( 'menu', 'user' ); ?>

		<?php 
		do_action( 'usam_before_main_content' );
		usam_get_content( ); 
		do_action( 'usam_after_main_content' );
		?>

		<?php
		get_footer( 'shop' );