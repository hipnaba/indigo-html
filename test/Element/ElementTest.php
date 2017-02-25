<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element\Element;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
    public function testElementIsInitializedProperly()
    {
        $element = new Element('div', [
            'class' => 'name',
        ]);

        $this->assertEquals('div', $element->getTag());
        $this->assertEquals('name', $element->getAttribute('class'));
        $this->assertInstanceOf('Traversable', $element->getChildren());
    }

    /**
     * @expectedException \Indigo\Html\Exception\InvalidTagNameException
     */
    public function testWiillThrowExceptionForInvalidTagName()
    {
        new Element('invalid');
    }

    /**
     * @expectedException \Indigo\Html\Exception\InvalidAttributeNameException
     */
    public function testWillThrowExceptionForInvalidAttributeName()
    {
        new Element('div', [
            'invalid' => 'value',
        ]);
    }

    public function testWillAcceptElementSpecificAttributes()
    {
        $element = new Element('base', [
            'href' => 'value',
        ]);

        $this->assertEquals('value', $element->getAttribute('href'));
    }

    public function testWillAcceptTypedAttribute()
    {
        $element = new Element('link', [
            'class' => 'class-name',
        ]);

        $this->assertEquals('class-name', $element->getAttribute('class'));
    }

    public function testWillAcceptArrayForListAttribute()
    {
        $element = new Element('div', [
            'class' => ['one', 'two'],
        ]);

        $this->assertEquals('one two', $element->getAttribute('class'));
    }

    /**
     * @expectedException \Indigo\Html\Exception\InvalidAttributeValueException
     */
    public function testWillThrowExceptionForInvalidEnumValue()
    {
        new Element('div', [
            'contenteditable' => 'invalid',
        ]);
    }

    public function testWillAcceptValidEnumValues()
    {
        $element = new Element('div', [
            'contenteditable' => 'true',
        ]);

        $this->assertEquals('true', $element->getAttribute('contenteditable'));
    }

    public function testWillConvertBooleanToStringForEnums()
    {
        $element = new Element('div', [
            'contenteditable' => false,
            'tabindex' => -1,
        ]);

        $this->assertEquals('false', $element->getAttribute('contenteditable'));
    }

    public function testHasAttribute()
    {
        $element = new Element('a');

        $this->assertTrue($element->hasAttribute('href'));
        $this->assertNull($element->getAttribute('href'));
        $this->assertFalse($element->hasAttribute('invalid attribute'));
    }

    public function testCanWorkWithDataAttributes()
    {
        $element = new Element('div', [
           'data-test' => 'value',
        ]);

        $this->assertEquals('value', $element->getAttribute('data-test'));
    }

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
     * @expectedException \Indigo\Html\Exception\InvalidAttributeValueException
     */
    public function testWillThrowExceptionForInvalidIntegerValue()
    {
        new Element('div', [
            'tabindex' => 'not an integer',
        ]);
    }
}