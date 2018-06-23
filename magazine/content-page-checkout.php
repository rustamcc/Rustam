<?php
global $user_ID;
?>
<div id = "checkout_page" class = "checkout_page">
	<?php
	if( usam_get_basket_number_items() < 1)
	{
		echo '<h3 class="head_msg">' . __('К сожалению, Ваша корзина пуста.', 'usam') . '</h3>';
		?>
		<div class = "checkout_page_button "><a class = "btn_r btn_r--main f1-5em" href="<?php echo usam_get_url_system_page('products-list'); ?>"><?php _e('Посетите Наш магазин', 'usam'); ?></a></div>
		<?php
	}
	else
	{	
		?>
		<form action='' method='post'>		
			<?php 	
			$error_messages = usam_get_errors_checkout();
			if(!empty($error_messages)) { ?>
				<div class='login_error'>
					<?php foreach($error_messages as $error ){?>
						<p class='validation-error'><span><?php echo  __('Ошибка', 'usam').': '; ?></span><?php echo $error; ?></p>
					<?php } ?>
				</div>			
				<?php 	
			}		
			$types_payers = usam_get_group_payers();
			?>		
			<table class='usam_checkout_table table-types_payers'>			
				<thead>
					<tr>
						<td><h4><?php _e('Тип плательщика', 'usam');?></h4></td>
					</tr>
				</thead>
				<tbody>			
					<?php 
					$type_payer = usam_get_customer_meta( 'type_payer' );
					foreach( $types_payers as $value ) 
					{ 
						$checked = $type_payer == $value['id'] ? "checked='checked'":'';
						?>
						<tr>
							<td><input onclick="selected_type_payer('<?php echo $value['id']; ?>')" type='radio' value='<?php echo $value['id']; ?>' name='type_payer' id='type_payer-<?php echo $value['id']; ?>' <?php echo $checked; ?> /><label for ="type_payer-<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>	
		</form>
		
		<form class='usam_checkout_forms' action='' method='post' enctype="multipart/form-data">	
			<?php 
			$id = '';
			$i = 0;			
			while (usam_have_checkout_items()) : usam_the_checkout_item(); 
				
				if( $id != usam_checkout_item_group_id() )
				{  //отображать заголовки для полей формы
					$i++;
					$id = usam_checkout_item_group_id(); 					
					if ( $id != '')
					{ 
						?></table><?php 
					}
					?>	
					<table class='usam_checkout_table table-customer_checkout_details-<?php echo $i; ?>'>					
						<thead>
							<tr <?php echo usam_the_checkout_item_error_class();?>>
								<td colspan='2'><h4><?php echo usam_checkout_item_group_name();?></h4></td>
							</tr>
						</thead>			  
						<?php 
					} 
					?>
					<tr> 
						<td class='<?php echo usam_checkout_form_element_id(); ?> title'>
							<label for='<?php echo usam_checkout_form_element_id(); ?>'><?php echo usam_checkout_form_name();?></label>
						</td>
						<td>
							<?php echo usam_checkout_form_field();?>
							<?php if(usam_the_checkout_item_error() != '') { ?>
								<p class='validation-error'><?php echo usam_the_checkout_item_error(); ?></p>
							<?php } ?>
						</td>
					</tr>			
				<?php endwhile; ?>		

				<?php if( usam_has_tnc() ) { ?>
					<tr>
						<td colspan='2'>					
							<label for="agree"><input id="agree" type='checkbox' value='yes' name='agree' checked /> <?php printf(__("Я согласен с <a class='thickbox' target='_blank' href='%s' class='termsandconds'>правилами и условиями</a>", "usam"), esc_url( add_query_arg( array( 'usam_action' => 'terms_and_conditions', 'width' => 360, 'height' => 400 ) ) ) ); ?> <span class="asterix">*</span></label>
						</td>
					</tr>		
				<?php } ?>
				<?php do_action('usam_inside_table_checkout'); ?>
			</table>

			<?php if( usam_selected_location() ) { ?>		
				<?php if( !usam_virtual_products_in_basket() ) { ?>
					<table  class='usam_checkout_table table-shipping'>
						<thead>
							<tr>
								<td colspan ='2'><h4><?php _e('Способ доставки', 'usam');?></h4></td>
							</tr>
						</thead>
						<tbody>					
							<?php 
							if( usam_have_shipping_methods() ): 
								while (usam_have_shipping_methods())
								{ 
									$shipping_method = usam_the_shipping_method();						
									?>
									<tr id='element_shipping_<?php echo $shipping_method->id; ?>' data-id_method = "<?php echo $shipping_method->id; ?>" class='element_shipping <?php echo usam_shipping_method_select() ?"selected_method":""; ?> <?php echo usam_shipping_method_pickup() ?"pickup_method":""; ?>' >
										<td colspan ='2' onclick = "selected_shipping_method(<?php echo $shipping_method->id; ?>)" >	
											<div class="method_box method_logo left_float"><span style='background-image:url(<? echo usam_shipping_method_url() ?>);' ></span></div>
											<div class="method_box method_title left_float">
												<div class="shipping_name"><strong><?php echo $shipping_method->name; ?></strong></div>
												<div class="shipping_description"><?php echo $shipping_method->description; ?></div>	
												<?php if ( usam_shipping_method_select() && usam_shipping_method_pickup() ) { ?>
													<div class="point_receipt"><?php _e('Выбран пункт самовывоза', 'usam'); ?>: <span class="title"><?php usam_cart_get_select_storage_address(); ?></span> <a href="" id = "usam_select_pickup_buttom" class="usam_modal"><?php _e('выбрать пункт выдачи', 'usam'); ?></a></div>
												<?php } ?>
											</div>
											<div class="method_box right_float">
												<span class="shipping_price"><?php echo $shipping_method->info_price; ?></span></br>
												<?php if ( $shipping_method->delivery_period ) { ?>
													<span class="delivery_period"><?php _e('Срок доставки', 'usam');?>: <?php echo $shipping_method->delivery_period; ?></span>
												<?php } ?>
											</div>							
										</td>	
									</tr>				
								<?php } ?>
								<?php else: ?>
									<tr><td><?php _e('Мы не доставляем в выбранный регион.', 'usam');?></td></tr>	
								<?php endif; ?>							
							</tbody>	
						</table>	  
					<?php } ?>		

					<?php if( usam_gateway_count() > 1) { ?>
						<table  class='usam_checkout_table table-gateway'>
							<thead>
								<tr>
									<td colspan='2'><h4><?php _e('Способ оплаты', 'usam');?></h4></td>
								</tr>
							</thead>
							<tbody>	
								<?php 
								while (usam_have_gateways()) : usam_the_gateway(); ?>
									<tr id='element_gateway_<?php echo usam_get_gateway_id();?>' data-id_method = "<?php echo usam_get_gateway_id();?>" class='element_gateway <?php echo usam_gateway_method_select() ?"selected_method":""; ?>' >
										<td colspan ='2' onclick = "selected_gateway_method('<?php echo usam_get_gateway_id(); ?>')" >						
											<div class="method_box method_logo left_float"><span style='background-image:url(<? echo usam_gateway_method_url() ?>);' ></span></div>				   
											<div class="method_box method_title left_float">
												<div class="shipping_name"><strong><?php usam_print_gateway_name(); ?></strong></div>
												<div class="shipping_description"><?php usam_print_gateway_description(); ?></div>	
											</div>
										</td>
									</tr>			
								<?php endwhile; ?>	
							</tbody>
						</table>	
					<?php } ?>	
				<?php } ?>	

				<table  class='usam_checkout_table table-display_totalprice'>			
					<thead>
						<tr>
							<td colspan='2'><h4><?php _e('Посмотреть и купить','usam'); ?></h4></td>
						</tr>
					</thead>
					<tbody>
						<tr class='usam_subtotal'>
							<td class='usam_name_row'><?php _e('Стоимость корзины', 'usam'); ?>:</td>				
							<td class='usam_value_row'><span class="pricedisplay"><?php echo usam_get_basket_subtotal(); ?></span></td>						
						</tr>			
						<?php 	
						if( usam_cart_tax_enabled() )
						{
							?>
							<tr class="usam_total_tax_row">				
								<td class='usam_name_row'><?php _e('Налог', 'usam'); ?>:</td>
								<td class='usam_value_row'><span id="checkout_shipping" class="pricedisplay checkout-shipping"><?php echo usam_cart_tax(); ?></span></td>									
							</tr>	
						<?php }	?>	
						<tr class="total_shipping">
							<td class='usam_name_row'><?php _e('Доставка', 'usam'); ?>:</td>
							<td class='usam_value_row'><span id="checkout_shipping" class="pricedisplay checkout-shipping"><?php echo usam_cart_shipping(); ?></span></td>
						</tr>
						<?php 
						if ( usam_discount_cart( false ) != 0 ) 
						{
							?>
							<tr class="usam_discount_row">
								<td class='usam_name_row'><?php _e('Скидка', 'usam'); ?>:</td>
								<td class='usam_value_row'><span id="checkout_discount" class="pricedisplay checkout-discount"><?php echo usam_discount_cart(); ?></span></td>				
							</tr>
						<?php } ?>
						<?php if( usam_bonuses_cart( false ) != 0 ){ ?>	
							<tr class="usam_bonuses_row">				
								<td class='usam_name_row'><?php _e('Потраченные бонусы', 'usam'); ?>:</td>
								<td class='usam_value_row'><span id="checkout_bonuses" class="pricedisplay checkout-bonuses"><?php echo usam_bonuses_cart(); ?></span></td>
							</tr>	
						<?php } ?>		
						<tr class='usam_total_price'>
							<td class='usam_name_row'><?php _e('Общая цена', 'usam'); ?>:</td>
							<td class='usam_value_row'><span id='checkout_total' class="pricedisplay checkout-total clr-2"><?php echo usam_cart_total(); ?></span></td>
						</tr>
					</tbody>
				</table>

				<div class='usam_checkout_taskbar'>			
					<?php wp_nonce_field( 'purchase_'.$user_ID, 'new_transaction' ); ?>			
					<input type='hidden' value='1' name='submit_checkout' />
					<button type='submit' name='submit' class='btn_r btn_r--main fr f1-5em loading'><?php _e('Покупка', 'usam');?> &raquo;</button>
				</div>		
			</form>
			<?php 	
		}
		?>	
	</div>