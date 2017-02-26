<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element;
use Indigo\Html\Element\Renderable;
use Indigo\Html\Helper\HtmlElement;
use Indigo\Html\Module;
use Indigo\View\ConfigProvider;
use PHPUnit\Framework\TestCase;
use Zend\ServiceManager\ServiceManager;
use Zend\Stdlib\ArrayUtils;
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

        $indigoView = new ConfigProvider();
        $module = new Module();

        $config = ArrayUtils::merge($indigoView->getViewHelperConfig(), $module->getViewHelperConfig());
        $helpers = new HelperPluginManager($container, $config);

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
        $content = new Element('strong');
        $content->setContent('content');

        $child = new Element('p');
        $child->append($content);

        $element = new Element('div');

        $element->append($child);
        $element->append($child);
        $element->append($child);

        $this->assertCount(3, $element->getChildren());

        $rendered = $this->helper->render($element);
        $expected = <<< EOS
<div>
    <p>
    <strong>content</strong>
</p>
    <p>
    <strong>content</strong>
</p>
    <p>
    <strong>content</strong>
</p>
</div>
EOS;

        $this->assertEquals($expected, $rendered);
    }

    /**
     * The helper will delegate rendering to other helpers if element implements RenderableInterface
     *
     * @return void
     */
    public function testWillDelegateRenderingForRenderableElements()
    {
        $object = ['key' => 'value'];
        $helper = function ($object) {
            return $object['key'];
        };

        $wrapper = new Renderable($object, $helper);

        $element = new Element('div');
        $element->append($wrapper);


        $rendered = $this->helper->render($element);
        $expected = <<< EOS
<div>
    value
</div>
EOS;

        $this->assertEquals($expected, $rendered);
    }
}
