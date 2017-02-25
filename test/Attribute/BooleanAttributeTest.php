<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\BooleanAttribute;
use PHPUnit\Framework\TestCase;

/**
 * Class BooleanAttributeTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class BooleanAttributeTest extends TestCase
{
    /**
     * The attribute's true value is the same as it's name.
     *
     * @return void
     */
    public function testCorrectValueIsSet()
    {
        $attribute = new BooleanAttribute('boolean');
        $attribute->setValue(true);

        $this->assertEquals('boolean', $attribute->getValue());
    }
}
