<?php
/**
 * @package Vihv Menu
 */
/*
Plugin Name: Vihv Menu
Description: Menu icons, menu item css class, menu link XFN and open menu link in new window under Appearance->Menus. 
Version: 2.4
Author: Vigorous Hive
Author URI: http://vihv.org/store
Plugin URI: http://vihv.org/store/v/our-plugins/vihv-menu/
License: MIT
*/

require_once "TVihvEditMenuWalker.php";

class TVihvMenu {
	function __construct() {
		add_action('admin_init', array($this,'setupMenu'));
		add_action('wp_update_nav_menu_item', array($this, 'updateNavMenuItem'), null, 3);
		add_filter('walker_nav_menu_start_el', array($this, 'imageToTitle'), null, 4);
		add_filter('wp_edit_nav_menu_walker', array($this,'createEditNavMenuWalker'));
	}
	
	function setupMenu() {
		add_meta_box('menu-icon', 'Optional menu item fields', array($this, 'showMenuIcon'),'nav-menus','side');
	}
	
	function showMenuIcon() {
		?>
		<a onclick="
			jQuery('.hidden-field').toggle();
		     " class="button-primary"><?php _e('Show optional menu item fields'); ?></a>
		<p class="howto"><?php _e('Toggle display of optional menu-item parametres: CSS class, XFN, Description. You will see em when you expand menu item.'); ?></p>
		<?php
	}
	
	function createEditNavMenuWalker() {
		return 'TVihvEditMenuWalker';
	}
	function updateNavMenuItem($menu_id, $menu_item_db_id, $args) {
		$icon = htmlspecialchars($_POST['menu-item-icon'][$menu_item_db_id], ENT_QUOTES);
		update_post_meta($menu_item_db_id, '_vihv_menu_icon', $icon);
	}
	function imageToTitle($item_output, $item, $depth, $args) {
		$icon = get_post_meta($item->ID, '_vihv_menu_icon', true);
		if(empty($icon)) {
			return $item_output;
		}
		$icon = $this->getIconSrc($icon);
		$image = "<img src='".$icon."' alt='".htmlspecialchars(strip_tags($item->title), ENT_QUOTES)."'/>";
		return preg_replace('/<a (.*)>(.*)<\/a>/s','<a ${1}>'.$image.'<span>${2}</span></a>',$item_output);
	}
	
	function getIconSrc($icon) {
		if(strpos($icon,'http://') === false) {
			if(file_exists(get_stylesheet_directory()."/".$icon)) {
				$icon = get_stylesheet_directory_uri()."/".$icon;
			} else {
				$icon = site_url()."/".$icon;
			}
		}
		return $icon;
	}
}

new TVihvMenu();
