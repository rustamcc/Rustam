<div class="slider">
	<?php
	foreach ($slides as $key => $slide)		
	{					
		if( wp_is_mobile() )
			$size = 'medium';
		else
			$size = 'full';
		$object_id = wp_get_attachment_image_src( $slide['object_id'], $size);	
		?>
		<?php if (!empty($slide['link'])) { ?>
			<a href="<?php echo $slide['link']; ?>">
			<?php } ?>	
			<div class="slide" style="<?php if(!empty($slide['fon'])){ ?>background-color: <?php echo $slide['fon'].'; '; } ?>background-image: url(<?php echo $object_id[0]; ?>);">
				<? if (!empty($slide['description']) || !empty($slide['title'])) { ?>

					<div class="box">
						<div class="title"><h3><? echo $slide['title']; ?></h3></div>
						<div class="desc"><? echo $slide['description']; ?></div>
					</div>

				<? } ?>
			</div>
			<?php if (!empty($slide['link'])) { ?></a><?php } ?>
		<?php } ?>
	</div>
	<script>
		$(document).ready(function () {
			if( $(window).width() > 800 ){
				$('.slider').slick({
					arrows: false,
					dots: true,
					pauseOnDotsHover: true,
					autoplay: true
				});
			}
		});
	</script>