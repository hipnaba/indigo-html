<?php
namespace IndigoTest\Html\Element;

use Indigo\Html\Element;
use Indigo\Html\Helper\HtmlElement;
use Indigo\Html\ConfigProvider as IndigoHtmlConfig;
use Indigo\View\ConfigProvider as IndigoViewConfig;
use PHPUnit\Framework\DOMTestCase;
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
class HtmlElementTest extends DOMTestCase
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

        $indigoView = new IndigoViewConfig();
        $indigoHtml = new IndigoHtmlConfig();

        $config = ArrayUtils::merge($indigoView->getViewHelperConfig(), $indigoHtml->getViewHelperConfig());
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

        $this->assertSelectCount('div', 1, $rendered);
        $this->assertSelectCount('div > p > strong', 3, $rendered);
    }
}
