=== Write Poetry ===
Contributors: giacomosecchi
Donate link: https://example.com/
Tags: comments, spam
Requires at least: 5.9
Tested up to: 6.2.2
Requires PHP: 5.6
Stable tag: "trunk"
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The Swiss knife plugin designed for developers and advanced users. Unlock the full potential of WordPress with this versatile tool. Empower your workflow without getting your hands dirty.

== Description ==

Welcome to the Write Poetry WordPress Plugin, a versatile tool meticulously crafted for developers and advanced users who seek to elevate their website development experience. Embrace a world of enhanced functionalities and seamless integration with popular plugins like WooCommerce and Jetpack. Write Poetry is your secret weapon to amplify your WordPress capabilities without the hassle of intricate coding.

Write Poetry is designed with developers and advanced users in mind. It acts as a bridge, providing a seamless way to extend the functionalities of official WordPress plugins such as WooCommerce, Jetpack, and more. With Write Poetry, you can tap into the potential of these plugins without having to dive into complex code, saving you time and effort.

Major features in Write Poetry include:

*   Load styles and scripts assets from your theme without using code (only configurations in the dedicated file `write-poetry-theme.json`).
*   Add multipe Query Vars via `writepoetry_query_vars`.
*   Including CSS for block styles without write a line of code: you just need to add the css files following the
naming convention rule: `my-theme/assets/css/blocks/prefix/blockname.css` (i.e., `write-white/assets/css/blocks/core/site-title.css`).
the file will load automatically only when the block with the same name will be rendered.
In addition, if you want to change the default base folder for blocks styles (`assets/css/blocks`) you can use this filter `writepoetry_blocks_styles_asset_path`
*   Add new Block Styles just using the `writepoetry_register_block_style` hook. An example here: [Add new Blocks Styles via filter](https://github.com/giacomo-secchi/write-poetry/blob/f39ad41e6ac3a9b5c8ec6f2467ea44b7055ef8df/themes/twentytwenty-child/functions.php#L41).
*	When you enable this plugin is adds by default: SVG, ttf, woff and woff2 mime types; In this way you can quickly add vectors and fonts to WordPress Media Library.
	If you want to disable this behaviour you can just remove the unwanted mime types using the `upload_mimes` and `mime_types` filters. [Here an example](https://github.com/giacomo-secchi/write-poetry/blob/de14197dfd774608425b648c0075adf285ba1396/themes/twentytwenty-child/functions.php#L22).
*	Enhanced maintenance mode that keeps the admin alive. To enable it go to 'Write Poetry Settings Page' (insert link) and check the box 'enable maintenace option'
*	You can find some code examples for configuring your project in the [project-custom-functions.php](https://github.com/giacomo-secchi/write-poetry/blob/908699814132696dbccb41a1fca86bd1fc26e300/mu-plugins/project-custom-functions.php#L45) file. Typically, you would place these code snippets in your `wp-config.php` file.

    Note that the `readme.txt` of the stable tag is the one that is considered the defining one for the plugin, so
if the `/trunk/readme.txt` file says that the stable tag is `4.3`, then it is `/tags/4.3/readme.txt` that'll be used
for displaying information about the plugin.  In this situation, the only thing considered from the trunk `readme.txt`
is the stable tag pointer.  Thus, if you develop in trunk, you can update the trunk `readme.txt` to reflect changes in
your in-development version, without having that information incorrectly disclosed about the current stable version
that lacks those changes -- as long as the trunk's `readme.txt` points to the correct stable tag.

    If no stable tag is provided, it is assumed that trunk is stable, but you should specify "trunk" if that's where
you put the stable version, in order to eliminate any doubt.

== Installation ==

1. Download the latest release `write-poetry.zip` archive from the [GitHub WritePoetry Repo release page](https://github.com/giacomo-secchi/write-poetry/releases/latest)
2. Upload `plugin-name.php` to the `/wp-content/plugins/` directory
3. Activate the plugin through the 'Plugins' menu in WordPress

== Frequently Asked Questions ==

= A question that someone might have =

An answer to that question.

= What about foo bar? =

Answer to foo bar dilemma.

== Screenshots ==

1. This screen shot description corresponds to screenshot-1.(png|jpg|jpeg|gif). Note that the screenshot is taken from
the /assets directory or the directory that contains the stable readme.txt (tags or trunk). Screenshots in the /assets
directory take precedence. For example, `/assets/screenshot-1.png` would win over `/tags/4.3/screenshot-1.png`
(or jpg, jpeg, gif).
2. This is the second screen shot

== Changelog ==
### 0.3.2 - 2024-03-02
#### Fixed
- `./vendor` folder not included in the release when plugin is updated
- Update PluginConfig::getInstance() to PluginConfig::get_instance() in `uninstall.php`

### 0.3.1 - 2024-02-28
#### Fixed
- PHP errors detected by PHP_CodeSniffer

### 0.2.8 - 2023-12-28
#### Added
- `write-poetry-theme.json` dedicated file to load styles and scripts.

#### Refactored
- Significant code improvements in blocks structure.

### 0.2.7 - 2023-11-15
#### Added
- Add support for multipe blocks and enable it by default
- Normalize block asset path
- Add support for custom block styles

#### Changed
- The folder structure has been modified to match best practices suggested in the Plugin Handbook


### 0.2.6 - 2023-10-31
#### Refactored
- Refactor admin section


### 0.2.4 - 2023-08-31
#### Added
- Add a settings page link to the Plugins list table.
- Add support for SVG file type Media upload
- Add setup for multiple Gutenberg blocks

### 0.2.2 - 2023-08-11
#### Added
- Remove query string from static resources, to enable this option add this line of code `add_filter( 'writepoetry_remove_query_strings', '__return_true' );` to your `wp-config.php` file.

#### Fixed
#### CHanged


== Upgrade Notice ==

= 1.0 =
Upgrade notices describe the reason a user should upgrade.  No more than 300 characters.

= 0.5 =
This version fixes a security related bug.  Upgrade immediately.

== Arbitrary section ==

You may provide arbitrary sections, in the same format as the ones above.  This may be of use for extremely complicated
plugins where more information needs to be conveyed that doesn't fit into the categories of "description" or
"installation."  Arbitrary sections will be shown below the built-in sections outlined above.

== A brief Markdown Example ==

Ordered list:

1. Some feature
1. Another feature
1. Something else about the plugin

Unordered list:

* something
* something else
* third thing

Here's a link to [WordPress](https://wordpress.org/ "Your favorite software") and one to [Markdown's Syntax Documentation][markdown syntax].
Titles are optional, naturally.

[markdown syntax]: https://daringfireball.net/projects/markdown/syntax
            "Markdown is what the parser uses to process much of the readme file"

Markdown uses email style notation for blockquotes and I've been told:
> Asterisks for *emphasis*. Double it up  for **strong**.

`<?php code(); // goes in backticks ?>`
