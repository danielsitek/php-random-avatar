<?php

use PHPUnit\Framework\TestCase;

class AvatarTests extends TestCase {

    private $root = __DIR__ . '/images';

    private $images = array(
        'man' => array(
            '/man/001.png'
        ),
        'woman' => array(
            '/woman/001.png'
        )
    );

    public function testGetRandomAvatar()
    {
        $avatar = new App\Avatar();
        $avatar->set_image_root($this->root);
        $avatar->set_images_array($this->images);

        $rendered = $avatar->init()->random();

        $this->assertArrayHasKey('file', $rendered);
        $this->assertArrayHasKey('headers', $rendered);
        $this->assertContains('images/', $rendered['file']);
    }

    public function testGetManAvatar()
    {
        $avatar = new App\Avatar();
        $avatar->set_image_root($this->root);
        $avatar->set_images_array($this->images);

        $rendered = $avatar->init()->man();

        $this->assertArrayHasKey('file', $rendered);
        $this->assertArrayHasKey('headers', $rendered);
        $this->assertContains('images/man/001.png', $rendered['file']);
    }

    public function testGetWomanAvatar()
    {
        $avatar = new App\Avatar();
        $avatar->set_image_root($this->root);
        $avatar->set_images_array($this->images);

        $rendered = $avatar->init()->woman();

        $this->assertArrayHasKey('file', $rendered);
        $this->assertArrayHasKey('headers', $rendered);
        $this->assertContains('images/woman/001.png', $rendered['file']);
    }

    public function testGetAvaiableCategories()
    {
        $avatar = new App\Avatar();
        $avatar->set_image_root($this->root);
        $avatar->set_images_array($this->images);

        $categories = $avatar->get_categories();

        $this->assertContains('man', $categories);
        $this->assertContains('woman', $categories);
    }
}
