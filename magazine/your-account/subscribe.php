<?php
// Описание: Подписка на новости

?>
<?php 	
$lists = usam_get_subscribers_list( );				
$userlists = usam_get_currentuser_list( );							
$current_user = wp_get_current_user();						
?>
<div class = "user_mail"><div class = "mail_div"><?php _e( 'Ваш почтовый ящик', 'usam' ); ?>: <span><?php echo $current_user->user_email; ?></span></div></div>
<table class="mail_service_table usam_user_profile_table" cellspacing="0">							
	<tbody>
		<?php								
		foreach($lists as $key => $list)
		{
			$list_id = $list['id'];																		
			if ( in_array($list_id, $userlists) )
				$checked = ' checked="checked"';
			else
				$checked = '';							
			echo '<tr>
				<td class="checkbox"><input type="checkbox" id="usam_mail_list-'.$list_id.'" name="mail_list[]" value="'.esc_attr($list_id).'"'.$checked.' /></td>
				<td><label for="usam_mail_list-'.$list_id.'" class = "mail_list_name"><strong>'.$list['title'].'</strong></label></td>
			</tr>';
		}
		?>
	</tbody>
</table>							
<input type="submit" class="btn_r btn_r--main" value="<?php _e( 'Сохранить', 'usam' ); ?>" name="submit" />
