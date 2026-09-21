/**
 * Saves the Preview / Edit choice of a section block with the page, and opens the block in it again after a reload.
 *
 * The toggle in the block toolbar belongs to Carbon Fields, and the mode it switches is plain component
 * state: every time the editor opens, a section starts again from its default, the fields form
 * (set_mode('both') in includes/section-blocks.php). Three steps keep the choice without touching vendor code:
 *
 * 1. Restoring. A block reads its starting mode once, when it mounts, from its container definition in the
 *    carbon-fields/blocks store. This script writes the mode saved with the page into that definition while it
 *    loads, which is before the editor mounts any block. Nothing is clicked, no block is selected, and it does
 *    not wait for the toolbar to render. The saved modes are printed by includes/editor-sections.php as
 *    window.yk4SectionViewMode.
 * 2. Saving. A click on the toggle (recognised by its icon, or by Carbon Fields' own translated label) edits the
 *    page's meta field, the way the editor edits any field. That makes the page dirty, which is what turns the
 *    Save / Update button on, and the choice is written with the page when the button is pressed. The edit is kept
 *    out of the undo history: Ctrl+Z keeps undoing the content, and never flips a mode the block cannot follow.
 *    Going back to the mode that was saved removes the edit, and the button goes off again.
 * 3. Staying put within a session. The store is updated too, so a block that mounts again in the same session
 *    (undo, moving it, the code editor) comes back the way it was left.
 *
 * The field holds a JSON object of the sections that differ from the mode they open in, so a page nobody touched
 * stores nothing. A choice that is not saved is not kept: after a reload the block opens in the saved mode, and
 * the editor asks about the unsaved change as it does for any other edit.
 */
(function () {
	var config = window.yk4SectionViewMode;
	var data = window.wp && window.wp.data;
	if (!config || !config.metaKey || !data) {
		return;
	}

	var i18n = window.wp.i18n;
	var storeName = 'carbon-fields/blocks';
	var blockPrefix = 'carbon-fields/';

	// Block name => mode, for the blocks switched away from the mode they open in. Starts as what the page has saved.
	var chosen = {};
	Object.keys(config.modes || {}).forEach(function (blockName) {
		if (config.modes[blockName] === 'preview' || config.modes[blockName] === 'edit') {
			chosen[blockName] = config.modes[blockName];
		}
	});
	// Block name => the mode it opens in when nothing was chosen, as Carbon Fields registered it.
	var defaults = {};

	/**
	 * Only blocks with a Preview toggle (set_mode('both')) are touched.
	 */
	function hasToggle(container) {
		return !!(container && container.settings && container.settings.preview);
	}

	/**
	 * The store answers one block at a time, but its setup action replaces every definition, so the whole map
	 * is rebuilt from the registered Carbon Fields blocks. The store keys it by block name without the prefix.
	 */
	function containerDefinitions() {
		var definitions = {};
		data.select('core/blocks').getBlockTypes().forEach(function (blockType) {
			if (blockType.name.indexOf(blockPrefix) === 0) {
				definitions[blockType.name.slice(blockPrefix.length)] = data.select(storeName).getContainerDefinitionByBlockName(blockType.name);
			}
		});
		return definitions;
	}

	/**
	 * Sets the mode a block opens in.
	 */
	function setStartMode(blockName, mode) {
		var actions = data.dispatch(storeName);
		var definitions = containerDefinitions();
		var key = blockName.slice(blockPrefix.length);
		var container = definitions[key];
		if (!actions || !actions.setupContainerDefinitions || !hasToggle(container)) {
			return;
		}
		definitions[key] = Object.assign({}, container, { settings: Object.assign({}, container.settings, { mode: mode }) });
		actions.setupContainerDefinitions(definitions);
	}

	/**
	 * The same string includes/editor-sections.php saves (yk4_sanitize_section_view_modes): sorted by block name,
	 * empty when nothing differs. The editor compares it with the saved value, so it must come out identical.
	 */
	function serialize(modes) {
		var names = Object.keys(modes).sort();
		var sorted = {};
		names.forEach(function (name) {
			sorted[name] = modes[name];
		});
		return names.length ? JSON.stringify(sorted) : '';
	}

	/**
	 * Puts the choice into the page as an edit of its meta field. From then on the page is dirty and the Save /
	 * Update button is on, until the saved state comes back. The field only exists in the loaded page when the
	 * post type exposes it to the REST API; without it there is nothing a save could store, so the edit is skipped.
	 */
	function editPage(blockName, mode) {
		if (mode === defaults[blockName]) {
			delete chosen[blockName];
		} else {
			chosen[blockName] = mode;
		}

		var editor = data.dispatch('core/editor');
		var post = data.select('core/editor').getCurrentPost();
		if (!editor || !editor.editPost || !post || !post.meta || !(config.metaKey in post.meta)) {
			return;
		}
		var meta = {};
		meta[config.metaKey] = serialize(chosen);
		editor.editPost({ meta: meta }, { undoIgnore: true });
	}

	/**
	 * The mode a click on this button switches its block to, or null when it is not the Preview toggle. The
	 * icon is a visibility eye while the form shows (the click opens the Preview) and a crossed eye while the
	 * Preview shows (the click goes back to the form).
	 */
	function modeAfterClick(button) {
		var label = button.getAttribute('aria-label') || '';
		if (button.querySelector('.dashicons-visibility') || label === i18n.__('Show preview', 'carbon-fields-ui')) {
			return 'preview';
		}
		if (button.querySelector('.dashicons-hidden') || label === i18n.__('Hide preview', 'carbon-fields-ui')) {
			return 'edit';
		}
		return null;
	}

	/**
	 * Capture phase, so the button still shows the mode it is about to leave. The rest runs after the click
	 * has: Carbon Fields flips its own state in that click, and a re-render before it would only get in the way.
	 */
	window.addEventListener('click', function (event) {
		var button = event.target.closest ? event.target.closest('button') : null;
		var mode = button ? modeAfterClick(button) : null;
		if (!mode) {
			return;
		}

		var blockEditor = data.select('core/block-editor');
		var clientId = blockEditor.getSelectedBlockClientId();
		var blockName = clientId ? blockEditor.getBlockName(clientId) : null;
		if (!blockName || blockName.indexOf(blockPrefix) !== 0) {
			return;
		}

		window.setTimeout(function () {
			setStartMode(blockName, mode);
			try {
				editPage(blockName, mode);
			} catch (error) {
				// The page is not set up for edits (no post loaded): the toggle still works, it is just not saved.
			}
		}, 0);
	}, true);

	data.select('core/blocks').getBlockTypes().forEach(function (blockType) {
		if (blockType.name.indexOf(blockPrefix) !== 0) {
			return;
		}
		var container = data.select(storeName).getContainerDefinitionByBlockName(blockType.name);
		if (!hasToggle(container)) {
			return;
		}
		defaults[blockType.name] = container.settings.mode;
		if (chosen[blockType.name]) {
			setStartMode(blockType.name, chosen[blockType.name]);
		}
	});
})();
