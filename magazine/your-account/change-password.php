<?php
// Описание: Сбросить пароль

?>
<?php
if (function_exists('user_management')) 
{
	$args = array( 'register_form' => 'resetpass', 'show_title' => 'false');			
	user_management( $args ); 
}
?>
