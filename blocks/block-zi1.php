<div id="zi1" class="df jc-sa">

	<?php $terms = get_terms('usam-category'); $c=0; foreach ( $terms as $category ) { ?>

		<?php
		$img = usam_category_thumbnail( $category->term_id );
				//$img = usam_category_image( $category->term_id );
		if(!$img) { $img = '<img alt="no img" src="'.get_template_directory_uri().'/img/no-img.jpg">'; }
				//if(!$img) { $img = get_template_directory_uri()."/img/no-img.jpg"; }
		?>

		<div class="zi-box ta-c pr oh border">
			<a href="<?php echo usam_get_term_link($category->term_id, 'usam-category')  ?>"> 
				<?php echo $img; ?>
				<div class="zi-box__centered centered pa tt-u f1-3em clr-4">
					<span><?php echo $category->name; ?></span>
					<?php if($category->description && 1 == 0) { ?>
						<div class="centered__divider"></div>
						<span><?php echo mb_strimwidth($category->description, 0, 30, "..."); ?></span>
					<?php } ?>
				</div>
			</a>
		</div>

		<?php $c++; if($c==3) { break; } } ?>

	</div>