<?php

/**
 * Setup url routes for Avatar app.
 *
 * @author Daniel Sitek <dan.sitek@gmail.com>
 */

namespace App;

use Silex;

class Router
{

    /** @var class  $app  Silex app class */
    private $app;

    /** @var class  $avatar  Avatar app class */
    private $avatar;


    /**
     * Construct Silex and Avatar app constructor
     */
    public function __construct($avatarInstance = null)
    {
        $this->app = new Silex\Application();

        if ($avatarInstance) {
            $this->avatar = $avatarInstance;
            return;
        }

        $this->avatar = new Avatar();
    }

    /**
     * Set using routes over https
     */
    public function useHttps()
    {
        $this->app['controllers']->requireHttps();

        return $this;
    }

    /**
     * Run Silex app
     */
    public function run()
    {

        $this->app->get( '/', function() {
            $this->stream( $this->getRandomGender() );
        } );

        $this->app->get( '/{gender}', function( $gender ) {
            $this->stream( $this->getDefinedGender( $gender ) );
        } );

        $this->app->run();
    }

    /**
     * Render accepted image
     *
     * @param  array $data [description]
     * @return string
     */
    private function stream( $data = array() )
    {
        foreach ($data['headers'] as $key => $value) {
            header("{$key}: {$value}");
        }

        return readfile($data['file']);
    }

    /**
     * Get random avatar image
     */
    private function getRandomGender()
    {
        return $this->avatar
                    ->init()
                    ->random();
    }

    /**
     * Get avatar image specified by gender
     *
     * @param  $gender  gender name
     */
    private function getDefinedGender($gender)
    {
        if ( !in_array( $gender, $this->avatar->getCategories() ) ) {

            return $this->app->abort( 404, "There is no picture for the  \"{$gender}\" category." );
        }

        return $this->avatar
                    ->init()
                    ->{$gender}();

    }
}
