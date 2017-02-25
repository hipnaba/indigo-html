<?php
namespace Indigo\Html;

use Indigo\Html\Helper;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

/**
 * Class Module
 *
 * @package Indigo\Html
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class Module implements ViewHelperProviderInterface
{
    /**
     * {@inheritdoc}
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
