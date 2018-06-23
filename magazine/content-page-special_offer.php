<?php
// Описание: Страница "Специальное предложения" или "Товар Дня"
?>

<?php
global $post;
if ( usam_product_count() != 0 )
{ 
	while ( usam_have_products() ) : 
		usam_the_product();	
		
$product_id = $post->ID;	
$product_has_stock = usam_product_has_stock( );		
?>
<div class="product_header">
<h1 itemprop="name" class="name"><?php the_title();?></h1>		
<div class="usam_article_product">
	<div class ="title_sku"><?php _e('Артикул:', 'usam'); ?></div>
	<div id='product_sku_<?php echo $product_id; ?>'><?php echo usam_get_product_meta($product_id , 'sku' ); ?></div>
	<div class='average_vote'><?php echo usam_get_product_rating( ); ?></div>			
</div>	
<?php 	
if ( post_password_required() ) 
{
	echo get_the_password_form();
	return;
}	
usam_single_image( ); 
if( usam_is_product_discount() )
{ ?>
	<div class="single_percent_action">
		<?php //echo __('Скидка', 'usam')." ".usam_you_save()."%"; ?>
		<?php _e('Акция', 'usam'); ?>
	</div>
<?php } ?>
<div class="productcol special_offer">							
	<?php do_action( 'usam_product_addon_after_descr', $product_id ); ?>				
	<div class="grid_1">							
		<div class="purchase_terms">
			<ul>						
				<?php 
				if( $product_has_stock )
				{ 							
					?>
					<li><strong>Этот товар в наличии</strong><br></li>
					<?php 
				}							
				?>
				<li><a href="" id = "warehouses_buttom" class="usam_modal"><strong>Наличие в магазинах</strong><br>
				<span class = "stock_store">Нажми<span></a></li>
				<?php 
				$customer_location = usam_get_customer_location();						
				if ( $customer_location == 981 )
				{
				?>							
					<li class = "normal"><strong>Бесплатная доставка*</strong><br>						
						<span class = "stock_store">							
							<?php if ( date_i18n( "H" ) > 14 ) { ?>	на следующий день*<?php } else { ?>сегодня при наличии на складе!<?php } ?><span></li>	
				<?php 
				}
				else
				{	
					?>
					<li class = "normal"><strong>Доставка в ваш регион</strong><br></li>	
					<?php 
				}
				?>
				<li class = "normal"><strong>Работаем</strong><br>
				каждый день</li>										
				<li class = "normal"><strong>Возврат товара</strong><br>
				если он вам не подошел</li>	
				<li class = "normal"><strong>Ассортимент</strong><br>
				4000 товаров и 50 брендов</li>													
			<ul>
		</div>				
	</div>
	
	<div class="grid_2">				
	<form class="product_form" enctype="multipart/form-data" action="<?php echo usam_this_page_url(); ?>" method="post" name="1" id="product_<?php echo $product_id; ?>">	
		<?php do_action ( 'usam_product_form_fields_begin' ); ?>			
	
		<div class="usam_product_price">					
			<div class="price_print store_price">
				<?php 
				$arg = array( 'output_you_save' => false, 'output_old_price' => false );
				usam_the_product_price_display( $arg ); 
				?>					
				<?php if(usam_product_has_multicurrency()) : ?>
					<?php echo usam_display_product_multicurrency(); ?>
				<?php endif; ?>					
			</div>
			<div class="usam_price_comparison">
					<?php usam_feedback_link( 'price_comparison', __('Есть дешевле?','usam') ); ?> 
				</div>
			<div class="price_print offline_store_price">
				<?php 							
				$offline_store_price = usam_get_product_price($product_id, 'tp_0');
				if ( $offline_store_price )
				{
					?>		
					<div class="price_name">
						В розничном магазине:
					</div>
					<div class="price_print">
						<?php echo usam_currency_display(usam_get_product_price($product_id, 'tp_0')); ?>
					</div>		
					<?php 							
				}
				?>								
			</div>
		</div>

		<div id="usam_quantity" class="usam_quantity">					
			<?php 
			if(usam_has_multi_adding() && $product_has_stock)
			{ 				
				$stock = usam_get_product_meta($product_id , 'stock' );	
				?>					
				<div class="qu_box">	
					<input type="button" value="-" class="minus b_quantity" data-title = "Уменьшить количество"/>
					<input type="text" class="quantity_update" id="usam_quantity_update_<?php echo $product_id; ?>" name="usam_quantity" size="2" value="1" />	
					<input type="button" value="+" class="plus b_quantity" data-title = "Увеличить количество" data-stock = "<?php echo $stock; ?>" />
				</div>	
			<?php }?>					
		</div>		
		
		<?php 
		if( usam_hide_addtocart_button() ) 
		{ 
			if($product_has_stock) 
			{ 
				?>
				<div class="usam_buy_button_blok">							
					<div class="quick_purchase">
						<a href="#quick_purchase" id = "usam_quick_purchase" class="usam_modal_feedback button">Быстрая покупка</a>
					</div>
					<?php usam_addtocart_button(); ?>
				</div>
			<?php 
			} 
			else 
			{ 
				$storage = usam_get_product_meta($product_id,'storage', true);
				if ( $storage > 0 ) 
				{
					?>
					<div class="soldout">							
						<p class="soldout-title"><?php _e('Этот товар доступен в розничном магазине.', 'usam'); ?></p></br>
						<a href="#buy_product" id="usam_buy_product" class="usam_modal_feedback button button_buy">Заказать по цене <?php usam_product_price_currency( ); ?>	?</a>
					</div>
					<?php						
				}
				else
				{
					?>
					<div class="soldout">							
						<p class="soldout-title"><?php _e('Этот товар продан.', 'usam'); ?></p>		
					</div>
					<?php
				}					
			} 
		} 
		?>		
		<?php usam_select_product_variation(); ?>						
		<div class="special_offer_box">
			<div class="special_offer_info">				
				<div class = "time"><?php _e('До конца продаж','usam'); ?><div id="countdown"></div></div>				
			</div>
		</div>
		<?php do_action ( 'usam_product_form_fields_end' ); ?>
	</form>				
		<div class="categories_title">
			<?php 
			$brand = usam_product_brand( $product_id );
			if ( !empty($brand) )
			{
				$brands_image = usam_brand_image( $brand->term_id );						
				if ( !empty($brands_image) )
				{
				?>
				<a title ='<?php printf(__('Посмотреть все товары бренда %s','usam'),$brand->name); ?>' href='<?php echo usam_brand_url( $brand->term_id ); ?>'>
					<img class="brands_image" alt="<?php echo $brand->name; ?>" width="150" height="50" src="<?php echo $brands_image; ?>"/>
				</a>
			<?php } 
				else
				{
					?>
					<h3><?php _e('Бренд', 'usam'); ?>:</h3>					
					<span><?php echo "<a class = 'brand_link' title ='".__('Посмотреть все товары бренда','usam')."' href='".usam_brand_url( $brand->term_id )."'>". $brand->name."</a>";	?></span>	
					<?php						
				}
			} ?>					
		</div>	
	</div>	
	<div class="grid_3">
	</div>										
</div>	
</div>	
<!------------------------------------------------------------------------------------------------------------------------------>
<?php endwhile; ?>
<div class = "product_footer_box">	
	<?php 	
	usam_product_tabs(); 	
	usam_products_for_buyers();		
	do_action('usam_product_before_description', $product_id, $wp_query->post); 	
	?>
</div>
<?php 
}
else 
{
	?><h3 class="head_msg"><?php _e('Нет сейчас предложения для Вас', 'usam');?></h3><?php
}
?>