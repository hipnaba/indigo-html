<?php
namespace Indigo\Html;

use Indigo\Html\Helper;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Provides configuration for other components.
 *
 * @package Indigo\Html
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class ConfigProvider
{
    /**
     * Returns the view helper manager configuration.
     *
     * @return array
     */
    public function getViewHelperConfig()
    {
        return [
            'aliases' => [
                'htmlElement' => Helper\HtmlElement::class,
            ],
            'factories' => [
                Helper\HtmlElement::class => InvokableFactory::class,
            ],
        ];
    }
}
