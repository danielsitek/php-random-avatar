# README

## Introduction

Php-Random-Avatar is a simple service which delivers a random image as the response for GET request. It's a small personal project, built just for fun, learning and experimenting with PHP.

## Usage

### Example

File: `app.php`

```php
$avatar = new App\Avatar();
$router = new App\Router($avatar);

$avatar->set_image_root( __DIR__ . '/images' );
$avatar->set_images_array( array(
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
    $router->use_https()->run();
}
```

Clone this repository to your server/localhost and open it in your browser.

In browser, you can request avatar image like this:

`/` for random image from any category.

`/man` for random image from the "man" category.

`/woman` for random image from the "woman" category.

## License
For more information, see [http://opensource.org/licenses/MIT](http://opensource.org/licenses/MIT) or the accompanying MIT file.

