<?php
// Описание: Модуль для страницы "каталог" и категорий товаров
if ( usam_display_products() )
{	
	?>
	<div id="catalog_list">
		<div class="products-catalog_list products_grid">
			<?php		
			$new_prod_date = 14;	
			while (usam_have_products()) :  	
				usam_the_product(); 			
				$product_id = $post->ID;	
				$stock = (int)usam_get_product_meta($product_id,'stock');
				?>	
				<?php get_template_part( 'item', 'card' ); ?>			
			<?php endwhile; ?>	
		</div>
		<?php if( ! usam_product_count() )
		{
			?><h4 class = "head_msg"><?php _e('Нет ни одного товара в этой группе.', 'usam'); ?></h4><?php 
		}
		?>	
		<div class = "navigation_box">
			<?php
			usam_product_info();	
			usam_pagination();
			?>
		</div>
		<?php usam_product_taxonomy_description();	?>
	</div>
	<?php
}
?>