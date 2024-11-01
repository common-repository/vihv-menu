=== Vihv Menu ===
Contributors: vihv
Donate link: 
Tags: menu, custom menu, customize menu item,  menu icon, menu images, menu css, xfn, menu item in new window, menu item description
Requires at least: 3.3
Tested up to: 3.5.2
Stable tag: 2.4
License: MIT
License URI: http://opensource.org/licenses/MIT

Adds menu icons, menu item css class, link XFN, menu item description, ability to target link to new tab.

== Description ==

Adds menu icons, menu item css class, menu link XFN, menu item description and ability to open menu link in new window. All using default Appearance->Menus.

Icons will be displayed with default menu walker. If you use your own you can add images to menu with $output .= apply_filters( 'walker_nav_menu_start_el', $output, $item, $depth, $args ); or get icon url with get_post_meta($menu_item_id, '_vihv_menu_icon', true); and display anywhere you want. Enjoy!

== Screenshots ==
1. Screenshot

== Installation ==

1. Unzip `vihv-menu` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently asked questions ==

= I add icon urls to menu, but they are not displayed in frontend, how can I work around? =
Most themes use custom menu walkers, instead of wp default Walker_Nav_Menu. And some of developers don't call 'walker_nav_menu_start_el' filter. You need to find menu walker class in your theme code (search for files which contain 'extends Walker_Nav_Menu' and 'extends Walker') and add apply_filter rule at the end. See wp-includes/nav-menu-template.php as example. Alternatively you can use get_post_meta($menu_item_id, '_vihv_menu_icon', true) to receive icon url inside menu walker code and use it as you want.

= How can i ask a question? =

You can send your questions to feedback@vihv.org.

== Changelog ==
= 2.4 =
-icons are now visible in backend
-then icon path has no http:// at the beginning, first suggestion will be http://your.site/path/to/your/theme/path-you've-entered, if file won't be found next suggestion will be http://your.site/path-you've-entered, so you can use shorter paths now
= 2.3 =
relative icon urls are now copatible with multilingual plugins like WPML

= 2.2 =
Alternate text for logo images
