<?php
/*
Plugin Name: Login Redirection Link
Description: Redirects users to the previous url after login ( and logout ) by adding a redirection parameter to the links.
Author: edik
Author URI: http://edik.ch/
Version: 1.0
License: GPLv3

Copyright 2014  Edgard Schmidt  (email : edik@edik.ch)

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License, version 2, as 
published by the Free Software Foundation.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

*/

namespace login_redirection_link;

class Main {

function __construct() {
	$urls = array( 'login_url', 'logout_url' );
	$urls = apply_filters( $this->get_prefix() . 'urls', $urls );
	foreach ( $urls as $url ) {
		add_filter( $url, array( $this, 'set_redirect' ), 10, 2 );
	}
}


function set_redirect( $url, $requested_url ) {
	$check = empty( $requested_url )
			&& !is_admin()
			&& !$this->is_login();
	if ( apply_filters( $this->get_prefix() . 'check', $check ) ) {
		$redirection = urlencode( $this->get_current_url() );
		$url = add_query_arg( 'redirect_to', $redirection , $url );
	}
	return $url;
}


function get_current_url() {
	$url = "http://{$_SERVER['SERVER_NAME']}";
	$port = $_SERVER['SERVER_PORT'];
	if ( '80' != $port ) {
		$url .= ":$port";
	}
	$url .= $_SERVER['REQUEST_URI'];
	return set_url_scheme( $url );
}


/**
 * Returns whether user is at login page
 *
 * Look: https://core.trac.wordpress.org/ticket/19898
*/
function is_login() {
	return 0 < did_action( 'login_init' );
}


function get_prefix() {
	return __NAMESPACE__ . '_';
}

}

new Main;
