<?php
// Описание: Сообщения

?>

<h3 class="ta-c p10 message-new-theme">
	<a href="/your-account/new_topic/"><i class="far fa-edit"></i> Новая тема</a>
</h3>

<?php
$chat = new USAM_Chat_Template();
if ( isset($_GET['sel']) && is_numeric($_GET['sel']) )
{				
	usam_go_back_user_account_tab();
	$dialog = $_GET['sel'];
	$chat->display_chat_dialogs( $dialog );
}
else
{
	$chat->display_dialogs();					
}
?>
