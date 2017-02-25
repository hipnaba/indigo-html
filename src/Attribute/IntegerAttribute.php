<?php
namespace Indigo\Html\Attribute;

use Indigo\Html\Exception;

/**
 * Class IntegerAttribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class IntegerAttribute extends Attribute
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
        if (!is_numeric($value)) {
            throw new Exception\InvalidAttributeValueException(
                'Invalid attribute value, must be an integer'
            );
        }

        parent::setValue($value);
    }
}
