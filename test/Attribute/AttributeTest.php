<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\Attribute;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributeTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeTest extends TestCase
{
    /**
     * Attribute should be configurable via the constructor and via setters
     *
     * @return void
     */
    public function testConstructor()
    {
        $attribute = new Attribute('name', 'value');

        $this->assertEquals('name', $attribute->getName());
        $this->assertEquals('value', $attribute->getValue());

        $attribute->setValue('new');

        $this->assertEquals('new', $attribute->getValue());
    }
}
