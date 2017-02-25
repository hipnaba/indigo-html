<?php
namespace IndigoTest\Html\Helper;

use Indigo\Html\Element\Element;
use Indigo\Html\Helper\AbstractHtmlHelper;
use PHPUnit\Framework\TestCase;
use PHPUnit_Framework_MockObject_MockObject;

class AbstractHelperTest extends TestCase
{
    /** @var AbstractHtmlHelper|PHPUnit_Framework_MockObject_MockObject */
    protected $helper;

    protected function setUp()
    {
        parent::setUp();

        $this->helper = $this->getMockForAbstractClass(AbstractHtmlHelper::class);
    }

    public function testHelperIsInvokable()
    {
        $helper = $this->helper;

        $this->assertTrue(is_callable($helper));
    }

    public function testHelperReturnsSelfWhenNoElementPassed()
    {
        $helper = $this->helper;

        $this->assertSame($helper, $helper());
    }

    public function testHelperCallsRenderIfElementPassed()
    {
        $element = new Element('div');

        $this->helper->expects($this->once())
                ->method('render')
                ->with($this->equalTo($element));

        $this->helper->render($element);
    }
}
