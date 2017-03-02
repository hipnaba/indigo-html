<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element;
use Indigo\Html\ElementInterface;
use Indigo\Html\Helper\HtmlElement;
use Indigo\Test\TestUtilsTrait;
use PHPUnit\Framework\DOMTestCase;
use PHPUnit_Framework_MockObject_MockObject as MockObject;
use Zend\View\Helper\EscapeHtml;
use Zend\View\Helper\EscapeHtmlAttr;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Renderer\RendererInterface;

/**
 * Class HtmlElementTest
 *
 * @package IndigoTest\Html\Element
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class HtmlElementTest extends DOMTestCase
{
    use TestUtilsTrait;

    /**
     * The helper has the proper interface.
     *
     * @return void
     */
    public function testHelperInterface()
    {
        $helper = new HtmlElement();
        $element = $this->createMock(ElementInterface::class);

        $this->assertTrue(is_callable($helper));
        $this->assertSame($helper, $helper());
        $this->assertInternalType('string', $helper($element));
    }

    /**
     * The helper should provide default helpers.
     *
     * @return void
     */
    public function testHelperProvidesDefaultHelpers()
    {
        $helper = new HtmlElement();

        $indent = $this->callProtectedMethod($helper, 'getEscapeHtmlHelper');
        $this->assertInstanceOf(EscapeHtml::class, $indent);

        $renderObject = $this->callProtectedMethod($helper, 'getEscapeHtmlAttrHElper');
        $this->assertInstanceOf(EscapeHtmlAttr::class, $renderObject);
    }

    /**
     * The helper should try to fetch the plugins from the renderer.
     *
     * @return void
     */
    public function testHelperWillFetchPluginsFromTheRenderer()
    {
        /**
         * Resolver.
         *
         * @var RendererInterface|MockObject $renderer
         */
        $renderer = $this->createMock(PhpRenderer::class);
        $renderer
            ->expects($this->exactly(2))
            ->method('plugin')
            ->withConsecutive(
                ['escapeHtml'],
                ['escapeHtmlAttr']
            );

        $helper = new HtmlElement();
        $helper->setView($renderer);

        $this->callProtectedMethod($helper, 'getEscapeHtmlHelper');
        $this->callProtectedMethod($helper, 'getEscapeHtmlAttrHelper');
    }

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
