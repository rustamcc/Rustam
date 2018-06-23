<?php
$product_id = get_the_ID();
$product_link = usam_the_product_permalink();
$product_has_stock = usam_product_has_stock();
$thumbnail = @usam_the_product_thumbnail( $product_id, array(250,200) );
$thumbnail = $thumbnail["src"];
?>
<div class="tt-u item-card">			
	<div class="item-card__head pr ta-c df jc-c oh">
		<div class="item-card__img" style="background-image: url(<?php echo $thumbnail; ?>);"></div>
		<a href="index.php?product_id=<?php echo $product_id; ?>&usam_ajax_action=desired_product" data-ajax_action="desired_product" class="item-card__rm pa clr-11"><i class="far fa-times-circle f1-5em"></i></a>
	</div>

	<div class="item-card__name oh item-card__body"><a href="<?php echo usam_the_product_permalink(); ?>"><?php the_title(); ?></a></div>
	<hr class="item-card__divider clr-4 bg-clr-4" /> 

	<div class="item-card__footer df jc-sb">
		<div>
			<?php if( usam_is_product_discount() ) { ?>
				<span class="clr-9 f0-9em td-lt"><?php usam_product_price_currency( true ); ?></span>
			<?php } ?>
			<span class="clr-2"><?php usam_product_price_currency( ); ?></span>
		</div>
		<div class="item-card__add">
			<?php button_addtocart( array( "product_has_stock" => $product_has_stock, "product_id" => $product_id, "product_link" => $product_link, "class" => "clr-7 button_mini" ) ); ?>
		</div>
	</div>
</div>