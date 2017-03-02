<?php
namespace Indigo\Html;

use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\ModuleManager\Feature\DependencyIndicatorInterface;

/**
 * ZF2 Module.
 *
 * @package Indigo\Html
 * @author  Danijel Fabijan <danijel.fabijan@bruckom.hr>
 * @link    https://github.com/hipnaba/indigo-view
 */
class Module implements
    DependencyIndicatorInterface,
    ConfigProviderInterface
{
    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Expected to return an array of modules on which the current one depends on
     *
     * @return array
     */
    public function getModuleDependencies()
    {
        return ['Indigo\View'];
    }
}
