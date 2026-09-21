# YK4 Single Page — theme guide for AI agents


A classic (non-block) WordPress starter theme for **single-page sites**. It ships with no design of its own: the look is deliberately modern and minimal, and the theme is reused as the starting point for new projects, so nothing project-specific belongs in it.

A multi-page sibling theme exists separately. Keep this one focused on one-page layouts.

## Mental model

A page is assembled from **sections**. One section = one PHP file = one shortcode. The client puts shortcodes into the page content, and every section renders its own markup, its own CSS and its own fields. Nothing about the layout is editable from the WordPress editor, which is the point: the client edits text and images, never markup.

A section is inserted from the block inserter (category **Page Sections**). A section with fields is a **Carbon Fields block**: the fields are edited inside the block itself, and the block renders by running the section's shortcode. There is no Page Sections metabox and no section field stored as post meta (Custom Fields): a block keeps its values in the page content. A section with no fields yet is still in the inserter, and its block tells the builder to *add the required fields to the theme to display and edit them in the WordPress admin and on the website*. *Registered shortcodes* says which sections are which. `home_banner` (the hero) is the reference; the rest follow the same pattern as they are rebuilt from the design.

The **site header and footer are not sections**: they are `header.php` and `footer.php`, on every page, and they read **Theme Options** (contact details, the logo, the header button, the footer) and the menus assigned in Appearance > Menus. See *Theme Options and menus*.

```
page content:  [home_banner]  [home_about]  [home_services]  ...
                     |              |              |
template-parts/sections/home/home-banner.php   (markup + <style> + fields)
```



## File map


