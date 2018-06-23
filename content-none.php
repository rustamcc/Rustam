<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Ничего не найдено', 'usam' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content bg-clr-white">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( __( 'Готовы опубликовать свой первый пост? <a href="%1$s"> Приступить к работе здесь </a>.', 'usam' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Извините, но ничто не соответствовало вашим условиям поиска. Пожалуйста, попытайтесь снова с другими ключевыми словами.', 'usam' ); ?></p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p><?php _e( 'Кажется мы не можем найти то, что вы ищете. Возможно, поиск может помочь вам.', 'usam' ); ?></p>
			<?php get_search_form(); ?>

		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
