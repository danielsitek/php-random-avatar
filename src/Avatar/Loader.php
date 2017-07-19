<?php

/**
 * Class for getting random avatar image
 *
 * @author Daniel Sitek <dan.sitek@gmail.com>
 */

namespace App\Avatar;

class Loader {

    /** @var string  $imagesPath  Set base path to image files */
    private $imagesPath = '/images';

    /** @var array  $avatars  Array with available images */
    private $avatars = array(
        'man' => array(
            '/man/001.png'
        ),
        'woman' => array(
            '/woman/001.png'
        )
    );

    /** @var string|null  $gender  Gender of avatar image */
    private $gender = null;

    /** @var string|null  $imageFilePath  Path to image file */
    private $imageFilePath = null;


    /**
     * Set root path to image files
     *
     * @param  string $path Root path to image files
     * @return $this
     */
    public function setImagesRootPath( $path )
    {
        $this->imagesPath = $path;

        return $this;
    }


    /**
     * Set array with images for loading
     *
     * @param  array $images Array with image file names
     * @return $this
     */
    public function setImagesArray( $images = array() )
    {
        $this->avatars = $images;

        return $this;
    }


    /**
     * Set gender for avatar image
     *
     * @param  string|null $gender Set avatar gender
     * @return $this
     */
    public function setGender( $gender = null )
    {
        if ( ! isset( $gender ) ) {
            $this->gender = array_rand( $this->avatars );
            return $this;
        }

        $this->gender = $gender;
        return $this;
    }


    /**
     * Load image from filesystem and return array with path and headers
     */
    public function loadImage()
    {
        $this->imageFilePath = $this->getImageFilePath();

        return array(
            'file' => $this->imageFilePath,
            'headers' => array(
                'Accept-Ranges' => 'bytes',
                'Content-Type' => 'image/png',
                'Content-Length' => strlen( file_get_contents( $this->imageFilePath ) ),
                'X-Avatar-Gender' => $this->gender,
                'Expires' => 0,
                'Cache-Control' => 'no-cache, no-store, must-revalidate',
                'Pragma' => 'no-cache'
            )
        );
    }


    /**
     * Get path to image file
     */
    private function getImageFilePath()
    {
        return $this->imagesPath . $this->avatars[ $this->gender ][ array_rand( $this->avatars[ $this->gender ] ) ];
    }
}