| Path                                                              | Role                                                                                                                                                                                              |
| ----------------------------------------------------------------- | ------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------- |
| `style.css`                                                       | Theme header only. **No styles here.**                                                                                                                                                            |
| `theme-styles.php`                                                | Document level CSS: reset, typography, forms, the **site header**, footer, animations. Printed inline in `wp_head` so WordPress never serves a stale cached copy. Tokens and shared components are in `includes/css/design-system.css`. |
| `functions.php`                                                   | Theme supports, Carbon Fields boot, `admin_text()`, `section_field()` and the section block helpers, `theme_icon()` and `theme_icon_options()` (the options of an icon picker field), palette, performance filters.                                                                |
| `includes/css/design-system.css`                                  | **The design tokens and the shared section components** (buttons, pills, glass, icons, content width). Printed inline by `theme-styles.php` and loaded into the block editor canvas, so a block previews with the tokens it ships with. |
| `includes/theme-options.php`                                      | The **Theme Options** admin page: one Carbon Fields container with tabs Contact Information, Header and Footer.                                                                                  |
| `includes/admin-translations.php`                                 | The **Ukrainian admin text**, keyed by the English text written in the code. `admin_text()` in `functions.php` reads it when the site language is Ukrainian. |
| `includes/section-blocks.php`                                     | One Carbon Fields `Block` per section that has fields: its fields, its placeholder content as field defaults, and its render callback. **The only place fields are defined for a section.** |
| `includes/editor-sections.php`                                    | The **Page Sections** inserter category: title, description and wireframe icon of every section, the single-instance rule, the canvas styles for block previews, and the placeholder block (with the *add the required fields* message) of a section that has no fields yet. |
| `shortcodes.php`                                                  | Registers one shortcode per section.                                                                                                                                                              |
| `includes/theme-changes.php`                                      | Global vanilla JS: lazy loading, scroll animations, and the site header (burger menu, solid state on scroll, menu highlight). Hooked to `wp_footer`.                                              |
| `template-parts/sections/home/*.php`                              | The 15 home sections. `home-banner.php` and `home-audience.php` (Who it's for) are built. The other thirteen are empty stubs waiting for their fields. |
| `template-parts/pages/<page>/*.php`                               | Sections belonging to one inner page rather than to the home page. `about/section-about-rev.php` is the About page's take on the About section: block `about_rev`, fields `crb_about_rev_*`. |
| `header.php` / `footer.php`                                       | The **site header** (logo, centered menu, phone icon, floating over the hero) and the footer. Both read Theme Options and the Header / Footer menus, and print every part only when it is filled in. |
| `index.php`, `archive.php`, `search.php`, `single.php`, `404.php` | Blog fallbacks. `blog-styles.php` and `single-blog-styles.php` hold their CSS.                                                                                                                    |
| `fonts/`                                                          | Self-hosted, one subfolder per family: `bricolage-grotesque/` (heading and display, variable 400–700, latin + latin-ext + vietnamese), `urbanist/` (body, variable 300–700, latin + latin-ext) and `manrope/` (variable 400–700, the **Cyrillic fallback**: neither design font has Cyrillic, so Ukrainian text falls through to it). `site-fonts.css` declares all `@font-face` rules. Nothing is fetched from Google at runtime. `space-grotesk/` and `jetbrains-mono/` are left over from the previous look, no longer declared anywhere, and safe to delete. |
| `images/`                                                         | Default images shipped with the theme, used as the fallback when an image field is empty. Reference them with `get_template_directory_uri() . '/images/<file>'` as the `section_field()` default. |
| `vendor/`                                                         | Carbon Fields, installed with composer. Must ship inside the theme zip.                                                                                                                           |




## Registered shortcodes

`home_banner`, `home_audience`, `home_services`, `home_about`, `home_team`, `home_cta`, `home_results`, `home_testimonials`, `home_social`, `home_news`, `home_contact`, `home_mission`, `home_pricing`, `home_portfolio`, `home_faq`, `about_rev`

**With fields (a Carbon Fields block in `includes/section-blocks.php`):** `home_banner`, `home_audience`, `about_rev`.

**Without fields yet:** the other thirteen. Their template is an empty stub, and in the editor their block shows *Add the required fields to the theme to display and edit them in the WordPress admin and on the website.* A section stops being one of these the moment a `Block::make()` exists for its tag: the inserter, the block name (`yk4/home-x` becomes `carbon-fields/home-x`) and the single-instance rule follow the block registry, nothing else is switched by hand. A page that already holds the old placeholder block of a section that then gets fields shows it as an unsupported block until it is replaced, though the front end keeps rendering the shortcode.

## Writing a section

Follow `home-banner.php` as the reference. Structure is always: `<style>` block first, markup second.

```php
<style type="text/css">
	.home-example{position: relative; padding: 60px 0; background: var(--color-surface);}
	.home-example h2{margin: 0 0 20px;}
	@media(max-width: 750px){
		.home-example{padding: 40px 0;}
	}
</style>

<section class="home-example" id="example">
	<div class="content-width">
		<h2 class="fade-from-bottom"><?= section_field('crb_example_title'); ?></h2>
	</div>
</section>
```

Hard rules:

- **CSS lives in the section file**, inside a `<style>` block placed **before** the markup.
- **One rule per line.** Never break a rule across lines — `.class { prop: value; prop: value; }` on a single line.
- **Reuse the root variables.** Never introduce a new font family, font size or colour in a section.
- **Never override global typography** (`p`, `h2`, `h3`, …) or the `.button` classes. Scope everything under the section's own class.
- **Breakpoints are only** `max-width: 750px` **and** `max-width: 1000px`**.** One deliberate exception: the hero header measures itself with a container query (`@container`, see `home-banner.php`) because its pills stop fitting at widths no fixed breakpoint predicts. Reach for that only when a component's width depends on its content, never to add a third viewport breakpoint. Height based `clamp()` on vertical spacing is fine.
- **Card grids size themselves to the number of cards.** Hold the track count in a `--columns` custom property and let quantity queries change it, so the grid reacts to what actually rendered rather than to how many fields exist:

```css
.home-x .x-grid{--columns: 4; display: grid; grid-template-columns: repeat(var(--columns), 1fr); gap: 24px;}
.home-x .x-grid:where(:has(> :nth-child(1):nth-last-child(2))){--columns: 2;}
.home-x .x-grid:where(:has(> :nth-child(1):nth-last-child(3n))){--columns: 3;}
.home-x .x-grid:where(:has(> :nth-child(1):nth-last-child(4n))){--columns: 4;}
@media(max-width: 1000px){
    .home-x .x-grid{--columns: 2;}
}
```

  `:nth-child(1):nth-last-child(n)` matches the first child only when the list is exactly that long, so the rule reads as "when there are n cards". The `:where()` is load bearing: without it `:has()` would push these rules to a higher specificity than the breakpoints below and the responsive columns would silently stop working. All the quantity rules therefore tie on specificity and the last match wins, which is why `3n` is written before `4n` — twelve cards land on four. Browsers without `:has()` simply keep the default column count. Grids of three use only the `2` and `4` rules (four cards read better as 2+2 than 3+1). `home_audience` is the reference for one: its `2` and `4n` rules both set two columns and a closing `3n` rule sets three again, so twelve cards do not land on two.

- **No BEM.** Short readable classes: `.team-member`, `.member-info`.
- **No localization of the page** — no `__()`, `_e()`, no text domains. Text on the page is hardcoded English. The admin panel is the one exception, see *Admin panel language*.
- **No escaping** — no `esc_html()`, `esc_attr()`, `esc_url()`.
- **Keep templates flat.** Do not declare PHP variables above the markup; call `section_field()` inline.
- **Guard every element** with `if(section_field('crb_x'))`. An empty field is how the client hides something. The placeholder copy is the field's default in `includes/section-blocks.php`, never a second copy in the template.
- **Print nothing for an empty field, wrapper included.** No empty `<div>`, no `href=""`, no heading over an empty list. A link or button needs both its text and its address to show. Test a wrapper on its content (`if(filled_rows(...))`, `if($a || $b)`), not on its existence. Use `is_filled()` instead of a plain `if()` where `0` is a real value (a count, a percentage).
- Add an animation class (`fade-in`, `fade-from-left`, `fade-from-right`, `fade-from-bottom`) to visual elements. A scroll script adds `.active` at 85% of the viewport; animations are disabled under 750px.
- Give the outer `<section>` an `id` so the anchor menu can reach it. `scroll-margin-top` is already handled globally.

Registering it in `shortcodes.php`:

```php
function home_example($atts, $content=null){
	ob_start();
	include(locate_template('template-parts/sections/home/home-example.php'));
	return ob_get_clean();
}
add_shortcode('home_example', 'home_example');
```



## Writing a block section

A block section is the same section file plus three things: a Carbon Fields `Block`, a row in the inserter list and a render through the shortcode. `home_banner` is the reference, `about_rev` the second one (tabs, a select, stats) and `home_audience` the third (two repeaters, an icon select, a card grid that sizes itself to its cards).

1. **Fields** go in `includes/section-blocks.php`, with every label, tab name and help text in `admin_text()`, as `Block::make('home_x', 'Title')` with `->add_tab()` per group of fields (a hero has dozens, so tabs are not optional), `->set_mode('both')` (form by default, Preview toggle in the toolbar) and `->set_render_callback(function ($fields) { echo render_section_block('home_x', $fields); })`. The id is the shortcode tag, which is what makes the block name `carbon-fields/home-x`.
2. **Placeholder content is the field default.** Every field gets `->set_default_value()` with the design's text: Lorem ipsum for copy, real labels for buttons and navigation, images from `images/`. The block is filled the moment it is inserted, and this is the only place the placeholder copy is written.
3. **Templates call `section_field('crb_x_y')` with no default.** `render_section_block()` puts the block's values in scope (merged over the defaults, so a field added later shows its placeholder instead of nothing), and `[home_x]` typed by hand renders the defaults. An emptied field returns `''`, so the `if(section_field(...))` guards still hide elements.
4. **Inserter row.** Every section already has a row in `yk4_editor_sections()` in `includes/editor-sections.php`: a title, a description and an icon `shape`. Adding the `Block::make()` is what makes it a block, there is no flag to set. Draw a new wireframe in `yk4_section_icon_shapes()` if no existing one reads like the section: the icon has to look like the section in the inserter. The single-instance rule (`multiple: false`) is applied there too, because sections carry an anchor `id`. Do not use a `rich_text` field in a block (Carbon Fields has no block support for it): use a `textarea` and print it through `wpautop()`, as `about_rev` does for its body text.
5. **Fields use the `crb_<section>_<name>` names** like every other section. Repeaters are `complex` fields: give every default row a unique `_id` (the block editor removes rows by it) and call `->set_header_template()` after `add_fields()`.
6. **The Preview must look right, and as wide as the page.** Without a `theme.json` the editor caps every block at 840px, so `yk4_editor_canvas_css()` in `includes/editor-sections.php` lifts the cap for every native section block. Carbon Fields also sizes the images of a Preview to `height: auto`, so a full cover image needs its own `height: 100%` (see `.absolute-cover` in `home-banner.php`). The editor canvas only loads `includes/css/design-system.css`, not `theme-styles.php`, so a section sets its own `box-sizing`, base `font-family` and heading `font-family`, and never relies on a document level rule. `defined('REST_REQUEST') && REST_REQUEST` is true while the editor renders the preview, so add an `in-editor` class there and undo anything that only makes sense on the live page (a `position: fixed` header becomes absolute). Scripts do not run in the preview, so the markup must already show its final state, and never leave a `fade-*` element depending on JS to become visible.
7. **Images in a block go through `the_content` before shortcodes do**, so `filter_url()` turns their `src` into `data-url` for the lazy loader. Mark an image that is above the fold `loading="eager"` (add `fetchpriority="high"` to the largest) and it keeps its `src`.
8. **The header is global.** A section never prints a site header. `header.php` does, floating over whatever comes first, and `page_has_hero()` (true when the page holds `home_banner`) only decides the look: over the hero it is see-through and turns solid once the page scrolls, everywhere else it is solid from the start and `#main-content` starts below it. A hero-like section needs top padding for the header (`--header-height` is what it takes).
9. **The Preview / Edit toggle is saved with the page.** Carbon Fields keeps the mode in component state, so left alone every reload would reopen the block as the fields form. A click on the toggle now edits the page's post meta `_yk4_section_view_modes` (a JSON object of the sections switched away from their default, e.g. `{"carbon-fields/home-banner":"preview"}`, or an empty string), so the page turns dirty, the editor's Save / Update button lights up, and the choice is stored when it is pressed. Switching back to the saved mode clears the edit and the button goes off again. The edit is made with `undoIgnore`, so the toggle adds no undo step (a Ctrl+Z that flipped the attribute could not flip the block, which keeps its mode in state). It is meta and not a block attribute for exactly that reason: only a persistent block change makes the page dirty, and that one always lands in the undo history. On the next load `includes/editor-sections.php` prints the saved modes as `window.yk4SectionViewMode`, and `includes/js/editor-section-view-mode.js` writes them into the block's container definition in the `carbon-fields/blocks` store while it loads, before the editor mounts a block (the component reads its starting mode once, on mount). The same file registers, sanitises and prints the field (`yk4_register_section_view_modes_meta()`, pages only, `show_in_rest`); the JS builds the string sorted by block name, exactly as PHP stores it, because the editor compares the two to decide whether the page is dirty. A choice that is not saved is not kept across a reload. Nothing to add per section: every block with `->set_mode('both')` gets it. Do not restore a mode by clicking the toolbar button: the button only exists while the block is selected. Do not test against a real page's data: use a throwaway page in a rolled-back transaction.

Image fields with `->set_value_type('url')` and a default from `images/` show a thumbnail in the block thanks to `theme_image_field_preview()` in `functions.php`. Output stays unescaped like the rest of the theme, so only people who may edit pages should be able to add this block.

## Theme Options and menus

**Theme Options** is a top level admin page (`includes/theme-options.php`), one Carbon Fields `theme_options` container with `->set_layout('tabbed-horizontal')` and a tab per topic: **Contact Information** (phone, email, address, working hours, social links), **Header** (logo image and text, and an optional button) and **Footer** (description, legal links, legal information, copyright, newsletter form). Fields are named `crb_options_<name>`.

- **Read them only through** `theme_option('crb_options_x')`, never `carbon_get_theme_option()`. It returns the trimmed text, the rows of a repeater as an array, or `''`, and it caches. Repeaters go through `theme_option_rows($name, array('label', 'url'))`, which drops a row missing one of the subfields. `theme_phone_href()` builds the `tel:` link from the phone number and is empty when there are fewer than three digits. `theme_form($name)` expands a pasted form shortcode.
- **No demo mode and no defaults.** An option nobody filled in is absent from the page, and so is every wrapper, heading and attribute that depends on it. The one exception is the logo image and text, which carry the design's placeholder until the options are first saved (Carbon Fields returns a field's default only while its option has never been saved, so clearing the field and saving removes it).
- **The header** prints the logo, the menu and, on the right, **only a phone icon** that calls the number from Contact Information. The icon is absent when the phone is empty. The optional button (Header tab) needs both its text and its link, is empty by default, and when filled sits beside the phone icon (inside the folded menu on small screens). The old masthead's EN/UA switcher is gone, the new header has no room for it.
- **The footer** takes the logo from the Header tab, the contacts and social links from Contact Information and the rest from the Footer tab. Each column shows only when it has something in it, and the whole `<footer>` is left out when nothing is filled in. Its headings are interface text, in English and Ukrainian, printed only with their column.

