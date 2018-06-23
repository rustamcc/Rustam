<div id="blog">

	<div class="title-2line ta-c tt-u oh">
		<div class="va-m dib">
			<div>Записи из блога</div>
			<div class="clr-3">BLOGGING IS FUN</div>
		</div>
	</div>

	<div class="blog-wrap df jc-sa ai-s">

		<?php global $post; 
		$myposts = get_posts( array('posts_per_page' => 3) );

		foreach( $myposts as $post ){ setup_postdata($post); preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', get_the_content(), $img_url); ?>
		<?php if( ! empty( $img_url[1][0] ) ) {
			$u_img = $img_url[1][0];
		} else {
			$u_img = get_template_directory_uri().'/img/no-img.jpg';
		}	?>
		<div class="blog-card border-box p20 border">
			<a href="<?php the_permalink(); ?>">
				<div class="blog-card__img ta-c pr oh" style="background-image: url(<?php echo $u_img; ?>);">
					<span class="blog-card__more centered ta-c pa dn clr-white">Читать...</span>
				</div>
			</a>
			<div>
				<a href="<?php the_permalink(); ?>"><div class="blog-card__title tt-u"><?php the_title(); ?></div></a>
				<div class="blog-card__date f0-8em"><?php echo get_the_date("j F Y"); ?></div>
				<div class="blog-card__text f0-9em"><?php the_excerpt(); ?></div>
			</div>
		</div>

	<?php } wp_reset_postdata(); ?>
</div>
</div>