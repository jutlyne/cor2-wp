<?php

namespace CorporateAdmin;

class CorporatePluginBase
{
    public function __construct()
    {
        $this->initializePluginClasses();
    }

    public function initializePluginClasses()
    {
        $classes = $this->getPluginClassList();
        foreach ($classes as $class) {
            if (class_exists($class)) {
                $this->initializeClass($class);
            }
        }
    }

    protected function initializeClass($class)
    {
        new $class();
    }

    protected function getPluginClassList()
    {
        return [
            AdminHandler::class
        ];
    }
}