**Menus are not fields.** They are made in Appearance > Menus. `register_nav_menus()` in `functions.php` registers two locations, **Header** and **Footer**, and WordPress turns them into the "Menu location" checkboxes under Menu Settings, on both the create and the edit screen of a menu. Print one with `theme_menu('header', 'header-menu')`, which returns `''` when no menu is assigned or the assigned menu is empty. Both menus are flat: `depth` is 1, so items nested under another are not shown. Header links may be anchors (`#pricing`) or `/#pricing`: the header highlights the section being read, and a link to a real page gets the WordPress `current-menu-item` class.

## Design tokens

All tokens live in `includes/css/design-system.css` on `:root`. That file is the single source: change a value there and every section follows. A section never hardcodes a colour, font size, radius or font family.

```
colours    --color-1 ink #0e1607 (text, dark surfaces)   --color-2 accent lime #e5f76a (highlights on dark)
           --color-3 muted #56604f   --color-bg #f3f5ef   --color-surface #e8eee0   --color-card #fff   --color-border #dde3d5
           --color-cta amber #f6c516 (the primary button, the one loud colour)   --color-green #2c7a2f / -deep #1e5a22 / --color-leaf #64b84a
           --color-ink-2 / -3 (raised dark surfaces)   --color-muted-dark (muted text on dark)   --color-inverse #fff
fonts      --heading-font Bricolage Grotesque   --default-font Urbanist   --accent-font = --default-font   (Manrope follows both for Cyrillic)
type       --xxl display (hero H1) 104   --xl h1 80   --lg h2 68   --md h3 32   --sm h4 22   --stat card numerals 40   --lead 20
           --card-title card h3 28   --card-text card copy 17   --card-note card foot line 15
           --default 18 (16 on a phone)   --ui 16   --xs 14   --xxs 12
           The display, heading and card steps are fluid clamp()s: the design value at 1440px, their floor on a phone.
spacing    --space-1..10 (4, 8, 12, 16, 24, 32, 48, 64, 96, 128)   --section-space   --gutter (page margin)   --grid-gap 24px
layout     --content-width 1440px (12 columns, 24px gutters, 64px margin)   --header-inset + --header-pill = --header-height (88 / 76 / 68)
radii      --radius-pill  --radius-xl 28  --radius-lg 24 (= --radius)  --radius-md 18  --radius-sm 12
glass      --glass-bg  --glass-line  --glass-blur  --glass-dark      --shadow      --transition      --z-header
```

