<?php

/**
 * Class for getting random avatar image
 *
 * @author Daniel Sitek <dan.sitek@gmail.com>
 */

namespace App\Avatar;

class Loader {

    /** @var string  $images_path  Set base path to image files */
    private $images_path = '/images';

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

    /** @var string|null  $image_file_path  Path to image file */
    private $image_file_path = null;

    /** @var string|null  $loaded_image  Image loaded to memory */
    // private $loaded_image = null;


    /**
     * Set root path to image files
     *
     * @param  string  $path  Root path to image files
     */
    public function set_images_root_path( $path )
    {
        $this->images_path = $path;

        return $this;
    }


    /**
     * Set array with images for loading
     *
     * @param  array  $images  Array with image file names
     */
    public function set_images_array( $images = array() )
    {
        $this->avatars = $images;

        return $this;
    }


    /**
     * Set gender for avatar image
     *
     * @param  string|null  $gender  Set avatar gender
     */
    public function set_gender( $gender = null )
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
    public function load_image()
    {
        $this->image_file_path = $this->get_image_file_path();

        return array(
            'file' => $this->image_file_path,
            'headers' => array(
                'Accept-Ranges' => 'bytes',
                'Content-Type' => 'image/png',
                'Content-Length' => strlen( file_get_contents( $this->image_file_path ) ),
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
    private function get_image_file_path()
    {
        return $this->images_path . $this->avatars[ $this->gender ][ array_rand( $this->avatars[ $this->gender ] ) ];
    }
}
