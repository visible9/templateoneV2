<style type="text/css">
	.home-program{position: relative; padding: var(--section-space) 0; background: var(--color-bg); color: var(--color-1); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-program, .home-program *, .home-program *::before, .home-program *::after{box-sizing: border-box;}
	/*With every field empty there would be a blank band holding nothing, so the whole section steps aside*/
	.home-program:not(:has(.content-width > *)){display: none;}
	.home-program h2, .home-program h3, .home-program p, .home-program ul, .home-program dl, .home-program dd{margin: 0;}
	.home-program ul{padding: 0; list-style: none;}
	.home-program .pill{margin: 0;}
	/*A word too long for its box breaks instead of pushing the card wider. anywhere is for the text that is the only shrinkable item of its row, where the break has to be allowed before the box is sized (the label of a fact is left out on purpose: it keeps its width and the value gives way).*/
	.home-program{overflow-wrap: break-word;}
	.home-program .program-title, .home-program .lead, .home-program .photo-label, .home-program .step-title, .home-program .step-points li, .home-program .facts-value{overflow-wrap: anywhere;}

	/*Layout -the 12 column grid of the design: the heading column takes five columns, the steps six, and one column of air lies between them. Either half stretches across when the other is left empty.*/
	.home-program .content-width{display: grid; grid-template-columns: repeat(12, minmax(0, 1fr)); column-gap: var(--grid-gap); align-items: start;}
	.home-program .program-side{grid-column: 1 / span 5; display: flex; flex-direction: column; align-items: flex-start; gap: var(--space-5); min-width: 0;}
	.home-program .program-steps{grid-column: 7 / span 6; display: flex; flex-direction: column; gap: var(--space-4); min-width: 0;}
	.home-program .program-side:only-child, .home-program .program-steps:only-child{grid-column: 1 / -1;}

	/*Heading*/
	.home-program .program-intro{display: flex; flex-direction: column; align-items: flex-start; gap: var(--space-5); margin-bottom: var(--space-3);}
	.home-program .program-title{font-family: var(--heading-font); font-size: var(--lg-narrow); font-weight: 500; line-height: 1.03; letter-spacing: -.032em; text-wrap: balance; color: var(--color-1);}

	/*Photo - the shade keeps the label readable on any picture*/
	.home-program .program-photo{position: relative; width: 100%; height: 260px; border-radius: var(--radius-xl); overflow: hidden;}
	.home-program .program-photo .absolute-cover{width: 100%; height: 100%; max-width: none;}
	.home-program .program-photo::after{content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, color-mix(in srgb, var(--color-1) 55%, transparent) 0%, color-mix(in srgb, var(--color-1) 10%, transparent) 55%, transparent 100%); pointer-events: none;}
	.home-program .photo-label{position: absolute; top: 18px; left: 18px; z-index: 1; max-width: calc(100% - 36px); height: auto; min-height: 36px; padding-top: 6px; padding-bottom: 6px; color: var(--color-inverse);}
	.home-program .photo-arrow{position: absolute; right: 18px; bottom: 18px; z-index: 1; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; border-radius: var(--radius-pill); background: var(--color-card); color: var(--color-1);}

	/*Facts - a dark panel of label and value rows*/
	.home-program .program-facts{width: 100%; padding: var(--space-6) var(--space-6) 20px; border-radius: var(--radius-xl); background: var(--color-1); color: var(--color-inverse);}
	.home-program .facts-title{margin-bottom: var(--space-2); font-family: var(--heading-font); font-size: var(--sm); font-weight: 400; line-height: 1.55; letter-spacing: -.02em; color: var(--color-inverse);}
	.home-program .facts-row{display: flex; justify-content: space-between; gap: var(--space-4); padding: 14px 0; border-bottom: 1px solid rgb(255 255 255 / 12%); font-size: var(--ui);}
	.home-program .facts-row:last-child{border-bottom: 0;}
	.home-program .facts-label{color: var(--color-muted-dark);}
	.home-program .facts-value{font-weight: 700; text-align: right;}
	.home-program .program-side .button{margin-top: var(--space-2);}
	.home-program .button .ico{width: 20px; height: 20px;}

	/*Steps - the ordinal on the left, the title and its period on one row, the copy and the check lines below*/
	.home-program .step-card{display: flex; gap: var(--space-2); padding: 36px 36px 32px 32px; border-radius: var(--radius-lg); background: var(--color-card); box-shadow: var(--shadow);}
	.home-program .step-number{flex: none; width: 1.714em; font-family: var(--heading-font); font-size: var(--numeral); line-height: 1; letter-spacing: -.04em; color: var(--color-leaf);}
	.home-program .step-body{display: flex; flex: 1 1 0; flex-direction: column; gap: 14px; min-width: 0;}
	.home-program .step-head{display: flex; align-items: center; justify-content: space-between; gap: var(--space-3);}
	.home-program .step-title{font-family: var(--heading-font); font-size: var(--card-title); font-weight: 500; line-height: 1.1; letter-spacing: -.025em; text-wrap: balance; color: var(--color-1);}
	.home-program .step-period{flex: none; height: 30px; font-size: var(--xs); white-space: nowrap;}
	.home-program .step-text{font-size: var(--card-text); line-height: 1.55; text-wrap: pretty; color: var(--color-3);}
	.home-program .step-points{display: flex; flex-direction: column; gap: var(--space-2); margin-top: var(--space-1);}
	.home-program .step-points li{display: flex; align-items: center; gap: 10px; font-size: var(--ui); font-weight: 600;}
	.home-program .step-points .ico{width: 18px; height: 18px; color: var(--color-green);}

	/*Tablet - one column. The heading and the photo come first, then the steps, and the facts and the button close the section.*/
	@media(max-width: 1000px){
		.home-program .content-width{display: flex; flex-direction: column; align-items: stretch; gap: var(--space-3);}
		.home-program .program-side{display: contents;}
		.home-program .program-intro{order: 1; margin-bottom: 20px;}
		.home-program .program-photo{order: 2;}
		.home-program .program-steps{order: 3;}
		.home-program .program-facts{order: 4;}
		.home-program .program-side .button{order: 5; align-self: flex-start;}
	}

	/*Phone - the photo drops its arrow, the step card lays its ordinal and period on one row above the title, and the button spans the width*/
	@media(max-width: 750px){
		.home-program .program-intro{gap: 18px;}
		.home-program .program-title{line-height: 1.05; letter-spacing: -.03em;}
		.home-program .program-photo{height: 200px; border-radius: var(--radius-lg);}
		.home-program .photo-label{top: 14px; left: 14px; min-height: 34px; padding-top: 5px; padding-bottom: 5px;}
		.home-program .photo-arrow{display: none;}
		.home-program .program-steps{gap: var(--space-3);}
		.home-program .step-card{display: grid; grid-template-columns: auto minmax(0, 1fr); gap: 14px; padding: var(--space-5);}
		.home-program .step-body, .home-program .step-head{display: contents;}
		.home-program .step-number{order: 1; width: auto;}
		.home-program .step-period{order: 2; grid-column: 2; align-self: center; justify-self: end;}
		.home-program .step-title{order: 3; grid-column: 1 / -1; line-height: 1.12;}
		.home-program .step-text{order: 4; grid-column: 1 / -1;}
		.home-program .step-points{order: 5; grid-column: 1 / -1; margin-top: 0;}
		.home-program .step-points li{align-items: flex-start; gap: var(--space-3); line-height: 1.4;}
		.home-program .step-points .ico{width: 20px; height: 20px; margin-top: 1px;}
		.home-program .program-facts{padding: var(--space-5) var(--space-5) var(--space-3); border-radius: var(--radius-lg);}
		.home-program .facts-title{margin-bottom: 6px;}
		.home-program .facts-row{gap: var(--space-3); padding: var(--space-3) 0;}
		.home-program .program-side .button{align-self: stretch;}
	}

