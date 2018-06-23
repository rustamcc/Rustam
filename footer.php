<?php get_template_part( 'blocks/block', 'about' ); ?>
<footer id="footer" class="tt-u">
	<?php
	if(has_nav_menu('footer_menu')){
		wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'footer__links tt-u f0-8em', 'menu_class' => 'active', 'items_wrap' => '%3$s', 'depth' => 1, 'item_spacing' => 'discard', 'theme_location' => 'footer_menu' ) );
	} else { ?>
		<!-- DEMO --><nav class="footer__links"><li id="menu-item-1" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-35"><a href="/">Главная</a></li><li id="menu-item-2" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-home menu-item-35"><a href="/products-list/">Каталог</a></li></nav><!-- DEMO -->
	<?php } ?>

	<div class="df jc-sb">
		<div class="footer__ct">
			<?php echo get_theme_mod('footer_copyricht', '© 2018 WP-Universam WordPress Theme. <a href="http://wp-universam.ru">WP-Universam.ru</a>'); ?>
		</div>
		<div class="footer__vmc">
			<?php echo get_theme_mod('footer_vmc', '<img alt="visa" src="'.get_template_directory_uri().'/img/visa.png"><img alt="mastercard" src="'.get_template_directory_uri().'/img/masercard.png">'); ?>
		</div>
	</div>
</footer>
</div> <!-- #content -->
</div>

<div id="popup" class="pf"><div id="popup_box" class="bg-clr-white centered clr-1 pf df ai-c p20"></div></div>

<?php wp_footer(); ?>
</body>
</html>