<?php
$product_id = $post->ID;		
$product_has_stock = usam_product_has_stock();		
$product_description = $post->post_excerpt;
$product_link = usam_the_product_permalink();
$cat = wp_get_post_terms( $product_id , 'usam-category' ); 
$brand = usam_product_brand( $product_id );
$tags = usam_get_the_product_tag_list();

if( empty($cat) ) {
	$cat_url = "";
	$cat_name = "";
}
else {
	$cat_url = $cat[0]->slug;
	$cat_name = $cat[0]->name;
}

if ( post_password_required() ) 
{
	echo get_the_password_form();
	return;
}
?>
<div class="single-product p20 bg-clr-white m-t20">
	<div class="df single-product__wrap">
		<div class="single-product__photos w50">

			<div class="main_single_img"></div>
			<div class="gallery_product">
				<?php
			/*
			*	Получаем "Изображение страницы"
			*/
			$main_post_img = get_main_post_img($product_id);
			if( ! empty( $main_post_img) ) {
				echo '<img src="'.$main_post_img.'" alt="'.get_the_title().'">';
			}
			/*
			*	Получаем "Галерею товара"
			*/
			$product_images = get_product_images( $product_id );
			if ( ! empty( $product_images ) ) 
			{
				foreach ( $product_images as $product_image ) 
				{	
					if( ! empty( $product_image ) ){
						$image = wp_get_attachment_image_src($product_image->ID, "full" );
						if( ! empty( $image ) ){
							echo '<img src="'.$image[0].'" alt="'.get_the_title().'">';
						}
					}
				}
			}
			?>
		</div>
		<script>
			$(document).ready(function () {
				$('.gallery_product').slick({
					infinite: false,
					slidesToShow: 3,
					slidesToScroll: 1
				});
				$('.gallery_product .slick-prev').html('<i class="fas fa-angle-left"></i>');
				$('.gallery_product .slick-next').html('<i class="fas fa-angle-right"></i>');
			});
		</script>
	</div>
	<div class="w50">
		<div class="single-product__head df jc-sb">
			<div>
				<?php the_post_navigation( array( 'screen_reader_text' => ' ', 'next_text' => '<i class="fas fa-angle-right"></i>',
				'prev_text' => '<i class="fas fa-angle-left"></i>' ) ); ?>
			</div>
			<div>
				<?php echo usam_get_product_rating( ); ?>
			</div>
		</div>

		<?php usam_select_product_variation(); ?>

		<h2 class="tt-u"><?php the_title();?></h2>

		<?php if( ! empty($cat) ) { ?>
			<h3 class="single-product__category tt-u">
				<a href="<?php echo get_option('siteurl'); ?>/product-category/<?php echo $cat_url; ?>/" class="clr-10"><?php echo $cat_name; ?></a>
			</h3>
		<?php } ?>

		<div class="single-product__price clr-2 f2em">
			<?php usam_the_product_price_display( array( 'output_you_save' => false, 'output_old_price' => false ) ); ?>					
			<?php if(usam_product_has_multicurrency()) : ?>
				<?php echo usam_display_product_multicurrency(); ?>
			<?php endif; ?>	
		</div>

		<?php
		if( ! $product_has_stock ) { ?>
			<div class="single-product__no-stock clr-4 f2em"><i class="far fa-frown"></i> Товара нет в наличии</div>
		<?php } ?>

		<?php
		if( usam_has_multi_adding() && $product_has_stock && usam_get_product_price( $product_id ) > 0 )
		{ 				
			$stock = usam_get_product_meta($product_id , 'stock' );	
			?>					
			<div class="quantity dib bg-clr-2">
				<input type="button" value="-" class="quantity__plusminus hover-pointer bg-clr-2 clr-white b0 p10" data-product_id="<?php echo $product_id; ?>">
				<input type="number"  class="quantity__count bg-clr-13 clr-white ta-c b0 p10" step="1" min="1" max="<?php echo $stock; ?>" name="quantity_count_<?php echo $product_id; ?>" value="1" pattern="[0-9]*" inputmode="numeric" data-product_id="<?php echo $product_id; ?>">
				<input type="button" value="+" class="quantity__plusminus hover-pointer bg-clr-2 clr-white b0 p10" data-product_id="<?php echo $product_id; ?>">
			</div>
		<?php } ?>
		<?php button_addtocart( array( "product_has_stock" => $product_has_stock, "product_id" => $product_id, "product_link" => $product_link, "text" => "Добавить в корзину", "class" => "button_big bg-clr-2 clr-white b0 p10 ws-n m-t10 dib") ); ?>


		<div class="single-product__block-like-compare df jc-sa">

			<?php $desired_class = usam_checks_product_from_customer_list( 'desired' )?'clr-2':'clr-1'; ?>
			<a href="index.php?product_id=<?php echo $product_id; ?>&usam_ajax_action=desired_product" class="add_favorite add_fc <?php echo $desired_class; ?>" data-ajax_action="desired_product" data-product_id="<?php echo $product_id; ?>"><i class="fas fa-heart"></i> Добавить в избранное</a>

			<?php $compare_class = usam_checks_product_from_customer_list( 'compare' )?'clr-2':'clr-1'; ?>
			<a href="index.php?product_id=<?php echo $product_id; ?>&usam_ajax_action=compare_product" class="add_compare add_fc <?php echo $compare_class; ?>" data-ajax_action="compare_product" data-product_id="<?php echo $product_id; ?>"><i class="far fa-clone"></i> Добавить к сравнению</a>
		</div>

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

		<div>
			<div class="single-product__line"><?php _e('Артикул:', 'usam'); ?>  <span class="clr-10" id="product_sku_<?php echo $product_id; ?>"><?php echo usam_get_product_meta($product_id , 'sku' ); ?></span></div>
		</div>

		<div>Поделиться:</div>
		<div class="single-product__share single-product__line"> 
			<?php
			$product_link = urlencode($product_link);
			$title = urlencode(wp_title('', false));
			$description = urlencode($product_description);
			$image_src = usam_get_product_images($product_id);
			if( ! empty($image_src) )
				$image_src = urlencode($image_src[0]->guid);
			else
				$image_src = "";
			$sc = array(
				"vk" => "https://vk.com/share.php?url=$product_link&title=$title&description=$description&image=$image_src&noparse=true",
				"odnoklassniki" => "https://www.odnoklassniki.ru/dk?st.cmd=addShare&st.s=1&st._surl=$product_link&st.comments=$description",
				"facebook" => "https://www.facebook.com/sharer/sharer.php?u=$product_link",
				"twitter" => "https://twitter.com/intent/tweet?text=$title&url=$product_link",
				"google-plus" => "https://plus.google.com/share?url=$product_link"
			);

			foreach ($sc as $sc_name => $sc_link) {
				?>
				<a href="<?php echo $sc_link; ?>" class="fab fa-<?php echo $sc_name; ?>" target="_blank"></a>
			<? } ?>

		</div>
	</div>
</div>
<div class="single-product__tabs">
	<?php 
	usam_product_tabs(); 
	?>
</div>
</div>

<div>
	<div class="title-2line pr ta-c tt-u">
		<div class="va-m dib">
			<div>Сопутствующие</div>
			<div class="clr-3">товары</div>
		</div>
	</div>
	<?php usam_display_product_groups( array('query' => 'same_category', 'template' => 'items_carousel', 'limit' => 0) ) ?>
</div>
<?php if(get_theme_mod('hide_block-items') == '') get_template_part( 'blocks/block', 'items' ); ?>