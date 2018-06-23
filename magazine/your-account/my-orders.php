<?php
// Описание: Заказы

?>
<?php
if ( usam_show_details_order() ) : 							
	usam_go_back_user_account_tab();
	usam_show_order_customer(); 
else : 
?>
<div class="profile-oders">
	<h2><?php _e('История покупок','usam'); ?></h2>		
	<?php 
	global $user_ID;
		
	$args =  array(
		'display_currency_symbol' => true,
		'decimal_point'   		  => true,
		'display_currency_code'   => false,
		'display_as_html'         => false,
		'code'                 => false,
	);
	
	$i = 0;
	$sum = 0;
    do_action( 'usam_pre_display_orders' );
	
	$query = array( 	
		'fields' => array('id', 'status', 'totalprice', 'date_insert','paid'),	
		'order' => 'DESC', 	
		'user_id' => $user_ID,
		'cache_order_documents' => true,	
	);		
	$orders = usam_get_orders( $query );
	
	echo '<table class="usam_user_profile_table order_table">';	
	if ( !empty($orders) )
	{
		echo '<tr class="toprow">	
				<td><strong>'. __( 'Номер заказа', 'usam' ).'</strong></td>
				<td><strong>'.__( 'Дата', 'usam' ).'</strong></td>
				<td><strong>'.__( 'Стоимость', 'usam' ).'</strong></td>										
				<td><strong>'.__( 'Статус заказа', 'usam' ).'</strong></td>
				<td><strong>'.__( 'Действия', 'usam' ).'</strong></td>										
			</tr>';
		foreach ( (array)$orders as $order )
		{
			$sum += $order->totalprice;
			$status_name = usam_get_order_status_name( $order->status );		
			$alternate = "";
			$i++;
			if ( ($i % 2) != 0 )
				$alternate = "class='alt'";

			echo "<tr $alternate>\n\r";
			echo " <td class='tr_name processed'>";
			echo "<a href='".usam_get_user_account_url('my-orders')."?id=".$order->id."' title='". __( 'Подробная информация', 'usam' )."'>";		
			echo "<span id='form_group_" . $order->id . "_text'>". $order->id ."</span>";
			echo "</a>";
			echo " </td>\n\r";
			
			echo " <td class='tr_name right_cell'>".date_i18n( get_option('date_format'), strtotime($order->date_insert ))." </td>\n\r";
			echo " <td class='tr_name right_cell'>".usam_currency_display( $order->totalprice, $args )."</td>\n\r";		
			echo "<td class='tr_name center_cell'>".$status_name." </td>\n\r";
			echo "<td class='tr_name center_cell'>";		
			if ( $order->paid != 2 && !usam_check_order_is_completed( $order->status ) )
			{
				echo '<a href="'.usam_get_user_account_url('my-orders').'?display=pay_the_order&id='.$order->id.'">'. __('Оплатить', 'usam') .'</a>';
			}
			echo "</td>\n\r";		
			echo "</tr>\n\r";
		}
		echo '<tr class = "sumtotal"><td class="right_cell" colspan="2">'.__( 'Сумма всех покупок:', 'usam' ).'</td><td colspan="3" class="left_cell">';
		echo usam_currency_display( $sum, $args );
		echo "</td></tr>";
	}
	else
	{
		echo "<tr><td>".__( 'У вас еще не было покупок.', 'usam' )."</td></tr>";
	}
	echo '</table>';
?>
</div>
<?php endif; ?>			