Seven colours are editable by the client under Appearance > Customize > Colours: ink, accent, primary button, brand green, muted text, surface and hairlines. `theme_palette()` in `functions.php` is the single map of what is exposed; `palette_overrides()` prints a second `:root` block holding only the values that differ from the defaults, and the block editor canvas loads the same block, so a preview follows the client's palette too.

`--color-bg`, `--color-inverse`, `--color-on-accent` and `--color-on-cta` are deliberately not exposed. Flipping the page background needs the whole palette rethought, and the text colours on the accent and the button only make sense with light fills: if a client ever picked a dark one, the text on it would need to flip to `--color-inverse`, which is a design decision, not a colour swap.

The accent is light, so it is never a text colour on the page background or `--color-surface`. It is a background (with `--color-on-accent`), or an accent on a dark surface. Text and icons on light backgrounds use `--color-green`. Translucent overlays derive from the ink with `color-mix(in srgb, var(--color-1) 84%, transparent)`, so they follow the palette too; keep that for overlays and shadows, never for text or a background a reader looks at.

Shared components in the same file: `.button` (primary, amber pill) with `.secondary` (outline on light), `.ghost` (glass on dark), `.dark` and `.small`; `.pill` (and its older name `.eyebrow`) with `.dark`; `.glass` with `.dark-glass`; `.icon-btn`; `.ico`; `.lead`; `.content-width`; `.absolute-cover`. Icons come from `theme_icon('arrow-r')`, one inline SVG map in `functions.php` (currentColor, 24x24): size them with the section's own CSS.

