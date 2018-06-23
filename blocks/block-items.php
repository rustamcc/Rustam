<br>
<div id="items_column" class="df jc-sb">

	<div class="items_column-card bg-clr-white p20 f0-9em tt-u border">
		<h3 class="items_column-card__title f1-3em clr-1">Новинки</h3>
		<hr class="b0 clr-4 bg-clr-4">
		<?php usam_display_product_groups( array('query' => 'news', 'template' => 'items_column', 'limit' => 3) ) ?>
	</div>

	<div class="items_column-card bg-clr-white p20 f0-9em tt-u border">
		<h3 class="items_column-card__title f1-3em clr-1">Популярные</h3>
		<hr class="b0 clr-4 bg-clr-4">
		<?php usam_display_product_groups( array('query' => 'popularity', 'template' => 'items_column', 'limit' => 3) ) ?>
	</div>

	<div class="items_column-card bg-clr-white p20 f0-9em tt-u border">
		<h3 class="items_column-card__title f1-3em clr-1">Рекомендуем</h3>
		<hr class="b0 clr-4 bg-clr-4">
		<?php usam_display_product_groups( array('query' => 'product_views_cat', 'template' => 'items_column', 'limit' => 3) ) ?>
	</div>

	<div class="items_column-card bg-clr-white p20 f0-9em tt-u border">
		<h3 class="items_column-card__title f1-3em clr-1">Случайные</h3>
		<hr class="b0 clr-4 bg-clr-4">
		<?php usam_display_product_groups( array('query' => 'rand', 'template' => 'items_column', 'limit' => 3) ) ?>
	</div>
</div>