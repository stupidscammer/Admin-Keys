function focus_check() {

	jQuery(document).ready(function($) {

		if ( 1 === $( "input:focus" ).length ) {
			return;
		}

	});

}

(function($) {

	/*//////////////////////////////////////////////////////////////////////////
	//  Admin Navigation  /////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////*/

	var standardShortcuts = [
		{
			/* Migrate DB Pro */
			shortcut:'d b command+enter',
			page:'tools.php?page=wp-migrate-db-pro'
		},
		{
			/* Dashboard */
			shortcut:'d command+enter',
			page:'index.php'
		},
		{
			/* Permalinks */
			shortcut:'s p command+enter',
			page:'options-permalink.php'
		},
		{
			/* Pages */
			shortcut:'p command+enter',
			page:'edit.php?post_type=page'
		},
		{
			/* Add New Page */
			shortcut:'a p command+enter',
			page:'post-new.php?post_type=page'
		},
		{
			/* Posts */
			shortcut:'b command+enter',
			page:'edit.php'
		},
		{
			/* Add New Post */
			shortcut:'a b command+enter',
			page:'post-new.php?post_type=post'
		},
		{
			/* Media Settings */
			shortcut:'s m command+enter',
			page:'options-media.php'
		},
		{
			/* Media Library */
			shortcut:'m command+enter',
			page:'upload.php'
		},
		{
			/* Add New Media */
			shortcut:'u m command+enter',
			page:'media-new.php'
		},
		{
			/* Themes */
			shortcut:'a t command+enter',
			page:'themes.php'
		},
		{
			/* Widgets */
			shortcut:'a w command+enter',
			page:'widgets.php'
		},
		{
			/* Menus */
			shortcut:'g m command+enter',
			page:'nav-menus.php'
		},
		{
			/* Plugins */
			shortcut:'g command+enter',
			page:'plugins.php'
		},
		{
			/* Add New Plugin */
			shortcut:'a g command+enter',
			page:'plugin-install.php'
		},
		{
			/* Upload Plugin */
			shortcut:'u g command+enter',
			page:'plugin-install.php?tab=upload'
		},
		{
			/* Users */
			shortcut:'u command+enter',
			page:'users.php'
		},
		{
			/* Add New User */
			shortcut:'a u command+enter',
			page:'user-new.php'
		},
		{
			/* Tools */
			shortcut:'t command+enter',
			page:'tools.php'
		},
		{
			/* Import */
			shortcut:'t i command+enter',
			page:'import.php'
		},
		{
			/* Export */
			shortcut:'t e command+enter',
			page:'export.php'
		},
		{
			/* Force Regenerate Thumbnails */
			shortcut:'f r command+enter',
			page:'tools.php?page=force-regenerate-thumbnails'
		},
		{
			/* Settings */
			shortcut:'s command+enter',
			page:'options-general.php'
		},
		{
			/* General */
			shortcut:'s g command+enter',
			page:'options-general.php'
		},
		{
			/* Writing */
			shortcut:'s w command+enter',
			page:'options-writing.php'
		},
		{
			/* Reading */
			shortcut:'s r command+enter',
			page:'options-reading.php'
		}
	];

	/* Set up Standard Shortcuts  */
	$(standardShortcuts).each(function(index, el) {

		var shortcut = standardShortcuts[index]['shortcut'];
		var page     = standardShortcuts[index]['page'];

		Mousetrap.bind(shortcut, function() {
			window.location.replace(akAdminUrl + page);
		});

	});

	/* Contact Form 7 */
	if (1 === $('#toplevel_page_wpcf7').length) {

		/* Contact Form 7 */
		Mousetrap.bind('c f 7 command+enter', function() {
			window.location.replace(akAdminUrl + 'admin.php?page=wpcf7');
		});

		/* Add New Contact Form 7 */
		Mousetrap.bind('a c f 7 command+enter', function() {
			window.location.replace(akAdminUrl + 'admin.php?page=wpcf7-new');
		});

	}

	/* Advanced Custom Fields */
	if ( 1 === $('#toplevel_page_edit-post_type-acf-field-group').length ) {

		/* ACF Field Groups */
		Mousetrap.bind('a c f command+enter', function() {
			window.location.replace(akAdminUrl + 'edit.php?post_type=acf-field-group');
		});

		/* Add New ACF Field Group */
		Mousetrap.bind('a a c f command+enter', function() {
			window.location.replace(akAdminUrl + 'post-new.php?post_type=acf-field-group');
		});

		/* Import/Export ACF Field Groups */
		Mousetrap.bind('a c f i command+enter', function() {
			window.location.replace(akAdminUrl + 'edit.php?post_type=acf-field-group&page=acf-settings-export');
		});

		/* ACF Updates */
		Mousetrap.bind('a c f u command+enter', function() {
			window.location.replace(akAdminUrl + 'edit.php?post_type=acf-field-group&page=acf-settings-updates');
		});

	}

	/*//////////////////////////////////////////////////////////////////////////
	//  Admin Actions  ////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////*/

	$("input").not('[type=submit]').addClass('mousetrap');

	// Clear focus
	Mousetrap.bindGlobal('esc', function() {
		$('input').trigger('blur');
	});

	// Toggle Select All Checkbox
	if (1 === $('#cb-select-all-1').length) {
		Mousetrap.bindGlobal('a', function() {
			$('#cb-select-all-1').trigger('click');
		});
	}

	// Add New Whatever
	if (1 === $('a.add-new-h2').length) {
		Mousetrap.bindGlobal('n', function() {
			window.location.replace($('a.add-new-h2').attr('href'));
		});
	}

	// Submit Form
	Mousetrap.bind('shift+s', function() {

		focus_check();

		if (1 === $('#publish').length) {
			$('#publish').trigger('click');
		}
		else if (1 === $('#submit').length) {
			$('#submit').trigger('click');
		}
		else if (1 === $('#createusersub').length) {
			$('#createusersub').trigger('click');
		}
		else if (1 === $('a.button-primary').length) {
			$('a.button-primary')[0].click();
		}

	});

	// Open Post/Page in New Tab
	Mousetrap.bind('shift+t', function() {

		focus_check();

		var url = $("#view-post-btn a").attr('href');
		window.open(url,'_blank');

	});

	// Hit Button (for secondary buttons)
	Mousetrap.bind('shift+b+h', function() {

		focus_check();

		$('.button').trigger('click');

	});

	// Pagination
	if ( $('.pagination-links').length != 0 ) {

		Mousetrap.bind('shift+right', function() {
			focus_check();
			$("a.last-page")[0].click();
		});

		Mousetrap.bind('right', function() {
			focus_check();
			$("a.next-page")[0].click();
		});

		Mousetrap.bind('shift+left', function() {
			focus_check();
			$("a.first-page")[0].click();
		});

		Mousetrap.bind('left', function() {
			focus_check();
			$("a.prev-page")[0].click();
		});

	}

	// Search
	if ( $('#post-search-input').length != 0 ) {

		Mousetrap.bind('shift+f', function(event) {
			focus_check();
			event.preventDefault();
			$("#post-search-input").focus();
		});

	}

	/*//////////////////////////////////////////////////////////////////////////////
	//  Modal Window  /////////////////////////////////////////////////////////////
	////////////////////////////////////////////////////////////////////////////*/

	// Trigger Shortcuts Modal
	Mousetrap.bind('?', function() {
		focus_check();
		$("a#admin-keys-modal-trigger")[0].click();
	});

	$( "#tab-panel-admin-keys" ).clone().appendTo( "#admin-keys-modal" );

})(jQuery);