## Utility classes to reuse

- `.content-width` — the centred 1440px container with gutters.
- `.section-padding` — the standard vertical rhythm between sections.
- `.surface` / `.dark` — light grey or ink background; `.dark` also flips heading colours.
- `.pill` — the outlined label above a heading (`.eyebrow` is the older name).
- `.lead` — larger muted intro paragraph. `.muted` — muted text.
- `.button` and its modifiers `.secondary`, `.ghost`, `.dark`, `.small`, wrapped in `.button-container` for a row of buttons.
- `.absolute-cover` — absolutely positioned, `object-fit: cover` fill; add `.flex` to centre children.
- `.fade-in`, `.fade-from-left`, `.fade-from-right`, `.fade-from-bottom`.



## Admin panel language

Everything the theme adds to the admin panel reads in **English or Ukrainian, by Settings > General > Site Language**: Ukrainian when it is `uk`, English for any other language. That covers field labels, tabs, help text and notes, container titles, block titles and descriptions, the Page Sections category, the menu locations, the Customizer colours and the strings of the editor script. It is not the language of the pages, which is `get_translation_data()`.

- Wrap the text in `admin_text('English text')`. The English text stays in the code and is the key, the Ukrainian sits in `includes/admin-translations.php`, grouped by where it is used. A text with no entry stays English instead of breaking.
- A text that carries a link or a number is `sprintf(admin_text('... %s ...'), $url)`, and the `%s` stays in the translation.
- Field names, container ids, `set_header_template()` templates and placeholder content (the defaults) are not admin text and are not wrapped.
- **Give a container an explicit id**: `Container::make('theme_options', 'theme_options', admin_text('Theme Options'))`. With only a title Carbon Fields builds the id, and with it the page slug, out of the title text, so a translated title would change it. `Block::make('home_x', ...)` takes its id first already.
- Data read later, the palette in `theme_palette()` and the section list in `yk4_editor_sections()`, holds plain English and is translated where it is used (`register_theme_colors()`, the inserter and the editor script), so a hot path such as `register_block_type_args`, which runs once per block type, does not translate thirty texts each time.
- Carbon Fields ships Ukrainian for its own interface. `theme_carbon_fields_labels()` covers the one gap, the default "Entry" and "Entries" of a repeater row.
- **Adding a field means adding its Ukrainian in the same change.** Use WordPress's own Ukrainian for what it names (Вигляд › Меню, Розміщення меню, Налаштування › Читання). Header and Footer are «Шапка» and «Підвал».

