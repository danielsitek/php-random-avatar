<?php

namespace Tests\Avatar;

use PHPUnit\Framework\TestCase;
use App;

class LoaderTests extends TestCase {

    private $root = __DIR__ . '/../images';

    private $images = array(
        'man' => array(
            '/man/001.png'
        ),
        'woman' => array(
            '/woman/001.png'
        )
    );

    public function testLoadRandomAvatarImage()
    {
        $loader = new App\Avatar\Loader();
        $loader->setImagesRootPath($this->root);
        $loader->setImagesArray($this->images);
        $loader->setGender();

        $image = $loader->loadImage();

        $this->assertArrayHasKey('file', $image);
        $this->assertArrayHasKey('headers', $image);
        $this->assertArrayHasKey('X-Avatar-Gender', $image['headers']);
        $this->assertArrayHasKey('Content-Type', $image['headers']);
        $this->assertContains('images/', $image['file']);
    }

    public function testLoadManAvatarImage()
    {
        $loader = new App\Avatar\Loader();
        $loader->setImagesRootPath($this->root);
        $loader->setImagesArray($this->images);
        $loader->setGender('man');

        $image = $loader->loadImage();

        $this->assertArrayHasKey('file', $image);
        $this->assertArrayHasKey('headers', $image);
        $this->assertArrayHasKey('X-Avatar-Gender', $image['headers']);
        $this->assertArrayHasKey('Content-Type', $image['headers']);
        $this->assertTrue($image['headers']['Content-Type'] === 'image/png');
        $this->assertTrue($image['headers']['X-Avatar-Gender'] === 'man');
        $this->assertContains('images/man/001.png', $image['file']);
    }

    public function testLoadWomanAvatarImage()
    {
        $loader = new App\Avatar\Loader();
        $loader->setImagesRootPath($this->root);
        $loader->setImagesArray($this->images);
        $loader->setGender('woman');

        $image = $loader->loadImage();

        $this->assertArrayHasKey('file', $image);
        $this->assertArrayHasKey('headers', $image);
        $this->assertArrayHasKey('X-Avatar-Gender', $image['headers']);
        $this->assertArrayHasKey('Content-Type', $image['headers']);
        $this->assertTrue($image['headers']['Content-Type'] === 'image/png');
        $this->assertTrue($image['headers']['X-Avatar-Gender'] === 'woman');
        $this->assertContains('images/woman/001.png', $image['file']);
    }
}
