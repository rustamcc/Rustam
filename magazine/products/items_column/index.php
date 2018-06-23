		<div>
			<?php while (usam_have_products()) : usam_the_product(); ?>
				<a href="<?php echo usam_the_product_permalink(); ?>">
					<div class="column-card__item cb df ai-c">
						<?php usam_product_thumbnail( ); ?>
						<div>
							<span><?php echo mb_strimwidth(get_the_title(), 0, 25, "..."); ?></span>
							<div class="column-card__item-price m-t10">
								<?php if( usam_is_product_discount() ) { ?>
									<span class="clr-9 f0-9em td-lt"><?php usam_product_price_currency( true ); ?></span>
								<?php } ?>
								<span class="clr-2"><?php usam_product_price_currency( ); ?></span>
							</div>	
						</div>	
					</div>
				</a>
			<?php endwhile; ?>
		</div>	