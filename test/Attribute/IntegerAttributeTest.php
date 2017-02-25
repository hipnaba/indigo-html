<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\IntegerAttribute;
use PHPUnit\Framework\TestCase;

/**
 * Class IntegerAttributeTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class IntegerAttributeTest extends TestCase
{
    /**
     * The attribute will throw an exception for non integer values
     *
     * @return void
     *
     * @expectedException \Indigo\Html\Exception\InvalidAttributeValueException
     */
    public function testValueIsValidated()
    {
        $attribute = new IntegerAttribute('tabindex');
        $attribute->setValue('non integer');
    }
}
