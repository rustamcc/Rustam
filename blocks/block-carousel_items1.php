		<div id="items-carousel1">

			<div class="title-2line pr ta-c tt-u oh">
				<div class="va-m dib">
					<div>Популярные</div>
					<div class="clr-3">Товары</div>
				</div>
			</div>

			<?php usam_display_product_groups( array('query' => 'popularity', 'template' => 'items_carousel', 'limit' => 4) ) ?>

		</div>