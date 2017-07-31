<?php

namespace TODO;

class App
{
    public function __construct()
    {

        //Init
        add_action('plugins_loaded', array($this, 'init'));

        //Front-end stuff
        add_action('admin_enqueue_scripts', array($this, 'enqueueStyles'));
        add_action('admin_enqueue_scripts', array($this, 'enqueueScripts'));
    }

    /**
     * Init plugin classes
     * @return void
     */
    public function init()
    {
        new \TODO\Ticket();
    }

    /**
     * Enqueue required style
     * @return void
     */
    public function enqueueStyles()
    {
    }

    /**
     * Enqueue required scripts
     * @return void
     */
    public function enqueueScripts()
    {
    }
}
