=== ACF: Field Selector ===
Contributors: danielpataki
Tags: acf, fields, google
Requires at least: 3.5
Tested up to: 4.2
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A field for Advanced Custom Fields which allows users to select a list of created custom fields

== Description ==

The filed selector field allows the selection of other custom fields. This is useful in situations where you want to give the user powerful display options. You could, for example, allow the user to select which custom fields are displayed in a post.

= ACF Compatibility =

This ACF field type is compatible with both *ACF 4* and *ACF 5*.

= Thanks =

* [Advanced Custom Fields](http://www.advancedcustomfields.com/) for the awesome base plugin.
* [Alexei Ryazancev](https://www.iconfinder.com/GlumPix) for the plugin icon

== Installation ==

= Automatic Installation =

Installing this plugin automatically is the easiest option. You can install the plugin automatically by going to the plugins section in WordPress and clicking Add New. Type "ACF Field Selector" in the search bar and install the plugin by clicking the Install Now button.

= Manual Installation =

1. Copy the `acf-field-selector-field` folder into your `wp-content/plugins` folder
2. Activate the Google Field Selector plugin via the plugins admin page
3. Create a new field via ACF and select the Role Selector type
4. Please refer to the description for more info regarding the field type settings

= For Developers =

For developers I've included a filter which allows you to further filter selected fields. At the moment this filter is used to make sure that included and excluded types and groups are reflected in the selectable list.

`add_filter( 'acffsf/item_filters', 'selectable_item_filter', 10, 2 )`

The first parameter is the list of items to modify, the second is the setting field.

== Screenshots ==

1. ACF control for field creation
2. The user-facing field selector

== Changelog ==

= 4.0.0 (2015-04-21) =
* WordPress 4.2 compatibility check
* Restructured the code

= 3.0.2 =
* Compatibility with 4.1

= 3.0.1 =
* Made sure search is case-insensitive
* Made sure value was json decoded when returned to the_field

= 3.0 =
* Complete rewrite with custom controls

= 2.0 =
* Added ACF 5 Support
* Removed ACF 3 Support

= 1.0 =
* Initial Release.
