=== Posts Filter Shortcodes ===
Contributors: numanrki
Tags: posts, filters, shortcode, WordPress, post filter, dynamic content
Donate link: https://bit.ly/PSFCoffee
Requires at least: 4.7
Tested up to: 6.2
Stable tag: 1.1
Requires PHP: 7.0
License: GPL3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

== Description ==
**Posts Filter Shortcodes** is a versatile WordPress plugin that simplifies the process of displaying filtered post content using intuitive shortcodes. It supports dynamic content filtering based on categories and can be customized to display either updated, trending posts, or standalone blinking tickers with customizable styles and effects.

== Features ==
- **Dynamic Post Filtering**: Easily display posts based on specific categories.
- **Custom Tickering**: Display standalone "Hot" or "New" tickers with customizable colors, sizes, and animations.
- **Custom Styles**: Adjust background and text colors, add animations, and more directly via shortcodes.
- **Flexible Usage**: Compatible with any WordPress theme and can be inserted into pages, posts, or widgets.

== Usage ==

=== [psf-updated] Shortcode ===
Displays a list of last updated posts. You can filter by categories, exclude certain categories, and specify the number of posts to display.

**Attributes:**
- `show`: Category slugs to include, separated by commas. Leave empty or use "all" to include all categories.
- `hide`: Category slugs to exclude, separated by commas.
- `posts`: Number of posts to display. Defaults to all matching posts if not specified.
- `bg-color`: Background color of the post item.
- `txt-color`: Text color of the post item.
- `font-size`: Font size of the post text.
- `ticker-pos`: Position of the ticker (after, top-right, bottom-right).

**Examples:**
1. `[psf-updated show="news,events" posts="5" bg-color="#EA4335" txt-color="#ffffff" font-size="14" ticker-pos="after"]` - Shows five posts from "news" and "events" categories with the ticker following the link.

=== [psf-trending] Shortcode ===
Displays a list of trending posts based on comment count or other criteria.

**Attributes:**
- `show`: Category slugs to include, similar to [psf-updated].
- `hide`: Category slugs to exclude.
- `posts`: Number of posts to display.
- `bg-color`, `txt-color`, `font-size`: Styling options similar to [psf-updated].
- `ticker-pos`: Position of the ticker (after, top-right, bottom-right).

**Examples:**
1. `[psf-trending show="how-to,guides" posts="5" ticker-pos="top-right"]` - Displays trending posts from "how-to" and "guides" categories with the ticker at the top right of each post.

=== [psf-hot-ticker] and [psf-new-ticker] Shortcodes ===
Displays a blinking ticker with customizable background color, text color, font size, width, and height. Use `psf-hot-ticker` for "Hot" and `psf-new-ticker` for "New".

**Attributes for both:**
- `bg-color`: Background color of the ticker.
- `txt-color`: Text color of the ticker.
- `font-size`: Font size of the ticker text.
- `width`: Width of the ticker.
- `height`: Height of the ticker.

**Example:**
1. `[psf-hot-ticker bg-color="#ff0000" txt-color="#ffffff" font-size="14" width="80" height="30"]` - Displays a blinking "Hot" ticker with custom dimensions and colors.

== Installation ==
1. Download the plugin ZIP file.
2. Log in to your WordPress dashboard.
3. Navigate to "Plugins" > "Add New" > "Upload Plugin".
4. Upload the ZIP file and click "Install Now".
5. After installation, activate the plugin via the "Plugins" menu in WordPress.

== Frequently Asked Questions ==
Q: Can I use multiple shortcodes on the same page?
A: Yes, you can use multiple instances of [psf-updated], [psf-trending], [psf-hot-ticker], and [psf-new-ticker] on the same page or across the site.

Q: Do I need to know how to code to use this plugin?
A: No coding knowledge is required! The shortcodes are designed to be simple and user-friendly.

== Changelog ==
= 1.1 =
- Added font size customization.
- Improved category filtering logic.
- Enhanced CSS for better visual separation of post items.
- Introduced "Hot" and "New" tickers with customizable styles and positions.

= 1.0 =
- Initial Release.
