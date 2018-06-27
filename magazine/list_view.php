<?php
// Описание: Модуль для страницы "каталог" и категорий товаров
if ( usam_display_products() ) { ?>
	<div>



		<?php
		$new_prod_date = 14;	
		while (usam_have_products()) :  
			usam_the_product(); 		
			$product_id = $post->ID;				
			$product_link = usam_the_product_permalink();
			$product_has_stock = usam_product_has_stock($product_id);	
			$stock = usam_get_product_meta($product_id , 'stock' );			
			?>			

			<div class="list_item bg-clr-white df m-b20">
				<a class="df" href="<?php echo $product_link; ?>">
					<?php usam_product_thumbnail( ); ?>
				</a>

				
				<div class="fg-1 f1-3em p20">


					<h4 class="dib"><a href="<?php echo $product_link; ?>"><?php the_title(); ?></a></h4>

					<?php
					$t = mktime(0,0,0,date('m'),date('d'),date('Y'));								
					$t = $t-$new_prod_date*24*60*60;
					if (strtotime($post->post_date)>=$t) {?>
						<span class="clr-2 f0-8em tt-u">
							<?php _e('Новинка', 'usam'); ?>

						</span>
					<?php }
					if( $product_has_stock )
					{
						if( usam_is_product_discount() )
							{ ?>			
								<div class="percent_action"><?php echo '-'. usam_you_save().'%'; ?></div>					
								<div class="transparent_box"><?php _e('Акция', 'usam'); ?></div>						
								<?php 
							}						
						}
						else
						{
							$storage = usam_get_product_meta($product_id,'storage', true);
							if ( $storage > 0 ) 
							{
								?><div class="unavailable"><?php _e('Под заказ', 'usam'); ?></div><?php						
							}
							else
							{
								?><div class="product_sold"><?php _e('Все запасы проданы', 'usam'); ?></div><?php	
							}
						}
						?>
						<div class="f0-8em clr-11 m-t10"><?php the_excerpt(); ?></div>
						<div class="f0-8em"><?php usam_edit_the_product_link( ); ?></div>
					</div>

					<div class="df fd-c jc-sa ta-r">
						<div class="list_item-price f1-3em m-r20">
							<?php if( usam_is_product_discount() ) { ?>
								<span class="clr-9 f0-9em td-lt"><?php usam_product_price_currency( true ); ?></span>
							<?php } ?>
							<span class="clr-2 ws-n"><?php usam_product_price_currency( ); ?></span>
						</div>

						<div class="list_item-add df">

							<?php if( usam_product_has_variations( $product_id ) ) { ?> 
								<a href="<?php echo $product_link; ?>" class="button_big bg-clr-2 clr-white b0 p10 ws-n">
									<i class="fas fa-bars"></i> Посмотреть
								</a>
							<?php } else {?>

								<?php
								if( usam_has_multi_adding() && $product_has_stock && usam_get_product_price( $product_id ) > 0 )
								{ 				
									$stock = usam_get_product_meta($product_id , 'stock' );	
									?>					
									<div class="quantity df">
										<input type="button" value="-" class="quantity__plusminus hover-pointer bg-clr-2 clr-white b0 p10" data-product_id="<?php echo $product_id; ?>">
										<input type="number"  class="quantity__count bg-clr-13 clr-white ta-c b0" step="1" min="1" max="<?php echo $stock; ?>" name="quantity_count_<?php echo $product_id; ?>" value="1" pattern="[0-9]*" inputmode="numeric" data-product_id="<?php echo $product_id; ?>">
										<input type="button" value="+" class="quantity__plusminus hover-pointer bg-clr-2 clr-white b0 p10" data-product_id="<?php echo $product_id; ?>">
									</div>
								<?php } ?>

								<?php button_addtocart( array( "product_has_stock" => $product_has_stock, "product_id" => $product_id, "product_link" => $product_link, "text" => "Добавить в корзину", "class" => "button_big bg-clr-2 clr-white b0 p10 ws-n" ) ); ?>

							<?php } ?>
						</div>
					</div>
				</div>


				<?php 
			endwhile;	
			if( !usam_product_count() )
			{
				?><h4 class = "head_msg"><?php  _e('Нет ни одного товара в этой группе.', 'usam'); ?></h4><?php 
			}
			?>		
		</div>
		<div class = "navigation_box">
			<?php
			usam_product_info();	
			usam_pagination();
			?>
		</div>
		<?php usam_product_taxonomy_description();	?>

		<?php
	}?>
