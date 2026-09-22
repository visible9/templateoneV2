<style type="text/css">
	.home-pricing{position: relative; padding: var(--section-space) 0; background: var(--color-1); color: var(--color-inverse); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-pricing, .home-pricing *, .home-pricing *::before, .home-pricing *::after{box-sizing: border-box;}
	/*With every field empty there would be a blank dark band holding nothing, so the whole section steps aside*/
	.home-pricing:not(:has(.content-width > *)){display: none;}
	.home-pricing h2, .home-pricing h3, .home-pricing ul{margin: 0;}
	.home-pricing p{margin: 0; text-wrap: pretty;}
	.home-pricing ul{padding: 0; list-style: none;}
	.home-pricing .pill{margin: 0; background: none;}
	/*A word too long for its box breaks instead of pushing a card wider. anywhere is for the text that is the only shrinkable item of its row, where the break has to be allowed before the box is sized.*/
	.home-pricing{overflow-wrap: break-word;}
	.home-pricing .pricing-title, .home-pricing .lead, .home-pricing .plan-name, .home-pricing .plan-text, .home-pricing .price-amount, .home-pricing .plan-features li{overflow-wrap: anywhere;}

	/*Heading - centred above the plans*/
	.home-pricing .pricing-head{display: flex; flex-direction: column; align-items: center; gap: var(--space-5); text-align: center;}
	.home-pricing .pricing-title{max-width: 820px; font-family: var(--heading-font); font-size: var(--lg); font-weight: 500; line-height: 1.03; letter-spacing: -.032em; text-wrap: balance; color: var(--color-inverse);}
	.home-pricing .lead{max-width: 640px; color: var(--color-muted-dark);}

	/*Plans - the grid sizes itself to the number of plans: one plan is a single narrow card, two are a pair, four fill a row, and anything else wraps three to a row (a fifth plan and beyond cannot lift a card into the row above, so --raise drops to nothing). --raise is how far a highlighted card stands above the rest, and the grid makes room for it on top.*/
	.home-pricing .pricing-grid{--columns: 3; --raise: 20px; --max: 100%; display: grid; grid-template-columns: repeat(var(--columns), minmax(0, 1fr)); gap: var(--grid-gap); max-width: var(--max); margin-left: auto; margin-right: auto; padding-top: var(--raise);}
	.home-pricing .pricing-head + .pricing-grid{margin-top: 80px;}
	.home-pricing .pricing-grid:where(:has(> :nth-child(1):nth-last-child(1))){--columns: 1; --max: 440px;}
	.home-pricing .pricing-grid:where(:has(> :nth-child(1):nth-last-child(2))){--columns: 2; --max: 900px;}
	.home-pricing .pricing-grid:where(:has(> :nth-child(1):nth-last-child(4n))){--columns: 4;}
	.home-pricing .pricing-grid:where(:has(> :nth-child(5))){--raise: 0px;}

	/*A plan is a dark card, or with Highlight a white one that stands above its neighbours: --raise of extra height on top, the rest of the row bottoms line up. Nothing pushes the buttons and lists to a common line, so a card with less in it simply ends sooner, as in the design.*/
	.home-pricing .plan-card{--pad-x: 40px; position: relative; display: flex; flex-direction: column; gap: 28px; min-width: 0; padding: 40px var(--pad-x); border-radius: var(--radius-xl); background: var(--color-ink-2); box-shadow: inset 0 0 0 1px rgb(255 255 255 / 10%);}
	.home-pricing .plan-featured{margin-top: calc(var(--raise) * -1); background: var(--color-card); color: var(--color-1); box-shadow: 0 40px 80px -30px color-mix(in srgb, var(--color-1) 60%, transparent);}
	.home-pricing .plan-badge{position: absolute; top: -16px; left: var(--pad-x); display: inline-flex; align-items: center; gap: var(--space-2); max-width: calc(100% - var(--pad-x) * 2); min-height: 34px; padding: 6px 16px; border-radius: var(--radius-pill); background: var(--color-2); color: var(--color-on-accent); font-size: var(--xs); font-weight: 700; line-height: 1.2;}
	.home-pricing .plan-badge .ico{width: 16px; height: 16px;}
	.home-pricing .plan-head{display: flex; flex-direction: column; gap: 10px;}
	.home-pricing .plan-name{font-family: var(--heading-font); font-size: var(--plan-title); font-weight: 500; line-height: 1.55; letter-spacing: -.025em; text-wrap: balance; color: inherit;}
	.home-pricing .plan-text{font-size: var(--ui); line-height: 1.5; color: var(--color-muted-dark);}
	.home-pricing .plan-price{display: flex; flex-direction: column; gap: 6px;}
	.home-pricing .price-row{display: flex; flex-wrap: wrap; align-items: baseline; column-gap: 10px;}
	.home-pricing .price-amount{font-family: var(--heading-font); font-size: var(--price); line-height: 1; letter-spacing: -.045em;}
	.home-pricing .price-period{font-size: var(--ui); color: var(--color-muted-dark);}
	.home-pricing .price-note{font-size: var(--card-note); color: var(--color-muted-dark);}
	.home-pricing .plan-featured .plan-text, .home-pricing .plan-featured .price-period, .home-pricing .plan-featured .price-note{color: var(--color-3);}
	.home-pricing .plan-button{width: 100%; height: auto; min-height: 56px; padding-top: 14px; padding-bottom: 14px; white-space: normal; text-align: center; line-height: 1.2;}
	.home-pricing .plan-button .ico{width: 20px; height: 20px;}
	.home-pricing .plan-features{display: flex; flex-direction: column; gap: 14px; padding-top: 28px; border-top: 1px solid rgb(255 255 255 / 12%);}
	.home-pricing .plan-features li{display: flex; align-items: flex-start; gap: var(--space-3); font-size: var(--ui); line-height: 1.4;}
	.home-pricing .plan-features .ico{width: 20px; height: 20px; margin-top: 1px; color: var(--color-2);}
	.home-pricing .plan-featured .plan-features{border-top-color: var(--color-border);}
	.home-pricing .plan-featured .plan-features .ico{color: var(--color-green);}
	.home-pricing .plan-featured .plan-features li:first-child{font-weight: 700;}

	/*Footnote - one line under the plans, an icon and a bold lead-in*/
	.home-pricing .pricing-footnote{display: flex; align-items: center; justify-content: center; gap: var(--space-3); margin-top: 56px; font-size: var(--card-text); text-align: center; color: var(--color-muted-dark);}
	.home-pricing .pricing-footnote .ico{color: var(--color-2);}
	.home-pricing .pricing-footnote strong{font-weight: 700; color: var(--color-inverse);}

	/*Tablet - the plans stack in one column. It is capped so a card does not stretch across a wide screen, and a badge, which hangs 16px above its card, gets that much room above it.*/
	@media(max-width: 1000px){
		.home-pricing .pricing-head + .pricing-grid{margin-top: var(--space-7);}
		.home-pricing .pricing-grid{--columns: 1; --raise: 0px; max-width: min(var(--max), 640px);}
		.home-pricing .plan-badged{margin-top: var(--space-4);}
	}

	/*Phone - the heading and the note line up left, the cards are a little tighter*/
	@media(max-width: 750px){
		.home-pricing .pricing-head{align-items: flex-start; gap: 18px; text-align: left;}
		.home-pricing .pricing-title{line-height: 1.05; letter-spacing: -.03em;}
		.home-pricing .pricing-head + .pricing-grid{margin-top: 36px;}
		.home-pricing .pricing-grid{gap: 14px;}
		.home-pricing .plan-card{--pad-x: 24px; gap: 22px; padding: 28px var(--pad-x);}
		.home-pricing .plan-featured{box-shadow: 0 30px 60px -28px color-mix(in srgb, var(--color-1) 60%, transparent);}
		.home-pricing .plan-badge{min-height: 32px; padding: 6px 14px;}
		.home-pricing .plan-head{gap: var(--space-2);}
		.home-pricing .plan-price{gap: var(--space-1);}
		.home-pricing .plan-features{gap: var(--space-3); padding-top: 22px;}
		.home-pricing .pricing-footnote{align-items: flex-start; justify-content: flex-start; margin-top: var(--space-6); font-size: var(--card-note); line-height: 1.5; text-align: left;}
		.home-pricing .pricing-footnote .ico{margin-top: 2px;}
	}

</style>

<section class="home-pricing" id="pricing">
	<div class="content-width">

		<?php if (section_field('crb_pricing_eyebrow') || section_field('crb_pricing_title') || section_field('crb_pricing_text')) { ?>
			<div class="pricing-head fade-from-bottom">
				<?php if (section_field('crb_pricing_eyebrow')) { ?>
					<span class="pill dark"><?= section_field('crb_pricing_eyebrow'); ?></span>
				<?php } ?>
				<?php if (section_field('crb_pricing_title')) { ?>
					<h2 class="pricing-title"><?= section_field('crb_pricing_title'); ?></h2>
				<?php } ?>
				<?php if (section_field('crb_pricing_text')) { ?>
					<p class="lead"><?= section_field('crb_pricing_text'); ?></p>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if (filled_rows(section_field('crb_pricing_plans'), 'name')) { ?>
			<div class="pricing-grid">
				<?php foreach (filled_rows(section_field('crb_pricing_plans'), 'name') as $plan) { ?>
					<article class="plan-card fade-from-bottom<?= !empty($plan['featured']) ? ' plan-featured' : ''; ?><?= is_filled($plan['badge'] ?? '') ? ' plan-badged' : ''; ?>">

						<?php if (is_filled($plan['badge'] ?? '')) { ?>
							<span class="plan-badge"><?= theme_icon(section_field('crb_pricing_badge_icon')); ?><?= $plan['badge']; ?></span>
						<?php } ?>

						<div class="plan-head">
							<h3 class="plan-name"><?= $plan['name']; ?></h3>
							<?php if (is_filled($plan['text'] ?? '')) { ?>
								<p class="plan-text"><?= $plan['text']; ?></p>
							<?php } ?>
						</div>

						<?php if (is_filled($plan['price'] ?? '') || is_filled($plan['period'] ?? '') || is_filled($plan['note'] ?? '')) { ?>
							<div class="plan-price">
								<?php if (is_filled($plan['price'] ?? '') || is_filled($plan['period'] ?? '')) { ?>
									<div class="price-row">
										<?php if (is_filled($plan['price'] ?? '')) { ?>
											<span class="price-amount"><?= $plan['price']; ?></span>
										<?php } ?>
										<?php if (is_filled($plan['period'] ?? '')) { ?>
											<span class="price-period"><?= $plan['period']; ?></span>
										<?php } ?>
									</div>
								<?php } ?>
								<?php if (is_filled($plan['note'] ?? '')) { ?>
									<p class="price-note"><?= $plan['note']; ?></p>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if (is_filled($plan['button_text'] ?? '') && is_filled($plan['button_url'] ?? '')) { ?>
							<a class="button<?= empty($plan['featured']) ? ' ghost' : ''; ?> plan-button" href="<?= $plan['button_url']; ?>"><?= $plan['button_text']; ?><?= !empty($plan['featured']) ? theme_icon('arrow-r') : ''; ?></a>
						<?php } ?>

						<?php if (text_lines($plan['features'] ?? '')) { ?>
							<ul class="plan-features">
								<?php foreach (text_lines($plan['features']) as $feature) { ?>
									<li><?= theme_icon('check'); ?><?= $feature; ?></li>
								<?php } ?>
							</ul>
						<?php } ?>

					</article>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if (section_field('crb_pricing_footnote_title') || section_field('crb_pricing_footnote_text')) { ?>
			<p class="pricing-footnote fade-from-bottom">
				<?= theme_icon(section_field('crb_pricing_footnote_icon')); ?>
				<span>
					<?php if (section_field('crb_pricing_footnote_title')) { ?>
						<strong><?= section_field('crb_pricing_footnote_title'); ?></strong>
					<?php } ?>
					<?= section_field('crb_pricing_footnote_text'); ?>
				</span>
			</p>
		<?php } ?>

	</div>
</section>
