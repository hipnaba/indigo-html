<?php
namespace Indigo\Html\Attribute;

use Indigo\Html\Exception;

/**
 * String Attribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class StringAttribute extends Attribute
{
    /**
     * {@inheritdoc}
     *
     * @param mixed $value The new value.
     *
     * @return void
     */
    public function setValue($value)
    {
        if (is_object($value) && method_exists($value, '__toString')) {
            $value = $value->__toString();
        } elseif (null === $value) {
            $value = '';
        }

        if (!is_scalar($value)) {
            throw new Exception\InvalidAttributeValueException(
                "The value must be a string or castable to string"
            );
        }

        parent::setValue($value);
    }
}
