<?php
namespace IndigoTest\Html\Helper;

use Indigo\Html\Element\Element;
use Indigo\Html\Helper\AbstractHtmlHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

/**
 * Class AbstractHtmlHelperTest
 *
 * @package IndigoTest\Html\Helper
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class AbstractHtmlHelperTest extends TestCase
{
    /**
     * Helper used for testing
     *
     * @var AbstractHtmlHelper|PHPUnit_Framework_MockObject_MockObject
     */
    protected $helper;

    /**
     * {@inheritdoc}
     *
     * @return void
     */
    protected function setUp()
    {
        parent::setUp();

        $this->helper = $this->getMockForAbstractClass(AbstractHtmlHelper::class);
    }

    /**
     * The helper should be invokable
     *
     * @return void
     */
    public function testHelperIsInvokable()
    {
        $helper = $this->helper;

        $this->assertTrue(is_callable($helper));
    }

    /**
     * The helper should return itself when no element is sent
     *
     * @return void
     */
    public function testHelperReturnsSelfWhenNoElementPassed()
    {
        $helper = $this->helper;

        $this->assertSame($helper, $helper());
    }

    /**
     * The helper should call its render method when an element is sent
     *
     * @return void
     */
    public function testHelperCallsRenderIfElementPassed()
    {
        $element = new Element('div');

        $this->helper
            ->expects($this->once())
            ->method('render')
            ->with($this->equalTo($element));

        $helper = $this->helper;
        $helper($element);
    }
}
