<?php
/**
 * Module configuration.
 *
 * @package Indigo\Html
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
return [
    'view_helpers' => [
        'aliases' => [
            'htmlelement' => \Indigo\Html\Helper\HtmlElement::class,
            'htmlElement' => \Indigo\Html\Helper\HtmlElement::class,
            'HtmlElement' => \Indigo\Html\Helper\HtmlElement::class,
        ],
        'factories' => [
            \Indigo\Html\Helper\HtmlElement::class => \Zend\ServiceManager\Factory\InvokableFactory::class,
        ],
    ],
];
