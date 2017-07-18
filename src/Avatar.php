<?php

/**
 * Siplified interface using Loader
 *
 * @author Daniel Sitek <dan.sitek@gmail.com>
 */

namespace App;

class Avatar {

    /** @var class  $loader  Loader app class */
    private $loader;

    private $image_root = null;
    private $image_array = null;


    public function init()
    {
        $this->loader = new Avatar\Loader();

        $this->loader
            ->set_images_root_path( $this->image_root )
            ->set_images_array( $this->image_array );

        return $this;
    }


    public function set_image_root($path)
    {
        $this->image_root = $path;

        return $this;
    }


    public function set_images_array($images)
    {
        $this->image_array = $images;

        return $this;
    }


    public function get_categories()
    {
        $cat = array();

        foreach ($this->image_array as $key) {
            array_push($cat, $key);
        }

        return $cat;
    }


    /**
     * Get random avatar image
     */
    public function random()
    {
        return $this->loader
            ->set_gender()
            ->load_image();
    }


    /**
     * Get random man avatar image
     */
    public function man()
    {
        return $this->loader
            ->set_gender( 'man' )
            ->load_image();
    }


    /**
     * Get random woman avatar image
     */
    public function woman()
    {
        return $this->loader
            ->set_gender( 'woman' )
            ->load_image();
    }
}
