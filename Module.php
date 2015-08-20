<?php

namespace atuin\staticPage;


class Module extends \atuin\skeleton\Module
{

    protected static $_id = 'staticPage';

    protected static $_version = '0.0.1';

    public $is_core_module = 0;

    /**
     * Returns the module name. Must be set if the module it's not a core_module = 1
     */
    public function getName()
    {
        return 'Static Pages';
    }

    /**
     * Return the description of the module
     * 
     * @return string
     */
    public function getDescription()
    {
        return 'Static page system created with TinyMCE for the Atuin CMS.';
    }
}