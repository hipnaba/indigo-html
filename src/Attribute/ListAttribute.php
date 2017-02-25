<?php
namespace Indigo\Html\Attribute;

/**
 * Class ListAttribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class ListAttribute extends Attribute
{
    /**
     * Seperator between list items.
     *
     * @var string
     */
    protected $separator = ' ';

    /**
     * Sets the list separator.
     *
     * @param string $separator The new separator.
     *
     * @return void
     */
    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    /**
     * {@inheritdoc}
     *
     * @param mixed $value The new value.
     *
     * @return void
     */
    public function setValue($value)
    {
        if (is_array($value)) {
            $value = implode($this->separator, $value);
        }

        parent::setValue($value);
    }
}
