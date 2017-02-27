<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\StringAttribute;
use PHPUnit\Framework\TestCase;

/**
 * Class StringAttributeTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class StringAttributeTest extends TestCase
{
    /**
     * The attribute should accept null as a valid value.
     *
     * @return void
     */
    public function testAcceptsNullForValue()
    {
        $attribute = new StringAttribute('value');
        $attribute->setValue(null);

        $this->assertEquals('', $attribute->getValue());
    }
}
