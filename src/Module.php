<?php
namespace Indigo\Html;

use Indigo\Html\Helper;
use Zend\ModuleManager\Feature\ViewHelperProviderInterface;
use Zend\ServiceManager\Factory\InvokableFactory;

class Module implements ViewHelperProviderInterface
{
    /**
     * {@inheritdoc}
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
