<?php
// Описание: Страница "Специальное предложения" или "Товар Дня"
?>
<div>
	<div id="content" class="margin-lr-auto">

		<div class = "wish_list products_grid bg-clr-white m-t10">
			<?php
			global $post;
			if ( usam_product_count() != 0 )
			{ 
				while ( usam_have_products() ) : 
					usam_the_product();	
					
					$product_id = get_the_ID();
					$product_link = usam_the_product_permalink();
					$product_has_stock = usam_product_has_stock();	
					$cat = wp_get_post_terms( $product_id , 'usam-category' );
					$brand = usam_product_brand( $product_id );
					$thumbnail = @usam_the_product_thumbnail( $product_id, array(250,200) );
					$thumbnail = $thumbnail["src"];
					if( empty($cat) ) {
						$cat_url = "";
						$cat_name = "";
					}
					else {
						$cat_url = $cat[0]->slug;
						$cat_name = $cat[0]->name;
					}
					$sale = usam_you_save();
					?>
					<div class="tt-u item-card">			
						<div class="item-card__head pr ta-c df jc-c oh">

							<div class="item-card__img" style="background-image: url(<?php echo $thumbnail; ?>);"></div>

							<?php $desired_class = usam_checks_product_from_customer_list( 'desired' )?'clr-2':'clr-1'; ?>
							<a class="item-card__like pa add_fc <?php echo $desired_class; ?>" href="index.php?product_id=<?php echo $product_id; ?>&usam_ajax_action=desired_product" data-ajax_action="desired_product" data-product_id="<?php echo $product_id; ?>">
								<i class="fas fa-heart"></i>
							</a>

							<div class="item-card__rating pa f0-8em">
								<?php echo usam_get_product_rating( $product_id, false ); ?>
							</div>
							<a href="<?php echo $product_link; ?>" class="item-card__quick-view pa clr-white bg-clr-2" data-product_id="<?php echo $product_id; ?>"><i class="far fa-window-restore"></i> Быстрый просмотр</a>
						</div>
						<?php if( usam_is_product_discount() ) { ?>
							<div class="item-card__tag bg-clr-2 clr-white pa tt-u">-<?php echo $sale; ?>%</div>
						<?php } ?>
						<div class="item-card__name oh item-card__body"><a href="<?php echo $product_link; ?>"><?php the_title(); ?></a></div>

						<div class="item-card__category item-card__body">
							<?php if( ! empty($cat) ) { ?>
								<a href="<?php echo get_option('siteurl'); ?>/product-category/<?php echo $cat_url; ?>/"><?php echo $cat_name; ?></a>
							<?php } elseif ( ! empty($brand) ) { ?>
								<a href="<?php echo usam_brand_url( $brand->term_id ); ?>"><?php echo $brand->name; ?></a>
							<?php } else{ ?>
								<span class="clr-10">...</span>
							<?php } ?>
						</div>

						<hr class="item-card__divider clr-4 bg-clr-4" /> 

						<div class="item-card__footer df jc-sb">
							<div>
								<?php if( usam_is_product_discount() ) { ?>
									<span class="clr-9 f0-9em td-lt"><?php usam_product_price_currency( true ); ?></span>
								<?php } ?>
								<span class="clr-2"><?php echo usam_product_price_currency(); ?></span>
							</div>
							<div class="item-card__add">
								<?php button_addtocart( array( "product_has_stock" => $product_has_stock, "product_id" => $product_id, "product_link" => $product_link, "class" => "clr-7 button_mini" ) ); ?>
							</div>
						</div>

					</div>
				<?php  endwhile; ?>
			<div class = "product_footer_box">	
				<?php do_action('usam_product_before_description', $product_id, $wp_query->post); ?>
			</div>
			<?php 
		}
		else 
		{
			?><h3 class="head_msg"><?php _e('Нет сейчас предложения для Вас', 'usam');?></h3><?php
		}
		?>
	</div>