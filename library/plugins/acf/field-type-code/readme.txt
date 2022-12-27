=== Advanced Custom Fields - Code Area Field ===
Contributors: taylor.mitchellstjoseph
Donate link: https://github.com/taylormsj/
Tags: acf, code, advanced custom fields
Requires at least: 3.3
Tested up to: 3.5.1
Stable tag: 1.0.0
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Adds a 'Code Area' textarea editor field type for the Advanced Custom Fields WordPress plugin.

== Description ==

The 'Code Area' field allows you to add custom CSS, Javascript, HTML and PHP to an advanced custom field, whcih can be use anywhere in your wordpress template files.

The code area uses [Code Mirror](http://codemirror.net) and has various themes to suit.

**CSS**
Type your css, no <style> tags needed

**Javascript**
Type your Javascript, no <script> tags needed

**PHP**
Type your PHP, no <?php ?> tags needed (Note, you can not open and close php tags anywhere in your code)

Output all types of code in the usual fashion the_field('code_area_field');


**Compatible with both ACF V3 & V4**

== Installation ==

This add-on can be treated as both a WP plugin and a theme include.

**Install as Plugin**
Copy the 'acf-code_area' folder into your plugins folder
Activate the plugin via the Plugins admin page

**Include within theme**
Copy the 'acf-code_area' folder into your theme folder (can use sub folders). You can place the folder anywhere inside the 'wp-content' directory
Edit your functions.php file and add the code below (Make sure the path is correct to include the acf-cf7.php file)

`add_action('acf/register_fields', 'my_register_fields');

function my_register_fields()
{
    include_once('acf_code_area-field/acf_code_area-v3.php');
}`

== Frequently asked questions ==


== Screenshots ==

1. Code Area field options
2. Editing a Code Area field


== Changelog ==


== Upgrade notice ==

