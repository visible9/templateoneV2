<style type="text/css">
	/*
	* THEME SETTINGS
	* Document level styles: reset, typography, forms, header, footer and animations.
	* Colours, type scale, spacing, buttons and pills are in includes/css/design-system.css.
	* Printed inline in wp_head so WordPress never caches a stale version.
	* Section-specific CSS lives inside each section file in template-parts/sections/home/.
	*/

	/*Design tokens and shared section components live in includes/css/design-system.css, so the block editor preview reads the same source*/
<?php include(get_template_directory() . '/includes/css/design-system.css'); ?>


	/*Default Overall Styles*/
	html {
		scroll-behavior: smooth;
	}

	* {
		box-sizing: border-box;
	}

	body {
		margin: 0;
		background: var(--color-bg);
		color: var(--color-1);
		font-family: var(--default-font);
		font-size: var(--default);
		line-height: 1.55;
		-webkit-font-smoothing: antialiased;
		font-variant-ligatures: none;
		overflow-anchor: none;
	}

	img,
	svg,
	video {
		max-width: 100%;
		height: auto;
	}

	iframe {
		max-width: 100%;
	}

	a {
		color: var(--color-1);
		text-decoration: underline;
		text-decoration-color: var(--color-border);
		text-decoration-thickness: 1px;
		text-underline-offset: 3px;
		transition: text-decoration-color var(--transition);
	}

	a:hover {
		text-decoration-color: var(--color-2);
	}

	hr {
		border: 0;
		border-top: 1px solid var(--color-border);
		margin: 2em 0;
	}

	::selection {
		background: var(--color-1);
		color: var(--color-inverse);
	}

	a:focus-visible,
	button:focus-visible,
	summary:focus-visible {
		outline: 2px solid var(--color-focus);
		outline-offset: 3px;
	}

	[class*="wp-block-"] {
		position: relative;
		z-index: 2;
	}


	/*Font Defaults*/
	h1,
	h2,
	h3,
	h4,
	h5,
	h6 {
		font-family: var(--heading-font);
		font-weight: 500;
		line-height: 1.05;
		letter-spacing: -.025em;
		text-wrap: balance;
		color: var(--color-1);
		margin: 0 0 .5em;
	}

	h1 {
		font-size: var(--xl);
		line-height: 1;
	}

	h2 {
		font-size: var(--lg);
		line-height: 1.03;
		letter-spacing: -.032em;
	}

	h3 {
		font-size: var(--md);
		line-height: 1.12;
	}

	h4 {
		font-size: var(--sm);
		line-height: 1.2;
	}

	h5,
	h6 {
		font-size: var(--default);
	}

	p,
	ul,
	ol,
	li {
		font-family: var(--default-font);
		line-height: 1.55;
	}

	p {
		margin: 0 0 1em;
		text-wrap: pretty;
	}

	p:last-child {
		margin-bottom: 0;
	}

	strong {
		font-weight: 700;
	}

	.accent-word {
		background: var(--color-2);
		color: var(--color-on-accent);
		padding: 0 8px;
		border-radius: var(--radius-sm);
		box-decoration-break: clone;
		-webkit-box-decoration-break: clone;
	}

	.mono {
		font-family: var(--accent-font);
	}


	/*Buttons (.button and its modifiers) are in includes/css/design-system.css*/

	/*Submit buttons come from whichever form plugin the client uses, so they are styled by element, not by class.*/
	input[type="submit"],
	button[type="submit"] {
		display: inline-flex;
		align-items: center;
		justify-content: center;
		width: auto;
		height: 56px;
		padding: 0 28px;
		background: var(--color-cta);
		color: var(--color-on-cta);
		font-family: var(--default-font);
		font-size: 17px;
		font-weight: 700;
		line-height: 1;
		border: 0;
		border-radius: var(--radius-pill);
		cursor: pointer;
		transition: background var(--transition), box-shadow var(--transition), transform var(--transition);
	}

	input[type="submit"]:hover,
	button[type="submit"]:hover {
		background: var(--color-cta-hover);
		box-shadow: 0 12px 26px -12px color-mix(in srgb, var(--color-cta) 80%, transparent);
		transform: translateY(-1px);
	}


	/*Form Defaults*/
	input,
	textarea,
	select,
	button {
		font-family: var(--default-font);
		font-size: var(--default);
		color: var(--color-1);
	}

	input[type="text"],
	input[type="email"],
	input[type="tel"],
	input[type="url"],
	input[type="search"],
	input[type="number"],
	textarea,
	select {
		-webkit-appearance: none;
		appearance: none;
		width: 100%;
		height: 60px;
		padding: 0 20px;
		background: var(--color-card);
		border: 0;
		border-radius: var(--radius-md);
		box-shadow: inset 0 0 0 1px var(--color-border);
		font-size: 17px;
		outline: none;
		transition: box-shadow var(--transition);
	}

	input:focus,
	textarea:focus,
	select:focus {
		box-shadow: inset 0 0 0 2px var(--color-green);
	}

	textarea {
		height: auto;
		min-height: 150px;
		padding: 16px 20px;
		resize: vertical;
	}

	::placeholder {
		color: var(--ink-faint);
		opacity: 1;
	}

	label {
		font-size: var(--xs);
		font-weight: 700;
	}


	/*Layout*/
	#main {
		position: relative;
		overflow-x: clip;
	}

	/*clip, not hidden: hidden makes #main a scroll container and kills the sticky header*/
	.section-padding {
		padding: var(--section-space) 0;
	}

	section[id] {
		scroll-margin-top: calc(var(--header-height) + 20px);
	}

	.surface {
		background: var(--color-surface);
	}

	.dark {
		background: var(--color-1);
		color: var(--color-inverse);
	}

	.dark h1,
	.dark h2,
	.dark h3,
	.dark h4 {
		color: var(--color-inverse);
	}

	.has-text-align-right {
		text-align: right;
	}

	.has-text-align-center,
	.aligncenter {
		text-align: center;
	}

	/*Decorative page background - sits behind every section, never intercepts clicks*/
	/*.page-wrap only needs position:relative as a positioning context - confirmed working on the live site without its own z-index, so none is set here.*/
	.page-wrap {
		position: relative;
	}

	.bg-grid {
		position: absolute;
		top: 0;
		left: 0;
		right: 0;
		bottom: 0;
		width: 100vw;
		z-index: 1;
		pointer-events: none;
		background-position: 0 0;
		background-image: repeating-linear-gradient(90deg, color-mix(in oklab, var(--color-1) 7%, transparent) 0px, color-mix(in oklab, var(--color-1) 7%, transparent) 1px, transparent 1px, transparent 120px), repeating-linear-gradient(0deg, color-mix(in oklab, var(--color-1) 7%, transparent) 0px, color-mix(in oklab, var(--color-1) 7%, transparent) 1px, transparent 1px, transparent 120px);
	}

	.bg-glow {
		position: absolute;
		z-index: 1;
		pointer-events: none;
		width: 900px;
		height: 900px;
		top: -300px;
		right: -200px;
		filter: blur(10px);
		background: radial-gradient(circle, color-mix(in oklab, var(--color-2) 30%, transparent) 0%, transparent 70%);
	}

	.beige-gradient {
		background: var(--beige-gradient);
	}

	@media(max-width: 750px) {
		.bg-glow {
			width: 600px;
			height: 600px;
			right: -260px;
		}
	}


	/*Header - the logo, the menu and a phone icon floating over the page, fixed while it scrolls. Markup: header.php. Behaviour: includes/theme-changes.php.
	It measures itself with a container query rather than the viewport: first the header gives up nothing, then it folds the menu into a burger once its own pills stop fitting.*/
	.site-header {
		container-type: inline-size;
		position: fixed;
		top: var(--header-inset);
		left: 0;
		right: 0;
		z-index: var(--z-header);
		display: grid;
		grid-template-columns: 1fr auto 1fr;
		align-items: center;
		gap: 20px;
		width: calc(100% - 2 * var(--gutter));
		max-width: calc(var(--content-width) - 2 * var(--gutter));
		margin: 0 auto;
	}

	body.admin-bar .site-header {
		top: calc(var(--header-inset) + 32px);
	}

	/*The header is see-through over the hero image. Everywhere else, and once the page scrolls, it turns solid so it stays readable on light sections.*/
	.site-header.is-scrolled .glass,
	body:not(.has-hero) .site-header .glass {
		background: var(--glass-dark);
	}

	.site-header.is-scrolled .header-actions,
	body:not(.has-hero) .site-header .header-actions {
		box-shadow: var(--shadow);
	}

	body:not(.has-hero) #main-content {
		padding-top: var(--header-height);
	}

	.site-header .brand {
		display: flex;
		align-items: center;
		gap: 12px;
		grid-column: 1;
		justify-self: start;
		height: var(--header-pill);
		padding: 0 26px 0 12px;
		border-radius: var(--radius-pill);
		color: var(--color-inverse);
		text-decoration: none;
	}

	.site-header .brand:not(:has(.brand-name)) {
		padding-right: 12px;
	}

	.site-header .brand:not(:has(.brand-mark)) {
		padding-left: 26px;
	}

	.site-header .brand-mark {
		display: block;
		flex: none;
		width: 40px;
		height: 40px;
		border-radius: 22%;
		object-fit: cover;
	}

	.site-header .brand-name {
		font-family: var(--heading-font);
		font-size: var(--sm);
		font-weight: 600;
		letter-spacing: -.04em;
		color: var(--color-inverse);
	}

	.site-header .header-nav {
		grid-column: 2;
		justify-self: center;
		display: flex;
		align-items: center;
		gap: 4px;
		height: var(--header-pill);
		padding: 8px;
		border-radius: var(--radius-pill);
	}

	.site-header .header-menu {
		display: flex;
		align-items: center;
		gap: 4px;
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.site-header .header-menu li {
		margin: 0;
		list-style: none;
	}

	.site-header .header-menu a {
		display: inline-flex;
		align-items: center;
		height: 48px;
		padding: 0 clamp(12px, 1.39vw, 20px);
		border-radius: var(--radius-pill);
		font-size: var(--ui);
		font-weight: 600;
		white-space: nowrap;
		color: rgb(255 255 255 / 90%);
		text-decoration: none;
		transition: background var(--transition), color var(--transition);
	}

	.site-header .header-menu a:hover {
		background: rgb(255 255 255 / 16%);
		color: var(--color-inverse);
	}

	.site-header .header-menu .current-menu-item>a,
	.site-header .header-menu a.is-active {
		background: var(--color-2);
		color: var(--color-on-accent);
	}

	.site-header .header-end {
		grid-column: 3;
		justify-self: end;
		display: flex;
		align-items: center;
		gap: 8px;
	}

	.site-header .header-actions {
		display: flex;
		align-items: center;
		gap: 10px;
		height: var(--header-pill);
		padding: 8px;
		border-radius: var(--radius-pill);
		background: var(--color-inverse);
		color: var(--color-1);
	}

	.site-header .header-actions .icon-btn.call {
		width: 48px;
		height: 48px;
		background: var(--color-surface);
		color: var(--color-green-deep);
	}

	.site-header .icon-btn .ico {
		width: 20px;
		height: 20px;
	}

	.site-header .burger,
	.site-header .nav-extra {
		display: none;
	}

	@container (max-width: 1040px) {
		.site-header .brand {
			height: 56px;
			padding-right: 22px;
		}

		.site-header .brand:not(:has(.brand-name)) {
			padding-right: 12px;
		}

		.site-header .header-nav {
			position: absolute;
			top: calc(100% + 10px);
			left: 0;
			right: 0;
			justify-self: stretch;
			display: none;
			flex-direction: column;
			align-items: stretch;
			height: auto;
			padding: 12px;
			border-radius: var(--radius-lg);
			background: var(--glass-dark);
		}

		.site-header.is-open .header-nav {
			display: flex;
		}

		.site-header .header-menu {
			flex-direction: column;
			align-items: stretch;
		}

		.site-header .header-menu a {
			height: 52px;
			padding: 0 18px;
			font-size: var(--default);
		}

		.site-header .nav-extra {
			display: block;
			margin-top: 8px;
		}

		.site-header .nav-extra .button {
			width: 100%;
		}

		.site-header.has-menu .header-actions .button {
			display: none;
		}

		.site-header .header-actions {
			height: auto;
			padding: 0;
			background: none;
			box-shadow: none;
		}

		.site-header .header-actions .icon-btn.call {
			width: 56px;
			height: 56px;
			background: var(--color-inverse);
		}

		.site-header .burger {
			display: inline-flex;
			width: 56px;
			height: 56px;
			color: var(--color-inverse);
		}
	}

	@media(max-width: 750px) {
		.site-header .brand {
			height: 52px;
			gap: 10px;
			padding: 0 20px 0 8px;
		}

		.site-header .brand:not(:has(.brand-name)) {
			padding-right: 8px;
		}

		.site-header .brand-mark {
			width: 36px;
			height: 36px;
		}

		.site-header .header-actions .icon-btn.call,
		.site-header .burger {
			width: 52px;
			height: 52px;
		}
	}

	/*the admin bar is taller on small screens*/
	@media(max-width: 782px) {
		body.admin-bar .site-header {
			top: calc(var(--header-inset) + 46px);
		}
	}

	/*The footer brand reuses the logo from Theme Options*/
	.logo-container {
		display: inline-flex;
		align-items: center;
		gap: 10px;
		color: var(--color-1);
		text-decoration: none;
	}

	.logo-container img {
		display: block;
		width: 40px;
		height: 40px;
		border-radius: 22%;
		object-fit: cover;
	}

	.logo-text {
		font-family: var(--heading-font);
		font-size: var(--sm);
		font-weight: 600;
		letter-spacing: -.04em;
	}

	/*Social*/
	.social-link {
		display: flex;
		align-items: center;
		justify-content: center;
		width: 44px;
		height: 44px;
		border-radius: 500px;
		border: 1px solid var(--color-border);
		color: var(--color-3);
		transition: background var(--transition), border-color var(--transition), color var(--transition);
	}

	.social-link:hover {
		background: var(--color-2);
		border-color: var(--color-2);
		color: var(--color-on-accent);
	}

	.social-link svg {
		width: 18px;
		height: 18px;
	}


	/*Page Banner (blog, archive, search, 404)*/
	.page-banner {
		padding: 90px 0 70px;
		background: var(--color-surface);
		border-bottom: 1px solid var(--color-border);
	}

	.page-banner h1 {
		margin: 0;
	}


	/*Footer*/
	.site-footer {
		background: var(--color-bg);
		color: var(--color-3);
		font-size: var(--xs);
		padding: 80px 0 30px;
		border-top: 1px solid var(--color-border);
	}

	.site-footer a {
		color: var(--color-3);
		text-decoration: none;
	}

	.site-footer a:hover {
		color: var(--color-1);
	}

	.footer-top {
		display: flex;
		justify-content: space-between;
		flex-wrap: wrap;
		gap: 48px;
		padding-bottom: 45px;
		border-bottom: 1px solid var(--color-border);
	}

	.footer-brand {
		max-width: 320px;
	}

	.footer-brand .logo-text {
		color: var(--color-1);
		font-size: var(--md);
	}

	.footer-brand p {
		margin: 18px 0 0;
		line-height: 1.75;
	}

	.footer-cols {
		display: flex;
		flex-wrap: wrap;
		gap: 48px;
	}

	.footer-col {
		min-width: 160px;
	}

	.footer-col-title {
		display: block;
		margin: 0 0 16px;
		font-family: var(--accent-font);
		font-size: var(--xs);
		font-weight: 500;
		letter-spacing: .1em;
		text-transform: uppercase;
		color: var(--color-3);
	}

	.footer-menu {
		display: grid;
		gap: 11px;
		margin: 0;
		padding: 0;
		list-style: none;
	}

	.footer-contacts {
		display: grid;
		gap: 11px;
	}

	.footer-col a,
	.footer-col span {
		display: block;
	}

	.footer-col a:hover {
		text-decoration: underline;
		text-decoration-color: var(--color-2);
		text-decoration-thickness: 2px;
		text-underline-offset: 3px;
	}

	.footer-cta {
		display: inline-block;
		margin-top: 22px;
		font-size: var(--default);
		font-weight: 600;
		color: var(--color-1);
		text-decoration: underline;
		text-decoration-thickness: 1px;
		text-underline-offset: 5px;
	}

	.footer-cta:hover {
		color: var(--color-1);
		text-decoration-color: var(--color-2);
	}

	.footer-form {
		max-width: 340px;
	}

	.footer-form input[type="text"],
	.footer-form input[type="email"],
	.footer-form input[type="tel"],
	.footer-form input[type="url"],
	.footer-form input[type="number"],
	.footer-form textarea,
	.footer-form select {
		height: 44px;
	}

	.footer-social {
		display: flex;
		gap: 10px;
	}

	.footer-bottom {
		display: flex;
		align-items: center;
		justify-content: space-between;
		gap: 16px;
		padding-top: 28px;
	}

	.footer-bottom p {
		margin: 0;
	}

	.footer-legal-info {
		display: grid;
		grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
		gap: 20px 32px;
		padding: 28px 0;
		border-bottom: 1px solid var(--color-border);
	}

	.footer-legal-info:last-child {
		border-bottom: 0;
	}

	.legal-item {
		display: flex;
		flex-direction: column;
		gap: 4px;
		font-size: var(--xs);
		line-height: 1.45;
	}

	.legal-label {
		font-size: var(--xxs);
		font-weight: 700;
		letter-spacing: .06em;
		text-transform: uppercase;
		color: var(--ink-faint);
	}

	@media(max-width: 1000px) {
		.footer-top {
			gap: 36px;
		}

		.footer-cols {
			gap: 36px;
			width: 100%;
		}

		.footer-col {
			flex: 1 1 160px;
		}
	}

	@media(max-width: 750px) {
		.site-footer {
			padding: 55px 0 26px;
		}

		.footer-top {
			flex-direction: column;
			gap: 32px;
		}

		.footer-cols {
			flex-direction: column;
			gap: 28px;
		}

		.footer-bottom {
			flex-direction: column;
			align-items: flex-start;
			gap: 8px;
		}
	}


	/*Transitions-Animations*/
	.fade-in {
		opacity: 0;
		transition: opacity 1s;
	}

	.fade-in.active {
		opacity: 1;
	}

	.fade-from-left {
		opacity: 0;
		transform: translateX(-25px);
		transition: opacity 1s, transform 1s;
	}

	.fade-from-left.active {
		opacity: 1;
		transform: translateX(0);
	}

	.fade-from-right {
		opacity: 0;
		transform: translateX(25px);
		transition: opacity 1s, transform 1s;
	}

	.fade-from-right.active {
		opacity: 1;
		transform: translateX(0);
	}

	.fade-from-bottom {
		opacity: 0;
		transform: translateY(25px);
		transition: opacity 1s, transform 1s;
	}

	.fade-from-bottom.active {
		opacity: 1;
		transform: translateY(0);
	}

	@media(max-width: 750px) {

		.fade-in,
		.fade-from-left,
		.fade-from-right,
		.fade-from-bottom {
			opacity: 1;
			transform: none;
		}
	}

	@media(prefers-reduced-motion: reduce) {
		html {
			scroll-behavior: auto;
		}

		* {
			animation-duration: .01ms !important;
			transition-duration: .01ms !important;
		}
	}

	/*Whatever the client picked in Appearance > Customize > Colours, and nothing else.*/
	<?= palette_overrides(); ?>
</style>