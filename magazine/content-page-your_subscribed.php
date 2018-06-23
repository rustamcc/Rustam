<?php
// Описание: Подписка на новости

?>
<?php 	
$lists = usam_get_subscribers_list( );
if ( isset($_GET['stat_id']) || isset($_GET['comm']) )
{
	if ( isset($_GET['stat_id']) )
	{
		$stat_id = (int)$_GET['stat_id'];	
		$stat = usam_get_user_stat_mailing( $stat_id );		
		
		$id_communication = $stat['id_communication'];
	}
	else
		$id_communication = (int)$_GET['comm'];	
	
	$communication = usam_get_communication( $id_communication );
	$subscriber_lists = usam_get_subscriber_list( $communication['id'] );
	
	$email = $communication['value'];
	$userlists = array();
	foreach($lists as $list)
	{
		foreach($subscriber_lists as $select)
		{
			if ( $list['id'] == $select['list'] && $select['status'] != 2 )
			{
				$userlists[] = $list['id'];
			}
		}
	}
}
else
{
	global $user_ID;
	
	$userlists = usam_get_currentuser_list( );							
	$current_user = wp_get_current_user();	
	$email = $current_user->user_email;
	
	$id_communication = 0;
}
?> 	
<div class = "your_subscribed">
	<h1 class="p20 bg-clr-white m-t20"><?php the_title();?></h1>
	<div class="p20 bg-clr-white">	
	<?php	
	if ( isset($_GET['subscribe']) )
	{
		$subscribe = (int)$_GET['subscribe'];	
		if ( $subscribe )
		{
			?>
			<p><strong><?php _e( 'Вы успешно подписались на новости!', 'usam' ); ?></strong></p>
			<?php
		}
		else
		{
			?>
			<p><strong><?php _e( 'К сожалению мы больше не сможем вас информировать о новостях!', 'usam' ); ?></strong></p>
			<?php
		}
	}	
	?>
	<div class = "user_mail"><div class = "mail_div"><?php _e( 'Ваш почтовый ящик', 'usam' ); ?>: <span><?php echo $email; ?></span></div></div>
	<form action="" method="post" class="bg-clr-white">
	<table class="mail_service_table" cellspacing="0">							
		<tbody>
			<?php								
			foreach($lists as $list)
			{	
				if ( in_array($list['id'], $userlists) )
					$checked = ' checked="checked"';
				else
					$checked = '';				
				echo '<tr>
					<td class="checkbox"><input type="checkbox" id="usam_mail_list-'.$list['id'].'" name="mail_list[]" value="'.esc_attr($list['id']).'"'.$checked.' /></td>
					<td><label for="usam_mail_list-'.$list['id'].'" class = "mail_list_name"><strong>'.$list['title'].'</strong></label></td>
				</tr>';
			}
			?>
		</tbody>
	</table>		
	<?php echo wp_nonce_field( 'usam_user_profile', '_usam_user_profile' );	?>
	<input type='hidden' name='usam_action' value='unsub_list'>
	<input type='hidden' name='communication_id' value='<?php echo $id_communication; ?>'>
	<input type="submit" class="button button_save" value="<?php _e( 'Сохранить', 'usam' ); ?>" name="submit" />
	</form>
	</div>
</div>