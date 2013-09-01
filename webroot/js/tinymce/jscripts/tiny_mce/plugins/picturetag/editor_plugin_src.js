(function() {
	// Load plugin specific language pack
	tinymce.PluginManager.requireLangPack('picturetag');

	tinymce.create('tinymce.plugins.PictureTagPlugin', {
		init : function(ed, url) {
			ed.addCommand('mcePictureTag', function() {
				ed.windowManager.open({
					file : url + '/dialog.htm',
					width : 320 + ed.getLang('example.delta_width', 0),
					height : 120 + ed.getLang('example.delta_height', 0),
					inline : 1
				}, {
					plugin_url : url,
					some_custom_arg : 'custom arg'
				});
			});

			// Register example button
			ed.addButton('picturetag', {
				title : 'PictureTagger.desc',
				cmd : 'mcePictureTag',
				image : url + '/img/picturetag.gif'
			});

			// Add a node change handler, selects the button in the UI when a image is selected
			ed.onNodeChange.add(function(ed, cm, n) {
				cm.setActive('picturetag', n.nodeName == 'IMG');
			});
		},

		/**
		 * Creates control instances based in the incomming name. This method is normally not
		 * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
		 * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
		 * method can be used to create those.
		 *
		 * @param {String} n Name of the control to create.
		 * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
		 * @return {tinymce.ui.Control} New control instance or null if no control was created.
		 */
		createControl : function(n, cm) {
			return null;
		},

		/**
		 * Returns information about the plugin as a name/value array.
		 * The current keys are longname, author, authorurl, infourl and version.
		 *
		 * @return {Object} Name/value array containing information about the plugin.
		 */
		getInfo : function() {
			return {
				longname : 'Picturetagger Plugin',
				author : 'embedded Projects GmbH',
				authorurl : 'http://eproo.net',
				infourl : 'http://eproo.net',
				version : "1.0"
			};
		}
	});

	// Register plugin
	tinymce.PluginManager.add('picturetag', tinymce.plugins.PictureTagPlugin);
})();

