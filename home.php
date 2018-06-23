<?php get_header(); ?>
<?php usam_display_slider(); ?>
<div>
	<div id="content" class="margin-lr-auto">
		<?php
		if(get_theme_mod('hide_block-zi1') == '')
			get_template_part( 'blocks/block', 'zi1' );

		if(get_theme_mod('hide_block-carousel_items1') == '')
			get_template_part( 'blocks/block', 'carousel_items1'); 

		if(get_theme_mod('hide_block-carousel_items2') == '')
			get_template_part( 'blocks/block', 'carousel_items2' );

		if(get_theme_mod('hide_block-brands') == '')
			get_template_part( 'blocks/block', 'zi2' );

		if(get_theme_mod('hide_block-blog') == '')
			get_template_part( 'blocks/block', 'blog' );

		if(get_theme_mod('hide_block-reviews') == '')
			get_template_part( 'blocks/block', 'fb' );

		if(get_theme_mod('hide_block-items') == '')
			get_template_part( 'blocks/block', 'items' );
		
		get_footer();
		?>