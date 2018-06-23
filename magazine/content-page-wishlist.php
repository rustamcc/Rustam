<?php
// Описание: Страница "Избранные товары"

if(usam_product_count() == 0) {	?>
	<h4 class="head_msg"><?php  _e('Нет ни одного товара в избранном', 'usam'); ?></h4>
	<div class = "ta-c"><a class = "btn_r btn_r--main" href="<?php echo usam_get_url_system_page('products-list'); ?>"><?php _e('Посетите Наш магазин', 'usam'); ?></a></div>
<?php }	else {	?>
	<div class = "wish_list products_grid bg-clr-white m-t10">
		<?php
		global $post;			
		while (usam_have_products()) :  
			usam_the_product(); 			
			$product_id = $post->ID;				
			?>
			<?php get_template_part( 'item', 'card_wish' ); ?>	
			<?php
		endwhile; 	
		?>
	</div>
	<?php
}
?>				
