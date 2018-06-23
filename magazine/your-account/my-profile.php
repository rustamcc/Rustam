</form>
<div class="profile-tabs ta-c tt-u">
	<a href="<?php echo get_option('siteurl'); ?>/your-account/my-profile/" class="active"><i class="far fa-user"></i> <span>Профиль</span></a>
	<a href="<?php echo get_option('siteurl'); ?>/your-account/my-profile/"><i class="far fa-envelope"></i> <span>Подписка</span></a>
	<a href="<?php echo get_option('siteurl'); ?>/your-account/my-profile/"><i class="fas fa-key"></i> <span>Пароль</span></a>
	<a href="<?php echo get_option('siteurl'); ?>/your-account/my-profile/"><i class="fas fa-credit-card"></i> <span>Оплата</span></a>
	<a href="<?php echo get_option('siteurl'); ?>/your-account/my-profile/"><i class="fas fa-shopping-cart"></i> <span>Оформление</span></a>
</div>

<div class="profile-tabs-content bg-clr-white p20 m-t20">

	<div><form action="<?php echo get_option('siteurl'); ?>/your-account/my-profile" method="post"><?php echo wp_nonce_field( 'usam_user_profile', '_usam_user_profile' );	?>
		<?php get_template_part( 'magazine/your-account/my', 'profile_mini' ); ?>
	</form></div>

	<div><form action="<?php echo get_option('siteurl'); ?>/your-account/subscribe" method="post"><?php echo wp_nonce_field( 'usam_user_profile', '_usam_user_profile' );	?>
		<h3 class="p10">Подписка</h3>
		<?php get_template_part( 'magazine/your-account/subscribe' ); ?>
	</form></div>

	<div><form action="<?php echo get_option('siteurl'); ?>/your-account/change-password" method="post"><?php echo wp_nonce_field( 'usam_user_profile', '_usam_user_profile' );	?>
		<h3 class="p10">Изменить пароль</h3>
		<?php get_template_part( 'magazine/your-account/change', 'password' ); ?>
	</form></div>

	<div><form action="<?php echo get_option('siteurl'); ?>/your-account/type_payer" method="post"><?php echo wp_nonce_field( 'usam_user_profile', '_usam_user_profile' );	?>
		<h3 class="p10">Тип плательщика</h3>
		<?php get_template_part( 'magazine/your-account/type_payer' ); ?>
	</form></div>

	<div><form action="<?php echo get_option('siteurl'); ?>/your-account/my-checkout" method="post"><?php echo wp_nonce_field( 'usam_user_profile', '_usam_user_profile' );	?>
		<?php get_template_part( 'magazine/your-account/my', 'checkout' ); ?>
	</form></div>

</div>

</div>
<form action="#" method="post">	