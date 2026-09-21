/**
 * Registers the theme's sections as blocks in the "Page Sections" inserter
 * category. window.yk4EditorSections is printed inline by
 * includes/editor-sections.php - one entry per shortcode, each carrying its
 * title, description and a small wireframe icon.
 *
 * Every block's save() writes out nothing but the plain shortcode text, so a
 * page's content ends up exactly as if the client had typed [home_banner] by
 * hand: the existing do_shortcode() render path in shortcodes.php never
 * changes.
 *
 * supports.multiple is false, so once a section is already on the page its
 * block goes disabled in the inserter - the same native treatment a
 * single-instance block like Post Title gets in the site editor. The
 * description is swapped to say so while it is disabled, since that text is
 * what the inserter's hover preview panel shows for a highlighted item.
 *
 * Sections flagged native are Carbon Fields blocks (includes/section-blocks.php). Carbon Fields
 * registers those itself, with a dashicon and its own supports, so they are only decorated here: a
 * blocks.registerBlockType filter swaps in the wireframe icon and the single-instance rule as the
 * block is registered. This script is enqueued ahead of Carbon Fields', which is what makes the filter
 * early enough.
 */
(function () {
	var sections = window.yk4EditorSections || [];
	var strings = window.yk4EditorStrings || {};
	if (!sections.length) {
		return;
	}

	var blocks = wp.blocks;
	var element = wp.element;
	var blockEditor = wp.blockEditor;
	var components = wp.components;
	var data = wp.data;
	var el = element.createElement;

	var nativeSections = {};
	sections.forEach(function (section) {
		if (section.native) {
			nativeSections[section.name] = section;
		}
	});

	wp.hooks.addFilter('blocks.registerBlockType', 'yk4/section-blocks', function (settings, name) {
		var section = nativeSections[name];
		if (!section) {
			return settings;
		}
		return Object.assign({}, settings, {
			icon: sectionIcon(section.icon),
			supports: Object.assign({}, settings.supports, {
				multiple: false,
				reusable: false
			})
		});
	});

	function sectionIcon(markup) {
		return el('span', {
			className: 'yk4-section-icon',
			dangerouslySetInnerHTML: { __html: markup }
		});
	}

	/**
	 * Reads block names straight off the already-parsed block tree instead of
	 * serialising post content to a string: getEditedPostContent() rebuilds
	 * that string from the block-type registry, and calling it from inside a
	 * listener that also registers/unregisters block types feeds back into
	 * itself - every registry write re-triggers a global data.subscribe(),
	 * which serialises again, which hits the registry again. That loop blew
	 * the call stack and took the whole editor down with it.
	 */
	function usedShortcodeTags() {
		var used = {};
		var names = {};
		sections.forEach(function (section) {
			names[section.name] = section.tag;
		});

		function walk(blockList) {
			blockList.forEach(function (block) {
				if (names[block.name]) {
					used[names[block.name]] = true;
				}
				if (block.innerBlocks && block.innerBlocks.length) {
					walk(block.innerBlocks);
				}
			});
		}

		walk(data.select('core/block-editor').getBlocks());
		return used;
	}

	function registerSection(section, isUsed) {
		var description = isUsed
			? section.description + ' ' + strings.used
			: section.description;

		blocks.registerBlockType(section.name, {
			apiVersion: 2,
			title: section.title,
			description: description,
			category: 'yk4-sections',
			icon: sectionIcon(section.icon),
			supports: {
				multiple: false,
				html: false,
				customClassName: false,
				className: false,
				reusable: false
			},
			edit: function () {
				var blockProps = blockEditor.useBlockProps({ className: 'yk4-section-placeholder' });
				return el('div', blockProps,
					el(components.Placeholder, {
						icon: sectionIcon(section.icon),
						label: section.title,
						instructions: strings.instructions
					},
						el('code', { className: 'yk4-section-placeholder-tag' }, '[' + section.tag + ']')
					)
				);
			},
			save: function () {
				return '[' + section.tag + ']';
			}
		});
	}

	var registeredAsUsed = {};

	function syncSections() {
		try {
			var used = usedShortcodeTags();
			sections.forEach(function (section) {
				if (section.native) {
					return;
				}
				var isUsed = !!used[section.tag];
				if (registeredAsUsed[section.tag] === isUsed) {
					return;
				}
				if (registeredAsUsed[section.tag] !== undefined) {
					blocks.unregisterBlockType(section.name);
				}
				registerSection(section, isUsed);
				registeredAsUsed[section.tag] = isUsed;
			});
		} catch (error) {
			console.error('YK4 editor sections failed to sync:', error);
		}
	}

	syncSections();
	/*
	 * Scoped to the block-editor store alone, so registering/unregistering a
	 * block type - which only ever touches the separate core/blocks store -
	 * can never re-trigger this listener itself.
	 */
	data.subscribe(syncSections, 'core/block-editor');
})();
