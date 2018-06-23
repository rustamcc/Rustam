<?
if( ! empty( $_REQUEST['product_id'] ) ){
	$product_id = (int)$_REQUEST['product_id'];
	$cat = wp_get_post_terms( $product_id , 'usam-category' );
	$brand = usam_product_brand( $product_id );
	$tags = get_the_term_list( $product_id, 'product_tag', '', '', '' );
	$post = get_post($product_id);
	if( $post->post_excerpt ){ $description = $post->post_excerpt; }
	else{ $description = ""; }
	$link = get_permalink($post->ID);
	if( empty($cat) ) {
		$cat_url = "";
		$cat_name = "";
	}
	else {
		$cat_url = $cat[0]->slug;
		$cat_name = $cat[0]->name;
	}
	?>

	<?php usam_single_image( $product_id ); ?>

	<div class="popup_content">
		<a href="<?php echo $link; ?>" class="f2em"><h3><?php echo get_the_title( $product_id );?></h3></a>

		<div class="df jc-sb m-t20">
			<?php if( ! empty($cat) ) { ?>
			<a href="<?php echo get_option('siteurl'); ?>/product-category/<?php echo $cat_url; ?>/" class="clr-10"><?php echo $cat_name; ?></a>
			<?php } ?>
			<?php echo usam_get_product_rating( $product_id, false ); ?>
		</div>

		<p class="m-t20 clr-3"><?php echo $description; ?></p>

		<div class="df jc-sb m-t20">
			<?php 
			if ( !empty($brand) )
			{
				?>
				<div class="single-product__line single-product__ct">
					Бренд:
					<a href='<?php echo usam_brand_url( $brand->term_id ); ?>' title ='<?php printf(__('Посмотреть все товары бренда %s','usam'),$brand->name); ?>' >
						<?php echo $brand->name; ?>
					</a>
				</div>
			<?php } ?>

			<?php  if($tags) { ?>
				<div class="single-product__line single-product__ct single-product__tags">
					Метки: 
					<?php echo $tags; ?>
				</div>
			<?php } ?>
		</div>

		<div class="single-product__line"><?php _e('Артикул:', 'usam'); ?>  <span class="clr-10"><?php echo usam_get_product_meta($product_id , 'sku' ); ?></span></div>

		<div class="single-product__view df jc-sb ai-c m-t20">
			<span class="clr-2 f2em">3.850 Ք</span>
			<a href="<?php echo $link; ?>" class="button btn_r--main f1-7em border"><i class="far fa-eye"></i> Посмотреть товар</a>
		</div>

	</div>
	<div class="popup-close pa f2em clr-4 hover-pointer"><i class="far fa-times-circle"></i></div>
	<script>
		$('html').css('overflow', 'hidden');
		$('.popup-close').on('click', function() {
			$('#popup').css('display', 'none');
			$('#popup_box').html('');
			$('html').css('overflow', 'auto');
			return false;
		});
		$('#popup a').on('click', function() {
			console.log($(this).attr('href'));
			document.location.href = $(this).attr('href');
		});
	</script>
	<?php exit; } ?>