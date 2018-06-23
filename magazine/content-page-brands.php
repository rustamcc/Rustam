<?php
// Описание: Модуль "Бренды"


$brand_image = get_option( 'usam_brand_image' );
?>
<?php
echo '<h3 class="head_msg">' . __('Бренды', 'usam') . '</h3>';
?>

<div id="brands_list" class="bg-clr-white">
	<ul>		
		<?php
		$brands = get_terms( 'usam-brands', "update_term_meta_cache=0" );
		foreach( $brands as $brand )
		{
			echo "<li class='brand' id='usam_brand_$brand->term_id'><a href=".get_term_link($brand->term_id, 'usam-brands')."><img src='".usam_brand_image($brand->term_id)."' width='".$brand_image['width']."' height='".$brand_image['height']."' alt='$brand->name'><h4 class='title m-t10'>$brand->name</h4></a></li>";
		}		
		?>		
	</ul>
</div>