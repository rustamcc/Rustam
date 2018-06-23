<?php if( is_user_logged_in() ) { ?>
	<div class="logged-menu">
		<div class="bg-clr-white ta-c user-menu-box p10 m-t10 tt-u df jc-c">
			<a href="<?php echo get_option('siteurl'); ?>/your-account/my-orders/"><i class="fas fa-history"></i> <span>История покупок</span></a>
			<a href="<?php echo get_option('siteurl'); ?>/your-account/my-views/"><i class="far fa-eye"></i> <span>Просмотренные товары</span></a>
			<a href="<?php echo get_option('siteurl'); ?>/your-account/my-bonus"><i class="fas fa-gift"></i> <span>Мои бонусы</span></a>
			<a href="<?php echo get_option('siteurl'); ?>/your-account/my-message/"><i class="far fa-envelope"></i> <span>Мои сообщения</span></a>
			<a href="<?php echo get_option('siteurl'); ?>/your-account/my-comments/"><i class="far fa-comment-alt"></i> <span>Мои отзывы</span></a>
		</div></div>
		<?php } ?>