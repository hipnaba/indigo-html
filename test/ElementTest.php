<?php
namespace IndigoTest\Html;

use Indigo\Html\Element\Element;
use PHPUnit\Framework\TestCase;

class ElementTest extends TestCase
{
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
        ]);

        $this->assertEquals('false', $element->getAttribute('contenteditable'));
    }
}
