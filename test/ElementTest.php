<?php
namespace IndigoTest\Html;

use Indigo\Html\Element;
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
     * Elements should be able to set tag specific attributes
     *
     * @return void
     */
    public function testCanSetTagSpecificAttributes()
    {
        $element = new Element('base');
        $element->setAttribute('href', 'value');

        $this->assertEquals('value', $element->getAttribute('href'));
    }

    /**
     * Elements should be able to set tag specific attributes via constructor
     *
     * @return void
     */
    public function testCanSetTagSpecificAttributesViaConstructor()
    {
        $element = new Element('base', [
            'href' => 'value',
        ]);

        $this->assertEquals('value', $element->getAttribute('href'));
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
     * Can append child elements.
     *
     * @return void
     */
    public function testCanAppendChildElements()
    {
        $element = new Element('div');

        $one = new Element('div');
        $two = new Element('div');

        $element->append($one);
        $element->append($two);

        $this->assertCount(2, $element);
    }
}
