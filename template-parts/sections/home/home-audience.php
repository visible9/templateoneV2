<style type="text/css">
	.home-audience{position: relative; padding: var(--section-space) 0; background: var(--color-bg); color: var(--color-1); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-audience, .home-audience *, .home-audience *::before, .home-audience *::after{box-sizing: border-box;}
	/*With every field empty there would be a blank band holding nothing, so the whole section steps aside*/
	.home-audience:not(:has(.content-width > *)){display: none;}
	.home-audience h2, .home-audience h3, .home-audience p{margin: 0;}
	.home-audience .pill{margin: 0;}

	/*Heading - the title on the left, the intro and its tags on the right, both ending on the bottom edge of the row*/
	.home-audience .audience-head{display: grid; grid-template-columns: repeat(12, minmax(0, 1fr)); column-gap: var(--grid-gap); align-items: end;}
	.home-audience .audience-intro{grid-column: 1 / span 8; display: flex; flex-direction: column; align-items: flex-start; gap: 28px;}
	.home-audience .audience-title{font-family: var(--heading-font); font-size: var(--lg); font-weight: 500; line-height: 1.03; letter-spacing: -.032em; text-wrap: balance; color: var(--color-1);}
	.home-audience .audience-aside{grid-column: 9 / -1; display: flex; flex-direction: column; align-items: flex-start; gap: 20px; padding-bottom: 8px;}
	.home-audience .audience-tags{display: flex; flex-wrap: wrap; gap: 8px;}
	.home-audience .audience-tags .pill{background: var(--color-card);}

	/*Cards - three across for the six of the design. The grid sizes itself to how many cards rendered: two for two or four cards (2+2 reads better than 3+1), three for any multiple of three. Keep the quantity rules ahead of the breakpoints, they tie on specificity and the last match wins.*/
	.home-audience .audience-grid{--columns: 3; display: grid; grid-template-columns: repeat(var(--columns), minmax(0, 1fr)); gap: var(--grid-gap);}
	.home-audience .audience-grid:where(:has(> :nth-child(1):nth-last-child(2))){--columns: 2;}
	.home-audience .audience-grid:where(:has(> :nth-child(1):nth-last-child(4n))){--columns: 2;}
	.home-audience .audience-grid:where(:has(> :nth-child(1):nth-last-child(3n))){--columns: 3;}
	.home-audience .audience-head + .audience-grid{margin-top: 72px;}
	.home-audience .audience-card{display: flex; flex-direction: column; gap: 20px; min-height: 290px; padding: 32px; border-radius: var(--radius-lg); background: var(--color-card); box-shadow: var(--shadow);}
	.home-audience .card-top{display: flex; align-items: center; justify-content: space-between;}
	.home-audience .card-icon{display: flex; align-items: center; justify-content: center; flex: none; width: 52px; height: 52px; border-radius: var(--radius-pill); background: var(--color-surface); color: var(--color-green-deep);}
	.home-audience .card-number{margin-left: auto; font-family: var(--heading-font); font-size: var(--ui); color: var(--ink-faint);}
	.home-audience .card-title{font-family: var(--heading-font); font-size: var(--card-title); font-weight: 500; line-height: 1.1; letter-spacing: -.025em; text-wrap: balance; color: var(--color-1);}
	.home-audience .card-text{font-size: var(--card-text); text-wrap: pretty; color: var(--color-3);}
	.home-audience .card-check{display: flex; align-items: center; gap: 8px; margin-top: auto; padding-top: 18px; border-top: 1px solid var(--color-border); font-size: var(--card-note); font-weight: 700; color: var(--color-green-deep);}
	.home-audience .card-check .ico{width: 18px; height: 18px;}

	/*Tablet - the heading stacks and the cards go two across*/
	@media(max-width: 1000px){
		.home-audience .audience-head{grid-template-columns: minmax(0, 1fr); row-gap: 18px;}
		.home-audience .audience-intro, .home-audience .audience-aside{grid-column: 1 / -1;}
		.home-audience .audience-aside{padding-bottom: 0;}
		.home-audience .audience-grid{--columns: 2;}
		.home-audience .audience-head + .audience-grid{margin-top: 48px;}
	}

	/*Phone - one card per row, tighter cards*/
	@media(max-width: 750px){
		.home-audience .audience-intro, .home-audience .audience-aside{gap: 18px;}
		.home-audience .audience-title{line-height: 1.05; letter-spacing: -.03em;}
		.home-audience .audience-grid{--columns: 1; gap: 12px;}
		.home-audience .audience-head + .audience-grid{margin-top: 36px;}
		.home-audience .audience-card{gap: 14px; min-height: 0; padding: 24px;}
		.home-audience .card-icon{width: 48px; height: 48px;}
		.home-audience .card-title{line-height: 1.12;}
		.home-audience .card-check{padding-top: 14px;}
	}

</style>

<section class="home-audience" id="audience">
	<div class="content-width">

		<?php if (section_field('crb_audience_eyebrow') || section_field('crb_audience_title') || section_field('crb_audience_text') || filled_rows(section_field('crb_audience_tags'), 'label')) { ?>
			<div class="audience-head fade-from-bottom">

				<?php if (section_field('crb_audience_eyebrow') || section_field('crb_audience_title')) { ?>
					<div class="audience-intro">
						<?php if (section_field('crb_audience_eyebrow')) { ?>
							<span class="pill"><?= section_field('crb_audience_eyebrow'); ?></span>
						<?php } ?>
						<?php if (section_field('crb_audience_title')) { ?>
							<h2 class="audience-title"><?= section_field('crb_audience_title'); ?></h2>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_audience_text') || filled_rows(section_field('crb_audience_tags'), 'label')) { ?>
					<div class="audience-aside">
						<?php if (section_field('crb_audience_text')) { ?>
							<p class="lead"><?= section_field('crb_audience_text'); ?></p>
						<?php } ?>
						<?php if (filled_rows(section_field('crb_audience_tags'), 'label')) { ?>
							<div class="audience-tags">
								<?php foreach (filled_rows(section_field('crb_audience_tags'), 'label') as $tag) { ?>
									<span class="pill"><?= $tag['label']; ?></span>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (filled_rows(section_field('crb_audience_cards'), 'title')) { ?>
			<div class="audience-grid">
				<?php foreach (filled_rows(section_field('crb_audience_cards'), 'title') as $index => $card) { ?>
					<article class="audience-card fade-from-bottom">

						<?php if (theme_icon($card['icon'] ?? '') || section_field('crb_audience_numbers')) { ?>
							<div class="card-top">
								<?php if (theme_icon($card['icon'] ?? '')) { ?>
									<span class="card-icon"><?= theme_icon($card['icon']); ?></span>
								<?php } ?>
								<?php if (section_field('crb_audience_numbers')) { ?>
									<span class="card-number" aria-hidden="true"><?= sprintf('%02d', $index + 1); ?></span>
								<?php } ?>
							</div>
						<?php } ?>

						<h3 class="card-title"><?= $card['title']; ?></h3>

						<?php if (is_filled($card['text'] ?? '')) { ?>
							<p class="card-text"><?= $card['text']; ?></p>
						<?php } ?>

						<?php if (is_filled($card['check'] ?? '')) { ?>
							<div class="card-check"><?= theme_icon('check'); ?><?= $card['check']; ?></div>
						<?php } ?>

					</article>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>
