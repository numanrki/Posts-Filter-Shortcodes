=== AADMY - Add Auto Date Month Year Into Posts ===
Contributors: numanrki
Tags: SEO, current year, year, shortcode, current year shortcode, copyright, copyright shortcode, trademark, copyright symbol, trademark shortcode, trademark symbol, symbol shortcode
Author URI: https://wordpress.org/plugins/Posts-Filter-Shortcodes
Author: https://numanrki.com
Donate link: https://bit.ly/aadmyCoffee
Requires at least: 4.7
Tested up to: 6.2
Stable tag: 1.1.2
Requires PHP: 7.0
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.html

== Description ==
Post Filters Shortcodes is a powerful WordPress plugin that allows effortless post filtering through user-friendly shortcodes.

### Last Updated Posts Shortcode

The `[psf-updated]` shortcode allows you to display a list of last updated posts on your WordPress site with various options for customization.

#### Shortcode Attributes:

1. `show`: A comma-separated list of category slugs to include posts from. By default, all categories are included. Use the value `all` to show all posts regardless of category. Example: `show="category1,category2"`

2. `hide`: A comma-separated list of category slugs to exclude posts from. By default, no categories are excluded. Example: `hide="category3,category4"`

3. `num_posts`: The number of posts to display. By default, all matching posts are shown. Use a numeric value to limit the number of posts shown. Example: `num_posts="5"`

#### Usage Examples:

1. Show 5 posts from the "pricing" category:
   ```
   [psf-updated show="pricing" num_posts="5"] Also can Show more by seprating with comma.
   ```

2. Show all posts but hide those from the "pricing" category:
   ```
   [psf-updated show="all" hide="pricing"] Also can hide more by seprating with comma.
   ```

3. Show 3 posts from the "category1" and "category2" categories:
   ```
   [psf-updated show="category1,category2" num_posts="3"]
   ```

#### Default Behavior:

If no attributes are provided, the `[psf-updated]` shortcode will display all last updated posts from all categories.

#### Note:

- Make sure to use the category slugs (not names) for the `show` and `hide` attributes.
- You can use any combination of `show`, `hide`, and `num_posts` to customize the output as per your requirements.