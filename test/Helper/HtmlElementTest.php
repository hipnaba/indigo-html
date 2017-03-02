<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element;
use Indigo\Html\Helper\HtmlElement;
use PHPUnit\Framework\DOMTestCase;

/**
 * Class HtmlElementTest
 *
 * @package IndigoTest\Html\Element
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class HtmlElementTest extends DOMTestCase
{
    /**
     * Can render elements without closing tags.
     *
     * @return void
     */
    public function testCanRenderElementsWithoutClosingTags()
    {
        $helper = new HtmlElement();
        $element = new Element('hr');

        $rendered = $helper($element);

        $this->assertEquals('<hr>', $rendered);
    }

    /**
     * Can render element with attributes.
     *
     * @return void
     */
    public function testCanRenderElementWithAttributes()
    {
        $helper = new HtmlElement();
        $element = new Element('hr', [
            'id' => 'my-hr',
            'class' => 'my-class',
        ]);

        $rendered = $helper($element);

        $this->assertEquals('<hr id="my-hr" class="my-class">', $rendered);
    }

    /**
     * Can render element with content.
     *
     * @return void
     */
    public function testCanRenderElementWithContent()
    {
        $helper = new HtmlElement();
        $element = new Element('div');
        $element->setContent('element content');

        $rendered = $helper($element);

        $this->assertEquals('<div>element content</div>', $rendered);
    }

    /**
     * Can render element with children
     *
     * @return void
     *
     * @noinspection PhpParamsInspection
     */
    public function testCanRenderElementWithChildren()
    {
        $helper = new HtmlElement();

        $content = new Element('strong');
        $content->setContent('content');

        $child = new Element('p');
        $child->append($content);

        $element = new Element('div');

        $element->append($child);
        $element->append($child);
        $element->append($child);

        $this->assertCount(3, $element->getChildren());
        $rendered = $helper($element);

        $this->assertSelectCount('div', 1, $rendered);
        $this->assertSelectCount('div > p > strong', 3, $rendered);
    }
}
