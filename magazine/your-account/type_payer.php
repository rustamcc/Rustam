<?php
// Описание: Список сравнения

?>
<?php
$type_payer = usam_get_customer_meta( 'type_payer' );
$types_payers = usam_get_group_payers();
?>					
<table class='usam_user_profile_table table-types_payers'>		
	<tbody>			
	<?php 
	foreach( $types_payers as $value ) 
	{ 
		$checked = $type_payer == $value['id'] ? "checked='checked'":'';
		?>
		<tr>
			<td><input type='radio' value='<?php echo $value['id']; ?>' name='type_payer' id='type_payer-<?php echo $value['id']; ?>' <?php echo $checked; ?> /><label for ="type_payer-<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label></td>
		</tr>
	<?php } ?>
	</tbody>
</table>
<input type="submit" class="button button_save" value="<?php _e( 'Сохранить', 'usam' ); ?>" name="button" />
<?php
