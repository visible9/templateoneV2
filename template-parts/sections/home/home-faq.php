<style type="text/css">
	.home-faq{position: relative; padding: var(--section-space) 0 calc(var(--section-space) + var(--space-4)); background: var(--color-bg); color: var(--color-1); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-faq, .home-faq *, .home-faq *::before, .home-faq *::after{box-sizing: border-box;}
	/*With every field empty there would be a blank band holding nothing, so the whole section steps aside*/
	.home-faq:not(:has(.content-width > *)){display: none;}
	.home-faq h2, .home-faq p{margin: 0;}
	.home-faq p{text-wrap: pretty;}
	.home-faq .pill{margin: 0;}
	/*A word too long for its box breaks instead of pushing a row wider. anywhere is for the text that is the only shrinkable item of its row, where the break has to be allowed before the box is sized.*/
	.home-faq{overflow-wrap: break-word;}
	.home-faq .faq-title, .home-faq .lead, .home-faq .question-text, .home-faq .faq-answer, .home-faq .contact-title, .home-faq .contact-text{overflow-wrap: anywhere;}

	/*Layout - the 12 column grid of the design: the heading and the contact card take five columns, the questions six, and one column of air lies between them. A list left alone is centred.*/
	.home-faq .content-width{display: grid; grid-template-columns: repeat(12, minmax(0, 1fr)); column-gap: var(--grid-gap); align-items: start;}
	.home-faq .faq-side{grid-column: 1 / span 5; display: flex; flex-direction: column; align-items: flex-start; gap: var(--space-5); min-width: 0;}
	.home-faq .faq-list{grid-column: 7 / span 6; display: flex; flex-direction: column; gap: var(--space-3); min-width: 0;}
	.home-faq .faq-list:only-child{grid-column: 3 / span 8;}

	/*Heading*/
	.home-faq .faq-intro{display: flex; flex-direction: column; align-items: flex-start; gap: var(--space-5);}
	.home-faq .faq-title{font-family: var(--heading-font); font-size: var(--lg); font-weight: 500; line-height: 1.03; letter-spacing: -.032em; text-wrap: balance; color: var(--color-1);}

	/*Contact card - a dark panel with a person and two ways to reach them*/
	.home-faq .faq-contact{display: flex; flex-direction: column; gap: 20px; width: 100%; margin-top: var(--space-4); padding: 28px; border-radius: var(--radius-xl); background: var(--color-1); color: var(--color-inverse);}
	.home-faq .contact-person{display: flex; align-items: center; gap: 14px;}
	.home-faq .contact-avatar{display: flex; align-items: center; justify-content: center; flex: none; width: 52px; height: 52px; border-radius: var(--radius-pill); background: var(--color-cta); color: var(--color-on-cta); font-size: var(--ui); font-weight: 700; line-height: 1;}
	.home-faq .contact-info{display: flex; flex-direction: column; gap: 1px; min-width: 0;}
	.home-faq .contact-title{font-family: var(--heading-font); font-size: var(--sm); letter-spacing: -.02em;}
	.home-faq .contact-text{font-size: var(--card-note); color: var(--color-muted-dark);}
	.home-faq .contact-buttons{display: flex; flex-wrap: wrap; align-items: center; gap: 10px;}
	.home-faq .contact-buttons .button{max-width: 100%; height: auto; min-height: 44px; padding-top: 10px; padding-bottom: 10px; white-space: normal; text-align: center; line-height: 1.2;}
	.home-faq .contact-buttons .ico{width: 18px; height: 18px;}

	/*Questions - one native details element per row, so a row opens and closes with no script, and opening one closes the one that was open. The open state is the markup's own, which is what the Preview shows.*/
	.home-faq .faq-row{border-radius: var(--radius-lg); background: var(--color-card); box-shadow: var(--shadow);}
	.home-faq .faq-question{display: flex; align-items: center; justify-content: space-between; gap: var(--space-5); padding: 26px 28px; list-style: none; cursor: pointer; font-family: var(--heading-font); font-size: var(--question); font-weight: 500; line-height: 1.2; letter-spacing: -.02em; color: var(--color-1);}
	.home-faq .faq-question::-webkit-details-marker{display: none;}
	.home-faq .question-text{min-width: 0;}
	.home-faq .faq-toggle{display: flex; align-items: center; justify-content: center; flex: none; width: 44px; height: 44px; border-radius: var(--radius-pill); background: var(--color-surface); color: var(--color-green-deep); transition: background var(--transition), color var(--transition);}
	.home-faq .faq-toggle .ico:last-child, .home-faq .faq-row[open] .faq-toggle .ico:first-child{display: none;}
	.home-faq .faq-row[open] .faq-toggle .ico:last-child{display: block;}
	.home-faq .faq-row[open] .faq-toggle{background: var(--color-1); color: var(--color-2);}
	.home-faq .faq-answer{padding: 0 96px 30px 28px; font-size: var(--card-text); line-height: 1.6; color: var(--color-3);}
	.home-faq .faq-answer p + p{margin-top: var(--space-3);}
	.home-faq .faq-answer a{color: var(--color-green);}

	@media(prefers-reduced-motion: reduce){
		.home-faq .faq-toggle{transition: none;}
	}

	/*Tablet - one column: the heading, the questions, then the contact card, which leaves the column it sits in on a wide screen*/
	@media(max-width: 1000px){
		.home-faq .content-width{display: flex; flex-direction: column; align-items: stretch; gap: 20px;}
		.home-faq .faq-side{display: contents;}
		.home-faq .faq-intro{order: 1; margin-bottom: var(--space-3);}
		.home-faq .faq-list{order: 2;}
		.home-faq .faq-contact{order: 3; margin-top: 0;}
	}

	/*Phone - tighter rows and card, and the two buttons stack at full size*/
	@media(max-width: 750px){
		.home-faq .faq-intro{gap: 18px;}
		.home-faq .faq-title{line-height: 1.05; letter-spacing: -.03em;}
		.home-faq .faq-list{gap: 10px;}
		.home-faq .faq-question{gap: var(--space-4); padding: 20px;}
		.home-faq .faq-toggle{width: 40px; height: 40px;}
		.home-faq .faq-answer{padding: 0 20px 24px;}
		.home-faq .faq-contact{gap: 18px; padding: var(--space-5); border-radius: var(--radius-lg);}
		.home-faq .contact-person{gap: var(--space-3);}
		.home-faq .contact-avatar{width: 48px; height: 48px;}
		.home-faq .contact-buttons{flex-direction: column; align-items: stretch;}
		.home-faq .contact-buttons .button{min-height: 56px; padding: 14px 28px; font-size: var(--ui);}
	}

</style>

<section class="home-faq" id="faq">
	<div class="content-width">

		<?php if (section_field('crb_faq_eyebrow') || section_field('crb_faq_title') || section_field('crb_faq_text') || section_field('crb_faq_contact_initials') || section_field('crb_faq_contact_title') || section_field('crb_faq_contact_text') || (section_field('crb_faq_contact_button_text') && section_field('crb_faq_contact_button_url')) || (section_field('crb_faq_contact_button_2_text') && section_field('crb_faq_contact_button_2_url'))) { ?>
			<div class="faq-side">

				<?php if (section_field('crb_faq_eyebrow') || section_field('crb_faq_title') || section_field('crb_faq_text')) { ?>
					<div class="faq-intro fade-from-bottom">
						<?php if (section_field('crb_faq_eyebrow')) { ?>
							<span class="pill"><?= section_field('crb_faq_eyebrow'); ?></span>
						<?php } ?>
						<?php if (section_field('crb_faq_title')) { ?>
							<h2 class="faq-title"><?= section_field('crb_faq_title'); ?></h2>
						<?php } ?>
						<?php if (section_field('crb_faq_text')) { ?>
							<p class="lead"><?= section_field('crb_faq_text'); ?></p>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_faq_contact_initials') || section_field('crb_faq_contact_title') || section_field('crb_faq_contact_text') || (section_field('crb_faq_contact_button_text') && section_field('crb_faq_contact_button_url')) || (section_field('crb_faq_contact_button_2_text') && section_field('crb_faq_contact_button_2_url'))) { ?>
					<div class="faq-contact fade-from-bottom">

						<?php if (section_field('crb_faq_contact_initials') || section_field('crb_faq_contact_title') || section_field('crb_faq_contact_text')) { ?>
							<div class="contact-person">
								<?php if (section_field('crb_faq_contact_initials')) { ?>
									<span class="contact-avatar" aria-hidden="true"><?= section_field('crb_faq_contact_initials'); ?></span>
								<?php } ?>
								<?php if (section_field('crb_faq_contact_title') || section_field('crb_faq_contact_text')) { ?>
									<div class="contact-info">
										<?php if (section_field('crb_faq_contact_title')) { ?>
											<p class="contact-title"><?= section_field('crb_faq_contact_title'); ?></p>
										<?php } ?>
										<?php if (section_field('crb_faq_contact_text')) { ?>
											<p class="contact-text"><?= section_field('crb_faq_contact_text'); ?></p>
										<?php } ?>
									</div>
								<?php } ?>
							</div>
						<?php } ?>

						<?php if ((section_field('crb_faq_contact_button_text') && section_field('crb_faq_contact_button_url')) || (section_field('crb_faq_contact_button_2_text') && section_field('crb_faq_contact_button_2_url'))) { ?>
							<div class="contact-buttons">
								<?php if (section_field('crb_faq_contact_button_text') && section_field('crb_faq_contact_button_url')) { ?>
									<a class="button small" href="<?= section_field('crb_faq_contact_button_url'); ?>"><?= section_field('crb_faq_contact_button_text'); ?></a>
								<?php } ?>
								<?php if (section_field('crb_faq_contact_button_2_text') && section_field('crb_faq_contact_button_2_url')) { ?>
									<a class="button ghost small" href="<?= section_field('crb_faq_contact_button_2_url'); ?>"><?= theme_icon(section_field('crb_faq_contact_button_2_icon')); ?><?= section_field('crb_faq_contact_button_2_text'); ?></a>
								<?php } ?>
							</div>
						<?php } ?>

					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (filled_rows(section_field('crb_faq_items'), array('question', 'answer'))) { ?>
			<div class="faq-list">
				<?php foreach (filled_rows(section_field('crb_faq_items'), array('question', 'answer')) as $index => $item) { ?>
					<details class="faq-row fade-from-bottom" name="faq"<?= ($index === 0 && section_field('crb_faq_open_first')) ? ' open' : ''; ?>>
						<summary class="faq-question">
							<span class="question-text"><?= $item['question']; ?></span>
							<span class="faq-toggle" aria-hidden="true"><?= theme_icon('plus'); ?><?= theme_icon('minus'); ?></span>
						</summary>
						<div class="faq-answer"><?= wpautop($item['answer']); ?></div>
					</details>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>
