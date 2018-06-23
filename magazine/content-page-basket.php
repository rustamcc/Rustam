<?php
// Описание: Шаблон корзины
?>
<div id="basket_content" class = "usam_basket_content">
	<?php
// Файл корзины
	if( usam_get_basket_number_items() < 1)
	{
		echo '<h3 class="head_msg">' . __('К сожалению, Ваша корзина пуста.', 'usam') . '</h3>';
		?>
		<div class = "checkout_page_button"><a class = "btn_r btn_r--main" href="<?php echo usam_get_url_system_page('products-list'); ?>"><?php _e('Посетите Наш магазин', 'usam'); ?></a></div>
	</div>
	<?php
}
else
{		
	$error_message = usam_cart_errors_message();	
	if(!empty( $error_message )): ?>
		<div class='login_error'>
			<?php foreach((array)$error_message as $error ){?>
				<p class='validation-error'><span><?php echo  __('Ошибка', 'usam').': '; ?></span><?php echo $error; ?></p>
			<?php } ?>
		</div>
	<?php endif;?>	
	<h3 class="head_msg"><?php _e('Пожалуйста, посмотрите ваш заказ', 'usam'); ?></h3>
	<div class='usam_products_basket'>	
		<table class="usam_products_table">
			<thead>		
				<tr>
					<th colspan="2" ><?php _e('Название товара', 'usam'); ?></th>
					<th><?php _e('Артикул', 'usam'); ?></th>			
					<th><?php _e('Цена', 'usam'); ?></th>
					<th><?php _e('Cкидка', 'usam'); ?></th>
					<th><?php _e('Цена со скидкой', 'usam'); ?></th>
					<?php
					if( usam_cart_tax_enabled() )
					{
						?>
						<th><?php _e('Налог', 'usam'); ?></th>
						<?php
					}
					?>
					<th><?php _e('Количество', 'usam'); ?></th>
					<th><?php _e('Всего', 'usam'); ?></th>
					<th></th>
				</tr>
			</thead>	
			<tbody>			
				<?php 
				$width = 100;
				$height = 100;	
				$alt = 0;
				while (usam_have_cart_items()) : usam_the_cart_item(); ?>
					<?php			
					$alt++;
					if ($alt %2 == 1)
						$alt_class = 'alt';
					else
						$alt_class = '';								
					?>			
					<?php do_action ( "usam_before_checkout_cart_row" ); ?>
					<tr class="product_row product_row-<?php echo usam_the_cart_item_key(); ?> <?php echo $alt_class;?>" id = "cart_item-<?php echo usam_the_cart_item_key(); ?>">
						<td class="firstcol usam_product_image"><?php echo usam_cart_item_image( $width, $height ); ?></td>			
						<td class="usam_product_name">
							<?php //do_action ( "usam_before_checkout_cart_item_name" ); ?>
							<a href="<?php echo usam_cart_item_url();?>"><?php echo usam_cart_item_name(); ?></a>
							<?php //do_action ( "usam_after_checkout_cart_item_name" ); ?>
						</td>
						<td class="usam_product_sku"><?php echo usam_cart_item_sku(); ?></td>
						<td class="product_price"><?php echo usam_cart_single_item_oldprice(); ?></td>		
						<td class="product_price"><?php echo usam_cart_single_item_discont(); ?></td>		
						<td class="product_price"><?php echo usam_cart_single_item_price(); ?></td>					
						<?php
						if( usam_cart_tax_enabled() )
						{
							?>
							<td class="product_tax"><?php echo usam_get_cart_single_item_tax(); ?></td>	
							<?php
						}
						?>				
						<td class="product_quantity">
							<div class="quantity dib bg-clr-2">
								<a href="<?php echo get_option('siteurl'); ?>/basket/?usam_action=update_item_quantity&usam_quantity=-1&key=<?php echo usam_the_cart_item_key(); ?>">
									<button class="quantity__plusminus hover-pointer bg-clr-2 clr-white b0 p10 loading">-</button>
								</a>
								<input type="number"  class="quantity__count bg-clr-13 clr-white ta-c b0 p10" step="1" min="1" max="<?php echo $stock; ?>" name="quantity_count_<?php echo $product_id; ?>" value="<?php echo usam_cart_item_quantity(); ?>" pattern="[0-9]*" inputmode="numeric">
								<a href="<?php echo get_option('siteurl'); ?>/basket/?usam_action=update_item_quantity&usam_quantity=1&key=<?php echo usam_the_cart_item_key(); ?>">
									<button class="quantity__plusminus hover-pointer bg-clr-2 clr-white b0 p10 loading">+</button>
								</a>
							</div>
						</td>

						<td class="product_price"><span class="pricedisplay"><?php echo usam_cart_item_price(true); ?></span></td>			
						<td class="product_remove">				
							<form action="" method="post" class="adjustform remove">
								<input type="hidden" name="key"         value="<?php echo usam_the_cart_item_key(); ?>" />
								<input type="hidden" name="usam_action" value="remove_cart_item" />
								<button type="submit" name="submit"      class="btn_remove btn_r loading">X</button>
							</form>
						</td>
					</tr>					
			<?php //do_action ( "usam_after_checkout_cart_row" ); 
		endwhile; ?>
	</tbody>	
	<tfoot>
		<tr>
			<td colspan="2">
				<form method="post" action="">
					<input type="hidden" name="usam_action" value="empty_cart"/>
					<button type="submit" id = 'empty_cart' class="btn_r loading"><i class="far fa-trash-alt"></i> <?php _e('Очистить корзину', 'usam'); ?></button>
				</form>
			</td>				
			<td colspan="7">
				<div class = "bonuses_submit">						
					<form method="post" action="">
						<?php if ( usam_get_available_user_bonuses() == 0 ) { ?>
							<input type="hidden" name="usam_action" value="spend_bonuses"/>
							<button type="submit" class="btn_r loading"><i class="fas fa-gift"></i> <?php _e('Потратить', 'usam'); ?></button>
						<?php } else { ?>
							<input type="hidden" name="usam_action" value="return_bonuses"/>
							<button type="submit" class="btn_r loading"><i class="fas fa-gift"></i> <?php _e('Вернуть', 'usam'); ?></button>
						<?php } ?>
					</form>
				</div>
				<div class = "usam_customer_bonus">
					<span class = "title"><?php _e('Ваши бонусы', 'usam'); ?>:</span>
					<span class = "total_bonuses">
						<?php 
						$current_user_id = get_current_user_id();
						echo usam_get_total_bonus_account( $current_user_id );
						?>
					</span>
				</div>					
			</td>
		</tr>
	</tfoot>		
</table>
</div>

<?php if( usam_uses_coupons()){?>		
	<div class ="usam_coupons_basket">
		<table class = "usam_coupons_basket_table">						
			<tr class="usam_coupons_title">						
				<td><?php _e('Введите код купона', 'usam'); ?>:</td>
			</tr>
			<tr class="usam_coupon_apply">
				<td class="coupon_code">
					<form  method="post" name='add_coupon' action="">						
						<input type="hidden" name="usam_action" value="apply_coupon" />
						<input type="text" class="text" name="coupon_num" id="coupon_num" value="<?php echo usam_coupons_code(); ?>" />
						<button type="submit" class="btn_r loading"><i class="fas fa-tag"></i> Активировать</button>
					</form>
				</td>	
			</tr>					
		</table>
	</div>
<?php } ?>

<div class ="usam_basket_results">
	<table class = "basket_results_table">
		<tr  class='displaying_results usam_subtotal'>
			<td class='usam_name_row'><?php _e('Стоимость корзины', 'usam'); ?>:</td>				
			<td class='usam_value_row'><?php echo usam_get_basket_subtotal(); ?></td>
		</tr>				
		<?php
		if( usam_cart_tax_enabled() )
		{
			?>
			<tr class="displaying_results usam_total_tax">				
				<td class='usam_name_row'><?php _e('Налог', 'usam'); ?>:</td>
				<td class='usam_value_row'><?php echo usam_cart_tax(); ?></td>
			</tr>	
		<?php }	?>		
		<?php 				
		if ( usam_discount_cart( false ) != 0 ) 
		{
			?>
			<tr class="displaying_results">
				<td class='usam_name_row'><?php _e('Скидка', 'usam'); ?>:</td>
				<td class='usam_value_row'><?php echo usam_discount_cart(); ?></td>
			</tr>
		<?php } ?>
		<?php if( usam_bonuses_cart( false ) != 0 ){ ?>	
			<tr class="displaying_results">				
				<td class='usam_name_row'><?php _e('Потраченные бонусы', 'usam'); ?>:</td>
				<td class='usam_value_row'><?php echo usam_bonuses_cart(); ?></td>
			</tr>	
		<?php } ?>			
		<tr  class='totals_price'>	
			<td class='usam_name_row'><?php _e('Общая цена', 'usam'); ?>:</td>				
			<td class='usam_value_row'><?php echo usam_cart_total_widget( false ); ?></td>	
		</tr>
	</table> 
</div>
<div class='clear'></div>
<div class='navigation_form'>
	<a class = "btn_r btn_r--main fr loading ta-c" href="<?php echo usam_get_url_system_page('checkout'); ?>"><?php _e('Оформить заказ', 'usam'); ?> &raquo;</a>
</div>
<!-- ++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
<?php
do_action('usam_before_shipping_of_shopping_cart');  ?>   
</div>
<?php
usam_display_cross_sells(); 
}
?>