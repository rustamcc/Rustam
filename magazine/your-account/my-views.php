<?php
// Описание: Просмотренные товары

?>
<div class="df fw-w">
	<?php
	$width = 160;
	$height = 160;
	$output = '';	
	$args = array( 'user_list' => 'view', 'fields' => 'product_id' );
	$product_ids = usam_get_user_products( $args );	
	$products = usam_get_products( array( 'post_status' => 'publish', 'post__in' => $product_ids, 'orderby' => 'post__in' ));
	foreach ( $products as $product )
	{				
		$price = usam_get_product_price_currency( $product->ID );
		$product_id = $product->ID;
		$product_link = usam_the_product_permalink($product_id);
		$product_has_stock = usam_product_has_stock($product_id);
		?>
		<div class="tt-u item-card m-b20 ">			
			<div class="item-card__head pr ta-c df jc-c oh">
				<?php echo usam_get_product_thumbnail( $product_id, array(250,200) ); ?>
			</div>
			<div class="item-card__name oh item-card__body"><a href="<?php echo $product_link; ?>"><?php echo $product->post_title; ?></a></div>
			<hr class="item-card__divider clr-4 bg-clr-4" /> 
			<div class="item-card__footer df jc-sb">
				<div class="clr-2">
					<?php echo $price; ?>
				</div>
				<div class="item-card__add">
					<?php if( usam_product_has_variations( $product_id ) ) { ?> 
						<a href="<?php echo $product_link; ?>" class="hover-pointer clr-7">
							<i class="fas fa-bars"></i>
						</a>
					<?php } else {?>
						<?php button_addtocart( array( "product_has_stock" => $product_has_stock, "product_id" => $product_id, "product_link" => $product_link, "class" => "clr-7 button_mini" ) ); ?>
					<?php } ?>
				</div>
			</div>
		</div>
		<?php
	}		
	?>				
</div>	