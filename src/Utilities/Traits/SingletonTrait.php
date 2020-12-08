<?php

namespace App\Utilities\Traits;

trait SingletonTrait
{
    /**
     * @var
     */
    protected static $instance = null;

    /**
     * SingletonTrait constructor.
     */
    final private function __construct()
    {
        $this->init();
    }

    /**
     * @return null
     */
    final public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new static();
        }

        return static::$instance;
    }

    /**
     *
     */
    protected function init()
    {

    }

    /**
     *
     */
    final private function __wakeup()
    {

    }

    /**
     *
     */
    final private function __clone()
    {

    }
}