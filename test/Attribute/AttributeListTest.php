<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Attribute\AttributeList;
use Indigo\Html\Element\Element;
use PHPUnit\Framework\TestCase;

/**
 * Class AttributeListTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AttributeListTest extends TestCase
{
    /**
     * Setting a boolean attribute to false removes it from the list
     *
     * @return void
     */
    public function testSettingsBooleanToFalseRemovesIt()
    {
        $element = new Element('input');
        $attributes = new AttributeList($element);

        $attributes->set('required', true);

        $this->assertArrayHasKey('required', $attributes);
        $this->assertEquals('required', $attributes['required']);

        $attributes['required'] = false;

        $this->assertArrayNotHasKey('required', $attributes);
    }

    /**
     * If an attribute is not set it has a value of null.
     *
     * @return void
     */
    public function testReturnsNullIfAttributeNotSet()
    {
        $attributes = new AttributeList();

        $this->assertNull($attributes['id']);
    }
}
