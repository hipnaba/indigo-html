<?php
namespace IndigoTest\Html\Attribute;

use Indigo\Html\Element;
use PHPUnit\Framework\TestCase;

/**
 * Class CssClassAwareTest
 *
 * @package IndigoTest\Html\Attribute
 * @author  Danijel Fabijan <hipnaba@gmail.com>
 * @link    https://github.com/hipnaba/indigo-html
 */
class CssClassAwareTest extends TestCase
{
    /**
     * The common API.
     *
     * @return void
     */
    public function testCommonApi()
    {
        $element = new Element('button', [
            'class' => 'btn',
        ]);

        $this->assertEquals('btn', $element->getAttribute('class'));

        $element->addClass('btn-primary');
        $this->assertEquals('btn btn-primary', $element->getAttribute('class'));

        $element->replaceClass('btn-(primary|secondary)', 'btn-secondary');
        $this->assertEquals('btn btn-secondary', $element->getAttribute('class'));

        $element->removeClass('btn-(primary|secondary)');
        $this->assertEquals('btn', $element->getAttribute('class'));

        $element->addClass('button', true);
        $this->assertEquals('button btn', $element->getAttribute('class'));
    }
}
