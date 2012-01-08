=== Simple Image Widget ===
Contributors: vickio
Donate link: http://vickio.net
Tags: image, sidebar, widget, photo, picture
Requires at least: 2.8
Tested up to: 3.2.1
Stable tag: 2.1

The simple way to place images in your sidebars.

== Description ==

Using this widget you can easily place an image in the sidebar. You can also specify a URL to link to when clicking on the image. It supports multiple instances, so you can use it multiple times in multiple sidebars.

Once the plugin is enabled, the widget will be available in your widgets list as "Simple Image". You can add this widget to sidebars as many times as you need. The control interface allows you to specify the following options for each instance of the widget:

* Image URL: The full URL to the image file
* Alternate Text: Shown by the browser if the image cannot be displayed, or if image loading is disabled
* Title: Displayed in a tooltip when the mouse cursor is held over the image for a few seconds
* Link URL: URL to open when the image is clicked on (optional)
* Open link in new window: If this is enabled, the link will open in a new browser window

== Installation ==

1. Copy or upload the `simple-image-widget` folder to your `/wp-content/plugins/` directory
1. Activate the plugin on the Plugins page
1. Add the "Simple Image" widget to a sidebar in Appearance -> Widgets

== Frequently Asked Questions ==

= How do I upload an image? =

The Simple Image widget does not provide a mechanism for uploading images or files. You can however easily upload an image by selecting Media -> Add New. After uploading an image, copy its 'File URL' for use in the Simple Image widget 'Image URL' field.

= How many images can be displayed? =

Each instance of the widget can only display one image, but you can create as many instances as you need.

= How do I remove the border from around a link image? =

In your theme's CSS file, add this code:

`.simpleimage img { border: 0px; }`

= How do I change the alignment of the images? =

This can also be done with CSS:

`.simpleimage { text-align: center; }`

= How do I edit my theme's CSS file? =

In Wordpress, select Appearance -> Editor, then in the file list on the right, select Stylesheet (style.css) under Styles. Add your custom CSS code to the bottom of this file.

== Screenshots ==

1. Simple Image Widget control interface
