		<div id="ats" class="ats df jc-sb">
			<div class="w33 ats__box">
				<h4 class="ats__title tt-u clr-1"><?php bloginfo('name'); ?></h4>
				<p class="clr-6 f0-9em"><?php echo get_option('blogdescription'); ?></p>

				<?php if(get_theme_mod('hide_sn') == '') { ?>
					<?php
					if(has_nav_menu('sn_menu')){
						wp_nav_menu( array( 'container' => 'nav', 'container_class' => 'ats__sn', 'menu_class' => 'sn-menu f2em', 'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>', 'depth' => 3, 'item_spacing' => 'discard', 'theme_location' => 'sn_menu', 'before' => '', 'fallback_cb' => '__return_empty_string' ) );
					} else {  ?>
						1.Создайте <a href="/wp-admin/nav-menus.php?action=edit&menu=0" style="color: #dd1f26;">меню</a>. 2.Добавьте "Произвольные ссылки" на соц.сети. 3.Выберите "Область отображения" -> "Соц.сети в подвале" 4.Ссылки преобразуются в такие иконки:
						<div class="ats__sn f2em"><a href="#fb.com" class="fab fa-fb">fb</a></div>
					<?php } ?>
				<?php } ?>
			</div>
			<div class="w33 ats__box">
				<h4 class="ats__title tt-u clr-1">Метки</h4>
				<div class="ats__tags tt-u">
					<?php wp_tag_cloud('taxonomy=product_tag&number=15&order=RAND'); ?>
				</div>
			</div>
			<div class="w33 ats__box">
				<h4 class="ats__title tt-u clr-1">Рассылка</h4>
				<p class="clr-6 f0-9em">Подпишитесь на новости, просто введите свой адрес электронной почты ниже</p>
				<?php usam_get_form_subscribe_for_newsletter() ?>
			</div>
		</div>