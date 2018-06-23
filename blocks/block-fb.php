<?php 
$reviews = usam_get_customer_reviews( array( "status" => 1 ) );
$count = count($reviews);
if($count) {
	?>
	<div id="fb-slider" class="border">
		<?php  $c=0; foreach ( $reviews as $review ) { ?>
			<div class="fbs-box p20">
				<div class="df">
					<img alt="<?php echo $review->name; ?>" src="<?php echo get_avatar_url( $review->user_id ); ?>">
					<div class="fd-c df jc-sb clr-8">
						<div><b><?php echo $review->title; ?></b></div>
						<div><?php echo mb_strimwidth($review->review_text, 0, 350, "..."); ?></div>
						<div class="clr-7"><?php echo $review->name; ?> (<?php echo date("d-m-Y", strtotime($review->date_time)); ?>)</div>
					</div>
				</div>
			</div>

			<?php $c++; if($c==10) { break; } } ?>
		</div>
		<script>
			$(document).ready(function () {
				$('#fb-slider').slick({
					arrows: false,
					autoplay: true,
					dots: true
				});
				$("#fb-slider .slick-dots li button").text('');
			});
		</script>
		<?php } ?>