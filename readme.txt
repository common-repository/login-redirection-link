=== Login Redirection Link ===
Contributors: plocha
Tags: login, redirect, logout, link, loginout, referer, url, front-end, frontend, redirect_to
Requires at least: 3.5
Tested up to: 4.0
Stable tag: 1.0
License: GPLv3
License URI: http://www.gnu.org/licenses/gpl-3.0.html

Redirects users to the previous url after login ( and logout ) by adding a redirection parameter to the links.

== Description ==

The plugin adds the 'redirect_to' parameter to all login and logout links in front-end. The value is the URL of the current site. Thus you're redirected to that site after login respectively logout. But if a link contains already a 'redirect_to' parameter, the plugin doesn't change it.

The Plugin affects only the links in front-end. These in wp-login.php and in admin back-end aren't touched.

The plugin hooks into [login_url](http://codex.wordpress.org/Plugin_API/Filter_Reference/login_url) and [logout_url](http://codex.wordpress.org/Plugin_API/Filter_Reference/logout_url). Your code has to call functions which make use of that filters. For example [wp_loginout](http://codex.wordpress.org/Function_Reference/wp_loginout). 

== Changelog ==

= 1.0 =
* Redirections for login and logout links added

== Upgrade Notice ==

= 1.0 =
First release
