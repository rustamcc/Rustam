<?php
// Описание: страницы содержащие списки товаров. Например, категории, новинки и т.д.
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
get_header( 'shop' );

?>
<div>
	<div id="content" class="margin-lr-auto">
		<div class="wrap">
			<?php do_action( 'usam_before_main_content' ); ?>
			<div class="usam_columns2">
				<div id="primary" class="usam_product_display">
					<?php usam_load_template("content-page-products"); ?>
				</div>				
				<?php 
				if( ! wp_is_mobile() )
					get_sidebar('product'); 
				?>
			</div>
			<?php do_action( 'usam_after_main_content' ); ?>
		</div>

		<?php get_template_part( 'block', 'items' ); ?>

		<?php
		get_footer( 'shop' );