<?php
namespace Indigo\Html\Attribute;

use Indigo\Html\Element\ElementInterface;

/**
 * Class AttributeAwareTrait
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
trait AttributeAwareTrait
{
    /**
     * Stored attributes.
     *
     * @var AttributeInterface[]|AttributeList
     */
    protected $attributes;

    /**
     * Returns true if the element has an attribute.
     *
     * @param string $name Attribute name
     *
     * @return boolean
     */
    public function hasAttribute($name)
    {
        $attributes = $this->getAttributeList();
        return $attributes->has($name);
    }

    /**
     * Returns an element's attribute value.
     *
     * @param string $name Attribute name
     *
     * @return mixed
     */
    public function getAttribute($name)
    {
        $attributes = $this->getAttributeList();

        if ($attributes->has($name)) {
            return $attributes->get($name)->getValue();
        }
        return null;
    }

    /**
     * Set an element's attribute value
     *
     * @param string $name  Attribute name
     * @param mixed  $value Attribute value
     *
     * @return void
     */
    public function setAttribute($name, $value)
    {
        $attributes = $this->getAttributeList();
        $attributes->set($name, $value);
    }

    /**
     * Returns all attributes.
     *
     * @return AttributeList
     */
    public function getAttributes()
    {
        return $this->getAttributeList();
    }

    /**
     * Sets multiple attributes.
     *
     * @param array $attributes New element attributes
     *
     * @return void
     */
    public function setAttributes(array $attributes)
    {
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }
    }

    /**
     * Replaces element attributes with new ones.
     *
     * @param array $attributes New attributes
     *
     * @return void
     */
    public function replaceAttributes(array $attributes)
    {
        $this->clearAttributes();
        $this->setAttributes($attributes);
    }

    /**
     * Remove an element's attribute.
     *
     * @param string $name Name of the attribute to be removed
     *
     * @return void
     */
    public function removeAttribute($name)
    {
        $attributes = $this->getAttributeList();
        unset($attributes[$name]);
    }

    /**
     * Removes multiple attributes.
     *
     * @param array $names Names of attributes to be removed
     *
     * @return void
     */
    public function removeAttributes(array $names)
    {
        foreach ($names as $name) {
            $this->removeAttribute($name);
        }
    }

    /**
     * Removes all attributes from the element.
     *
     * @return void
     */
    public function clearAttributes()
    {
        $this->attributes = null;
    }

    /**
     * Returns the internal attribute list.
     *
     * @return AttributeInterface[]|AttributeList
     */
    protected function getAttributeList()
    {
        if (null === $this->attributes) {
            $this->attributes = new AttributeList(
                $this instanceof ElementInterface ? $this : null
            );
        }

        return $this->attributes;
    }
}
