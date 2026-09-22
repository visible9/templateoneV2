<style type="text/css">
	.home-proof{position: relative; padding: var(--section-space) 0; background: var(--color-surface); color: var(--color-1); font-family: var(--default-font); font-size: var(--default); line-height: 1.55;}
	.home-proof, .home-proof *, .home-proof *::before, .home-proof *::after{box-sizing: border-box;}
	/*With every field empty there would be a blank band holding nothing, so the whole section steps aside*/
	.home-proof:not(:has(.content-width > *)){display: none;}
	.home-proof h2, .home-proof h3, .home-proof h4, .home-proof p, .home-proof ul{margin: 0;}
	.home-proof ul{padding: 0; list-style: none;}
	.home-proof a{text-decoration: none;}
	.home-proof .pill{margin: 0;}
	/*A word too long for its box breaks instead of pushing the card wider. anywhere is for the text that is the only shrinkable item of its row, where the break has to be allowed before the box is sized.*/
	.home-proof{overflow-wrap: break-word;}
	.home-proof .proof-title, .home-proof .stat-number, .home-proof .video-title, .home-proof .quote-text, .home-proof .review-text, .home-proof .author-name, .home-proof .author-role, .home-proof .story-title, .home-proof .story-text, .home-proof .logo-name{overflow-wrap: anywhere;}

	/*Rhythm - the gap above each block of the section*/
	.home-proof .content-width > * + *{margin-top: 80px;}
	.home-proof .proof-head + .proof-stats{margin-top: 72px;}
	.home-proof .content-width > * + .proof-stories{margin-top: 112px;}
	.home-proof .content-width > * + .proof-logos{margin-top: 96px;}

	/*Heading - the title on the left, the rating and the intro on the right, both ending on the bottom edge of the row*/
	.home-proof .proof-head{display: grid; grid-template-columns: repeat(12, minmax(0, 1fr)); column-gap: var(--grid-gap); align-items: end;}
	.home-proof .proof-intro{grid-column: 1 / span 8; display: flex; flex-direction: column; align-items: flex-start; gap: 28px;}
	.home-proof .proof-title{font-family: var(--heading-font); font-size: var(--lg); font-weight: 500; line-height: 1.03; letter-spacing: -.032em; text-wrap: balance; color: var(--color-1);}
	.home-proof .proof-side{grid-column: 9 / -1; display: flex; flex-direction: column; align-items: flex-start; gap: var(--space-4); padding-bottom: 8px;}
	.home-proof .proof-rating{display: flex; align-items: center; gap: var(--space-3);}
	.home-proof .stars{display: flex; flex: none; color: var(--color-cta);}
	.home-proof .stars .ico{width: 22px; height: 22px;}
	.home-proof .proof-head .stars .ico{width: 24px; height: 24px;}
	.home-proof .rating-text{font-size: var(--default); font-weight: 700;}

	/*Numbers - a row that sizes itself to how many there are. :where() keeps the quantity rules from outranking the breakpoint below, and the last match wins, so twelve numbers land on four across.*/
	.home-proof .proof-stats{--columns: 4; display: grid; grid-template-columns: repeat(var(--columns), minmax(0, 1fr)); gap: var(--grid-gap);}
	.home-proof .proof-stats:where(:has(> :nth-child(1):nth-last-child(2))){--columns: 2;}
	.home-proof .proof-stats:where(:has(> :nth-child(1):nth-last-child(3n))){--columns: 3;}
	.home-proof .proof-stats:where(:has(> :nth-child(1):nth-last-child(4n))){--columns: 4;}
	.home-proof .stat{display: flex; flex-direction: column; gap: 6px; padding-top: var(--space-5); border-top: 1.5px solid color-mix(in srgb, var(--color-1) 85%, transparent);}
	.home-proof .stat-number{font-family: var(--heading-font); font-size: var(--figure); line-height: 1; letter-spacing: -.045em;}
	.home-proof .stat-label{font-size: var(--card-text); color: var(--color-3);}

	/*Proof cards - the video, the quote and the chat share a row in the proportions of the design's 12 columns (5, 4, 3), and the reviews follow three to a row. flex-grow follows those shares, so a card that is left out lets the others stretch across. The .5px keeps a full row from wrapping on a rounding error.*/
	.home-proof .proof-grid{--gap: var(--space-4); --col: calc((100% - var(--gap) * 11) / 12); display: flex; flex-direction: column; gap: var(--gap);}
	.home-proof .proof-feature, .home-proof .proof-reviews{display: flex; flex-wrap: wrap; gap: var(--gap);}
	.home-proof .proof-video{flex: 5 1 calc(var(--col) * 5 + var(--gap) * 4 - .5px);}
	.home-proof .proof-quote{flex: 4 1 calc(var(--col) * 4 + var(--gap) * 3 - .5px);}
	.home-proof .proof-chat{flex: 3 1 calc(var(--col) * 3 + var(--gap) * 2 - .5px);}
	.home-proof .proof-review{flex: 1 1 calc(var(--col) * 4 + var(--gap) * 3 - .5px);}
	.home-proof .avatar{display: flex; align-items: center; justify-content: center; flex: none; width: 44px; height: 44px; border-radius: var(--radius-pill); font-size: var(--xs); font-weight: 700;}
	.home-proof .author-copy{display: flex; flex-direction: column; min-width: 0;}
	.home-proof .author-name{font-size: var(--ui); font-weight: 700; line-height: 1.25;}
	.home-proof .author-role{font-size: var(--xs); color: var(--color-3);}

	/*Video - a photo under a shade, with a frosted label, the play button and the title over it. The shade keeps them readable on any picture.*/
	.home-proof .proof-video{position: relative; min-height: 460px; border-radius: var(--radius-xl); overflow: hidden; background: var(--color-1); color: var(--color-inverse);}
	.home-proof .proof-video .absolute-cover{width: 100%; height: 100%; max-width: none;}
	.home-proof .proof-video::after{content: ""; position: absolute; inset: 0; background: linear-gradient(180deg, color-mix(in srgb, var(--color-1) 50%, transparent) 0%, color-mix(in srgb, var(--color-1) 38%, transparent) 40%, color-mix(in srgb, var(--color-1) 86%, transparent) 100%); pointer-events: none;}
	.home-proof .video-label{position: absolute; top: 22px; left: 22px; z-index: 1; height: 36px; gap: var(--space-2); color: var(--color-inverse);}
	.home-proof .video-label .ico{width: 16px; height: 16px;}
	.home-proof .video-play{position: absolute; top: 50%; left: 50%; z-index: 1; display: flex; align-items: center; justify-content: center; width: 92px; height: 92px; border-radius: var(--radius-pill); background: var(--color-card); color: var(--color-1); box-shadow: 0 0 0 14px rgb(255 255 255 / 20%); transform: translate(-50%, -60%); transition: transform var(--transition), box-shadow var(--transition);}
	.home-proof .video-play:hover{box-shadow: 0 0 0 18px rgb(255 255 255 / 26%); transform: translate(-50%, -60%) scale(1.06);}
	.home-proof .video-play:focus-visible{outline: 2px solid var(--color-focus); outline-offset: 20px;}
	.home-proof .video-play .ico{width: 36px; height: 36px; margin-left: 5px;}
	.home-proof .video-caption{position: absolute; right: 30px; bottom: 28px; left: 30px; z-index: 1; display: flex; flex-direction: column; gap: 6px;}
	.home-proof .video-title{font-family: var(--heading-font); font-size: var(--card-title); font-weight: 400; line-height: 1.1; letter-spacing: -.025em; text-wrap: wrap; color: var(--color-inverse);}
	.home-proof .video-sub{font-size: var(--ui); color: rgb(255 255 255 / 82%);}

	/*Quote - the dark card*/
	.home-proof .proof-quote{display: flex; flex-direction: column; justify-content: space-between; gap: var(--space-5); min-height: 460px; padding: 36px; border-radius: var(--radius-xl); background: var(--color-1); color: var(--color-inverse);}
	.home-proof .quote-mark{height: 56px; font-family: var(--heading-font); font-size: var(--quote-mark); line-height: .6; color: var(--color-2);}
	.home-proof .quote-text{font-family: var(--heading-font); font-size: var(--quote); line-height: 1.2; letter-spacing: -.02em;}
	.home-proof .quote-author{display: flex; align-items: center; gap: 14px;}
	.home-proof .proof-quote .avatar{width: 52px; height: 52px; background: var(--color-2); color: var(--color-on-accent); font-size: var(--ui);}
	.home-proof .proof-quote .author-copy{gap: 1px;}
	.home-proof .proof-quote .author-name{font-size: var(--card-text); line-height: 1.55;}
	.home-proof .proof-quote .author-role{font-size: var(--card-note); color: var(--color-muted-dark);}

	/*Chat - a messenger window: the sender on top, the messages sitting on the bottom of the pane, a caption under it*/
	.home-proof .proof-chat{display: flex; flex-direction: column; min-height: 460px; border-radius: var(--radius-xl); overflow: hidden; background: var(--color-card); box-shadow: var(--shadow);}
	.home-proof .chat-head{display: flex; align-items: center; gap: var(--space-3); padding: var(--space-4) 18px; background: var(--color-ink-2); color: var(--color-inverse);}
	.home-proof .chat-head .avatar{width: 40px; height: 40px; background: var(--color-cta); color: var(--color-on-cta);}
	.home-proof .chat-who{display: flex; flex-direction: column; min-width: 0;}
	.home-proof .chat-name{font-size: var(--ui); font-weight: 700; line-height: 1.2;}
	.home-proof .chat-status{font-size: var(--xxs); color: var(--color-2);}
	.home-proof .chat-body{display: flex; flex: 1 1 auto; flex-direction: column; justify-content: flex-end; gap: 10px; padding: 18px; background: var(--color-surface);}
	.home-proof .chat-message{max-width: 88%; padding: 10px 14px; font-size: var(--card-note); line-height: 1.4; overflow-wrap: anywhere;}
	.home-proof .chat-sent{align-self: flex-end; border-radius: var(--radius-md) var(--radius-md) var(--space-1) var(--radius-md); background: color-mix(in srgb, var(--color-leaf) 35%, var(--color-card));}
	.home-proof .chat-received{align-self: flex-start; border-radius: var(--radius-md) var(--radius-md) var(--radius-md) var(--space-1); background: var(--color-card);}
	.home-proof .chat-time{display: block; margin-top: 2px; font-size: var(--xxs); color: var(--color-3);}
	.home-proof .chat-sent .chat-time{text-align: right;}
	.home-proof .chat-caption{padding: 14px 18px; font-size: var(--xs); color: var(--color-3);}

	/*Reviews - the avatar takes one of three tints in turn*/
	.home-proof .proof-review{display: flex; flex-direction: column; gap: 20px; min-height: 270px; padding: var(--space-6); border-radius: var(--radius-lg); background: var(--color-card); box-shadow: var(--shadow);}
	.home-proof .proof-review .stars{align-self: flex-start;}
	.home-proof .review-text{font-size: var(--card-text-lg); line-height: 1.5;}
	.home-proof .review-foot{display: flex; align-items: center; justify-content: space-between; gap: var(--space-3); margin-top: auto;}
	.home-proof .review-author{display: flex; align-items: center; gap: var(--space-3); min-width: 0;}
	.home-proof .review-tag{flex: none; height: 30px; font-size: var(--xs); white-space: nowrap;}
	.home-proof .proof-review .avatar{background: var(--color-surface); color: var(--color-green-deep);}
	.home-proof .proof-review:nth-child(3n+2) .avatar{background: color-mix(in srgb, var(--color-cta) 35%, var(--color-card)); color: var(--color-1);}
	.home-proof .proof-review:nth-child(3n) .avatar{background: color-mix(in srgb, var(--color-leaf) 30%, var(--color-card)); color: var(--color-green-deep);}

	/*Case studies - a row of cards that scrolls sideways. The track runs on through the page margin, so the next card shows at the edge, and its padding keeps the shadows from being cut.*/
	.home-proof .stories-head{display: flex; align-items: flex-end; justify-content: space-between; gap: var(--space-5);}
	.home-proof .stories-title{font-family: var(--heading-font); font-size: var(--md-lg); font-weight: 500; line-height: 1.05; letter-spacing: -.03em; text-wrap: balance; color: var(--color-1);}
	.home-proof .stories-actions{display: flex; align-items: center; gap: var(--space-3); margin-left: auto;}
	.home-proof .stories-actions .button{margin-right: var(--space-3);}
	.home-proof .stories-actions .button .ico{width: 18px; height: 18px;}
	.home-proof .stories-arrows{display: flex; gap: var(--space-3);}
	.home-proof .stories-arrow{width: 56px; height: 56px; background: var(--color-1); color: var(--color-inverse);}
	.home-proof .stories-arrow:disabled{background: transparent; color: color-mix(in srgb, var(--color-1) 40%, transparent); box-shadow: inset 0 0 0 1.5px color-mix(in srgb, var(--color-1) 25%, transparent); cursor: default; transform: none;}
	.home-proof .stories-arrow:focus-visible{outline: 2px solid var(--color-focus); outline-offset: 3px;}
	.home-proof .is-prev .ico{transform: rotate(180deg);}
	.home-proof .stories-track{margin: var(--space-6) calc(var(--gutter) * -1) -32px 0; padding-bottom: var(--space-6); overflow-x: auto; overflow-y: hidden; scroll-snap-type: x mandatory; scrollbar-width: none;}
	.home-proof .stories-track::-webkit-scrollbar{display: none;}
	.home-proof .stories-list{display: flex; gap: var(--space-5);}
	.home-proof .story-card{display: flex; flex: none; flex-direction: column; width: 400px; overflow: hidden; border-radius: var(--radius-xl); background: var(--color-card); box-shadow: var(--shadow); scroll-snap-align: start;}
	.home-proof .story-head{position: relative; height: 200px; padding: var(--space-5) 28px; overflow: hidden; background: var(--color-1); color: var(--color-inverse);}
	.home-proof .story-card:nth-child(5n+2) .story-head, .home-proof .story-card:nth-child(5n) .story-head{background: var(--color-green-deep);}
	.home-proof .story-card:nth-child(5n+3) .story-head{background: var(--color-ink-3);}
	.home-proof .story-card:nth-child(5n+4) .story-head{background: var(--color-ink-2);}
	.home-proof .story-curve{position: absolute; bottom: 0; left: 0; display: block; width: 100%; height: 110px;}
	.home-proof .story-curve path{vector-effect: non-scaling-stroke;}
	.home-proof .story-area{fill: var(--color-2); fill-opacity: .14; stroke: none;}
	.home-proof .story-line{fill: none; stroke: var(--color-2); stroke-width: 3; stroke-linecap: round;}
	/*Figures that rise (the After number is higher than the Before) draw the curve the other way round, so it climbs to the right*/
	.home-proof .rising .story-curve{transform: scaleX(-1);}
	.home-proof .story-values{position: relative; display: flex; justify-content: space-between; gap: var(--space-3);}
	.home-proof .story-before, .home-proof .story-after{display: flex; flex-direction: column;}
	.home-proof .story-after{align-items: flex-end; margin-left: auto; color: var(--color-2);}
	.home-proof .story-label{font-size: var(--xxs); font-weight: 700; letter-spacing: .05em; text-transform: uppercase; color: rgb(255 255 255 / 70%);}
	.home-proof .story-after .story-label{color: var(--color-2);}
	.home-proof .story-value{font-family: var(--heading-font); font-size: var(--stat-lg); line-height: 1.05; letter-spacing: -.03em;}
	.home-proof .story-body{display: flex; flex: 1 1 auto; flex-direction: column; gap: 14px; padding: 28px 28px 30px;}
	.home-proof .story-tags{display: flex; flex-wrap: wrap; gap: var(--space-2);}
	.home-proof .story-tags .pill{height: 28px; font-size: var(--xxs);}
	.home-proof .story-title{font-family: var(--heading-font); font-size: var(--card-title); font-weight: 500; line-height: 1.12; letter-spacing: -.025em; text-wrap: balance;}
	.home-proof .story-text{font-size: var(--ui); line-height: 1.55; text-wrap: pretty; color: var(--color-3);}
	.home-proof .story-link{display: inline-flex; align-items: center; gap: var(--space-2); margin-top: 6px; font-size: var(--ui); font-weight: 700; color: var(--color-green-deep);}
	.home-proof .story-link .ico{width: 18px; height: 18px;}
	.home-proof .stories-progress{display: flex; align-items: center; gap: 20px; margin-top: 44px;}
	.home-proof .progress-count{font-family: var(--heading-font); font-size: var(--ui); color: var(--color-3);}
	.home-proof .progress-track{flex: 1 1 auto; height: 3px; border-radius: 3px; background: color-mix(in srgb, var(--color-1) 14%, transparent);}
	.home-proof .progress-fill{display: block; width: calc(100% / var(--count)); height: 3px; border-radius: 3px; background: var(--color-1); transition: width var(--transition);}
	.home-proof .stories-dots{display: none; align-items: center; justify-content: center; gap: var(--space-2); margin-top: var(--space-6);}
	.home-proof .stories-dots span{width: 8px; height: 8px; border-radius: 8px; background: color-mix(in srgb, var(--color-1) 20%, transparent); transition: width var(--transition), background var(--transition);}
	.home-proof .stories-dots .is-active{width: 28px; background: var(--color-1);}
	/*Every card already fits, so there is nothing to scroll and nothing to show a position for*/
	.home-proof .no-scroll .stories-arrows, .home-proof .no-scroll .stories-progress, .home-proof .no-scroll .stories-dots{display: none;}

	/*Logos - a logo is an image, and one with no image is set as a text logo from its name, in one of six styles in turn*/
	.home-proof .proof-logos{display: flex; align-items: center; justify-content: space-between; gap: var(--space-6); padding-top: 36px; border-top: 1px solid color-mix(in srgb, var(--color-1) 16%, transparent);}
	.home-proof .logos-label{flex: none; width: 170px; font-size: var(--card-note); font-weight: 700; line-height: 1.35; text-wrap: wrap; color: var(--color-3);}
	.home-proof .logos-list{display: grid; flex: 1 1 auto; grid-auto-flow: column; grid-auto-columns: minmax(0, 1fr); gap: var(--space-4); align-items: center; color: color-mix(in srgb, var(--color-1) 75%, var(--color-surface));}
	.home-proof .logo-item{display: flex; align-items: center; justify-content: center; min-width: 0;}
	.home-proof .logo-image{display: block; width: auto; max-width: 100%; height: auto; max-height: 32px; object-fit: contain; filter: grayscale(1); opacity: .75;}
	.home-proof .logo-name{display: flex; align-items: center; gap: 10px; font-family: var(--heading-font); font-size: var(--ui); font-weight: 700; letter-spacing: .12em; text-transform: uppercase; white-space: nowrap;}
	.home-proof .logo-name::before{content: ""; flex: none; width: 16px; height: 16px; border-radius: var(--radius-pill); background: currentColor;}
	.home-proof .logo-item:nth-child(6n+2) .logo-name{font-size: var(--sm); font-weight: 600; letter-spacing: -.03em; text-transform: none;}
	.home-proof .logo-item:nth-child(6n+2) .logo-name::before{width: 14px; height: 14px; border-radius: 0; transform: rotate(45deg);}
	.home-proof .logo-item:nth-child(6n+3) .logo-name{font-family: var(--default-font); font-size: var(--card-note); letter-spacing: .2em;}
	.home-proof .logo-item:nth-child(6n+3) .logo-name::before{background: none; border: 3px solid currentColor;}
	.home-proof .logo-item:nth-child(6n+4) .logo-name{font-size: var(--sm); font-weight: 400; letter-spacing: -.02em; text-transform: none;}
	.home-proof .logo-item:nth-child(6n+4) .logo-name::before{width: 16px; height: 14px; border-radius: 0; clip-path: polygon(50% 0, 100% 100%, 0 100%);}
	.home-proof .logo-item:nth-child(6n+5) .logo-name{font-size: var(--default); letter-spacing: .06em;}
	.home-proof .logo-item:nth-child(6n+5) .logo-name::before{width: 15px; height: 15px; border-radius: var(--space-1);}
	.home-proof .logo-item:nth-child(6n) .logo-name{font-family: var(--default-font); font-size: var(--sm); font-weight: 600; letter-spacing: -.01em; text-transform: none;}
	.home-proof .logo-item:nth-child(6n) .logo-name::before{width: 18px; height: 9px; border-radius: 18px 18px 0 0;}

	/*Video popup - moved to the end of <body> by the script below, so nothing can clip it, which is why it is keyed off its own class and not the section's*/
	html.proof-modal-open{overflow: hidden;}
	.proof-modal{position: fixed; inset: 0; z-index: calc(var(--z-header) + 100); display: none; align-items: center; justify-content: center; padding: var(--gutter); background: color-mix(in srgb, var(--color-1) 90%, transparent);}
	.proof-modal:not([hidden]){display: flex;}
	.proof-modal .modal-frame{position: relative; width: min(1100px, 100%); max-height: 100%; aspect-ratio: 16 / 9; border-radius: var(--radius-lg); overflow: hidden; background: var(--color-1);}
	.proof-modal .modal-frame iframe, .proof-modal .modal-frame video{position: absolute; inset: 0; display: block; width: 100%; height: 100%; border: 0; background: var(--color-1); object-fit: contain;}
	.proof-modal .modal-close{position: absolute; top: var(--space-4); right: var(--space-4); z-index: 1; display: flex; align-items: center; justify-content: center; width: 48px; height: 48px; padding: 0; border: 0; border-radius: var(--radius-pill); background: rgb(255 255 255 / 14%); color: var(--color-inverse); cursor: pointer; transition: background var(--transition);}
	.proof-modal .modal-close:hover{background: rgb(255 255 255 / 26%);}
	.proof-modal .modal-close:focus-visible{outline: 2px solid var(--color-focus); outline-offset: 3px;}
	.proof-modal .modal-close .ico{width: 22px; height: 22px;}

	@media(prefers-reduced-motion: reduce){
		.home-proof .video-play, .home-proof .progress-fill, .home-proof .stories-dots span, .proof-modal .modal-close{transition: none;}
	}

	/*Tablet - the heading stacks, the video takes a row and the quote and the chat share the next, the reviews go two across, and the logos sit under their label*/
	@media(max-width: 1000px){
		.home-proof .proof-head{grid-template-columns: minmax(0, 1fr); row-gap: 18px;}
		.home-proof .proof-intro, .home-proof .proof-side{grid-column: 1 / -1;}
		.home-proof .proof-side{padding-bottom: 0;}
		.home-proof .proof-video{flex-basis: 100%;}
		.home-proof .proof-quote, .home-proof .proof-chat, .home-proof .proof-review{flex-basis: calc(50% - var(--gap) * .5 - .5px);}
		.home-proof .proof-logos{flex-direction: column; align-items: flex-start; gap: var(--space-5);}
		.home-proof .logos-label{width: auto;}
		.home-proof .logos-list{grid-auto-flow: row; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 22px var(--space-3); width: 100%;}
		.home-proof .logo-item{justify-content: flex-start;}
	}

	/*Phone - one card per row, two numbers across, the case studies show dots under them and the intro paragraph steps aside. A chat message loses its time.*/
	@media(max-width: 750px){
		.home-proof .content-width > * + *{margin-top: 44px;}
		.home-proof .proof-head + .proof-stats{margin-top: 36px;}
		.home-proof .content-width > * + .proof-stories{margin-top: 64px;}
		.home-proof .content-width > * + .proof-logos{margin-top: 56px;}
		.home-proof .proof-intro{gap: 18px;}
		.home-proof .proof-title{line-height: 1.05; letter-spacing: -.03em;}
		.home-proof .proof-rating{gap: 10px;}
		.home-proof .stars .ico, .home-proof .proof-head .stars .ico{width: 20px; height: 20px;}
		.home-proof .rating-text{font-size: var(--ui);}
		.home-proof .proof-side .lead{display: none;}
		.home-proof .proof-stats{--columns: 2; gap: var(--space-5) var(--space-4);}
		.home-proof .stat{gap: var(--space-1); padding-top: var(--space-4);}
		.home-proof .stat-label{font-size: var(--xs); line-height: 1.35;}
		.home-proof .proof-grid{--gap: var(--space-3);}
		.home-proof .proof-video, .home-proof .proof-quote, .home-proof .proof-chat, .home-proof .proof-review{flex-basis: 100%;}
		.home-proof .proof-video{min-height: 420px; border-radius: var(--radius-lg);}
		.home-proof .video-label{top: var(--space-4); left: var(--space-4); height: 34px;}
		.home-proof .video-play{top: 44%; width: 76px; height: 76px; box-shadow: 0 0 0 10px rgb(255 255 255 / 20%); transform: translate(-50%, -50%);}
		.home-proof .video-play:hover{box-shadow: 0 0 0 12px rgb(255 255 255 / 26%); transform: translate(-50%, -50%) scale(1.06);}
		.home-proof .video-play .ico{width: 30px; height: 30px; margin-left: 4px;}
		.home-proof .video-caption{right: 20px; bottom: 20px; left: 20px; gap: var(--space-1);}
		.home-proof .video-sub{font-size: var(--card-note);}
		.home-proof .proof-quote{gap: 20px; min-height: 0; padding: 28px var(--space-5); border-radius: var(--radius-lg);}
		.home-proof .quote-mark{height: 44px;}
		.home-proof .quote-text{line-height: 1.22;}
		.home-proof .quote-author{gap: var(--space-3);}
		.home-proof .proof-quote .avatar{width: 48px; height: 48px;}
		.home-proof .proof-quote .author-name{font-size: var(--ui);}
		.home-proof .proof-quote .author-role{font-size: var(--xs);}
		.home-proof .proof-chat{min-height: 0; border-radius: var(--radius-lg);}
		.home-proof .chat-head{padding: 14px var(--space-4);}
		.home-proof .chat-head .avatar{width: 38px; height: 38px; font-size: var(--xxs);}
		.home-proof .chat-name{font-size: var(--card-note);}
		.home-proof .chat-body{gap: var(--space-2); padding: var(--space-4);}
		.home-proof .chat-message{max-width: 86%; padding: 9px 13px; font-size: var(--ui);}
		.home-proof .chat-sent{border-radius: var(--space-4) var(--space-4) var(--space-1) var(--space-4);}
		.home-proof .chat-received{border-radius: var(--space-4) var(--space-4) var(--space-4) var(--space-1);}
		.home-proof .chat-time{display: none;}
		.home-proof .chat-caption{padding: var(--space-3) var(--space-4);}
		.home-proof .proof-review{min-height: 0; gap: 14px; padding: var(--space-5);}
		.home-proof .review-foot, .home-proof .review-author{gap: 10px;}
		.home-proof .review-tag{height: 28px;}
		.home-proof .stories-head{align-items: center; gap: var(--space-3);}
		.home-proof .stories-actions{gap: var(--space-2);}
		.home-proof .stories-actions .button{display: none;}
		.home-proof .stories-arrows{gap: var(--space-2);}
		.home-proof .stories-arrow{width: 48px; height: 48px;}
		.home-proof .stories-track{margin-top: 20px;}
		.home-proof .stories-list{gap: var(--space-3);}
		.home-proof .story-card{width: 300px; border-radius: var(--radius-lg);}
		.home-proof .story-head{height: 150px; padding: 18px 22px;}
		.home-proof .story-curve{height: 80px;}
		.home-proof .story-body{gap: var(--space-3); padding: 22px 22px var(--space-5);}
		.home-proof .stories-progress{display: none;}
		.home-proof .stories-dots{display: flex;}
		.home-proof .proof-logos{gap: 20px; padding-top: 28px;}
		.home-proof .logos-label{font-size: var(--xs); line-height: 1.55;}
		.home-proof .logos-list{grid-template-columns: repeat(2, minmax(0, 1fr));}
	}

