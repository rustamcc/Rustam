						<div class="slider-carousel slider-carousel<?php $r = rand(1,99); echo $r;?>">
							<?php	 
							while (usam_have_products()) :  	
								usam_the_product();			
								?>
								<?php get_template_part( 'item', 'card' ); ?>		
							<?php endwhile; ?>
						</div>

						<script>
							$(document).ready(function () {
								$('.slider-carousel<?php echo $r;?>').slick({
									arrows: true,
									dots: false,
									pauseOnDotsHover: true,
									infinite: true,
									speed: 300,
									slidesToShow: 1,
									centerMode: true,
									variableWidth: true
								});

								$('.slider-carousel .slick-prev').html('<i class="fas fa-angle-left"></i>');
								$('.slider-carousel .slick-next').html('<i class="fas fa-angle-right"></i>');
							});
						</script>