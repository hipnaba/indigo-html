<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\EnumAttribute;
use PHPUnit\Framework\TestCase;

/**
 * Class EnumAttributeTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class EnumAttributeTest extends TestCase
{
    /**
     * Attribute should convert value if valueMap provided
     *
     * @return void
     */
    public function testValueIsConverted()
    {
        $attribute = new EnumAttribute('attr', [
            'validValues' => ['one', 'two'],
            'valueMap' => [
                1 => 'one',
                0 => 'two',
            ],
        ]);

        $attribute->setValue(1);
        $this->assertEquals('one', $attribute->getValue());

        $attribute->setValue(false);
        $this->assertEquals('two', $attribute->getValue());
    }

    /**
     * Attribute should not accept values not found in validValues
     *
     * @return void
     *
     * @expectedException \Indigo\Html\Exception\InvalidAttributeValueException
     */
    public function testWillThrowExceptionForInvalidValue()
    {
        $attribute = new EnumAttribute('attr');
        $attribute->setValue('doesnt exist');
    }
}
