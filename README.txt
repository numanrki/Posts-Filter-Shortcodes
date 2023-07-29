=== Posts Filter Shortcodes ===
Contributors: numanrki
Tags: SEO, current year, year, shortcode, current year shortcode, copyright, copyright shortcode, trademark, copyright symbol, trademark shortcode, trademark symbol, symbol shortcode
Author URI: https://wordpress.org/plugins/Posts-Filter-Shortcodes
Author: https://numanrki.com
Donate link: https://bit.ly/PSFCoffee
Requires at least: 4.7
Tested up to: 6.2
Stable tag: 1.0
Requires PHP: 7.0
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
**Post Filters Shortcodes** is a powerful WordPress plugin that allows effortless post filtering through user-friendly shortcodes.

== Last Updated Posts Shortcode ==
The **[psf-updated]** shortcode allows you to display a list of last updated posts on your WordPress site with various options for customization.

== Shortcode Attributes ==

1. **show**: A comma-separated list of category slugs to include posts from. By default, all categories are included. Use the value `all` to show all posts regardless of category. Example: `show="category1,category2"`

2. **hide**: A comma-separated list of category slugs to exclude posts from. By default, no categories are excluded. Example: `hide="category3,category4"`

3. **num_posts**: The number of posts to display. By default, all matching posts are shown. Use a numeric value to limit the number of posts shown. Example: `num_posts="5"`

== Usage Examples For Last Updated ==

1. Show 5 posts from the "pricing" category: `**[psf-updated show="pricing" num_posts="5"]** Also can Show more by separating with a comma.`
2. Show all posts but hide those from the "pricing" category:`**[psf-updated show="all" hide="pricing"]** Also can hide more by separating with a comma.`
3. Show 3 posts from the "category1" and "category2" categories: `**[psf-updated show="category1,category2" num_posts="3"]**`

== Default Behavior ==
If no attributes are provided, the **[psf-updated]** shortcode will display all last updated posts from all categories.

== Usage Examples For Trending Posts ==
The `[psf-trending]` shortcode supports the following attributes:

- `show`: Comma-separated category slugs to show trending posts from. Use *"all"* to display trending posts from all categories. Default: `''`.
- `hide`: Comma-separated category slugs to hide trending posts from. This attribute is optional. Default: `''`.
- `posts`: Number of trending posts to display. Default: `5`.

1. Display trending posts from the **"how-to"** category and show 5 posts: Use **[psf-trending show="how-to" posts="5"]** 
2. Display all trending posts but hide posts from the **"how-to"** category and show 5 posts: **[psf-trending show="all" hide="how-to" posts="5"]**
3. Display trending posts from both the **"how-to"** and **"guides"** categories and show 5 posts: **[psf-trending show="how-to,guides" posts="5"]**

1. Display trending posts from the **"how-to"** category and show 5 posts:

== Note ==
- Make sure to use the category slugs (not names) for the **show** and **hide** attributes.
- You can use any combination of **show**, **hide**, and **num_posts** to customize the output as per your requirements.

== Installation ==

* Download the plugin file. The plugin file will usually be in the form of a .zip file.

* Log in to your **WordPress dashboard**.

* Navigate to the **"Plugins"** section by clicking on the **"Plugins"** link in the left-hand menu.

* Click on the **"Add New"** button at the top of the page.

* Click on the **"Upload Plugin"** button.

* Choose the **.zip** file you downloaded in step 1, and then click on the **"Install Now"** button.

* Once the plugin has been installed, click on the **"Activate Plugin"** link to activate it.

* The plugin should now be installed and activated on your WordPress site. You can access the plugin's settings and options by clicking on the **"Settings"** link for the plugin on the **"Plugins"** page.

* **Note:** Some plugins may require additional steps to be fully configured and functional on your site. Be sure to read the documentation provided by the plugin developer for any additional instructions.



== Upgrade Notice == 


== Frequently Asked Questions ==


== Screenshots ==

1. List of shortcodes
2. Table of shortcodes
3. Using of shortcodes
4. output of shortcodes




== Changelog ==
= 1.0.0 =
Initial Release: Ju.y 29, 2023