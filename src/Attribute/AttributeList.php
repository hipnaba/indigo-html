<?php
namespace Indigo\Html\Attribute;

use ArrayAccess;
use Indigo\Html\Element\ElementInterface;

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
     * The element this attribute list belongs to.
     *
     * @var ElementInterface
     */
    protected $element;

    /**
     * Factory used to build attributes
     *
     * @var AttributeFactory
     */
    protected $factory;

    /**
     * AttributeList constructor.
     *
     * @param ElementInterface|null $element The element this list belongs to.
     */
    public function __construct(ElementInterface $element = null)
    {
        $this->element = $element;
    }

    /**
     * Returns the attribute factory.
     *
     * @return AttributeFactory
     */
    protected function getFactory()
    {
        if (null === $this->factory) {
            $this->factory = new AttributeFactory();
        }

        return $this->factory;
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
     * Sets an attribute value by it's name.
     *
     * @param string $name  The attribute name.
     * @param mixed  $value The new value.
     *
     * @return void
     */
    public function set($name, $value)
    {
        if (!$this->has($name)) {
            $factory = $this->getFactory();
            $attribute = $factory->create($name, $this->element);
            $this->add($attribute);
        }

        $attribute = $this->get($name);

        if ($attribute instanceof BooleanAttribute && !$value) {
            $this->remove($name);
            return;
        }

        $attribute->setValue($value);
    }

    /**
     * Removes an attribute from the list by name.
     *
     * @param string $name Attribute name.
     *
     * @return void
     */
    public function remove($name)
    {
        unset($this->attributes[$name]);
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
        $this->set($offset, $value);
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
        $this->remove($offset);
    }
}
