<?php
// Описание: Страница отображение товаров
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
get_header( 'shop' );

?>
<div>
	<div id="content" class="margin-lr-auto">
		
		<?php do_action( 'usam_before_main_content' ); ?>	
		<?php 
		usam_output_breadcrumbs();	
		do_action( 'usam_top_display_product' );		
		while ( usam_have_products() ) : usam_the_product(); 
			usam_load_template("content-single_product");
		endwhile; 
		?>		
		<?php do_action( 'usam_after_main_content' ); ?>

		<?php get_template_part( 'block', 'items' ); ?>
		
		<?php
		get_footer( 'shop' );