<style type="text/css">
	.home-banner{position: relative; display: flex; flex-direction: column; min-height: 100vh; min-height: 100svh; overflow: hidden; background: var(--color-1); color: var(--color-inverse);}
	.home-banner.in-editor{min-height: 720px;}
	.home-banner, .home-banner *, .home-banner *::before, .home-banner *::after{box-sizing: border-box;}
	.home-banner{font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-banner a{text-decoration: none;}
	.home-banner h1, .home-banner p{margin: 0;}
	/*Carbon Fields sizes every image of the editor Preview to height auto, which would stop the photo from covering the section*/
	.home-banner .absolute-cover{width: 100%; height: 100%; max-width: none;}

	/*Background image and the overlay that keeps the copy readable on any photo*/
	.home-banner .banner-overlay{position: absolute; inset: 0; z-index: 1; background: linear-gradient(180deg, color-mix(in srgb, var(--color-1) 38%, transparent) 0%, transparent 26%, transparent 62%, color-mix(in srgb, var(--color-1) 45%, transparent) 100%), linear-gradient(90deg, color-mix(in srgb, var(--color-1) 84%, transparent) 0%, color-mix(in srgb, var(--color-1) 70%, transparent) 45%, color-mix(in srgb, var(--color-1) 56%, transparent) 100%);}

	/*Content - headline top, everything else pinned to the bottom of the screen. The vh clamps keep the whole stack close to the fold on a short laptop screen.*/
	.home-banner .banner-body{position: relative; z-index: 2; flex: 1; display: flex; flex-direction: column; justify-content: space-between; gap: clamp(24px, 5.3vh, 48px); padding-top: clamp(116px, 16.7vh, 150px); padding-bottom: clamp(32px, 6.2vh, 56px);}
	.home-banner .banner-top{display: flex; flex-direction: column; align-items: flex-start; gap: 26px;}
	.home-banner .banner-top .pill{margin: 0; height: 34px;}
	.home-banner .pill .ico{width: 16px; height: 16px; color: var(--color-2);}
	.home-banner .banner-title{font-family: var(--heading-font); font-size: min(var(--xxl), 14vh); line-height: .96; font-weight: 500; letter-spacing: -.04em; text-wrap: balance; color: var(--color-inverse);}
	.home-banner .banner-bottom{display: flex; align-items: flex-end; justify-content: space-between; gap: 48px;}
	.home-banner .banner-copy{display: flex; flex-direction: column; flex: 1 1 0; gap: 32px; min-width: 0; max-width: 540px;}
	.home-banner .banner-text{font-size: var(--sm); line-height: 1.5; color: rgb(255 255 255 / 90%);}
	.home-banner .banner-actions{display: flex; flex-wrap: wrap; align-items: center; gap: 14px;}
	.home-banner .banner-proof{display: flex; align-items: center; gap: 14px;}
	.home-banner .avatars{display: flex; align-items: center;}
	.home-banner .avatar{display: flex; align-items: center; justify-content: center; width: 38px; height: 38px; border-radius: var(--radius-pill); box-shadow: 0 0 0 2px var(--color-1); font-size: var(--xxs); font-weight: 700; color: var(--color-1);}
	.home-banner .avatar + .avatar{margin-left: -10px;}
	.home-banner .avatar:not(:last-child){padding-right: 10px;}
	.home-banner .avatar:nth-child(4n+1){background: var(--color-2);}
	.home-banner .avatar:nth-child(4n+2){background: var(--color-cta);}
	.home-banner .avatar:nth-child(4n+3){background: var(--color-leaf);}
	.home-banner .avatar:nth-child(4n){background: var(--color-inverse);}
	.home-banner .proof-copy{display: flex; flex-direction: column; gap: 2px;}
	.home-banner .stars{display: flex; gap: 2px; color: var(--color-cta);}
	.home-banner .stars .ico{width: 16px; height: 16px;}
	.home-banner .proof-text{font-size: var(--xs); font-weight: 600; line-height: 1.3; color: rgb(255 255 255 / 88%);}

	/*Highlight cards*/
	.home-banner .banner-hud{display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); flex: 0 1 min(604px, 50%); gap: 12px; min-width: 0;}
	.home-banner .hud-card{display: flex; flex-direction: column; gap: 12px; height: 180px; padding: 18px 20px; border-radius: var(--radius-lg); color: var(--color-inverse);}
	.home-banner .hud-chip{display: inline-flex; align-items: center; align-self: flex-start; height: 28px; padding: 0 12px; margin: 0; font-size: var(--xxs);}
	.home-banner .hud-head{display: flex; align-items: center; justify-content: space-between; gap: 8px;}
	.home-banner .hud-delta{font-size: var(--xs); font-weight: 700; white-space: nowrap; color: var(--color-2);}
	.home-banner .hud-person{display: flex; align-items: center; gap: 10px; min-width: 0;}
	.home-banner .hud-avatar{display: flex; align-items: center; justify-content: center; flex: none; width: 36px; height: 36px; border-radius: var(--radius-pill); background: var(--color-2); font-size: var(--xxs); font-weight: 700; color: var(--color-1);}
	.home-banner .hud-name{font-size: var(--ui); font-weight: 700; line-height: 1.2;}
	.home-banner .hud-role{font-size: var(--xs); line-height: 1.3; color: rgb(255 255 255 / 72%);}
	.home-banner .hud-foot{display: flex; align-items: flex-end; justify-content: space-between; margin-top: auto;}
	.home-banner .hud-was{font-size: var(--xxs); font-weight: 600; color: var(--color-2);}
	.home-banner .hud-value{font-family: var(--heading-font); font-size: var(--stat); line-height: 1; letter-spacing: -.03em;}
	.home-banner .hud-unit{font-family: var(--default-font); font-size: var(--xs); font-weight: 600; letter-spacing: 0; color: rgb(255 255 255 / 72%);}
	.home-banner .hud-arrow{display: flex; align-items: center; justify-content: center; flex: none; width: 38px; height: 38px; border-radius: var(--radius-pill); box-shadow: inset 0 0 0 1.5px rgb(255 255 255 / 80%);}
	.home-banner .hud-arrow .ico{width: 18px; height: 18px;}
	.home-banner .hud-ring-card{flex-direction: row; align-items: center; justify-content: space-between;}
	.home-banner .hud-ring-copy{display: flex; flex-direction: column; justify-content: space-between; align-self: stretch; min-width: 0;}
	.home-banner .hud-ring-title{font-size: var(--ui); font-weight: 700; line-height: 1.25;}
	.home-banner .hud-ring{position: relative; flex: none; width: 104px; height: 104px;}
	.home-banner .hud-ring svg{display: block; width: 104px; height: 104px;}
	.home-banner .hud-ring-track{fill: none; stroke: rgb(255 255 255 / 24%); stroke-width: 9; stroke-dasharray: 2 4.6;}
	.home-banner .hud-ring-fill{fill: none; stroke: var(--color-2); stroke-width: 3; stroke-linecap: round; transition: stroke-dasharray 1.4s cubic-bezier(.2, .7, .2, 1);}
	.home-banner .hud-ring-value{position: absolute; inset: 0; display: flex; align-items: center; justify-content: center; font-family: var(--heading-font); font-size: var(--md); letter-spacing: -.03em;}
	.home-banner .hud-feature{grid-column: span 2; flex-direction: row; align-items: center; gap: 20px; height: 150px; padding: 12px;}
	.home-banner .hud-thumb{flex: none; width: 150px; height: 126px; border-radius: var(--radius-md); overflow: hidden;}
	.home-banner .hud-thumb img{display: block; width: 100%; height: 100%; object-fit: cover;}
	.home-banner .hud-feature-copy{display: flex; flex-direction: column; gap: 6px; padding-right: 12px; min-width: 0;}
	.home-banner .hud-feature-title{font-family: var(--heading-font); font-size: var(--sm); font-weight: 500; letter-spacing: -.02em; line-height: 1.15;}
	.home-banner .hud-feature-text{font-size: var(--xs); line-height: 1.4; color: rgb(255 255 255 / 78%);}

	/*Tablet and phone - the cards step aside and the copy sits at the bottom. The header is global, see theme-styles.php.*/
	@media(max-width: 1000px){
		.home-banner .banner-overlay{background: linear-gradient(180deg, color-mix(in srgb, var(--color-1) 60%, transparent) 0%, color-mix(in srgb, var(--color-1) 55%, transparent) 40%, color-mix(in srgb, var(--color-1) 86%, transparent) 100%);}
		.home-banner .banner-body{justify-content: flex-end; gap: 20px; padding-top: 120px; padding-bottom: 40px;}
		.home-banner .banner-bottom{display: block;}
		.home-banner .banner-hud{display: none;}
		.home-banner .banner-copy{max-width: 620px; gap: 24px;}
	}

	@media(max-width: 750px){
		.home-banner .banner-body{padding-top: 100px; padding-bottom: 28px;}
		.home-banner .banner-top{gap: 20px;}
		.home-banner .banner-top .pill{gap: 8px; height: 32px; padding: 0 14px; font-size: var(--xs);}
		.home-banner .banner-text{font-size: var(--lead);}
		.home-banner .banner-actions{flex-direction: column; align-items: stretch; gap: 10px;}
		.home-banner .avatar{width: 34px; height: 34px;}
		.home-banner .avatar:nth-child(n+4){display: none;}
		.home-banner .stars{display: none;}
	}

