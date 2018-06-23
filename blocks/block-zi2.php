<div id="zi2" class="df jc-sa">
	<?php
// Описание: Модуль "Бренды"


//$brand_image = get_option( 'usam_brand_image' );
// width='".$brand_image['width']."' height='".$brand_image['height']."'
	?>

	<?php
	$brands = get_terms( 'usam-brands', "update_term_meta_cache=0" );
		//var_dump($brands);
	$c=0;
	foreach( $brands as $brand ) { ?>

		<div class="zi-box oh ta-c pr bg-clr-white border">
			<a href="<?php echo get_term_link($brand->term_id, 'usam-brands'); ?>" class="df"> 
				<img alt="<?php echo $brand->name; ?>" src="<?php echo usam_brand_image($brand->term_id); ?>">
				<div class="zi-box__centered centered pa tt-u f1-3em clr-4">
					<span><?php echo $brand->name; ?></span>
					<?php if($brand->description && 1 == 0) { ?>
						<div class="centered__divider"></div>
						<span class="f0-8em"><?php echo mb_strimwidth($brand->description, 0, 50, "..."); ?></span>
					<?php } ?>
				</div>
			</a>
		</div>

	<?php $c++; if($c==4) { break; } } ?>
</div>