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
    public function __construct($avatar_instance = null)
    {
        $this->app = new Silex\Application();
        $this->app[ 'debug' ] = true;

        if ($avatar_instance) {
            $this->avatar = $avatar_instance;
            return;
        }

        $this->avatar = new Avatar();
    }

    /**
     * Set using routes over https
     */
    public function use_https()
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
            $this->stream( $this->get_random_gender() );
        } );

        $this->app->get( '/{gender}', function( $gender ) {
            $this->stream( $this->get_defined_gender( $gender ) );
        } );

        $this->app->run();
    }

    /**
     * Render accepted image
     * @param  array  $data [description]
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
    private function get_random_gender()
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
    private function get_defined_gender($gender)
    {
        if ( !in_array( $gender, $this->avatar->get_categories() ) ) {

            $this->app->abort( 404, "There is no picture for the  \"{$gender}\" category." );
            return;
        }

        return $this->avatar
                    ->init()
                    ->{$gender}();

    }
}