## Fields (Carbon Fields)

Carbon Fields lives in the theme's `vendor/`, not as a plugin. The client installs the theme and the fields are simply there — no plugin, no licence, no importing field groups, and no admin UI that could delete a field.

**Every section field is defined inside its block**, in `includes/section-blocks.php`, see *Writing a block section*. There is no Page Sections metabox and no post meta container for sections: nothing about a section is stored as a Custom Field. A block keeps its values as JSON in the page content, so moving a page moves its content with it. The one post meta field the theme registers is `_yk4_section_view_modes` (the Preview / Edit toggle of the blocks). The other place fields live is Theme Options (`includes/theme-options.php`), stored as options.

- **Admin labels go through `admin_text()`**: the English text in the definition, the Ukrainian in `includes/admin-translations.php`. See *Admin panel language*.
- Field names are prefixed `crb_<section>_<name>`, e.g. `crb_banner_title`, `crb_about_rev_title`. A name is unique across all blocks, because `section_block_defaults_for()` finds the owning block from it.
- Read values **only** through the helper, with no default:

```php
<?= section_field('crb_banner_title'); ?>
```

Without `vendor/` the section blocks are not registered, `section_field()` returns its `$default` (empty) and the theme never fatals.

Wrap every element in `if(section_field(...))`: a heading, a paragraph, an image, a whole stats row — anything that can end up empty needs a guard, or the page renders empty tags. Never call `carbon_get_post_meta()` in a section.

Image fields use `->set_value_type('url')` so templates get a URL and stay flat.

Repeating content uses a `complex` field: the client decides how many rows there are, so a fixed set of `crb_x_item_1_*` slots is only right when the count is part of the design. Give every default row a unique `_id`, write the placeholder rows as the field's default value, guard the row on whichever subfield is required (a member with no name is skipped) and keep one copy of the card markup in the template. A `complex` nested inside a `complex` works too.

Social links go through `social_networks()` in `functions.php` — one map holding the label, the inline SVG icon and the admin option list. `social_icon()` and `social_label()` read from it, `social_network_options()` feeds the `select` in `includes/theme-options.php`. Add a network there and nothing else changes.

