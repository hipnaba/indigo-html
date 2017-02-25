<?php
namespace Indigo\Html\Attribute;

use ArrayAccess;

/**
 * Class AttributeList
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeList implements ArrayAccess
{
    /**
     * Attributes stored in this list
     *
     * @var AttributeInterface[]
     */
    protected $attributes = [];

    /**
     * Factory used to build attributes
     *
     * @var AttributeFactory
     */
    protected $factory;

    /**
     * Returns the attribute factory.
     *
     * @return AttributeFactory
     */
    public function getFactory()
    {
        if (null === $this->factory) {
            $this->factory = new AttributeFactory();
        }

        return $this->factory;
    }

    /**
     * Sets the attribute factory.
     *
     * @param AttributeFactory $factory The factory to use.
     *
     * @return void
     */
    public function setFactory(AttributeFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Adds an attribute to the list
     *
     * @param AttributeInterface $attribute The attribute
     *
     * @return void
     */
    public function add(AttributeInterface $attribute)
    {
        $name = $attribute->getName();
        $this->attributes[$name] = $attribute;
    }

    /**
     * Returns true if the attribute with the given name exists in this list
     *
     * @param string $name Attribute name
     *
     * @return bool
     */
    public function has($name)
    {
        return array_key_exists($name, $this->attributes);
    }

    /**
     * Returns the attribute with the given name
     *
     * @param string $name Attribute name
     *
     * @return AttributeInterface|null
     */
    public function get($name)
    {
        return $this->has($name) ? $this->attributes[$name] : null;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $offset An offset to check for.
     *
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return $this->has($offset);
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $offset The offset to retreive.
     *
     * @return mixed
     */
    public function offsetGet($offset)
    {
        if ($this->has($offset)) {
            $attribute = $this->get($offset);
            return $attribute->getValue();
        }

        return null;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $offset The offset to assign a value to.
     * @param mixed $value  The value to set.
     *
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (!$this->has($offset)) {
            $factory = $this->getFactory();
            $attribute = $factory->create($offset);
            $this->add($attribute);
        }

        $attribute = $this->get($offset);
        $attribute->setValue($value);
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $offset The offset to unset.
     *
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }
}
