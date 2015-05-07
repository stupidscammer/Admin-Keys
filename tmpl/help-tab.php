<?php
/**
 * Plugin Name: Help Tab Test Case
 * Plugin URI:  http://unserkaiser.com
 * Description: Add Help Tab test case
 */
class admin_keys_help
{

	public $tabs = array(
		// The assoc key represents the ID
		// It is NOT allowed to contain spaces
		 'admin-keys' => array(
		 	 'title'   => 'Admin Keys'
		 	,'content' => '
		 		<h3>Navigation</h3>
		 		<p class="description">(shortcut + command+enter = page)<br />note: shortcuts are done <a href="https://craig.is/killing/mice#api.bind.sequence">in sequence</a>, not all at once</p>
				<div class="columns">
					<div class="column"><div class="inside"> <kbd>d</kbd> <strong>Dashboard</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>p</kbd> <strong>Pages</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a p</kbd> <strong>Add New Page</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>b</kbd> <strong>Posts (Blog)</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a b</kbd> <strong>Add New Post</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>c f 7</kbd> <strong>Contact Form 7</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a c f 7</kbd> <strong>Add New Contact Form 7</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>m</kbd> <strong>Media Library</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>u m</kbd> <strong>Add New Media</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a t</kbd> <strong>Themes</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a w</kbd> <strong>Widgets</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a m</kbd> <strong>Menus</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>g</kbd> <strong>Plugins</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a g</kbd> <strong>Add New Plugin</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>u g</kbd> <strong>Upload Plugin</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>u</kbd> <strong>Users</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a u</kbd> <strong>Add New User</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>t</kbd> <strong>Tools</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>t i</kbd> <strong>Import</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>t e</kbd> <strong>Export</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>d b</kbd> <strong>Migrate DB Pro</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>f r</kbd> <strong>Force Regenerate Thumbnails</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>s g</kbd> <strong>General Settings</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>s w</kbd> <strong>Writing</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>s r</kbd> <strong>Reading</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>s m</kbd> <strong>Media</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>s p</kbd> <strong>Permalinks</strong> </div></div>
				</div>
				<h3>Actions</h3>
				<p class="description"></p>
				<div class="columns">
					<div class="column"><div class="inside"> <kbd>␛</kbd> <strong>Clear input focus</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>a</kbd> <strong>Select all checkbox</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>n</kbd> <strong>Add new</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>⇧+s</kbd> <strong>Primary button click</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>⇧+b+h</kbd> <strong>Secondary button click</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>⇧+t</kbd> <strong>Open page/post in new tab</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>→</kbd> <strong>Pagination: next page</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>←</kbd> <strong>Pagination: previous page</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>⇧+→</kbd> <strong>Pagination: last page</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>⇧+←</kbd> <strong>Pagination: first page</strong> </div></div>
					<div class="column"><div class="inside"> <kbd>⇧+f</kbd> <strong>Search box focus</strong> </div></div>
				</div>
		 	'
		 )
	);

	static public function init()
	{

		$class = __CLASS__ ;
		new $class;
	}

	public function __construct()
	{

		add_action( "in_admin_header", array( $this, 'add_tabs' ), 20 );
	}

	public function add_tabs()
	{

		foreach ( $this->tabs as $id => $data )
		{
			get_current_screen()->add_help_tab( array(
				 'id'       => $id
				,'title'    => __( $data['title'], 'admin-keys' )
				// Use the content only if you want to add something
				// static on every help tab. Example: Another title inside the tab
				,'content'  => '<h2>Admin Keyboard Shortcuts</h2>'
				,'callback' => array( $this, 'prepare' )
			) );
		}
	}

	public function prepare( $screen, $tab )
	    {
	    	printf(
			 '<p>%s</p>'
			,__(
	    			 $tab['callback'][0]->tabs[ $tab['id'] ]['content']
				,'dmb_textdomain'
			 )
		);
	}
}
// Always add help tabs during "load-{$GLOBALS['pagenow'}".
// There're some edge cases, as for example on reading options screen, your
// Help Tabs get loaded before the built in tabs. This seems to be a core error.
add_action( 'in_admin_header', array('admin_keys_help', 'init') );
