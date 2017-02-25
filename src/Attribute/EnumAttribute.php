<?php
namespace Indigo\Html\Attribute;

use Indigo\Html\Exception;

/**
 * Class EnumAttribute
 *
 * @package Indigo\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class EnumAttribute extends Attribute
{
    /**
     * Valid values for this enum.
     *
     * @var array
     */
    protected $validValues = [];

    /**
     * Map used to translate values to enum values.
     *
     * @var array
     */
    protected $valueMap = [];

    /**
     * Sets the valid values for this enum.
     *
     * @param array $validValues Valid values
     *
     * @return void
     */
    public function setValidValues(array $validValues)
    {
        $this->validValues = $validValues;
    }

    /**
     * Sets the map used to transform values to enum values.
     *
     * @param array $valueMap The value map.
     *
     * @return void
     */
    public function setValueMap($valueMap)
    {
        $this->valueMap = $valueMap;
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
        if (is_bool($value)) {
            $value = intval($value);
        }

        if (array_key_exists($value, $this->valueMap)) {
            $value = $this->valueMap[$value];
        }

        if (!in_array($value, $this->validValues)) {
            throw new Exception\InvalidAttributeValueException(
                sprintf(
                    '%s is not a valid value, must be one of %s',
                    $value,
                    implode(', ', array_filter($this->validValues))
                )
            );
        }

        parent::setValue($value);
    }
}
