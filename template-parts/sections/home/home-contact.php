<style type="text/css">
	.home-contact{position: relative; min-height: 860px; overflow: hidden; padding: calc(var(--section-space) - var(--space-2)) 0 var(--section-space); background: var(--color-bg); color: var(--color-1); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-contact, .home-contact *, .home-contact *::before, .home-contact *::after{box-sizing: border-box;}
	/*With nothing to show but the photo there would be a picture with no reason to be there, so the section steps aside*/
	.home-contact:not(:has(.contact-intro)):not(:has(.contact-card > :not(:empty))){display: none;}
	.home-contact h2, .home-contact p{margin: 0;}
	.home-contact p{text-wrap: pretty;}
	.home-contact .pill{margin: 0;}
	/*A word too long for its box breaks instead of pushing the card wider. anywhere is for the text that is the only shrinkable item of its row, where the break has to be allowed before the box is sized.*/
	.home-contact{overflow-wrap: break-word;}
	.home-contact .contact-title, .home-contact .lead, .home-contact .contact-consent, .home-contact .contact-note{overflow-wrap: anywhere;}

	/*Photo - fills the section, and its top fades into the page colour so the section joins the one above it*/
	.home-contact .contact-photo{position: absolute; inset: 0; pointer-events: none;}
	.home-contact .contact-photo .absolute-cover{width: 100%; height: 100%; max-width: none;}
	.home-contact .contact-photo::after{content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, var(--color-bg) 0%, color-mix(in srgb, var(--color-bg) 0%, transparent) 40%);}
	.home-contact .content-width{position: relative; z-index: 2; display: flex; flex-direction: column; align-items: center; gap: var(--space-5); text-align: center;}

	/*Heading*/
	.home-contact .contact-intro{display: flex; flex-direction: column; align-items: center; gap: var(--space-5);}
	.home-contact .contact-pill{background: color-mix(in srgb, var(--color-card) 72%, transparent);}
	.home-contact .contact-pill .ico{width: 16px; height: 16px; color: var(--color-green);}
	.home-contact .contact-title{max-width: 940px; font-family: var(--heading-font); font-size: var(--xl); font-weight: 500; line-height: 1; letter-spacing: -.032em; text-wrap: balance; color: var(--color-1);}
	.home-contact .lead{max-width: 660px; color: color-mix(in srgb, var(--color-3) 60%, var(--color-1));}

	/*Card - the form and its small print on a frosted white panel*/
	.home-contact .contact-card{display: flex; flex-direction: column; gap: 18px; width: 960px; max-width: 100%; margin-top: 20px; padding: 28px; border-radius: var(--radius-2xl); background: color-mix(in srgb, var(--color-card) 90%, transparent); box-shadow: 0 40px 80px -36px color-mix(in srgb, var(--color-1) 55%, transparent); text-align: left;}
	.home-contact .contact-form:empty{display: none;}
	/*A card whose form did not expand (the plugin is off) and that has no small print or note would be an empty white box*/
	.home-contact .contact-card:not(:has(> :not(:empty))){display: none;}
	.home-contact .contact-meta{display: flex; align-items: center; justify-content: space-between; gap: var(--space-5);}
	.home-contact .contact-consent, .home-contact .contact-note{font-size: var(--xs); line-height: 1.4; text-wrap: wrap;}
	.home-contact .contact-consent{color: var(--color-3);}
	.home-contact .contact-consent a{color: var(--color-green-deep); font-weight: 700; text-decoration: underline;}
	.home-contact .contact-note{display: flex; align-items: center; gap: var(--space-2); font-weight: 600; color: var(--color-1);}
	.home-contact .contact-note .ico{width: 18px; height: 18px; color: var(--color-green);}

	/*The form. The form plugin's own stylesheet loads on every page and is more specific than the global element rules, so its fields, labels and button are restyled here by element, never by the plugin's class names. The script below the section marks the row that holds the fields and the button (form-row, form-item, form-submit) because no class name survives a change of plugin.*/
	.home-contact .contact-form fieldset{min-width: 0; margin: 0; padding: 0; border: 0;}
	.home-contact .contact-form legend{position: absolute; width: 1px; height: 1px; margin: -1px; padding: 0; overflow: hidden; clip: rect(0 0 0 0); white-space: nowrap;}
	.home-contact .contact-form label{display: block; margin: 0 0 var(--space-2); padding: 0; font-family: var(--default-font); font-size: var(--xs); font-weight: 700; letter-spacing: .01em; line-height: 1.55; color: var(--color-1);}
	.home-contact .contact-form input[type="text"], .home-contact .contact-form input[type="email"], .home-contact .contact-form input[type="tel"], .home-contact .contact-form input[type="url"], .home-contact .contact-form input[type="search"], .home-contact .contact-form input[type="number"], .home-contact .contact-form select{display: block; width: 100%; height: 60px; min-height: 0; margin: 0; padding: 0 20px; border: 0; border-radius: var(--radius-md); background: var(--color-card); box-shadow: inset 0 0 0 1px var(--color-border); font-family: var(--default-font); font-size: var(--card-text); line-height: normal; color: var(--color-1);}
	.home-contact .contact-form textarea{display: block; width: 100%; height: auto; min-height: 150px; margin: 0; padding: 16px 20px; border: 0; border-radius: var(--radius-md); background: var(--color-card); box-shadow: inset 0 0 0 1px var(--color-border); font-family: var(--default-font); font-size: var(--card-text); line-height: 1.55; color: var(--color-1);}
	/*The plugin draws its focus glow with a very specific rule, so the ring is stated with !important*/
	.home-contact .contact-form input:focus, .home-contact .contact-form textarea:focus, .home-contact .contact-form select:focus{box-shadow: inset 0 0 0 2px var(--color-green) !important; outline: none;}
	.home-contact .contact-form button[type="submit"], .home-contact .contact-form input[type="submit"]{display: inline-flex; align-items: center; justify-content: center; gap: 10px; width: auto; max-width: 100%; height: auto; min-height: 60px; margin: 0; padding: 12px 28px; border: 0; border-radius: var(--radius-pill); background: var(--color-cta); box-shadow: none; color: var(--color-on-cta); font-family: var(--default-font); font-size: var(--card-text); font-weight: 700; line-height: 1.2; text-align: center; white-space: normal; text-shadow: none; cursor: pointer; transition: background var(--transition), box-shadow var(--transition), transform var(--transition);}
	.home-contact .contact-form button[type="submit"]:hover, .home-contact .contact-form input[type="submit"]:hover{background: var(--color-cta-hover); color: var(--color-on-cta); box-shadow: 0 12px 26px -12px color-mix(in srgb, var(--color-cta) 80%, transparent); transform: translateY(-1px);}
	/*The arrow after the button text, drawn with a mask so it takes the button's colour*/
	.home-contact .contact-form button[type="submit"]::after{content: ""; flex: none; width: 20px; height: 20px; background: currentColor; -webkit-mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14M13 6l6 6-6 6'/%3E%3C/svg%3E") center / contain no-repeat; mask: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='black' stroke-width='1.8' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='M5 12h14M13 6l6 6-6 6'/%3E%3C/svg%3E") center / contain no-repeat;}
	/*The plugin's own colours for the button while it sends, so nothing flashes blue*/
	.home-contact .contact-form > *{--submit-bg-color: var(--color-cta); --submit-border-color: var(--color-cta); --submit-text-color: var(--color-on-cta); --submit-hover-bg-color: var(--color-cta-hover); --submit-hover-border-color: var(--color-cta-hover); --submit-hover-color: var(--color-on-cta); --submit-active-bg-color: var(--color-cta); --submit-active-border-color: var(--color-cta); --submit-active-color: var(--color-on-cta);}
	/*The row - fields side by side and the button beside them, level with the fields whatever sits above them*/
	.home-contact .contact-form .form-row{display: flex; flex-wrap: wrap; align-items: flex-end; gap: 14px;}
	.home-contact .contact-form .form-pass{display: contents;}
	.home-contact .contact-form .form-item{position: relative; flex: 1 1 220px; min-width: 0; margin: 0;}
	.home-contact .contact-form .form-submit{flex: none; max-width: 100%; margin: 0;}
	.home-contact .contact-form .form-submit > *{margin: 0;}
	/*The notes and errors under a field are gathered in one box that hangs below the field instead of pushing the button down, and the script gives the row the room it needs*/
	.home-contact .contact-form .form-extras{position: absolute; top: 100%; left: 0; right: 0; margin: 4px 0 0; padding: 0;}
	.home-contact .contact-form .form-extras:empty{display: none;}

	/*Tablet - a narrower card, and the fields and the button stack*/
	@media(max-width: 1000px){
		.home-contact .contact-card{width: 720px;}
		.home-contact .contact-form .form-row{flex-direction: column; align-items: stretch;}
		.home-contact .contact-form .form-item{flex: none;}
		.home-contact .contact-form .form-extras{position: static;}
		.home-contact .contact-form .form-submit{width: 100%;}
		.home-contact .contact-form button[type="submit"], .home-contact .contact-form input[type="submit"]{width: 100%; min-height: 56px;}
	}

	/*Phone - left aligned, and the note goes above the small print*/
	@media(max-width: 750px){
		.home-contact{min-height: 780px; padding-bottom: var(--space-7);}
		.home-contact .content-width{align-items: flex-start; gap: var(--space-4); text-align: left;}
		.home-contact .contact-intro{align-items: flex-start; gap: var(--space-4);}
		.home-contact .contact-pill{gap: var(--space-2); height: 32px; padding: 0 14px; font-size: var(--xs);}
		.home-contact .contact-card{width: 100%; margin-top: var(--space-2); padding: 20px; gap: 14px; border-radius: var(--radius-xl); background: color-mix(in srgb, var(--color-card) 92%, transparent); box-shadow: 0 30px 60px -30px color-mix(in srgb, var(--color-1) 55%, transparent);}
		.home-contact .contact-form label{margin-bottom: 6px;}
		.home-contact .contact-form .form-row{gap: 14px;}
		.home-contact .contact-meta{flex-direction: column-reverse; align-items: flex-start; gap: 14px;}
		.home-contact .contact-consent{font-size: var(--xxs);}
		.home-contact .contact-note{line-height: 1.55;}
	}
</style>

<section class="home-contact" id="contact">

	<?php if (section_field('crb_contact_image')) { ?>
		<div class="contact-photo">
			<img class="absolute-cover" src="<?= section_field('crb_contact_image'); ?>" alt="">
		</div>
	<?php } ?>

	<div class="content-width">

		<?php if (section_field('crb_contact_eyebrow') || section_field('crb_contact_title') || section_field('crb_contact_text')) { ?>
			<div class="contact-intro fade-from-bottom">
				<?php if (section_field('crb_contact_eyebrow')) { ?>
					<span class="pill contact-pill"><?= theme_icon(section_field('crb_contact_eyebrow_icon')); ?><?= section_field('crb_contact_eyebrow'); ?></span>
				<?php } ?>
				<?php if (section_field('crb_contact_title')) { ?>
					<h2 class="contact-title"><?= section_field('crb_contact_title'); ?></h2>
				<?php } ?>
				<?php if (section_field('crb_contact_text')) { ?>
					<p class="lead"><?= section_field('crb_contact_text'); ?></p>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if (section_field('crb_contact_form') || section_field('crb_contact_consent') || section_field('crb_contact_note')) { ?>
			<div class="contact-card fade-from-bottom">
				<?php if (section_field('crb_contact_form')) { ?>
					<div class="contact-form"><?= section_form('crb_contact_form'); ?></div>
				<?php } ?>
				<?php if (section_field('crb_contact_consent') || section_field('crb_contact_note')) { ?>
					<div class="contact-meta">
						<?php if (section_field('crb_contact_consent')) { ?>
							<p class="contact-consent"><?= section_field('crb_contact_consent'); ?></p>
						<?php } ?>
						<?php if (section_field('crb_contact_note')) { ?>
							<p class="contact-note"><?= theme_icon(section_field('crb_contact_note_icon')); ?><?= section_field('crb_contact_note'); ?></p>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>

<script>
	(function() {
		let form = document.querySelector(".home-contact .contact-form");
		if (!form) {
			return;
		}
		let controls = "input:not([type=hidden]):not([type=submit]):not([type=button]):not([type=image]):not([type=reset]), textarea, select";
		let buttons = "button[type=submit], input[type=submit]";
		let marks = ["form-row", "form-pass", "form-item", "form-submit"];

		/*A control that cannot be seen is not a field. Form plugins hide their spam trap with their own stylesheet, so this runs once the page has loaded.*/
		function isShown(element) {
			let style = getComputedStyle(element);
			return style.display !== "none" && style.visibility !== "hidden";
		}

		/*How many fields and buttons an element holds. The options of one radio group share a name and count once.*/
		function countIn(element) {
			let names = new Set();
			element.querySelectorAll(controls + ", " + buttons).forEach(function(control) {
				if (isShown(control)) {
					names.add(control.name || control);
				}
			});
			return names.size;
		}

		/*The block that holds one field with its label and notes, or the button: the widest ancestor with nothing else in it*/
		function unitOf(control) {
			let unit = control;
			while (unit.parentElement && unit.parentElement !== form && countIn(unit.parentElement) === 1) {
				unit = unit.parentElement;
			}
			return unit;
		}

		function mark() {
			form.querySelectorAll("." + marks.join(",.")).forEach(function(element) {
				element.classList.remove.apply(element.classList, marks);
			});
			let button = form.querySelector(buttons);
			let fields = Array.prototype.filter.call(form.querySelectorAll(controls), isShown);
			if (!button || !fields.length) {
				return;
			}
			let items = [];
			fields.forEach(function(field) {
				let unit = unitOf(field);
				if (items.indexOf(unit) === -1) {
					items.push(unit);
				}
			});
			let submit = unitOf(button);

			/*The row is the lowest ancestor that holds every field and the button*/
			let row = submit.parentElement;
			while (row && row !== form && !items.every(function(item) { return row.contains(item); })) {
				row = row.parentElement;
			}
			if (!row || row === submit) {
				return;
			}
			row.classList.add("form-row");
			items.concat(submit).forEach(function(unit) {
				unit.classList.add(unit === submit ? "form-submit" : "form-item");
				for (let between = unit.parentElement; between && between !== row; between = between.parentElement) {
					between.classList.add("form-pass");
				}
			});

			/*What follows a field's control inside its block, a description or an error, is gathered in one box that hangs under the field*/
			items.forEach(function(item) {
				let field = item.querySelector(controls);
				if (!field || field.type === "checkbox" || field.type === "radio") {
					return;
				}
				let notes = [];
				let after = false;
				Array.prototype.forEach.call(item.children, function(child) {
					if (child === field || child.contains(field)) {
						after = true;
					} else if (after && child.tagName !== "LABEL" && !child.querySelector(controls) && !child.classList.contains("form-extras")) {
						notes.push(child);
					}
				});
				if (!notes.length) {
					return;
				}
				let box = item.querySelector(":scope > .form-extras");
				if (!box) {
					box = document.createElement("div");
					box.className = "form-extras";
					item.insertBefore(box, notes[0]);
				}
				notes.forEach(function(note) {
					box.appendChild(note);
				});
			});
		}

		/*The row leaves room under it for the tallest box of notes that hangs below a field, so the small print never runs into it. On a tablet or a phone the box is part of the flow and needs none.*/
		function reserve() {
			let row = form.querySelector(".form-row");
			if (!row) {
				return;
			}
			let room = 0;
			row.querySelectorAll(".form-extras").forEach(function(box) {
				let style = getComputedStyle(box);
				if (style.position === "absolute") {
					room = Math.max(room, box.offsetHeight + parseFloat(style.marginTop));
				}
			});
			row.style.paddingBottom = room ? room + "px" : "";
		}

		/*A form plugin that validates without reloading swaps the fields for new ones, so the row is marked again*/
		let waiting = false;
		new MutationObserver(function() {
			if (waiting) {
				return;
			}
			waiting = true;
			requestAnimationFrame(function() {
				waiting = false;
				mark();
				reserve();
			});
		}).observe(form, {childList: true, subtree: true});

		function start() {
			mark();
			reserve();
		}

		window.addEventListener("resize", reserve);
		if (document.readyState === "loading") {
			document.addEventListener("DOMContentLoaded", start);
		} else {
			start();
		}
	})();
</script>
