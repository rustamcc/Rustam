<?php
// Описание: Оформление заказа

?>
<?php
global $usam_checkout;		

$usam_checkout = new USAM_Checkout( );		
$usam_checkout->profile_part( );

$id = '';
while ( $usam_checkout->have_checkout_items() ) : $usam_checkout->the_checkout_item(); 
	if( $id != usam_checkout_item_group_id() )
		{  //отображать заголовки для полей формы			
			$id = usam_checkout_item_group_id(); 
			if ( $id != '')
			{ 
				?></table><?php 
			}
			?>			
			<div class="profile-checkout">
				<h3><?php echo usam_checkout_item_group_name();?></h3>
			<?php } ?>
			<div class="profile-checkout_box df m-t10">
				<label class="db" for='<?php echo $usam_checkout->form_element_id(); ?>'><?php echo $usam_checkout->checkout_item->name; ?></label>
				<div class="db profile-checkout_form"><?php echo $usam_checkout->form_field(); ?></div>
			</div>
			<?php 
		endwhile; 
		?>
		<input type="submit" class="button button_save m-t20" value="<?php _e( 'Сохранить профиль', 'usam' ); ?>" name="button" />
	</div>
	<?php 