</style>

<section class="home-proof" id="proof">
	<div class="content-width">

		<?php if (section_field('crb_proof_eyebrow') || section_field('crb_proof_title') || section_field('crb_proof_stars') || section_field('crb_proof_rating_text') || section_field('crb_proof_text')) { ?>
			<div class="proof-head fade-from-bottom">

				<?php if (section_field('crb_proof_eyebrow') || section_field('crb_proof_title')) { ?>
					<div class="proof-intro">
						<?php if (section_field('crb_proof_eyebrow')) { ?>
							<span class="pill"><?= section_field('crb_proof_eyebrow'); ?></span>
						<?php } ?>
						<?php if (section_field('crb_proof_title')) { ?>
							<h2 class="proof-title"><?= nl2br(section_field('crb_proof_title')); ?></h2>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (section_field('crb_proof_stars') || section_field('crb_proof_rating_text') || section_field('crb_proof_text')) { ?>
					<div class="proof-side">
						<?php if (section_field('crb_proof_stars') || section_field('crb_proof_rating_text')) { ?>
							<div class="proof-rating">
								<?php if (section_field('crb_proof_stars')) { ?>
									<span class="stars" role="img" aria-label="5 out of 5 stars"><?= str_repeat(theme_icon('star'), 5); ?></span>
								<?php } ?>
								<?php if (section_field('crb_proof_rating_text')) { ?>
									<span class="rating-text"><?= section_field('crb_proof_rating_text'); ?></span>
								<?php } ?>
							</div>
						<?php } ?>
						<?php if (section_field('crb_proof_text')) { ?>
							<p class="lead"><?= section_field('crb_proof_text'); ?></p>
						<?php } ?>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (filled_rows(section_field('crb_proof_stats'), 'number')) { ?>
			<div class="proof-stats">
				<?php foreach (filled_rows(section_field('crb_proof_stats'), 'number') as $stat) { ?>
					<div class="stat fade-from-bottom">
						<div class="stat-number count"><?= $stat['number']; ?></div>
						<?php if (is_filled($stat['label'] ?? '')) { ?>
							<div class="stat-label"><?= $stat['label']; ?></div>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
		<?php } ?>

		<?php if (section_field('crb_proof_video_image') || section_field('crb_proof_video_label') || section_field('crb_proof_video_title') || section_field('crb_proof_video_caption') || section_field('crb_proof_video_file') || section_field('crb_proof_video_url') || section_field('crb_proof_quote_text') || filled_rows(section_field('crb_proof_chat_messages'), 'text') || filled_rows(section_field('crb_proof_reviews'), 'text')) { ?>
			<div class="proof-grid">

				<?php if (section_field('crb_proof_video_image') || section_field('crb_proof_video_label') || section_field('crb_proof_video_title') || section_field('crb_proof_video_caption') || section_field('crb_proof_video_file') || section_field('crb_proof_video_url') || section_field('crb_proof_quote_text') || filled_rows(section_field('crb_proof_chat_messages'), 'text')) { ?>
					<div class="proof-feature">

						<?php if (section_field('crb_proof_video_image') || section_field('crb_proof_video_label') || section_field('crb_proof_video_title') || section_field('crb_proof_video_caption') || section_field('crb_proof_video_file') || section_field('crb_proof_video_url')) { ?>
							<article class="proof-video fade-from-bottom">
								<?php if (section_field('crb_proof_video_image')) { ?>
									<img class="absolute-cover" src="<?= section_field('crb_proof_video_image'); ?>" alt="">
								<?php } ?>
								<?php if (section_field('crb_proof_video_label')) { ?>
									<span class="pill glass video-label"><?= theme_icon('video'); ?><?= section_field('crb_proof_video_label'); ?></span>
								<?php } ?>
								<?php if (section_field('crb_proof_video_file') || section_field('crb_proof_video_url')) { ?>
									<a class="video-play" href="<?= section_field('crb_proof_video_file') ?: section_field('crb_proof_video_url'); ?>" target="_blank" rel="noopener" aria-label="Play video testimonial"><?= theme_icon('play'); ?></a>
								<?php } ?>
								<?php if (section_field('crb_proof_video_title') || section_field('crb_proof_video_caption')) { ?>
									<div class="video-caption">
										<?php if (section_field('crb_proof_video_title')) { ?>
											<h3 class="video-title"><?= section_field('crb_proof_video_title'); ?></h3>
										<?php } ?>
										<?php if (section_field('crb_proof_video_caption')) { ?>
											<p class="video-sub"><?= section_field('crb_proof_video_caption'); ?></p>
										<?php } ?>
									</div>
								<?php } ?>
							</article>
						<?php } ?>

						<?php if (section_field('crb_proof_quote_text')) { ?>
							<article class="proof-quote fade-from-bottom">
								<div class="quote-mark" aria-hidden="true">“</div>
								<p class="quote-text"><?= section_field('crb_proof_quote_text'); ?></p>
								<?php if (section_field('crb_proof_quote_initials') || section_field('crb_proof_quote_name') || section_field('crb_proof_quote_role')) { ?>
									<div class="quote-author">
										<?php if (section_field('crb_proof_quote_initials')) { ?>
											<span class="avatar"><?= section_field('crb_proof_quote_initials'); ?></span>
										<?php } ?>
										<?php if (section_field('crb_proof_quote_name') || section_field('crb_proof_quote_role')) { ?>
											<div class="author-copy">
												<?php if (section_field('crb_proof_quote_name')) { ?>
													<span class="author-name"><?= section_field('crb_proof_quote_name'); ?></span>
												<?php } ?>
												<?php if (section_field('crb_proof_quote_role')) { ?>
													<span class="author-role"><?= section_field('crb_proof_quote_role'); ?></span>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
							</article>
						<?php } ?>

						<?php if (filled_rows(section_field('crb_proof_chat_messages'), 'text')) { ?>
							<article class="proof-chat fade-from-bottom">
								<?php if (section_field('crb_proof_chat_initials') || section_field('crb_proof_chat_name') || section_field('crb_proof_chat_status')) { ?>
									<div class="chat-head">
										<?php if (section_field('crb_proof_chat_initials')) { ?>
											<span class="avatar"><?= section_field('crb_proof_chat_initials'); ?></span>
										<?php } ?>
										<?php if (section_field('crb_proof_chat_name') || section_field('crb_proof_chat_status')) { ?>
											<div class="chat-who">
												<?php if (section_field('crb_proof_chat_name')) { ?>
													<span class="chat-name"><?= section_field('crb_proof_chat_name'); ?></span>
												<?php } ?>
												<?php if (section_field('crb_proof_chat_status')) { ?>
													<span class="chat-status"><?= section_field('crb_proof_chat_status'); ?></span>
												<?php } ?>
											</div>
										<?php } ?>
									</div>
								<?php } ?>
								<div class="chat-body">
									<?php foreach (filled_rows(section_field('crb_proof_chat_messages'), 'text') as $message) { ?>
										<div class="chat-message <?= ($message['side'] ?? '') === 'sent' ? 'chat-sent' : 'chat-received'; ?>">
											<?= $message['text']; ?>
											<?php if (is_filled($message['time'] ?? '')) { ?>
												<span class="chat-time"><?= $message['time']; ?></span>
											<?php } ?>
										</div>
									<?php } ?>
								</div>
								<?php if (section_field('crb_proof_chat_caption')) { ?>
									<p class="chat-caption"><?= section_field('crb_proof_chat_caption'); ?></p>
								<?php } ?>
							</article>
						<?php } ?>

					</div>
				<?php } ?>

				<?php if (filled_rows(section_field('crb_proof_reviews'), 'text')) { ?>
					<div class="proof-reviews">
						<?php foreach (filled_rows(section_field('crb_proof_reviews'), 'text') as $review) { ?>
							<article class="proof-review fade-from-bottom">
								<?php if ((int) ($review['stars'] ?? 0) > 0) { ?>
									<span class="stars" role="img" aria-label="<?= (int) $review['stars']; ?> out of 5 stars"><?= str_repeat(theme_icon('star'), (int) $review['stars']); ?></span>
								<?php } ?>
								<p class="review-text"><?= $review['text']; ?></p>
								<?php if (is_filled($review['name'] ?? '') || is_filled($review['tag'] ?? '')) { ?>
									<div class="review-foot">
										<?php if (is_filled($review['name'] ?? '')) { ?>
											<div class="review-author">
												<?php if (is_filled($review['initials'] ?? '')) { ?>
													<span class="avatar"><?= $review['initials']; ?></span>
												<?php } ?>
												<div class="author-copy">
													<span class="author-name"><?= $review['name']; ?></span>
													<?php if (is_filled($review['role'] ?? '')) { ?>
														<span class="author-role"><?= $review['role']; ?></span>
													<?php } ?>
												</div>
											</div>
										<?php } ?>
										<?php if (is_filled($review['tag'] ?? '')) { ?>
											<span class="pill review-tag"><?= $review['tag']; ?></span>
										<?php } ?>
									</div>
								<?php } ?>
							</article>
						<?php } ?>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (section_field('crb_proof_stories_title') || (section_field('crb_proof_stories_button_text') && section_field('crb_proof_stories_button_url')) || filled_rows(section_field('crb_proof_stories'), 'title')) { ?>
			<div class="proof-stories">

				<?php if (section_field('crb_proof_stories_title') || (section_field('crb_proof_stories_button_text') && section_field('crb_proof_stories_button_url')) || filled_rows(section_field('crb_proof_stories'), 'title')) { ?>
					<div class="stories-head fade-from-bottom">
						<?php if (section_field('crb_proof_stories_title')) { ?>
							<h3 class="stories-title"><?= section_field('crb_proof_stories_title'); ?></h3>
						<?php } ?>
						<?php if ((section_field('crb_proof_stories_button_text') && section_field('crb_proof_stories_button_url')) || filled_rows(section_field('crb_proof_stories'), 'title')) { ?>
							<div class="stories-actions">
								<?php if (section_field('crb_proof_stories_button_text') && section_field('crb_proof_stories_button_url')) { ?>
									<a class="button secondary small" href="<?= section_field('crb_proof_stories_button_url'); ?>"><?= section_field('crb_proof_stories_button_text'); ?><?= theme_icon('arrow-ur'); ?></a>
								<?php } ?>
								<?php if (filled_rows(section_field('crb_proof_stories'), 'title')) { ?>
									<div class="stories-arrows">
										<button type="button" class="icon-btn stories-arrow is-prev" aria-label="Previous case study" disabled><?= theme_icon('arrow-r'); ?></button>
										<button type="button" class="icon-btn stories-arrow is-next" aria-label="Next case study"><?= theme_icon('arrow-r'); ?></button>
									</div>
								<?php } ?>
							</div>
						<?php } ?>
					</div>
				<?php } ?>

				<?php if (filled_rows(section_field('crb_proof_stories'), 'title')) { ?>
					<div class="stories-track" role="region" aria-label="Case studies">
						<div class="stories-list">
							<?php foreach (filled_rows(section_field('crb_proof_stories'), 'title') as $index => $story) { ?>
								<article class="story-card<?= is_rising($story['before'] ?? '', $story['after'] ?? '') ? ' rising' : ''; ?>">

									<?php if (is_filled($story['before'] ?? '') || is_filled($story['after'] ?? '')) { ?>
										<div class="story-head">
											<svg class="story-curve" viewBox="0 0 300 100" preserveAspectRatio="none" aria-hidden="true" focusable="false">
												<path class="story-area" d="<?= story_curve($index); ?>V100H0Z"/>
												<path class="story-line" d="<?= story_curve($index); ?>"/>
											</svg>
											<div class="story-values">
												<?php if (is_filled($story['before'] ?? '')) { ?>
													<div class="story-before">
														<?php if (section_field('crb_proof_stories_before_label')) { ?>
															<span class="story-label"><?= section_field('crb_proof_stories_before_label'); ?></span>
														<?php } ?>
														<span class="story-value count"><?= $story['before']; ?></span>
													</div>
												<?php } ?>
												<?php if (is_filled($story['after'] ?? '')) { ?>
													<div class="story-after">
														<?php if (section_field('crb_proof_stories_after_label')) { ?>
															<span class="story-label"><?= section_field('crb_proof_stories_after_label'); ?></span>
														<?php } ?>
														<span class="story-value count"><?= $story['after']; ?></span>
													</div>
												<?php } ?>
											</div>
										</div>
									<?php } ?>

									<div class="story-body">
										<?php if (text_lines($story['tags'] ?? '')) { ?>
											<div class="story-tags">
												<?php foreach (text_lines($story['tags']) as $tag) { ?>
													<span class="pill"><?= $tag; ?></span>
												<?php } ?>
											</div>
										<?php } ?>
										<h4 class="story-title"><?= $story['title']; ?></h4>
										<?php if (is_filled($story['text'] ?? '')) { ?>
											<p class="story-text"><?= $story['text']; ?></p>
										<?php } ?>
										<?php if (section_field('crb_proof_stories_link_text') && is_filled($story['url'] ?? '')) { ?>
											<a class="story-link" href="<?= $story['url']; ?>"><?= section_field('crb_proof_stories_link_text'); ?><?= theme_icon('arrow-r'); ?></a>
										<?php } ?>
									</div>

								</article>
							<?php } ?>
						</div>
					</div>

					<div class="stories-progress" style="--count: <?= count(filled_rows(section_field('crb_proof_stories'), 'title')); ?>" aria-hidden="true">
						<span class="progress-count">01 / <?= sprintf('%02d', count(filled_rows(section_field('crb_proof_stories'), 'title'))); ?></span>
						<span class="progress-track"><span class="progress-fill"></span></span>
					</div>
					<div class="stories-dots" aria-hidden="true">
						<?php foreach (filled_rows(section_field('crb_proof_stories'), 'title') as $index => $story) { ?>
							<span<?= $index === 0 ? ' class="is-active"' : ''; ?>></span>
						<?php } ?>
					</div>
				<?php } ?>

			</div>
		<?php } ?>

		<?php if (section_field('crb_proof_logos_label') || filled_rows(section_field('crb_proof_logos'), 'name')) { ?>
			<div class="proof-logos fade-from-bottom">
				<?php if (section_field('crb_proof_logos_label')) { ?>
					<p class="logos-label"><?= section_field('crb_proof_logos_label'); ?></p>
				<?php } ?>
				<?php if (filled_rows(section_field('crb_proof_logos'), 'name')) { ?>
					<ul class="logos-list">
						<?php foreach (filled_rows(section_field('crb_proof_logos'), 'name') as $logo) { ?>
							<li class="logo-item">
								<?php if (is_filled($logo['logo'] ?? '')) { ?>
									<img class="logo-image" src="<?= $logo['logo']; ?>" alt="<?= $logo['name']; ?>">
								<?php } else { ?>
									<span class="logo-name"><?= $logo['name']; ?></span>
								<?php } ?>
							</li>
						<?php } ?>
					</ul>
				<?php } ?>
			</div>
		<?php } ?>

	</div>
</section>

<?php if (section_field('crb_proof_video_file') || section_field('crb_proof_video_url')) { ?>
	<div class="proof-modal" role="dialog" aria-modal="true" aria-label="Video" hidden>
		<button type="button" class="modal-close" aria-label="Close video"><?= theme_icon('close'); ?></button>
		<div class="modal-frame"></div>
	</div>
<?php } ?>

<script>
	(function() {
		let section = document.querySelector(".home-proof");
		if (!section) {
			return;
		}
		let reducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

		/*NUMBERS - each one counts up from zero the first time it is seen, and ends on the author's exact text. The first number in the text is the one that counts and whatever surrounds it stays (a sign, a unit, a plus). A space, or a comma before exactly three digits, groups thousands ("1,200", "1 200") and any other comma is a decimal point ("12,4", "0,125"), the way first_number() reads it in PHP.*/
		let counters = new Map();

		function formatCounter(counter, value) {
			let parts = value.toFixed(counter.decimals).split(".");
			if (counter.group) {
				parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, counter.group);
			}
			return counter.prefix + parts.join(counter.separator) + counter.suffix;
		}

		function countUp(element) {
			let counter = counters.get(element);
			let startedAt = performance.now();

			function step(now) {
				let progress = Math.min((now - startedAt) / 1400, 1);
				if (progress === 1) {
					element.textContent = counter.original;
					return;
				}
				element.textContent = formatCounter(counter, counter.target * (1 - Math.pow(1 - progress, 3)));
				requestAnimationFrame(step);
			}

			requestAnimationFrame(step);
		}

		if ("IntersectionObserver" in window && !reducedMotion) {
			let seen = new IntersectionObserver(function(entries) {
				entries.forEach(function(entry) {
					if (entry.isIntersecting) {
						seen.unobserve(entry.target);
						countUp(entry.target);
					}
				});
			}, {threshold: .6});

			/*Start every number from zero before it is seen, so nothing flashes its final value first*/
			section.querySelectorAll(".count").forEach(function(element) {
				let text = element.textContent;
				let match = text.match(/(\d+)((?:[,\s  ]\d{3}(?!\d))*)(?:([.,])(\d+))?/);
				if (match && match[1] === "0" && match[2]) {
					match = text.match(/(\d+)()(?:([.,])(\d+))?/);
				}
				if (!match) {
					return;
				}
				let counter = {
					original: text,
					target: parseFloat(match[1] + match[2].replace(/\D/g, "") + (match[4] ? "." + match[4] : "")),
					decimals: match[4] ? match[4].length : 0,
					separator: match[3] || ".",
					group: match[2] ? match[2].charAt(0) : "",
					prefix: text.slice(0, match.index),
					suffix: text.slice(match.index + match[0].length)
				};
				counters.set(element, counter);
				element.textContent = formatCounter(counter, 0);
				seen.observe(element);
			});
		}

		/*CASE STUDIES - the track is a plain scroller, so a swipe or a trackpad works as it is. The arrows, the counter and the dots follow it: the counter runs from the first card to the last as the track runs from its start to its end, and everything hides when every card already fits.*/
		let stories = section.querySelector(".proof-stories");
		let track = stories ? stories.querySelector(".stories-track") : null;
		if (track) {
			let cards = track.querySelectorAll(".story-card");
			let prev = stories.querySelector(".is-prev");
			let next = stories.querySelector(".is-next");
			let position = stories.querySelector(".progress-count");
			let fill = stories.querySelector(".progress-fill");
			let dots = stories.querySelectorAll(".stories-dots span");
			let pending = false;

			function pad(number) {
				return String(number).padStart(2, "0");
			}

			function update() {
				pending = false;
				let end = track.scrollWidth - track.clientWidth;
				let current = end > 1 ? 1 + Math.round(track.scrollLeft / end * (cards.length - 1)) : 1;
				stories.classList.toggle("no-scroll", end <= 1);
				prev.disabled = track.scrollLeft <= 1;
				next.disabled = track.scrollLeft >= end - 1;
				position.textContent = pad(current) + " / " + pad(cards.length);
				fill.style.width = current / cards.length * 100 + "%";
				dots.forEach(function(dot, index) {
					dot.classList.toggle("is-active", index === current - 1);
				});
			}

			function schedule() {
				if (!pending) {
					pending = true;
					requestAnimationFrame(update);
				}
			}

			function move(direction) {
				let gap = parseFloat(getComputedStyle(cards[0].parentNode).columnGap) || 0;
				track.scrollBy({left: direction * (cards[0].offsetWidth + gap), behavior: reducedMotion ? "auto" : "smooth"});
			}

			prev.addEventListener("click", function() {
				move(-1);
			});
			next.addEventListener("click", function() {
				move(1);
			});
			track.addEventListener("scroll", schedule, {passive: true});
			window.addEventListener("resize", schedule);
			update();
		}

		/*VIDEO POPUP - the play link is a real link to the video, so it still works without this script. A YouTube page becomes its embed and a video file a <video>; any other address is left to the link, which opens it in a new tab. The player is made when the popup opens and removed when it closes, which is what stops it playing.*/
		let modal = document.querySelector(".proof-modal");
		let plays = section.querySelectorAll(".video-play");
		if (modal && plays.length) {
			document.body.appendChild(modal);
			let frame = modal.querySelector(".modal-frame");
			let close = modal.querySelector(".modal-close");
			let opener = null;

			function makePlayer(address) {
				let youtube = address.match(/(?:youtube(?:-nocookie)?\.com\/(?:watch\?(?:[^#]*&)?v=|embed\/|shorts\/|live\/|v\/)|youtu\.be\/)([\w-]{11})/);
				if (youtube) {
					let time = address.match(/[?&#](?:t|start)=(?:(\d+)h)?(?:(\d+)m)?(\d+)?s?(?=&|#|$)/);
					let start = time ? (+time[1] || 0) * 3600 + (+time[2] || 0) * 60 + (+time[3] || 0) : 0;
					let player = document.createElement("iframe");
					player.src = "https://www.youtube-nocookie.com/embed/" + youtube[1] + "?autoplay=1&rel=0&playsinline=1" + (start ? "&start=" + start : "");
					player.allow = "autoplay; encrypted-media; picture-in-picture; fullscreen";
					player.allowFullscreen = true;
					player.title = "Video";
					return player;
				}
				if (/\.(mp4|webm|ogv|ogg|mov|m4v)(?:[?#].*)?$/i.test(address)) {
					let player = document.createElement("video");
					player.src = address;
					player.controls = true;
					player.autoplay = true;
					player.playsInline = true;
					return player;
				}
				return null;
			}

			function openModal(link) {
				let player = makePlayer(link.href);
				if (!player) {
					return false;
				}
				opener = link;
				frame.appendChild(player);
				modal.hidden = false;
				document.documentElement.classList.add("proof-modal-open");
				close.focus();
				return true;
			}

			function closeModal() {
				if (modal.hidden) {
					return;
				}
				let player = frame.querySelector("video");
				if (player) {
					player.pause();
				}
				frame.textContent = "";
				modal.hidden = true;
				document.documentElement.classList.remove("proof-modal-open");
				if (opener) {
					opener.focus();
				}
			}

			plays.forEach(function(link) {
				link.addEventListener("click", function(event) {
					if (openModal(link)) {
						event.preventDefault();
					}
				});
			});
			close.addEventListener("click", closeModal);
			modal.addEventListener("click", function(event) {
				if (event.target === modal) {
					closeModal();
				}
			});

			/*Escape closes it, and Tab stays inside: between the close button and the player*/
			document.addEventListener("keydown", function(event) {
				if (modal.hidden) {
					return;
				}
				if (event.key === "Escape") {
					closeModal();
					return;
				}
				if (event.key === "Tab") {
					let stops = modal.querySelectorAll("button, iframe, video");
					let first = stops[0];
					let last = stops[stops.length - 1];
					if (event.shiftKey && document.activeElement === first) {
						last.focus();
						event.preventDefault();
					} else if (!event.shiftKey && document.activeElement === last) {
						first.focus();
						event.preventDefault();
					}
				}
			});
		}
	})();
</script>
