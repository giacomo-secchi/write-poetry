=== Write Poetry ===
Contributors: giacomosecchi
Donate link: https://example.com/
Tags: comments, spam
Requires at least: 4.5
Tested up to: 6.2.2
Requires PHP: 5.6
Stable tag: 0.2.2
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

The Swiss knife plugin designed for developers and advanced users. Unlock the full potential of WordPress with this versatile tool. Empower your workflow without getting your hands dirty.

== Description ==

Welcome to the Write Poetry WordPress Plugin, a versatile tool meticulously crafted for developers and advanced users who seek to elevate their website development experience. Embrace a world of enhanced functionalities and seamless integration with popular plugins like WooCommerce and Jetpack. Write Poetry is your secret weapon to amplify your WordPress capabilities without the hassle of intricate coding.

Write Poetry is designed with developers and advanced users in mind. It acts as a bridge, providing a seamless way to extend the functionalities of official WordPress plugins such as WooCommerce, Jetpack, and more. With Write Poetry, you can tap into the potential of these plugins without having to dive into complex code, saving you time and effort.

Major features in Write Poetry include:

*   Load styles and scripts assets from your theme without using code (only configurations in `theme.json`).
*   Add multipe Query Vars via `writepoetry_query_vars`.
*   "Requires at least" is the lowest version that the plugin will work on
*   "Tested up to" is the highest version that you've *successfully used to test the plugin*. Note that it might work on
higher versions... this is just the highest one you've verified.
*   Stable tag should indicate the Subversion "tag" of the latest stable version, or "trunk," if you use `/trunk/` for
stable.

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
