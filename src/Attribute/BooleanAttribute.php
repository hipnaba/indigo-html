<?php
namespace Indigo\Html\Attribute;

/**
 * Class BooleanAttribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class BooleanAttribute extends Attribute
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $value The new value
     *
     * @return void
     */
    public function setValue($value)
    {
        if ($value) {
            $value = $this->name;
        }

        parent::setValue($value);
    }
}
