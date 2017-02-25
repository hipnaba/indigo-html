<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element\Element;
use PHPUnit\Framework\TestCase;

/**
 * Class ElementTest
 *
 * @package IndigoTest\Html\Element
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class ElementTest extends TestCase
{
    /**
     * Element should be configurable via the constructor
     *
     * @return void
     */
    public function testConfigurable()
    {
        $element = new Element('div', [
            'class' => 'name',
        ]);

        $this->assertEquals('div', $element->getTag());
        $this->assertEquals('name', $element->getAttribute('class'));
        $this->assertInstanceOf('Traversable', $element->getChildren());
    }

    /**
     * Elements should not accept invalid tag names
     *
     * @expectedException \Indigo\Html\Exception\InvalidTagNameException
     *
     * @return void
     */
    public function testWillThrowExceptionForInvalidTagName()
    {
        new Element('invalid');
    }

    /**
     * Elements should not accept invalid attribute names
     *
     * @expectedException \Indigo\Html\Exception\InvalidAttributeNameException
     *
     * @return void
     */
    public function testWillThrowExceptionForInvalidAttributeName()
    {
        new Element('div', [
            'invalid' => 'value',
        ]);
    }

    /**
     * Tags must define their own attributes
     *
     * @return void
     */
    public function testWillAcceptElementSpecificAttributes()
    {
        $element = new Element('base', [
            'href' => 'value',
        ]);

        $this->assertEquals('value', $element->getAttribute('href'));
    }

    /**
     * List type attributes should accept arrays for value
     *
     * @return void
     */
    public function testWillAcceptArrayForListAttribute()
    {
        $element = new Element('div', [
            'class' => ['one', 'two'],
        ]);

        $this->assertEquals('one two', $element->getAttribute('class'));
    }

    /**
     * Enum type attributes should only accept valid values
     *
     * @expectedException \Indigo\Html\Exception\InvalidAttributeValueException
     *
     * @return void
     */
    public function testWillThrowExceptionForInvalidEnumValue()
    {
        new Element('div', [
            'contenteditable' => 'invalid',
        ]);
    }

    /**
     * Enum type values can be converted
     *
     * @return void
     */
    public function testWillConvertBooleanToStringForEnums()
    {
        $element = new Element('div', [
            'contenteditable' => false,
            'tabindex' => -1,
        ]);

        $this->assertEquals('false', $element->getAttribute('contenteditable'));
    }

    /**
     * HasAttribute should return true for attributes not set but valid for the element
     *
     * @return void
     */
    public function testHasAttribute()
    {
        $element = new Element('a');

        $this->assertTrue($element->hasAttribute('href'));
        $this->assertNull($element->getAttribute('href'));
        $this->assertFalse($element->hasAttribute('invalid attribute'));
    }

    /**
     * Element will accept any attribute name starting with data-
     *
     * @return void
     */
    public function testCanWorkWithDataAttributes()
    {
        $element = new Element('div', [
           'data-test' => 'value',
        ]);

        $this->assertEquals('value', $element->getAttribute('data-test'));
    }

    /**
     * Element should properly handle boolean attributes
     *
     * @return void
     */
    public function testCanWorkWithBooleanAttributes()
    {
        $element = new Element('input');

        $this->assertTrue($element->hasAttribute('required'));
        $this->assertTrue(is_bool($element->getAttribute('required')));
        $this->assertFalse($element->getAttribute('required'));

        $element->setAttribute('required', true);

        $this->assertArrayHasKey('required', $element->getAttributes());

        $element->setAttribute('required', false);

        $this->assertArrayNotHasKey('required', $element->getAttributes());
    }

    /**
     * Integer type attributes should only accept numeric values
     *
     * @expectedException \Indigo\Html\Exception\InvalidAttributeValueException
     *
     * @return void
     */
    public function testWillThrowExceptionForInvalidIntegerValue()
    {
        new Element('div', [
            'tabindex' => 'not an integer',
        ]);
    }
}
