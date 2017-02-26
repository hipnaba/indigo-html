<?php
namespace Indigo\Html\Attribute;

/**
 * Interface HasAttributesInterface
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
interface AttributeAwareInterface
{
    /**
     * Returns true if the element has an attribute.
     *
     * @param string $name Attribute name
     *
     * @return boolean
     */
    public function hasAttribute($name);

    /**
     * Returns an element's attribute value.
     *
     * @param string $name Attribute name
     *
     * @return mixed
     */
    public function getAttribute($name);

    /**
     * Set an element's attribute value
     *
     * @param string $name  Attribute name
     * @param mixed  $value Attribute value
     *
     * @return void
     */
    public function setAttribute($name, $value);

    /**
     * Returns all attributes.
     *
     * @return array
     */
    public function getAttributes();

    /**
     * Sets multiple attributes.
     *
     * @param array $attributes New element attributes
     *
     * @return void
     */
    public function setAttributes($attributes);

    /**
     * Replaces element attributes with new ones.
     *
     * @param array $attributes New attributes
     *
     * @return void
     */
    public function replaceAttributes($attributes);

    /**
     * Remove an element's attribute.
     *
     * @param string $name Name of the attribute to be removed
     *
     * @return void
     */
    public function removeAttribute($name);

    /**
     * Removes multiple attributes.
     *
     * @param array $names Names of attributes to be removed
     *
     * @return void
     */
    public function removeAttributes(array $names);

    /**
     * Removes all attributes from the element.
     *
     * @return void
     */
    public function clearAttributes();
}
