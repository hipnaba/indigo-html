<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element\Element;
use Indigo\Html\Helper\HtmlElement;
use Indigo\Html\Module;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;

/**
 * Class HtmlElementTest
 *
 * @package IndigoTest\Html\Element
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class HtmlElementTest extends TestCase
{
    /**
     * The helper under test.
     *
     * @var HtmlElement
     */
    protected $helper;

    /**
     * Sets up the helper for testing.
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $container = new ServiceManager();
        $module = new Module();
        $helpers = new HelperPluginManager($container, $module->getViewHelperConfig());

        $renderer = new PhpRenderer();
        $renderer->setHelperPluginManager($helpers);

        $this->helper = $helpers->get('htmlElement');
    }


    /**
     * Can render elements without closing tags.
     *
     * @return void
     */
    public function testCanRenderElementsWithoutClosingTags()
    {
        $element = new Element('hr');
        $rendered = $this->helper->render($element);

        $this->assertEquals('<hr>', $rendered);
    }

    /**
     * Can render element with attributes.
     *
     * @return void
     */
    public function testCanRenderElementWithAttributes()
    {
        $element = new Element('hr', [
            'id' => 'my-hr',
            'class' => 'my-class',
        ]);

        $rendered = $this->helper->render($element);

        $this->assertEquals('<hr id="my-hr" class="my-class">', $rendered);
    }

    /**
     * Can render element with content.
     *
     * @return void
     */
    public function testCanRenderElementWithContent()
    {
        $element = new Element('div');
        $element->setContent('element content');

        $rendered = $this->helper->render($element);

        $this->assertEquals('<div>element content</div>', $rendered);
    }

    /**
     * Can render element with children
     *
     * @return void
     */
    public function testCanRenderElementWithChildren()
    {
        $p = new Element('p');
        $p->setContent('content');

        $element = new Element('div');
        $element->append($p);

        $this->assertCount(1, $element);

        $rendered = $this->helper->render($element);
        $expected = <<< EOS
<div>
    <p>content</p>
</div>
EOS;

        $this->assertEquals($expected, $rendered);
    }
}
