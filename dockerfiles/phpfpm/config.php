<?php

// Rebuild Photon URL
$url = sprintf( '%s://%s?%s',
	array_key_exists( 'ssl', $_GET ) ? 'https' : 'http',
	substr( parse_url( 'scheme://host' . $_SERVER['REQUEST_URI'], PHP_URL_PATH ), 1 ), // see https://bugs.php.net/bug.php?id=71112 (and #66813)
	$_SERVER['QUERY_STRING']
);

// Don't bother if bad data is passed
$host = parse_url( $url, PHP_URL_HOST );

if ( false === $host ) {
	header( 'HTTP/1.1 400' );
	die( '400 Bad Request' );
}

// Whitelist requests, with a bypass for certain referers
$referer = parse_url( $_SERVER['HTTP_REFERER'], PHP_URL_HOST );

$hosts_whitelist = array(
	//'example.com',
);

if ( PRIVATE_SERVICE_REFERER === $referer ) {
	$hosts_whitelist = array();
}

// Whitelist file types for redirection
$type = parse_url( $url, PHP_URL_PATH );
$type = pathinfo( $type, PATHINFO_EXTENSION );

$allowed_types = apply_filters( 'allowed_types', array(
	'gif',
	'jpg',
	'jpeg',
	'png',
) );

// Redirect to the original URL if not whitelisted
if ( ! empty( $hosts_whitelist ) && ! in_array( $host, $hosts_whitelist, true ) ) {
	// Check type before redirecting
	if ( ! in_array( $type, $allowed_types, true ) ) {
		@header( 'HTTP/1.1 400' );
		die( '400 Bad Request' );
	}

	@header( 'HTTP/1.1 302' );
	header( "Location: $url", true, 302 );
}