</style>

<section class="home-banner<?= (defined('REST_REQUEST') && REST_REQUEST) ? ' in-editor' : ''; ?>" id="home">

	<?php if (section_field('crb_banner_image')) { ?>
		<img class="absolute-cover" src="<?= section_field('crb_banner_image'); ?>" alt="" loading="eager" fetchpriority="high">
	<?php } ?>
	<div class="banner-overlay" aria-hidden="true"></div>

	<div class="banner-body content-width">

		<?php if (section_field('crb_banner_eyebrow') || section_field('crb_banner_title')) { ?>
			<div class="banner-top fade-from-bottom">
				<?php if (section_field('crb_banner_eyebrow')) { ?>
					<span class="pill dark glass"><?= theme_icon('flag'); ?><?= section_field('crb_banner_eyebrow'); ?></span>
				<?php } ?>
				<?php if (section_field('crb_banner_title')) { ?>
					<h1 class="banner-title"><?= nl2br(section_field('crb_banner_title')); ?></h1>
				<?php } ?>
			</div>
		<?php } ?>

		<div class="banner-bottom">

			<div class="banner-copy fade-from-bottom">
				<?php if (section_field('crb_banner_text')) { ?>
					<p class="banner-text"><?= section_field('crb_banner_text'); ?></p>
				<?php } ?>

				<?php if ((section_field('crb_banner_button_text') && section_field('crb_banner_button_url')) || (section_field('crb_banner_button_2_text') && section_field('crb_banner_button_2_url'))) { ?>
					<div class="banner-actions">
						<?php if (section_field('crb_banner_button_text') && section_field('crb_banner_button_url')) { ?>
							<a class="button" href="<?= section_field('crb_banner_button_url'); ?>"><?= section_field('crb_banner_button_text'); ?><?= theme_icon('arrow-r'); ?></a>
						<?php } ?>
						<?php if (section_field('crb_banner_button_2_text') && section_field('crb_banner_button_2_url')) { ?>
							<a class="button ghost" href="<?= section_field('crb_banner_button_2_url'); ?>"><?= section_field('crb_banner_button_2_text'); ?></a>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_banner_proof_text') || filled_rows(section_field('crb_banner_proof_people'), 'initials')) { ?>
					<div class="banner-proof">
						<?php if (filled_rows(section_field('crb_banner_proof_people'), 'initials')) { ?>
							<div class="avatars">
								<?php foreach (filled_rows(section_field('crb_banner_proof_people'), 'initials') as $person) { ?>
									<span class="avatar"><?= $person['initials']; ?></span>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if (section_field('crb_banner_proof_stars') || section_field('crb_banner_proof_text')) { ?>
							<div class="proof-copy">
								<?php if (section_field('crb_banner_proof_stars')) { ?>
									<span class="stars" aria-label="Rated five out of five"><?= str_repeat(theme_icon('star'), 5); ?></span>
								<?php } ?>
								<?php if (section_field('crb_banner_proof_text')) { ?>
									<span class="proof-text"><?= section_field('crb_banner_proof_text'); ?></span>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>

			<?php if (is_filled(section_field('crb_banner_card1_value')) || is_filled(section_field('crb_banner_card2_percent')) || section_field('crb_banner_card3_title')) { ?>
				<div class="banner-hud fade-from-bottom">

					<?php if (is_filled(section_field('crb_banner_card1_value'))) { ?>
						<div class="hud-card glass">
							<?php if (section_field('crb_banner_card1_label') || is_filled(section_field('crb_banner_card1_delta'))) { ?>
								<div class="hud-head">
									<?php if (section_field('crb_banner_card1_label')) { ?>
										<span class="pill dark hud-chip"><?= section_field('crb_banner_card1_label'); ?></span>
									<?php } ?>
									<?php if (is_filled(section_field('crb_banner_card1_delta'))) { ?>
										<span class="hud-delta count"><?= section_field('crb_banner_card1_delta'); ?></span>
									<?php } ?>
								</div>
							<?php } ?>
							<?php if (section_field('crb_banner_card1_name')) { ?>
								<div class="hud-person">
									<?php if (section_field('crb_banner_card1_initials')) { ?>
										<span class="hud-avatar"><?= section_field('crb_banner_card1_initials'); ?></span>
									<?php } ?>
									<div>
										<div class="hud-name"><?= section_field('crb_banner_card1_name'); ?></div>
										<?php if (section_field('crb_banner_card1_role')) { ?>
											<div class="hud-role"><?= section_field('crb_banner_card1_role'); ?></div>
										<?php } ?>
									</div>
								</div>
							<?php } ?>
							<div class="hud-foot">
								<div>
									<?php if (section_field('crb_banner_card1_was')) { ?>
										<div class="hud-was"><?= section_field('crb_banner_card1_was'); ?></div>
									<?php } ?>
									<div class="hud-value"><span class="count"><?= section_field('crb_banner_card1_value'); ?></span><?php if (section_field('crb_banner_card1_unit')) { ?> <span class="hud-unit"><?= section_field('crb_banner_card1_unit'); ?></span><?php } ?></div>
								</div>
								<span class="hud-arrow"><?= theme_icon('arrow-ur'); ?></span>
							</div>
						</div>
					<?php } ?>

					<?php if (is_filled(section_field('crb_banner_card2_percent'))) { ?>
						<div class="hud-card hud-ring-card glass">
							<?php if (section_field('crb_banner_card2_label') || section_field('crb_banner_card2_title')) { ?>
								<div class="hud-ring-copy">
									<?php if (section_field('crb_banner_card2_label')) { ?>
										<span class="pill dark hud-chip"><?= section_field('crb_banner_card2_label'); ?></span>
									<?php } ?>
									<?php if (section_field('crb_banner_card2_title')) { ?>
										<div class="hud-ring-title"><?= nl2br(section_field('crb_banner_card2_title')); ?></div>
									<?php } ?>
								</div>
							<?php } ?>
							<div class="hud-ring">
								<svg viewBox="0 0 104 104" width="104" height="104" aria-hidden="true">
									<circle class="hud-ring-track" cx="52" cy="52" r="42"></circle>
									<circle class="hud-ring-fill" cx="52" cy="52" r="50" transform="rotate(-90 52 52)" stroke-dasharray="<?= round(314.16 * clamp_percent(section_field('crb_banner_card2_percent')) / 100, 1); ?> 314.16"></circle>
								</svg>
								<div class="hud-ring-value"><span class="count"><?= clamp_percent(section_field('crb_banner_card2_percent')); ?></span>%</div>
							</div>
						</div>
					<?php } ?>

					<?php if (section_field('crb_banner_card3_title')) { ?>
						<div class="hud-card hud-feature glass">
							<?php if (section_field('crb_banner_card3_image')) { ?>
								<div class="hud-thumb"><img src="<?= section_field('crb_banner_card3_image'); ?>" alt="" width="150" height="126" loading="eager"></div>
							<?php } ?>
							<div class="hud-feature-copy">
								<?php if (section_field('crb_banner_card3_label')) { ?>
									<span class="pill dark hud-chip"><?= section_field('crb_banner_card3_label'); ?></span>
								<?php } ?>
								<div class="hud-feature-title"><?= section_field('crb_banner_card3_title'); ?></div>
								<?php if (section_field('crb_banner_card3_text')) { ?>
									<div class="hud-feature-text"><?= section_field('crb_banner_card3_text'); ?></div>
								<?php } ?>
							</div>
						</div>
					<?php } ?>

				</div>
			<?php } ?>

		</div>
	</div>
</section>

<script>
	(function() {
		let hud = document.querySelector(".home-banner .banner-hud");
		if (!hud || !("IntersectionObserver" in window) || window.matchMedia("(prefers-reduced-motion: reduce)").matches) {
			return;
		}
		let ring = hud.querySelector(".hud-ring-fill");
		let ringTarget = ring ? ring.getAttribute("stroke-dasharray") : "";
		let counters = [];

		/*Counts the first number found in the text up from zero and keeps whatever surrounds it, so "-6.2 ↓" and "92" both work.*/
		function countUp(counter) {
			let target = parseFloat(counter.match[0]);
			let startedAt = performance.now();

			function step(now) {
				let progress = Math.min((now - startedAt) / 1400, 1);
				counter.element.textContent = counter.prefix + (target * (1 - Math.pow(1 - progress, 3))).toFixed(counter.decimals) + counter.suffix;
				if (progress < 1) {
					requestAnimationFrame(step);
				}
			}

			requestAnimationFrame(step);
		}

		/*Start every number from zero before the cards are seen, so nothing flashes its final value first*/
		hud.querySelectorAll(".count").forEach(function(element) {
			let text = element.textContent;
			let match = text.match(/\d+(\.\d+)?/);
			if (!match) {
				return;
			}
			let counter = {
				element: element,
				match: match,
				decimals: match[1] ? match[1].length - 1 : 0,
				prefix: text.slice(0, match.index),
				suffix: text.slice(match.index + match[0].length)
			};
			element.textContent = counter.prefix + (0).toFixed(counter.decimals) + counter.suffix;
			counters.push(counter);
		});
		if (ring) {
			ring.setAttribute("stroke-dasharray", "0 314.16");
		}

		new IntersectionObserver(function(entries, observer) {
			if (!entries[0].isIntersecting) {
				return;
			}
			observer.disconnect();
			if (ring) {
				ring.setAttribute("stroke-dasharray", ringTarget);
			}
			counters.forEach(countUp);
		}, {threshold: .3}).observe(hud);
	})();
</script>
