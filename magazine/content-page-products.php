<?php
// Описание: Модуль для страницы "каталог" и категорий товаров
?>
<?php global $usam_query; ?>		
<div class="products_catalog_head m-t20">			
	<?php do_action( 'usam_catalog_head' ); ?>	
	<?php usam_output_breadcrumbs(); ?>	
	<div class="title">
		<?php usam_page_name_html(); ?>
		<span class ="number_products_title"><?php printf( _n('%s товар', '%s товаров', $usam_query->found_posts, 'usam'), $usam_query->found_posts); ?></span>		
	</div>		
	<form method="get" action="">	
		<div class="usam_setting_display">
			<?php
			usam_sortby_form();			
			usam_range_price_slider();	
			if( !wp_is_mobile() )
			{
				usam_quantity_of_products();
				usam_display_products_options();
			}
			?>
		</div>				
		<?php usam_filter_form(); ?>
	</form>
</div>
<?php usam_include_products_page_template(); ?>