A section can also draw its content from WordPress instead of from fields, listing the latest posts with `get_posts()` for example. The fields then only cover the heading and the button.

Gotcha: a `complex` subfield in **Theme Options** must not be called `value`. Those rows are stored as `_field|subfield|row|index|value`, so that name collides with the trailing segment — the row saves with an empty subfield slot and reads back as an empty array, silently. `_type` is taken as well.

## Forms

The theme ships no form of its own. A section that needs one carries a plain text field for a shortcode — `crb_cta_form`, `crb_contact_form` — and the client pastes in whatever their form plugin gives them, so the theme stays plugin agnostic. Print it through the helper, never through `do_shortcode()` directly:

```php
<?php if(section_form('crb_contact_form')){ ?>
	<div class="contact-form"><?= section_form('crb_contact_form'); ?></div>
<?php } ?>
```

`section_form()` expands the tag and returns an empty string when nothing expanded. That second part matters: with the plugin deactivated or the theme moved to another site, `do_shortcode()` hands the tag straight back and a literal `[formidable key=x]` would be printed on the page.

Form fields need no plugin specific CSS. The global form styles in `theme-styles.php` are written against element selectors — `input[type="email"]`, `textarea`, `select` — so any plugin's markup picks them up, and submit buttons are covered by `input[type="submit"], button[type="submit"]` for the same reason. Never add `.frm_*` or `.wpcf7-*` rules. Do not reach for the plugin's "disable styling" setting either: plugins hide their spam honeypot with their own CSS — Formidable's is a plain `input type="text"` — and switching that stylesheet off puts the honeypot on the page as a visible field. On a dark panel, re-colour the submit inside the section the way `home_cta` does.

Laying a form out beyond what element selectors reach — putting a single field and its submit on one row, for instance — is a job for a few lines of section JavaScript rather than for guessed class names. `home_cta` walks up from the field until it finds the ancestor that also holds the submit, tags that ancestor and the two branches with its own classes, and styles those. It survives any plugin's wrapper depth, and it skips empty wrappers left in the markup while never touching a real control, honeypots included.

There is no demo form. Until a shortcode is pasted the form area is simply absent, which leaves containers that would otherwise hold empty space. `home_cta` and `home_contact` deal with that in CSS rather than with long `if` chains — `:not(:has(> *))` hides an empty column, and a section with nothing left in it hides itself.

## Images and lazy loading

The theme disables WordPress lazy loading, `srcset` and `decoding`, and runs its own script in `includes/theme-changes.php`. It swaps `data-url` → `src` and `data-bg-img` → inline background when the element approaches the viewport.

A `the_content` filter rewrites `src="` to `data-url="`. It runs at priority 10, before shortcodes expand at priority 11 — so **images output by a shortcode section keep a normal** `src` and load eagerly. That is correct for above-the-fold content. For heavy images further down the page, write `data-url` yourself instead of `src`.

Blocks render at priority 9, **before** that filter, so every image in a block section is rewritten and lazy loaded, except one carrying `loading="eager"`, which `filter_url()` leaves alone. Mark everything above the fold `loading="eager"` (the hero background also gets `fetchpriority="high"`), and let the rest lazy load.

## JavaScript

Vanilla only, no jQuery. Global behaviour belongs in `includes/theme-changes.php`; anything section-specific goes in a `<script>` inside the section file. Use readable variable names and avoid inventing custom `data-` attributes.

A full screen overlay (the portfolio lightbox is the reference) is written inside the section file but moved to the end of `<body>` by its own script, so no ancestor can clip a `position: fixed` element. Its CSS is therefore keyed off its own top level class rather than the section class, and it reads its content out of the DOM — the tile's `img` and its `.item-title` / `.item-category` — instead of carrying invented `data-` attributes.

## Content

Approved copy always beats text found in a design. Skip placeholder instructions wrapped in brackets `[...]`.

## Local development

- Neither `php` nor `composer` is on `PATH`. Use `D:\OSPanel\modules\PHP-8.3\php.exe`, and a downloaded `composer.phar` run through it.
- Lint before finishing: `D:/OSPanel/modules/PHP-8.3/php.exe -l <file>`.
- The dev site is `http://yk4-single-page.local/`; `curl` against it is the quickest way to confirm a section renders without notices.
- On the macOS Local install the site is `http://localhost:10114/` and PHP is `/opt/homebrew/opt/php@8.1/bin/php`. The theme is only loaded once it is the active theme.

