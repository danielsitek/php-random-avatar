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


    private $imageRoot = null;
    private $imageArray = null;


	/**
     * @return $this
     */
    public function init()
    {
        $this->loader = new Avatar\Loader();

        $this->loader
            ->setImagesRootPath( $this->imageRoot )
            ->setImagesArray( $this->imageArray );

        return $this;
    }


	/**
     * Set root path for images
     *
     * @param $path
     * @return $this
     */
    public function setImageRoot($path)
    {
        $this->imageRoot = $path;

        return $this;
    }


	/**
     * Set array of images
     *
     * @param $images
     * @return $this
     */
    public function setImagesArray($images)
    {
        $this->imageArray = $images;

        return $this;
    }


	/**
     * Get available categories
     *
     * @return array
     */
    public function getCategories()
    {
        $cat = array();

        foreach ($this->imageArray as $key => $value) {
            array_push($cat, $key);
        }

        return $cat;
    }


	/**
     * Get random avatar image
     *
     * @return mixed
     */
    public function random()
    {
        return $this->loader
            ->setGender()
            ->loadImage();
    }


	/**
     * Get random man avatar image
     *
     * @return mixed
     */
    public function man()
    {
        return $this->loader
            ->setGender( 'man' )
            ->loadImage();
    }


	/**
     * Get random woman avatar image
     *
     * @return mixed
     */
    public function woman()
    {
        return $this->loader
            ->setGender( 'woman' )
            ->loadImage();
    }
}
