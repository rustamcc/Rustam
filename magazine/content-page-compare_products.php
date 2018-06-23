<?php
// Описание: Страница "Сравнение товаров"
if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
?>
<div class = "product_comparison">
	<?php
	if(usam_product_count() == 0)
	{
		?>
		<h4 class="head_msg"><?php  _e('Нет товаров для сравнения', 'usam'); ?></h4>
		<div class = "ta-c"><a class = "btn_r btn_r--main" href="<?php echo usam_get_url_system_page('products-list'); ?>"><?php _e('Посетите Наш магазин', 'usam'); ?></a></div>
		<?php 
	}
	else
	{
		global $post, $wp_query;		
		$args = array( 'hide_empty' => 0, 'fields' => 'id=>name', 'orderby' => 'meta_value_num', 'meta_key' => 'usam_sort_order' );
		$terms = get_terms('usam-product_attributes', $args);
		$products_ids = array();
		?>
		<div class = "body_comparison">
			<table class = "tcomparison">
				<thead>
					<tr>
						<td></td>
						<?php										
						while (usam_have_products()) 
						{  
							usam_the_product(); 
							$products_ids[] = $post->ID;
							$product_id = $post->ID;
							$product_has_stock = usam_product_has_stock();	
							$aggregate_reviews = usam_get_aggregate_reviews( $product_id );	
							$product_link = '';					
							?>
							<td>
								<div class="image">
									<?php echo usam_get_product_thumbnail( $product_id, 'product-image' ); ?>
									<a href="index.php?product_id=<?php echo $product_id; ?>&usam_ajax_action=compare_product" data-ajax_action="compare_product" class="item-card__rm pa clr-11"><i class="far fa-times-circle f1-5em"></i></a>
								</div>

								<div class="title compare_line">
									<a href="<?php echo usam_the_product_permalink(); ?>"><?php echo $post->post_title; ?></a>
								</div>
								<div class='average_vote compare_line'><?php echo usam_get_product_rating( $product_id ); ?></div>
								<div class='review compare_line'>
									<div class="review_rating"><div><?php echo $aggregate_reviews['aggregate']; ?></div></div>
									<a class="link" href="<?php echo usam_the_product_permalink(); ?>"><?php echo $aggregate_reviews['total']."&nbsp;".__('отзывов', 'usam') ?></a>
								</div>							
								<div class="price compare_line ta-c"><?php echo usam_get_product_price_currency( $product_id ); ?></div>
								
								<?php button_addtocart( array( "product_has_stock" => $product_has_stock, "product_id" => $product_id, "product_link" => $product_link, "text" => "Добавить в корзину", "class" => "button_big bg-clr-2 clr-white b0 p10 f0-8em dib" ) ); ?>
							</td>						
							<?php
						}					
						?>
					</tr>
				</thead>
				<tbody>
					<?php	
					$attributes_value = array();
					$attributes_ids = array();
					$excellent_properties = array();
					$excellent_ids = array();
					foreach ( $products_ids as $product_id )		
					{
						$product_attributes = usam_get_product_attributes( $product_id );	
						$attributes_ids_current = array_keys($product_attributes);		
						$attributes_ids = array_merge($attributes_ids, $attributes_ids_current);
						$attributes_ids = array_unique($attributes_ids);			
						$attributes_value[$product_id] = $product_attributes;
						if ( empty($excellent_properties) )
						{
							$excellent_properties = $product_attributes;							
						}
						else
						{							
//							$product_attributes = ksort($product_attributes);
							foreach ( $excellent_properties as $attributes_id1 => $attributes1 )	
							{															
								if ( isset($product_attributes[$attributes_id1]) )
								{ 
									$result = array_intersect($attributes1, $product_attributes[$attributes_id1]);							
									if ( empty($result) && !in_array($attributes1, $excellent_ids) ) 
									{ 
										$excellent_ids[] = $attributes_id1;								
									}
								}								
							}
						}
					}
					foreach ( $attributes_ids as $attribute_id )	
					{					
						$class = in_array($attribute_id, $excellent_ids)?'there_difference':'';
						?>			
						<tr class = "<?php echo $class; ?>">			
							<td><?php echo $terms[$attribute_id]; ?></td>
							<?php				
							foreach ( $attributes_value as $product_id => $attribute_value )	
							{
								?><td><?php if ( isset($attribute_value[$attribute_id]) ) echo implode(',', $attribute_value[$attribute_id]); ?></td><?php							
							}
							?>			
						</tr>			
						<?php				
					}
					?>
				</tbody>
			</table>	
		</div>
		<?php
	}
	?>				
</div>
<?php 