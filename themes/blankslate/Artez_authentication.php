<?php
/* Artez Library */

$url = 'https://secure.e2rm.com/api/Registrations';
$username = 'nbts';
$password = '88247423acec49b7932ac3493b1e8251';
$eventid = '148005';
$firstname = 'RegistrantFirstName';
$lastname = 'RegistrantLastName';
$args = array(
    'timeout'     => 5,
    'redirection' => 5,
    'httpversion' => '1.0',
    'user-agent'  => 'WordPress/' . $wp_version . '; ' . get_bloginfo( 'url' ),
    'blocking'    => true,
    'headers'     => array('Authorization' => 'Basic ' . base64_encode($username . ':' . $password), 'Accept-Language' => 'en-CA'),
    'cookies'     => array(),
    'body'        => null,
    'compress'    => false,
    'decompress'  => true,
    'sslverify'   => true,
    'stream'      => false,
    'filename'    => null
);

$request_url = $url . '?EventID=' . $eventid  ;
$result = wp_remote_get($request_url, $args);

?>