<?php
// Описание: Вывод данных в профиле пользователя

?>
<?php
global $user_ID;
$user = get_user_by( 'ID', $user_ID );
?>
<div class="profile-mini df fd-c">

	<div class="df fd-c m-t10">
		<label for="email"><?php _e( 'Логин', 'usam' ); ?></label>
		<?php echo esc_attr( $user->user_login ) ?>
	</div>

	<div class="df fd-c m-t10">
		<label for="email"><?php _e( 'Электронная почта', 'usam' ); ?></label>
		<input type="text" name="email" id="email" value="<?php echo esc_attr( $user->user_email ) ?>" class="regular-text" />
	</div>

	<div class="df fd-c m-t10">
		<label for="first_name"><?php _e( 'Имя', 'usam' ) ?></label>
		<input type="text" name="first_name" id="first_name" value="<?php echo esc_attr( $user->first_name ) ?>" class="regular-text code" />
	</div>

	<div class="df fd-c m-t10">
		<label for="last_name"><?php _e( 'Фамилия', 'usam' ) ?></label>
		<input type="text" name="last_name" id="last_name" value="<?php echo esc_attr( $user->last_name ) ?>" class="regular-text code" />
	</div>

	<div class="df fd-c m-t10">
		<label for="sex"><?php _e( 'Пол', 'usam' ) ?></label>
		<?php $selected = get_user_meta( $user_ID, 'usam_sex', true ); ?>
		<select class="select_sex" id="sex" name="sex">
			<option value="" <?php echo ($selected == ''?'selected':''); ?>><?php _e( 'Выберите', 'usam' ) ?>...</option>
			<option value="w" <?php echo ($selected == 'w'?'selected':''); ?>><?php _e( 'Мужской', 'usam' ) ?></option>
			<option value="m"<?php echo ($selected == 'm'?'selected':''); ?>><?php _e( 'Женский', 'usam' ) ?></option>					
		</select>
	</div>

	<div class="df fd-c m-t10">
		<?php $birthday = get_user_meta( $user_ID, 'usam_birthday', true ); ?>
		<label for="birthday"><?php _e( 'День рождения', 'usam' ) ?></label>
		<?php 		
		if ( empty($birthday) ) 
			usam_display_date_picker( 'birthday', $birthday ); 
		else
			echo usam_local_date( $birthday, "d.m.Y" );
		?>
	</div
	>
	<div class="m-t20">
		<input type="submit" class="button button_save" value="<?php _e( 'Сохранить профиль', 'usam' ); ?>" name="button" />
	</div>

</div>