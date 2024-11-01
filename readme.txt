=== WP Wapuu Widget ===
Contributors: redcocker
Donate link: http://www.near-mint.com/blog/donate
Tags: widget, wapuu, pretty, cute, image, わぷー
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: 0.4.3

This plugin adds a widget that shows the pretty official character of WordPress Japanese local site.

== Description ==

This plugin adds a widget that shows the official character of WordPress Japanese local site. This pretty character is called "[わぷー(Wapuu)](http://wordpress.org/extend/plugins/wp-wapuu-widget/screenshots/ "わぷー(Wapuu)")" in Japanese.

"わぷー(Wapuu)" was designed by [Kazuko Kaneuchi](http://blog.cgfm.jp/mutsuki/ "Kazuko Kaneuchi") under GPL v2 license or any later version.

= Features =

* Widget that shows the official character of WordPress Japanese local site.
* Resizing the image by GD library 2.0.1 or higher.
* Setting image background color.
* Adding a link to the image.
* Showing your description on the widget.
* Setting font size for your description.
* Support lightbox.
* Localization: English(Default), 日本語(Japanese, UTF-8).

= Notes =

Some different sizes of images are prepared.

Available size: 125pixel, 150pixel, 175pixel, 200pixel, 380pixel

You can also set other size. If you set other size, the high-quality resized image will be created by GD library.

If GD library 2.0.1 or higher is not installed, the low-quality image will be shown, because the image is resized by the browser.

== Installation ==

= Installation =

1. Upload plugin folder to the `/wp-content/plugins/` directory.
1. Activate the plugin through the "Plugins" menu in WordPress.
1. Go to "Widgets" section under "Appearance" menu in WordPress and add the "Wapuu Widget" in your sidebar.

= Widget Settings =

* Title: Textarea to enter title for this widget block.
* Image size: Enter image size in pixels.
* Background color: If you need, check the checkbox and enter the colorcode. e.g. #FFFFFF
* Image link URL: Enter the URL to add a link to the image. When the textarea is left blank, this pluguin does not add a link.
* Rel attribute: Check the checkbox to add `rel="lightbox"` attribute for lightbox. If need, change the attribute value. To apply Wapuu image to lightbox, you must enter an image URL in "Image link URL". e.g. http://YOUR_BLOG/wp-content/plugins/wp-wapuu-widget/wapuu_380.png
* Description: Textarea to enter description.
* Font size: Enter the font size for description in numbers. When the textarea is left blank, the font size is defined by your theme CSS.

== Screenshots ==

1. This is the official character of WordPress Japanese local site.

== Changelog ==

= 0.4.3 =
* Replaced Wapuu images(125, 150, 175 and 200 pixel) with the images created by o6asan. Thnaks o6asan!
* Added uninstall.php.

= 0.4.2 =
* Replaced Wapuu images(125, 150 and 175 pixel) with the images resampled using bilinear.

= 0.4.1 =
* Support lightbox.
* Changed conditional branches for showing Wapuu image.

= 0.4 =
* Replaced Wapuu images with new Wapuu images with transparent background.
* Added new option to define background color
* Added new option to define font size.
* Changed image-resize process to resize while preserving transparency.
* Added ALT attribute to the image.
* Using esc_url() to escape Image link URL.
* Using dirname() and plugin_basename() instead of hardcoded directory name.
* Changed in the timing of executing image-resize.
* Added error checking for handling image-resizeing.
* Added new conditional branches for validating setting values.
* Changed directory name stored translation files.

= 0.3 =
* Plugin name is changed.(also filename etc.)
* Added new option to change the link URL.
* Fix a bug: When description is undefined(null), necessary tags are not added.

= 0.2 =
* Added new function: Resizeing image by GD library.
* Added new function: Showing description.

= 0.1 =
* This is the initial release.

== Upgrade Notice ==

= 0.4.3 =
This version has some changes.

= 0.4.2 =
This version has some changes.

= 0.4.1 =
This version has a new features and change.

= 0.4 =
This version has some new features and important changes. Thanks lilyfan and o6asan.

= 0.3 =
Plugin name is changed. This version has a new feature and bug fix.

= 0.2 =
This version has some new features.

= 0.1 =
This is the initial release.
