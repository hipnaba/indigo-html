<?php
namespace Indigo\Html\Attribute;

/**
 * An HTML Attribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class Attribute implements AttributeInterface
{
    /**
     * Attribute name
     *
     * @var string
     */
    protected $name;

    /**
     * Attribute value
     *
     * @var mixed
     */
    protected $value;

    /**
     * Attribute constructor.
     *
     * @param string     $name  Attribute name
     * @param mixed|null $value Attribute value
     */
    public function __construct($name, $value = null)
    {
        $this->name = $name;
        $this->setValue($value);
    }

    /**
     * {@inheritdoc}
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * {@inheritdoc}
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $value The new value
     *
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
}
