<?php

/**
 * Singleton 
 * 
 * @since 0.1.0 
 * @package BFSB Project
 * @author Brainstormforce
 */

namespace Bfsb\Traits;

trait Singleton
{
    /**
     * Store the singleton object.
     */
    private static $singleton = false;

    /**
     * Fetch an instance of the class.
     */
    public static function getInstance()
    {
        if (self::$singleton === false) {
            self::$singleton = new self();
        }

        return self::$singleton;
    }

    public function wage()
    {
        return function_exists('bfsbp') && bfsbp()->wage();
    }
}
