<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET');

require_once __DIR__ . '/vendor/autoload.php';

$avatar = new App\Avatar();
$router = new App\Router($avatar);

$avatar->setImageRoot( __DIR__ . '/images' );
$avatar->setImagesArray( array(
    'man' => array(
        '/man/001.png',
        '/man/002.png',
        '/man/003.png',
        '/man/004.png',
        '/man/005.png'
    ),
    'woman' => array(
        '/woman/001.png',
        '/woman/002.png',
        '/woman/003.png',
        '/woman/004.png',
        '/woman/005.png'
    )
) );

if ( in_array( @$_SERVER['REMOTE_ADDR'], ['127.0.0.1', 'fe80::1', '::1'] ) ) {

    $router->run();

} else {

    $router->useHttps()->run();
}