</style>

<section class="home-program" id="program">
	<div class="content-width">

		<?php if (section_field('crb_program_eyebrow') || section_field('crb_program_title') || section_field('crb_program_text') || section_field('crb_program_image') || section_field('crb_program_facts_title') || filled_rows(section_field('crb_program_facts'), array('label', 'detail')) || (section_field('crb_program_button_text') && section_field('crb_program_button_url'))) { ?>
			<div class="program-side">

				<?php if (section_field('crb_program_eyebrow') || section_field('crb_program_title') || section_field('crb_program_text')) { ?>
					<div class="program-intro fade-from-bottom">
						<?php if (section_field('crb_program_eyebrow')) { ?>
							<span class="pill"><?= section_field('crb_program_eyebrow'); ?></span>
						<?php } ?>
						<?php if (section_field('crb_program_title')) { ?>
							<h2 class="program-title"><?= section_field('crb_program_title'); ?></h2>
						<?php } ?>
						<?php if (section_field('crb_program_text')) { ?>
							<p class="lead"><?= section_field('crb_program_text'); ?></p>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_program_image')) { ?>
					<div class="program-photo fade-from-bottom">
						<img class="absolute-cover" src="<?= section_field('crb_program_image'); ?>" alt="">
						<?php if (section_field('crb_program_image_label')) { ?>
							<span class="pill glass photo-label"><?= section_field('crb_program_image_label'); ?></span>
						<?php } ?>
						<?php if (section_field('crb_program_image_arrow')) { ?>
							<span class="photo-arrow" aria-hidden="true"><?= theme_icon('arrow-ur'); ?></span>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_program_facts_title') || filled_rows(section_field('crb_program_facts'), array('label', 'detail'))) { ?>
					<div class="program-facts fade-from-bottom">
						<?php if (section_field('crb_program_facts_title')) { ?>
							<h3 class="facts-title"><?= section_field('crb_program_facts_title'); ?></h3>
						<?php } ?>
						<?php if (filled_rows(section_field('crb_program_facts'), array('label', 'detail'))) { ?>
							<dl class="facts-list">
								<?php foreach (filled_rows(section_field('crb_program_facts'), array('label', 'detail')) as $fact) { ?>
									<div class="facts-row">
										<dt class="facts-label"><?= $fact['label']; ?></dt>
										<dd class="facts-value"><?= $fact['detail']; ?></dd>
									</div>
								<?php } ?>
							</dl>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_program_button_text') && section_field('crb_program_button_url')) { ?>
					<a class="button fade-from-bottom" href="<?= section_field('crb_program_button_url'); ?>"><?= section_field('crb_program_button_text'); ?><?= theme_icon('arrow-r'); ?></a>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (filled_rows(section_field('crb_program_steps'), 'title')) { ?>
			<div class="program-steps">
				<?php foreach (filled_rows(section_field('crb_program_steps'), 'title') as $index => $step) { ?>
					<article class="step-card fade-from-bottom">

						<?php if (section_field('crb_program_numbers')) { ?>
							<span class="step-number" aria-hidden="true"><?= sprintf('%02d', $index + 1); ?></span>
						<?php } ?>

						<div class="step-body">
							<div class="step-head">
								<h3 class="step-title"><?= $step['title']; ?></h3>
								<?php if (is_filled($step['period'] ?? '')) { ?>
									<span class="pill step-period"><?= $step['period']; ?></span>
								<?php } ?>
							</div>
							<?php if (is_filled($step['text'] ?? '')) { ?>
								<p class="step-text"><?= $step['text']; ?></p>
							<?php } ?>
							<?php if (text_lines($step['points'] ?? '')) { ?>
								<ul class="step-points">
									<?php foreach (text_lines($step['points']) as $point) { ?>
										<li><?= theme_icon('check'); ?><?= $point; ?></li>
									<?php } ?>
								</ul>
							<?php } ?>
						</div>

					</article>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>
