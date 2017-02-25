<?php
namespace Indigo\Html\Attribute;

/**
 * An HTML attribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
interface AttributeInterface
{
    /**
     * Returns the attribute's name
     *
     * @return string
     */
    public function getName();

    /**
     * Returns the attribute's value
     *
     * @return mixed
     */
    public function getValue();

    /**
     * Sets the attribute value
     *
     * @param mixed $value The new value
     *
     * @return void
     */
    public function setValue($value);
}
