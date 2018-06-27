<?php
// Описание: страница "каталог"
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
get_header( 'shop' );
?>
<div>
	<div id="content" class="margin-lr-auto">
		<div class="wrap page-catalog">
			<?php do_action( 'usam_before_main_content' );	?>
			<div class="usam_columns2">
				<div id="primary" class="usam_product_display">
					<?php 
					$products_day = usam_get_data_active_products_day();
					if ( !empty($products_day[0]) )
					{
						$product = $products_day[0];						
						?>
						<div class = "product_day">
							<h3><?php _e('Товар дня','usam'); ?></h3>
							<div class = "text">		
								<a href="<?php echo usam_the_product_permalink($product->ID); ?>">	
									<div class = "p_title"><h4><?php echo $product->post_title; ?></h4></div>	
								</a>
								<div class = "post_excerpt"><?php echo usam_limit_words($product->post_excerpt, 300); ?></div>
								<div class = "price">
									<div class = "old_price"><?php echo usam_get_product_price_currency( $product->ID, true ); ?></div>
									<div class = "p_price"><?php echo usam_get_product_price_currency( $product->ID ); ?></div>	
								</div>		
								<a href="<?php echo usam_get_url_system_page('special-offer'); ?>">	
									<div class = "buy">Купить</div>	
								</a>
							</div>
							<div class = "image_box">
								<a href="<?php echo usam_the_product_permalink($product->ID); ?>">	
									<?php echo usam_get_product_thumbnail( $product->ID, array(450, 450), $product->post_title ); ?>
								</a>	
							</div>	
						</div>
						<?php	
					}	
					?>
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

		<?php get_footer( 'shop' );