<style type="text/css">
	.home-benefits{position: relative; padding: var(--section-space) 0; background: var(--color-1); color: var(--color-inverse); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-benefits, .home-benefits *, .home-benefits *::before, .home-benefits *::after{box-sizing: border-box;}
	/*With every field empty there would be a blank dark band holding nothing, so the whole section steps aside*/
	.home-benefits:not(:has(.content-width > *)){display: none;}
	.home-benefits h2, .home-benefits h3, .home-benefits p{margin: 0;}
	.home-benefits .pill{margin: 0; background: none;}

	/*Heading - the title on the left, the intro on the right, both ending on the bottom edge of the row*/
	.home-benefits .benefits-head{display: grid; grid-template-columns: repeat(12, minmax(0, 1fr)); column-gap: var(--grid-gap); align-items: end;}
	.home-benefits .benefits-intro{grid-column: 1 / span 8; display: flex; flex-direction: column; align-items: flex-start; gap: 28px;}
	.home-benefits .benefits-title{font-family: var(--heading-font); font-size: var(--lg); font-weight: 500; line-height: 1.03; letter-spacing: -.032em; text-wrap: balance; color: var(--color-inverse);}
	.home-benefits .benefits-text{grid-column: 9 / -1; padding-bottom: 8px; color: var(--color-muted-dark);}

	/*Cards - a bento. A tile is a quarter of a row and a featured card half of one, and flex-grow follows those shares: a row that comes up short stretches across instead of leaving a hole, whatever the number of tiles. The .5px keeps a full row from wrapping on a rounding error.*/
	.home-benefits .benefits-grid{--gap: var(--space-4); display: flex; flex-wrap: wrap; gap: var(--gap);}
	.home-benefits .benefits-head + .benefits-grid{margin-top: 72px;}
	.home-benefits .benefit-card{display: flex; flex: 1 1 calc(25% - var(--gap) * .75 - .5px); min-width: 0; min-height: 330px; border-radius: var(--radius-xl); overflow-wrap: break-word;}
	.home-benefits .benefit-tile{flex-direction: column; gap: var(--space-5); padding: var(--space-6); background: var(--color-ink-2); box-shadow: inset 0 0 0 1px rgb(255 255 255 / 8%);}
	.home-benefits .benefit-feature{flex: 2 1 calc(50% - var(--gap) * .5 - .5px); gap: var(--space-5); padding: 36px;}
	.home-benefits .feature-copy{display: flex; flex: 1 1 0; flex-direction: column; gap: var(--space-5); min-width: 0;}
	.home-benefits .card-icon{display: flex; align-items: center; justify-content: center; flex: none; width: 52px; height: 52px; border-radius: var(--radius-pill); background: color-mix(in srgb, var(--color-2) 14%, transparent); color: var(--color-2);}
	.home-benefits .card-body{display: flex; flex-direction: column; gap: 10px; margin-top: auto;}
	.home-benefits .benefit-feature .card-body{gap: var(--space-3);}
	.home-benefits .card-title{font-family: var(--heading-font); font-size: var(--card-title); font-weight: 500; line-height: 1.1; letter-spacing: -.025em; text-wrap: balance; color: var(--color-inverse);}
	.home-benefits .benefit-feature .card-title{font-size: var(--card-title-lg); line-height: 1.05;}
	.home-benefits .card-text{font-size: var(--ui); line-height: 1.5; text-wrap: pretty; color: var(--color-muted-dark);}
	.home-benefits .benefit-feature .card-text{font-size: var(--card-text);}

	/*Chart card - the green one. The curve is decorative, the two values sit at its ends. The strokes do not scale with the drawing, so the line stays even and the end dot stays round whatever the size of the card.*/
	.home-benefits .benefit-chart{background: var(--color-green-deep);}
	.home-benefits .benefit-chart .card-icon{background: var(--color-2); color: var(--color-on-accent);}
	.home-benefits .benefit-chart .card-text{color: rgb(255 255 255 / 80%);}
	.home-benefits .chart{position: relative; flex: 1 1 0; align-self: stretch; min-width: 0;}
	.home-benefits .chart-line{position: absolute; left: 0; bottom: 0; display: block; width: 100%; height: 170px; overflow: visible;}
	.home-benefits .chart-line path{vector-effect: non-scaling-stroke;}
	.home-benefits .chart-grid{fill: none; stroke: rgb(255 255 255 / 12%); stroke-width: 1;}
	.home-benefits .chart-area{fill: var(--color-2); fill-opacity: .14; stroke: none;}
	.home-benefits .chart-curve{fill: none; stroke: var(--color-2); stroke-width: 4; stroke-linecap: round; stroke-linejoin: round;}
	.home-benefits .chart-halo{fill: none; stroke: var(--color-2); stroke-opacity: .25; stroke-width: 28; stroke-linecap: round;}
	.home-benefits .chart-dot{fill: none; stroke: var(--color-2); stroke-width: 14; stroke-linecap: round;}
	.home-benefits .chart-stat{position: absolute; display: flex; flex-direction: column; gap: 2px;}
	.home-benefits .chart-start{top: 0; left: 0;}
	.home-benefits .chart-end{right: 0; bottom: 56px; align-items: flex-end;}
	.home-benefits .stat-label{font-size: var(--xxs); font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: rgb(255 255 255 / 65%);}
	.home-benefits .stat-value{font-family: var(--heading-font); font-size: var(--stat); line-height: 1; letter-spacing: -.03em; color: var(--color-inverse);}
	.home-benefits .chart-end .stat-label, .home-benefits .chart-end .stat-value{color: var(--color-2);}
	.home-benefits .chart-arrow{display: none; flex: none; width: 30px; height: var(--stat); fill: none; stroke: var(--color-2); stroke-width: 2; stroke-linecap: round; stroke-linejoin: round;}

	/*A rising chart (the end value is higher than the start) draws the curve the other way round, so it climbs to the end dot, and the values follow their points: the start above the low left end, the end above the high right one. 480 is the width of the drawing, 84 the drop from where the falling curve ends (108) to where the rising one does (24).*/
	.home-benefits .rising .chart-shape{transform: translateX(480px) scaleX(-1); transform-origin: 0 0;}
	.home-benefits .rising .chart-halo, .home-benefits .rising .chart-dot{transform: translateY(-84px);}
	.home-benefits .rising .chart-start{top: auto; bottom: 56px;}
	.home-benefits .rising .chart-end{top: 0; bottom: auto;}

	/*Checklist card - the lime one. The first line is the highlighted one.*/
	.home-benefits .benefit-check{background: var(--color-2); color: var(--color-on-accent);}
	.home-benefits .benefit-check .card-icon{background: var(--color-1); color: var(--color-2);}
	.home-benefits .benefit-check .card-title{color: var(--color-on-accent);}
	.home-benefits .benefit-check .card-text{color: var(--color-on-accent); opacity: .85;}
	.home-benefits .check-rows{display: flex; flex: 1 1 0; flex-direction: column; justify-content: center; gap: var(--space-3); min-width: 0;}
	.home-benefits .check-row{display: flex; align-items: center; gap: 14px; padding: var(--space-4) 18px; border-radius: var(--radius-md); background: color-mix(in srgb, var(--color-card) 55%, transparent);}
	.home-benefits .check-row:first-child{background: var(--color-card); box-shadow: 0 18px 36px -18px color-mix(in srgb, var(--color-1) 45%, transparent);}
	.home-benefits .row-icon{display: flex; align-items: center; justify-content: center; flex: none; width: 40px; height: 40px; border-radius: var(--radius-pill); background: var(--color-1); color: var(--color-2);}
	.home-benefits .check-row:first-child .row-icon{background: var(--color-green); color: var(--color-inverse);}
	.home-benefits .row-icon .ico{width: 20px; height: 20px;}
	.home-benefits .row-copy{display: flex; flex-direction: column; gap: 1px; min-width: 0;}
	.home-benefits .row-title{font-size: var(--ui); font-weight: 700; line-height: 1.25;}
	.home-benefits .row-text{font-size: var(--xs); color: var(--color-3);}

	/*Tablet - the heading stacks, the tiles go two across and the featured cards take a row each*/
	@media(max-width: 1000px){
		.home-benefits .benefits-head{grid-template-columns: minmax(0, 1fr); row-gap: 18px;}
		.home-benefits .benefits-intro, .home-benefits .benefits-text{grid-column: 1 / -1;}
		.home-benefits .benefits-text{padding-bottom: 0;}
		.home-benefits .benefits-head + .benefits-grid{margin-top: 48px;}
		.home-benefits .benefit-card{flex-basis: calc(50% - var(--gap) * .5 - .5px);}
		.home-benefits .benefit-feature{flex: 1 1 100%;}
	}

	/*Phone - one card per row. The chart card lays its curve along the bottom with both values on one line, and the checklist card keeps only its first line.*/
	@media(max-width: 750px){
		.home-benefits .benefits-intro{gap: 18px;}
		.home-benefits .benefits-title{line-height: 1.05; letter-spacing: -.03em;}
		.home-benefits .benefits-head + .benefits-grid{margin-top: 36px;}
		.home-benefits .benefits-grid{--gap: var(--space-3);}
		.home-benefits .benefit-card{flex: 1 1 100%; min-height: 0; padding: var(--space-5); border-radius: var(--radius-lg);}
		.home-benefits .benefit-tile, .home-benefits .benefit-feature, .home-benefits .feature-copy, .home-benefits .card-body, .home-benefits .benefit-feature .card-body{gap: 14px;}
		.home-benefits .benefit-feature{flex-direction: column;}
		.home-benefits .feature-copy{flex: none;}
		.home-benefits .card-icon{width: 48px; height: 48px;}
		.home-benefits .card-title{line-height: 1.12;}
		.home-benefits .benefit-feature .card-title{line-height: 1.08;}
		.home-benefits .benefit-chart{position: relative; min-height: 340px; padding-bottom: 132px; overflow: hidden;}
		.home-benefits .chart{position: absolute; right: 0; bottom: 0; left: 0; display: flex; flex: none; align-items: flex-start; justify-content: flex-end; gap: 10px; height: 120px; padding: 6px var(--space-5) 0;}
		.home-benefits .chart-line{height: 120px;}
		.home-benefits .chart-halo{display: none;}
		.home-benefits .chart-dot{stroke-width: 16;}
		.home-benefits .chart-stat{position: static; flex-direction: row;}
		.home-benefits .stat-label{display: none;}
		.home-benefits .chart-start .stat-value{color: var(--color-2);}
		.home-benefits .chart-arrow{display: block;}
		.home-benefits .rising .chart{justify-content: flex-start;}
		.home-benefits .check-rows{flex: none; margin-top: 6px;}
		.home-benefits .check-row:nth-child(n+2){display: none;}
		.home-benefits .check-row{gap: var(--space-3); padding: 14px var(--space-4);}
		.home-benefits .check-row:first-child{box-shadow: none;}
		.home-benefits .row-icon{width: 36px; height: 36px;}
		.home-benefits .row-icon .ico{width: 18px; height: 18px;}
	}

</style>

<section class="home-benefits" id="benefits">
	<div class="content-width">

		<?php if (section_field('crb_benefits_eyebrow') || section_field('crb_benefits_title') || section_field('crb_benefits_text')) { ?>
			<div class="benefits-head fade-from-bottom">

				<?php if (section_field('crb_benefits_eyebrow') || section_field('crb_benefits_title')) { ?>
					<div class="benefits-intro">
						<?php if (section_field('crb_benefits_eyebrow')) { ?>
							<span class="pill dark"><?= section_field('crb_benefits_eyebrow'); ?></span>
						<?php } ?>
						<?php if (section_field('crb_benefits_title')) { ?>
							<h2 class="benefits-title"><?= section_field('crb_benefits_title'); ?></h2>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_benefits_text')) { ?>
					<p class="lead benefits-text"><?= section_field('crb_benefits_text'); ?></p>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (section_field('crb_benefits_chart_title') || filled_rows(section_field('crb_benefits_tiles'), 'title') || section_field('crb_benefits_check_title')) { ?>
			<div class="benefits-grid">

				<?php if (section_field('crb_benefits_chart_title')) { ?>
					<article class="benefit-card benefit-feature benefit-chart<?= is_rising(section_field('crb_benefits_chart_start_value'), section_field('crb_benefits_chart_end_value')) ? ' rising' : ''; ?> fade-from-bottom">

						<div class="feature-copy">
							<?php if (theme_icon(section_field('crb_benefits_chart_icon'))) { ?>
								<span class="card-icon"><?= theme_icon(trend_icon(section_field('crb_benefits_chart_icon'), is_rising(section_field('crb_benefits_chart_start_value'), section_field('crb_benefits_chart_end_value')))); ?></span>
							<?php } ?>
							<div class="card-body">
								<h3 class="card-title"><?= section_field('crb_benefits_chart_title'); ?></h3>
								<?php if (section_field('crb_benefits_chart_text')) { ?>
									<p class="card-text"><?= section_field('crb_benefits_chart_text'); ?></p>
								<?php } ?>
							</div>
						</div>

						<?php if (is_filled(section_field('crb_benefits_chart_start_value')) || is_filled(section_field('crb_benefits_chart_end_value'))) { ?>
							<div class="chart">
								<svg class="chart-line" viewBox="0 0 480 140" preserveAspectRatio="none" aria-hidden="true" focusable="false">
									<path class="chart-grid" d="M0 40H480M0 80H480M0 120H480"/>
									<g class="chart-shape">
										<path class="chart-area" d="M10 24C40 26 50 32 78 34S120 50 146 52S190 62 214 60S260 78 282 80S330 90 350 88S395 98 418 100S455 108 470 108V140H10Z"/>
										<path class="chart-curve" d="M10 24C40 26 50 32 78 34S120 50 146 52S190 62 214 60S260 78 282 80S330 90 350 88S395 98 418 100S455 108 470 108"/>
									</g>
									<path class="chart-halo" d="M470 108h.01"/>
									<path class="chart-dot" d="M470 108h.01"/>
								</svg>
								<?php if (is_filled(section_field('crb_benefits_chart_start_value'))) { ?>
									<div class="chart-stat chart-start">
										<?php if (section_field('crb_benefits_chart_start_label')) { ?>
											<span class="stat-label"><?= section_field('crb_benefits_chart_start_label'); ?></span>
										<?php } ?>
										<span class="stat-value count"><?= section_field('crb_benefits_chart_start_value'); ?></span>
									</div>
								<?php } ?>
								<?php if (is_filled(section_field('crb_benefits_chart_start_value')) && is_filled(section_field('crb_benefits_chart_end_value'))) { ?>
									<svg class="chart-arrow" viewBox="0 0 32 12" aria-hidden="true" focusable="false"><path d="M1 6h30M25 1l6 5-6 5"/></svg>
								<?php } ?>
								<?php if (is_filled(section_field('crb_benefits_chart_end_value'))) { ?>
									<div class="chart-stat chart-end">
										<?php if (section_field('crb_benefits_chart_end_label')) { ?>
											<span class="stat-label"><?= section_field('crb_benefits_chart_end_label'); ?></span>
										<?php } ?>
										<span class="stat-value count"><?= section_field('crb_benefits_chart_end_value'); ?></span>
									</div>
								<?php } ?>
							</div>
						<?php } ?>

					</article>
				<?php } ?>

				<?php foreach (filled_rows(section_field('crb_benefits_tiles'), 'title') as $tile) { ?>
					<article class="benefit-card benefit-tile fade-from-bottom">
						<?php if (theme_icon($tile['icon'] ?? '')) { ?>
							<span class="card-icon"><?= theme_icon($tile['icon']); ?></span>
						<?php } ?>
						<div class="card-body">
							<h3 class="card-title"><?= $tile['title']; ?></h3>
							<?php if (is_filled($tile['text'] ?? '')) { ?>
								<p class="card-text"><?= $tile['text']; ?></p>
							<?php } ?>
						</div>
					</article>
				<?php } ?>

				<?php if (section_field('crb_benefits_check_title')) { ?>
					<article class="benefit-card benefit-feature benefit-check fade-from-bottom">

						<div class="feature-copy">
							<?php if (theme_icon(section_field('crb_benefits_check_icon'))) { ?>
								<span class="card-icon"><?= theme_icon(section_field('crb_benefits_check_icon')); ?></span>
							<?php } ?>
							<div class="card-body">
								<h3 class="card-title"><?= section_field('crb_benefits_check_title'); ?></h3>
								<?php if (section_field('crb_benefits_check_text')) { ?>
									<p class="card-text"><?= section_field('crb_benefits_check_text'); ?></p>
								<?php } ?>
							</div>
						</div>

						<?php if (filled_rows(section_field('crb_benefits_check_rows'), 'title')) { ?>
							<div class="check-rows">
								<?php foreach (filled_rows(section_field('crb_benefits_check_rows'), 'title') as $row) { ?>
									<div class="check-row">
										<?php if (theme_icon($row['icon'] ?? '')) { ?>
											<span class="row-icon"><?= theme_icon($row['icon']); ?></span>
										<?php } ?>
										<div class="row-copy">
											<span class="row-title"><?= $row['title']; ?></span>
											<?php if (is_filled($row['text'] ?? '')) { ?>
												<span class="row-text"><?= $row['text']; ?></span>
											<?php } ?>
										</div>
									</div>
								<?php } ?>
							</div>
						<?php } ?>

					</article>
				<?php } ?>

			</div>
		<?php } ?>

	</div>
</section>

<script>
	(function() {
		let chart = document.querySelector(".home-benefits .chart");
		if (!chart || !("IntersectionObserver" in window) || window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}
		let counters = [];

		/*Counts the first number found in the text up from zero and keeps whatever surrounds it, so "12.4", "12,4 min" and "-6" all work. A decimal comma stays a comma, and the last frame is the text exactly as written.*/
		function countUp(counter) {
			let startedAt = performance.now();

			function step(now) {
				let progress = Math.min((now - startedAt) / 1400, 1);
				if (progress === 1) {
					counter.element.textContent = counter.original;
					return;
				}
				counter.element.textContent = counter.prefix + (counter.target * (1 - Math.pow(1 - progress, 3))).toFixed(counter.decimals).replace(".", counter.separator) + counter.suffix;
				requestAnimationFrame(step);
			}

			requestAnimationFrame(step);
		}

		/*Start every number from zero before the card is seen, so nothing flashes its final value first*/
		chart.querySelectorAll(".count").forEach(function(element) {
			let text = element.textContent;
			let match = text.match(/\d+(?:([.,])(\d+))?/);
			if (!match) {
				return;
			}
			let counter = {
				element: element,
				original: text,
				target: parseFloat(match[0].replace(",", ".")),
				decimals: match[2] ? match[2].length : 0,
				separator: match[1] || ".",
				prefix: text.slice(0, match.index),
				suffix: text.slice(match.index + match[0].length)
			};
			element.textContent = counter.prefix + (0).toFixed(counter.decimals).replace(".", counter.separator) + counter.suffix;
			counters.push(counter);
		});

		new IntersectionObserver(function(entries, observer) {
			if (!entries[0].isIntersecting) {
				return;
			}
			observer.disconnect();
			counters.forEach(countUp);
		}, {threshold: .3}).observe(chart);
	})();
</script>
