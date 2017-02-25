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
}
